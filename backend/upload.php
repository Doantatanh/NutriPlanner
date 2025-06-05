<?php
    $connect = new PDO("mysql:host=localhost;dbname=quyen", "root", "");
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
        
    $targetDir = "uploads/";
    if (!is_dir($targetDir)) {
        mkdir($targetDir, 0777, true);
    }

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $name = $_POST['name'];
        $prep_time = $_POST['prep_time'];
        $calories = $_POST['calories'];
        $status = $_POST['status'];
        $description = $_POST['description'];
        $instructions = $_POST['instructions'];

        // Lấy checkbox mảng: tags, meal_types
        $tags = isset($_POST['tags']) ? implode(',', (array)$_POST['tags']) : '';
        $meal_types = isset($_POST['meal_types']) ? implode(',', (array)$_POST['meal_types']) : '';
        // Dinh dưỡng
        $protein = $_POST['protein'] ?? 0;
        $carbs = $_POST['carbs'] ?? 0;
        $fats = $_POST['fats'] ?? 0;
        $fiber = $_POST['fiber'] ?? 0;
        $sugar = $_POST['sugar'] ?? 0;
        $sodium = $_POST['sodium'] ?? 0;
        

        // Xử lý ảnh
        $image_path = null;
        if (isset($_FILES['image']) && $_FILES['image']['error'] === UPLOAD_ERR_OK) {
            $fileName = uniqid() . "-" . basename($_FILES["image"]["name"]);
            $targetFile = $targetDir . $fileName;

            if (move_uploaded_file($_FILES["image"]["tmp_name"], $targetFile)) {
                $image_path = $targetFile;
            }
        }
        // tags, meal_types, 2 bảng riêng cần insert
        try {
        $pdo = new PDO("mysql:host=localhost;dbname=quyen", "root", "");
        $stmt = $pdo->prepare("INSERT INTO meals 
            (name, prep_time,  description, instructions, status, image_path, create_at, Calories) 
            VALUES (?, ?, ?, ?, ?, ?, ?, ?)");

        $stmt->execute([
            $name, $prep_time, $tags, $meal_types, $description, $instructions, $status, $image_path,$ingredients
        ]);

            echo json_encode(["status" => "success", "image_path" => $image_path]);
        } catch (Exception $e) {
            echo json_encode(["status" => "error", "message" => $e->getMessage()]);
        }






    }


    $connect = null;
?>