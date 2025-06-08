<?php
$connect = new PDO("mysql:host=localhost;dbname=quyen", "root", "");
$sql = "SELECT * FROM Meals";
$result = $connect->query($sql);
$meals = [];

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
        $this->instruction =  $instruction;
        $this->image_url = $image_url;
        $this->nutrition = $nutrition;
        $this->tags = explode(",", $tags);
        $this->type = explode(",", $type);
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
    $result_nutrition = $nutri->fetchAll(PDO::FETCH_ASSOC) ;
    if($result_nutrition){
            $nutritions = new nutrition(
                $result_nutrition[0]["amount"],
                $result_nutrition[1]["amount"],
                $result_nutrition[2]["amount"],
                $result_nutrition[3]["amount"],
                $result_nutrition[4]["amount"],
                $result_nutrition[5]["amount"]
            );
    }


    

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


file_put_contents('meals.json', json_encode($meals, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE));
$connect = null;

?>