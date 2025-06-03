<?php
// Thiết lập header để trả về dữ liệu dạng JSON
header('Content-Type: application/json');

// Import file cấu hình kết nối database
require_once __DIR__ . '/configuration/Database.php';

try {
    // Khởi tạo kết nối database
    $db = new Database();
    $conn = $db->getConnection();

    // Lấy tham số GET, nếu không có thì để rỗng/all
    $search_query = trim($_GET['search_query'] ?? '');
    $meal_type = $_GET['meal_type'] ?? 'all';
    $diet_type = $_GET['diet_type'] ?? 'all';
    $calories = $_GET['calories'] ?? 'all';

    // Xây dựng câu truy vấn SQL cơ bản
    // - Sử dụng DISTINCT để loại bỏ các kết quả trùng lặp
    // - LEFT JOIN để lấy thông tin từ các bảng liên quan
    // - GROUP_CONCAT để gom nhóm các tags và types thành một chuỗi
    $sql = "SELECT m.id, m.name, m.image_url as image, m.prep_time, m.Calories,
                   GROUP_CONCAT(DISTINCT t.name) as meal_types,
                   GROUP_CONCAT(DISTINCT tag.name) as diet_tags
            FROM Meals m
            LEFT JOIN Meal_Types mt ON m.id = mt.meal_id
            LEFT JOIN Type t ON mt.type_id = t.id
            LEFT JOIN Meal_Tags mtag ON m.id = mtag.meal_id
            LEFT JOIN Tags tag ON mtag.tag_id = tag.id
            LEFT JOIN Meal_Ingredients mi ON m.id = mi.meal_id
            LEFT JOIN Ingredients i ON mi.ingredient_id = i.id
            WHERE 1=1";

    // Mảng chứa các tham số cho prepared statement
    $params = [];

    // Nếu có search_query thì thêm điều kiện
    if ($search_query !== '') {
        $sql .= " AND (m.name LIKE :search_query OR i.name LIKE :search_query)";
        $params[':search_query'] = '%' . $search_query . '%';
    }

    // Thêm điều kiện lọc theo loại bữa ăn nếu không chọn 'Tất cả'
    if ($meal_type !== 'all') {
        $sql .= " AND t.id = :meal_type";
        $params[':meal_type'] = $meal_type;
    }

    // Thêm điều kiện lọc theo chế độ ăn nếu không chọn 'Tất cả'
    if ($diet_type !== 'all') {
        $sql .= " AND tag.id = :diet_type";
        $params[':diet_type'] = $diet_type;
    }

    // Thêm điều kiện lọc theo calories
    switch ($calories) {
        case 'under300':
            $sql .= " AND m.Calories < 300";
            break;
        case '300-500':
            $sql .= " AND m.Calories BETWEEN 300 AND 500";
            break;
        case '500-800':
            $sql .= " AND m.Calories BETWEEN 500 AND 800";
            break;
        case 'over800':
            $sql .= " AND m.Calories > 800";
            break;
    }

    // Thêm GROUP BY để gom nhóm kết quả và ORDER BY để sắp xếp
    $sql .= " GROUP BY m.id, m.name, m.image_url, m.prep_time, m.Calories
              ORDER BY m.name ASC";

    // Chuẩn bị và thực thi câu truy vấn
    $stmt = $conn->prepare($sql);
    $stmt->execute($params);

    // Lấy tất cả kết quả
    $meals = $stmt->fetchAll(PDO::FETCH_ASSOC);

    // Xử lý và format dữ liệu trước khi trả về
    $result = array_map(function ($meal) {
        return [
            'id' => $meal['id'],
            'name' => $meal['name'],
            'image' => $meal['image'],
            'prep_time' => $meal['prep_time'],
            'calories' => $meal['Calories'],
            // Chuyển chuỗi tags và types thành mảng
            'meal_types' => $meal['meal_types'] ? explode(',', $meal['meal_types']) : [],
            'diet_tags' => $meal['diet_tags'] ? explode(',', $meal['diet_tags']) : []
        ];
    }, $meals);

    // Trả về kết quả dạng JSON với status success
    echo json_encode([
        'status' => 'success',
        'data' => $result
    ]);
} catch (PDOException $e) {
    // Xử lý lỗi nếu có
    // Trả về status code 500 (Internal Server Error)
    http_response_code(500);
    // Trả về thông báo lỗi dạng JSON
    echo json_encode([
        'status' => 'error',
        'message' => 'Database error: ' . $e->getMessage()
    ]);
}
