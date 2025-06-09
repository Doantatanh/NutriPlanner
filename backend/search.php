<?php
require_once 'configuration/Database.php';
$db = new Database();
$connect = $db->getConnection();
header("Content-Type: application/json");
$data = json_decode(file_get_contents("php://input"), true);

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

    $params = [];

    $sql = "SELECT m.id , m.name, m.description, m.ingredients, m.calories, m.prep_time ,m.instructions ,m.image_url, m.tags, m.type from meals m 

        WHERE 1 = 1";
    $meal_type = isset($data['type']) ? $data['type'] : "";
    $meal_diet = isset($data["diet"]) ? $data["diet"] : "";
    $meal_calo = isset($data["calo"]) ? $data["calo"] : "";

    


    if(!empty($data['name'])){
        $sql .= " AND m.name LIKE ?";
        $params[] = "%" . $data['name'] . "%";

    }

    if(!empty($meal_diet)){
        $sql .= " AND m.tags LIKE ?";
        $params[] = "%" . $meal_diet . "%"; 
    }

    if(!empty($meal_type)){
        $sql .= " AND m.type = ?";
        $params[] = $meal_type; 
    }

    if(!empty($meal_calo)){
        if ($meal_calo === "under300") {
            $sql .= " AND m.calories < ?";
            $params[] = 300;
        } elseif ($meal_calo === "300-500") {
            $sql .= " AND m.calories >= ? AND m.calories <= ?";
            $params[] = 300;
            $params[] = 500;
        } elseif ($meal_calo === "500-800") {
            $sql .= " AND m.calories >= ? AND m.calories <= ?";
            $params[] = 500;
            $params[] = 800;
        } elseif ($meal_calo === "over800") {
            $sql .= " AND m.calories > ?";
            $params[] = 800;
        }
    }

$nutrition_sql = "SELECT nutrition.name, amount 
    FROM meal_nutrition 
    JOIN nutrition ON meal_nutrition.nutrition_id = nutrition.id 
    WHERE meal_nutrition.meal_id = ?";

$stmt = $connect->prepare($sql);
    $arr = $stmt->execute($params);
$result = [];

while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {

    $nutri = $connect->prepare($nutrition_sql);
    $nutri->execute([$row['id']]);
    $result_nutrition = $nutri->fetchAll(PDO::FETCH_ASSOC);
    if (count($result_nutrition) >= 2) {
        $nutritions = new nutrition(
            $result_nutrition[0]["amount"],
            $result_nutrition[1]["amount"],
            $result_nutrition[2]["amount"],
            $result_nutrition[3]["amount"],
            $result_nutrition[4]["amount"],
            $result_nutrition[5]["amount"]
        );
    } else {
        // Gán giá trị mặc định hoặc xử lý khi không đủ dữ liệu
        $nutritions = new nutrition(0, 0, 0, 0, 0, 0); // hoặc null tùy cách bạn xử lý
    }
    $row['nutrition'] = $nutritions;
    $row['instruction'] = explode("\n", $row['instructions']);

    $row['tags'] = explode(",", $row['tags']);
    $row['type'] = explode(",", $row['type']);
    $result[] = $row;
}
echo json_encode(["data" => $result]);

$connect = null;
