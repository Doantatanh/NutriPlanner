<?php
// Trả về định dạng JSON
header("Content-Type: application/json");





// Cấu hình kết nối PDO
$host = 'localhost';
$db   = 'quyen';
$user = 'root';
$pass = '';
$charset = 'utf8mb4';

$dsn = "mysql:host=$host;dbname=$db;charset=$charset";
$options = [
    PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION, // Bắt lỗi rõ ràng
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,       // Kết quả dạng mảng kết hợp
    PDO::ATTR_EMULATE_PREPARES   => false,                  // Tắt giả lập
];

$pdo = new PDO($dsn, $user, $pass, $options);


if ($_SERVER['REQUEST_METHOD'] === 'GET') {
        $stmt = $pdo->query("SELECT * name FROM  favourites
        JOIN nutrition ON meals.id = meal_id");
        $favourites = $stmt->fetchAll();
        echo json_encode(["success" => true, "data" => $favourites]);
        exit();
    
}
if($_SERVER['REQUEST_METHOD'] === 'POST'){
    try {

        // Đọc dữ liệu JSON từ JavaScript
        $data = json_decode(file_get_contents("php://input"), true);
    
        // Kiểm tra dữ liệu đầu vào
        if (!isset($data['id']) || !isset($data['name']) || !isset($data['action'])) {
        echo json_encode(["success" => false, "message" => "Thiếu dữ liệu"]);
        exit();
        }

            // Lấy thông tin
        $meal_id = $data['id'];
        $meal_name = $data['name'];
        $action = $data['action'];
    
        if ($action === "add") {
            // Thêm nếu chưa tồn tại
            $stmt = $pdo->prepare("INSERT IGNORE INTO favourites (meal_id, name) VALUES (?, ?)");
            $stmt->execute([$meal_id, $meal_name]);
            echo json_encode(["success" => true]);
        } elseif ($action === "remove") {
            // Xóa bản ghi
            $stmt = $pdo->prepare("DELETE FROM favourites WHERE meal_id = ?");
            $stmt->execute([$meal_id]);
            echo json_encode(["success" => true]);
        } else {
            echo json_encode(["success" => false, "message" => "Hành động không hợp lệ"]);
        }
    
    } catch (PDOException $e) {
        echo json_encode(["success" => false, "message" => "Lỗi DB: " . $e->getMessage()]);
    }
    
}


