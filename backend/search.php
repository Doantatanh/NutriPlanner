<?php
    header("Content-Type: application/json");
    $data = json_decode(file_get_contents("php://input"), true);
    $connect = new PDO("mysql:host=localhost;dbname=quyen","root", "");

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


    $sql = "SELECT m.id , m.name, m.description, m.ingredients, m.calories, m.prep_time ,m.instructions ,m.image_url from meals m 
        INNER JOIN tags ON m.tag_id = tags.id
        INNER JOIN type ON m.type_id = type.id
        WHERE m.name LIKE ?";
    $meal_name =isset($data["name"]) ? "%" . $data['name'] . "%" : "%"; 
    $meal_type = isset($data['type']) ? $data['type'] : "";
    $meal_diet = isset($data["diet"]) ? $data["diet"] : "";
    $meal_calo = isset($data["calo"]) ? $data["calo"] : "";

    

    $params = [$meal_name];

    if(!empty($meal_type)){
        $sql .= " AND type.id = ?";
        $params[] = $meal_type; 
    }

    if(!empty($meal_diet)){
        $sql .= " AND tags.id = ?";
        $params[] = $meal_diet; 
    }

    if(!empty($meal_calo)){
        if ($meal_calo === "under300") {
            $sql .= " AND meals.calories < ?";
            $params[] = 300;
        } elseif ($meal_calo === "300-500") {
            $sql .= " AND meals.calories >= ? AND meals.calories <= ?";
            $params[] = 300;
            $params[] = 500;
        } elseif ($meal_calo === "500-800") {
            $sql .= " AND meals.calories >= ? AND meals.calories <= ?";
            $params[] = 500;
            $params[] = 800;
        } elseif ($meal_calo === "over800") {
            $sql .= " AND meals.calories > ?";
            $params[] = 800;
        }
    }




    $tags_sql = "SELECT tags.name
    FROM meal_tags 
    JOIN tags ON meal_tags.tag_id = tags.id 
    WHERE meal_tags.meal_id = ?";

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
        $nutritions = new nutrition(
            $result_nutrition[0]["amount"],
            $result_nutrition[1]["amount"],
            $result_nutrition[2]["amount"],
            $result_nutrition[3]["amount"],
            $result_nutrition[4]["amount"],
            $result_nutrition[5]["amount"]
        );
        $row['nutrition'] = $nutritions;
        $row['instruction'] = explode("\n", $row['instructions']);

        $result_tag = [];
        $tags = $connect->prepare($tags_sql);
        $tags->execute([$row['id']]);
        $result_tag = $tags->fetchAll(PDO::FETCH_COLUMN);
        $row['tags'] = $result_tag;

        $type = $connect->prepare("select name from type where id = ?");
        $type->execute([$row['id']]);
        $result_type = $type->fetch(PDO::FETCH_COLUMN);
        $row['type'] = $result_type;

        $result[] = $row;
    }
    echo json_encode(["data" => $result]);

    $connect = null;
?>