<?php
//thiết lập cho dữ liệu trả về form và json
header('Content-Type: application/json');
require_once __DIR__ . '/configuration/Database.php';

// nhận dữ liệu từ form 
$db = new Database();
$conn = $db->getConnection();
$search_query = trim($_GET['search_query'] ?? '');
$meal_type = $_GET['meal_type'] ?? 'all';
$diet_type = $_GET['diet_type'] ?? 'all';
$calories = $_GET['calories'] ?? 'all';

$CategoryMap = [
    'breakfast' => 1,
    'lunch' => 2,
    'dinner' => 3,
    'snack' => 4,
    'smoothie' => 5
];

$sql = "SELECT m.id, m.name, m.image_url as image, m.prep_time, m.tags, m.calories
FROM Meals m
WHERE 1=1";

$params = [];

if ($search_query !== '') {
    $sql .= " AND m.name LIKE :search_query";
    $params[':search_query'] = '%' . $search_query . '%';
}

if ($meal_type !== 'all' && isset($CategoryMap[$meal_type])) {
    $sql .= " AND m.category_id = :category_id";
    $params[':category_id'] = $CategoryMap[$meal_type];
}

if ($diet_type !== 'all') {
    $sql .= " AND m.tags = :diet_type";
    $params[':diet_type'] = '%' . $diet_type . '%';
}

switch ($calories) {
    case 'under200':
        $sql .= " AND m.calories < 200";
        break;
    case '200-400':
        $sql .= " AND m.calories BETWEEN 200 AND 400";
        break;
    case '400-600':
        $sql .= " AND m.calories BETWEEN 400 AND 600";
        break;
    case 'over600':
        $sql .= " AND m.calories > 600";
        break;
}

try {
    $stmt = $conn->prepare($sql);
    $stmt->execute($params);
    $meals = $stmt->fetchAll(PDO::FETCH_ASSOC);
    echo json_encode($meals);
} catch (PDOException $e) {
    echo json_encode([]);
}
