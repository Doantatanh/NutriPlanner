<?php
session_start();
// Trả về định dạng JSON
header("Content-Type: application/json");




require_once 'configuration/Database.php';
$db = new Database();
$pdo = $db->getConnection();

class nutrition
{
    public $protein;
    public $fat;
    public $carb;
    public $fiber;
    public $sugar;
    public $sodium;

    public function __construct($protein, $fat, $carb, $fiber, $sugar, $sodium)
    {
        $this->protein = $protein;
        $this->fat = $fat;
        $this->carb = $carb;
        $this->fiber = $fiber;
        $this->sugar = $sugar;
        $this->sodium = $sodium;
    }
}

if ($_SERVER['REQUEST_METHOD'] === 'GET') {
        // $stmt = $pdo->query("SELECT * FROM  favourites
        // JOIN meals ON meals.id = favourites.meal_id");
        $user_id = $_SESSION['user_id'];
        $stmt = $pdo->prepare("
            SELECT *
            FROM favourites
            JOIN meals ON meals.id = favourites.meal_id
            WHERE favourites.user_id = ? AND favourites.status = 1
        ");
        $stmt->execute([$user_id]);
        $favourites =[];
        while($row = $stmt->fetch(PDO::FETCH_ASSOC)){
            $row['tags'] = explode(",", $row['tags']);
            $row['type'] = explode(",", $row['type']);
            $row['instruction'] = $row["instructions"];
            $nutrition_sql = "SELECT amount 
            FROM meal_nutrition 
            JOIN nutrition ON meal_nutrition.nutrition_id = nutrition.id 
            WHERE meal_nutrition.meal_id = ?";
            $nutri = $pdo->prepare($nutrition_sql);
            $nutri->execute([$row['id']]);
            $result_nutrition = $nutri->fetchAll(PDO::FETCH_COLUMN);
            $nutritions = new nutrition(
                $result_nutrition[0] ?? 0,
                $result_nutrition[1] ?? 0,
                $result_nutrition[2] ?? 0,
                $result_nutrition[3] ?? 0,
                $result_nutrition[4] ?? 0,
                $result_nutrition[5] ?? 0
            );
            $row["nutrition"] = $nutritions;
            $favourites[]=$row;
        }
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


        $user_id = $_SESSION['user_id'];
        $meal_id = $data['id'];
        $meal_name = $data['name'];
        $action = $data['action'];

        if ($action === "add") {
            // Kiểm tra nếu đã tồn tại rồi thì chỉ cần bật status lên 1
            $stmt = $pdo->prepare("SELECT * FROM favourites WHERE meal_id = ? AND user_id = ?");
            $stmt->execute([$meal_id, $user_id]);
            $existing = $stmt->fetch(PDO::FETCH_ASSOC);

            if ($existing) {
                // Nếu có rồi, chỉ cần update status
                $stmt = $pdo->prepare("UPDATE favourites SET status = 1 WHERE meal_id = ? AND user_id = ?");
                $stmt->execute([$meal_id, $user_id]);
            } else {
                // Nếu chưa có, thêm mới
                $stmt = $pdo->prepare("INSERT INTO favourites (meal_id, name, user_id, status) VALUES (?, ?, ?, 1)");
                $stmt->execute([$meal_id, $meal_name, $user_id]);
            }

            echo json_encode(["success" => true]);
        }
        elseif ($action === "remove") {
            // Ẩn
            $stmt = $pdo->prepare("UPDATE favourites SET status = 0 WHERE meal_id = ? AND user_id = ?");
            $stmt->execute([$meal_id, $user_id]);
            echo json_encode(["success" => true]);
        }
        else {
            echo json_encode(["success" => false, "message" => "Hành động không hợp lệ"]);
        }
    
    } catch (PDOException $e) {
        echo json_encode(["success" => false, "message" => "Lỗi DB: " . $e->getMessage()]);
    }
    
}


