<?php
require_once "configuration/Database.php";
    header('Content-Type: application/json');
    ini_set('display_errors', 1);
    error_reporting(E_ALL);
    $db = new Database();
    $connect = $db->getConnection();


   if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $name = trim($_POST['name'] ?? "");
        $prep_time = trim($_POST['prep_time'] ?? "") ;
        $calories = trim($_POST['calories'] ?? "");
        $status = trim($_POST['status'] ?? "");
        $description = trim($_POST['description'] ?? "");
        $instructions = trim($_POST['instructions'] ?? "");
        $ingredients = trim($_POST['ingredients'] ?? "");

        // Lấy checkbox mảng: tags, meal_types
        $tags = isset($_POST['hashtags']) ? $_POST['hashtags'] : '';
        $meal_types = isset($_POST['meal_types']) ? implode(',', (array)$_POST['meal_types']) : '';
        // Dinh dưỡng
        $nutrition = [];

        $protein = $_POST['protein'] ?? 0;
        $carbs = $_POST['carbs'] ?? 0;
        $fats = $_POST['fats'] ?? 0;
        $fiber = $_POST['fiber'] ?? 0;
        $sugar = $_POST['sugar'] ?? 0;
        $sodium = $_POST['sodium'] ?? 0;
        
        $nutrition = [$protein, $fats,  $carbs, $fiber, $sugar, $sodium];

        // Xử lý ảnh
        $targetDir = "../images/";

        if (!is_dir($targetDir)) {
            mkdir($targetDir, 0777, true);
        }
        $targetFile = null;
        $fileName = null;
        if (isset($_FILES['image']) && $_FILES['image']['error'] === UPLOAD_ERR_OK) {
            $originalName = basename($_FILES["image"]["name"]);
            $timestamp = date("Ymd_His");
            $fileName = $timestamp . "-" . $originalName;
            $targetFile = $targetDir . $fileName;

            if (move_uploaded_file($_FILES["image"]["tmp_name"], $targetFile)) {
                $response = [
                    "status" => "success",
                    "path" => "assets/images/" . $fileName // hoặc chỉ $fileName nếu chỉ cần tên ảnh
                ];
            }
        }
        // tags, meal_types, 2 bảng riêng cần insert
        try {
        $stmt = $connect->prepare("INSERT INTO meals 
            (name, prep_time,  description, instructions, status, image_url, ingredients, Calories, tags, type) 
            VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");

        $stmt->execute([
            $name, $prep_time, $description, $instructions, $status, "assets/images/" . $fileName,$ingredients,$calories, $tags, $meal_types 
        ]);

            echo json_encode([
                "status" => "success",
                "path" => "assets/images/" . $fileName
            ]);
        } catch (Exception $e) {
            echo json_encode(["status" => "error", "message" => $e->getMessage()]);
        }
        $acc = $connect->prepare("SELECT id from meals WHERE name = ?");
        $acc->execute([$name]);  
        $meal = $acc->fetch(PDO::FETCH_ASSOC);
        $id = $meal['id'];                  

        
        for ($i=1; $i < 7; $i++) { 
            $stmt = $connect->prepare("INSERT INTO meal_nutrition (meal_id, nutrition_id, amount) 
            VALUES (?, ?, ?)");
            $stmt->execute([$id, $i, $nutrition[$i-1]]);
        }
            


    }



        
    

 


    $connect = null;
?>