<?php
    header('Content-Type: application/json');
    ini_set('display_errors', 1);
    error_reporting(E_ALL);
    $connect = new PDO("mysql:host=localhost;dbname=quyen", "root", "");

    $sql = "SELECT * FROM Meals";
    $result = $connect->query($sql);


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

class Meal
{
    public $id;
    public $name;
    public $description;
    public $calories;
    public $prep_time;
    public $difficulty;
    public $instruction;
    public $image_url;
    public $nutrition;
    public $tags;
    public $type;
    public $ingredients;
    public $create_at;
    public $status;


    public function __construct(
        $id,
        $name,
        $description,
        $calories,
        $prep_time,
        $instruction,
        $image_url,
        $nutrition,
        $tags,
        $type,
        $ingredients,
        $create_at,
        $status
    ) {
        $this->id = $id;
        $this->name = $name;
        $this->description = $description;
        $this->calories = $calories;
        $this->prep_time = $prep_time;
        $this->instruction = explode("\n", $instruction);
        $this->image_url = $image_url;
        $this->nutrition = $nutrition;
        $this->tags = explode("\n", $tags);
        $this->type = explode("\n", $type);
        $this->ingredients = $ingredients;
        $this->create_at = $create_at;
        $this->status = $status;
    }
}





$nutrition_sql = "SELECT nutrition.name, amount 
    FROM meal_nutrition 
    JOIN nutrition ON meal_nutrition.nutrition_id = nutrition.id 
    WHERE meal_nutrition.meal_id = ?";



while ($row = $result->fetch(PDO::FETCH_ASSOC)) {

    $result_nutrition = [];
    $nutri = $connect->prepare($nutrition_sql);
    $nutri->execute([$row['id']]);
    $result_nutrition = $nutri->fetchAll(PDO::FETCH_ASSOC);
    $nutritions = new nutrition(
        $result_nutrition[0]["amount"],
        $result_nutrition[1]["amount"],
        $result_nutrition[2]["amount"],
        $result_nutrition[3]["amount"],
        $result_nutrition[4]["amount"],
        $result_nutrition[5]["amount"]
    );

    

    $Meal = new Meal(
        $row['id'],
        $row['name'],
        $row['description'],
        $row['Calories'],
        $row['prep_time'],
        $row['instructions'],
        $row['image_url'],
        $nutritions,
        $row['tags'],
        $row['type'],
        $row['ingredients'],
        $row['created_at'], 
        $row['status']
    );
    $meals[] = $Meal;
};

   if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $name = $_POST['name'] ?? "";
        $prep_time = $_POST['prep_time']?? "";
        $calories = $_POST['calories'] ?? "";
        $status = $_POST['status'] ?? "";
        $description = $_POST['description'] ?? "";
        $instructions = $_POST['instructions'] ?? "";
        $ingredients = $_POST['ingredients'] ?? "";

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
        $targetFile = null;
        if (isset($_FILES['image']) && $_FILES['image']['error'] === UPLOAD_ERR_OK) {
            $fileName = uniqid() . "-" . basename($_FILES["image"]["name"]);
            $targetFile = $targetDir . $fileName;

            if (move_uploaded_file($_FILES["image"]["tmp_name"], $targetFile)) {
                $response = [
                    "status" => "success",
                    "path" => $targetFile // hoặc chỉ $fileName nếu chỉ cần tên ảnh
                ];
            }
        }
        // tags, meal_types, 2 bảng riêng cần insert
        try {
        $pdo = new PDO("mysql:host=localhost;dbname=quyen", "root", "");
        $stmt = $pdo->prepare("INSERT INTO meals 
            (name, prep_time,  description, instructions, status, image_url, ingredients, Calories, tags, type) 
            VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");

        $stmt->execute([
            $name, $prep_time, $description, $instructions, $status, $targetFile,$ingredients,$calories, $tags, $meal_types 
        ]);

            echo json_encode([
                "status" => "success",
                "path" => $targetFile // hoặc chỉ $fileName nếu chỉ cần tên ảnh
            ]);
        } catch (Exception $e) {
            echo json_encode(["status" => "error", "message" => $e->getMessage()]);
        }
    }

    file_put_contents('meals.json', json_encode($meals, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE));


        
    $targetDir = "uploads/";
    if (!is_dir($targetDir)) {
        mkdir($targetDir, 0777, true);
    }

 


    $connect = null;
?>