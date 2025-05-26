<?php
    $connect = new PDO("mysql:host=localhost;dbname=quyen", "root", "");
    $sql = "SELECT * FROM Meals";
    $result = $connect->query($sql);
    $meals = [];

    class nutrition {
        public $protein;
        public $fat;
        public $carb;
        public $fiber;
        public $sugar;
        public $sodium;

        public function __construct($protein ,$fat, $carb, $fiber, $sugar, $sodium) {
            $this->protein = $protein;
            $this->fat = $fat;
            $this->carb = $carb;
            $this->fiber = $fiber;
            $this->sugar = $sugar;
            $this->sodium = $sodium;
            
        }

    }

    class Meal {
        public $id;
        public $name;
        public $description;
        public $calories;
        public $preptime;
        public $difficulty;
        public $instruction;
        public $image_url; 
        public $nutrition;
        public $tags;
        public $type;
        public $ingredients;


    
        public function __construct($id, $name, $description, $calories, $preptime, $difficulty, $instruction, $image_url,
         $nutrition, $tags, $type, $ingredients ) {
            $this->id = $id;
            $this->name = $name;
            $this->description = $description;
            $this->calories = $calories;
            $this->preptime = $preptime;
            $this->difficulty = $difficulty;
            $this->instruction = explode("\n", $instruction);
            $this->image_url = $image_url;
            $this->nutrition = $nutrition;
            $this->tags = $tags;
            $this->type = $type;
            $this->ingredients = $ingredients;


        }
    }

    
    $ingredients_sql = "SELECT Ingredients.name 
        FROM meal_ingredients 
        JOIN Ingredients ON meal_ingredients.ingredient_id = Ingredients.id 
        WHERE meal_ingredients.meal_id = ?";

    $nutrition_sql = "SELECT nutrition.name, amount 
    FROM meal_nutrition 
    JOIN nutrition ON meal_nutrition.nutrition_id = nutrition.id 
    WHERE meal_nutrition.meal_id = ?";

    $tags_sql = "SELECT tags.name
    FROM meal_tags 
    JOIN tags ON meal_tags.tag_id = tags.id 
    WHERE meal_tags.meal_id = ?";

    $types_sql = "SELECT type.name
    FROM meal_types 
    JOIN type ON meal_types.type_id = type.id 
    WHERE meal_types.meal_id = ?";

    while($row = $result->fetch(PDO::FETCH_ASSOC)){
        $result_ingredients = [];
        $stmt = $connect->prepare($ingredients_sql);
        $stmt->execute([$row['id']]);
        $result_ingredients = $stmt->fetchAll(PDO::FETCH_COLUMN);

        $result_nutrition = [];
        $nutri = $connect->prepare($nutrition_sql);
        $nutri->execute([$row['id']]);
        $result_nutrition = $nutri->fetchAll(PDO::FETCH_ASSOC);
        $nutritions = new nutrition($result_nutrition[0]["amount"], $result_nutrition[1]["amount"], $result_nutrition[2]["amount"],
        $result_nutrition[3]["amount"], $result_nutrition[4]["amount"], $result_nutrition[5]["amount"] );

        $result_tag = [];
        $tags = $connect->prepare($tags_sql);
        $tags->execute([$row['id']]);
        $result_tag = $tags->fetchAll(PDO::FETCH_COLUMN);

        $result_type = [];
        $types = $connect->prepare($types_sql);
        $types->execute([$row['id']]);
        $result_type = $types->fetchAll(PDO::FETCH_COLUMN);


         $Meal = new Meal($row['id'], $row['name'], $row['description'], $row['Calories'],
          $row['prep_time'], $row['difficulty'],$row['instructions'],
           $row['image_url'], $nutritions, $result_tag, $result_type, $result_ingredients); 
         $meals[] = $Meal; 
    };
    
    
    file_put_contents('meals.json', json_encode($meals, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE));


?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="assets/css/reset.css">
    <link href="../assets/css/bootstrap.css" rel="stylesheet">
    <link rel="stylesheet" href="assets/fontawesome-free-6.7.2-web/css/all.min.css">
    <link rel="stylesheet" href="../assets/css/style.css">
</head>


<body>
    <header class="main-header ">
        <div class="header--banner text-white">
            <div class="col-xxl-8 col-xl-10 col-sm-11 mx-auto d-flex">
                <div class="header--text mt-5">
                    <label>Create your perfect meal plan</label>
                    <span class="mt-4 text-center">2,000 calories per day <i class="fas fa-question-circle"
                            title="Infomation about calo"></i></span>

                </div>
                <div class="header--image">
                    <picture>
                        <img class="" src="https://samsungfood.com/wp-content/cache/thumb/3c/def98820344fe3c_600x520.jpeg"
                            alt="">
                    </picture>
                </div>

            </div>
        </div>

    </header>
    <div class="header-lower position-sticky top-0 bg-white shadow z-3">
        <div class="container col-xl-10">
            <div class="outer-box clearfix d-flex justify-content-center align-items-center">
                <div class="logo-box">
                    <figure class="logo">
                        <a href="index.html"><img class="" src="../assets/images/NUTRIPLANNER.png" alt=""></a>
                    </figure>

                </div>
                <div class="nav m-0 p-0 text-center">
                    <ul class="d-flex m-0">
                        <li><a href="" class="">Công thức nấu ăn</a></li>
                        <li><a href="" class="">Mua sắm</a></li>
                        <li><a href="" class="">Lập kế hoạch bữa ăn</a></li>
                        <li><a href="" class="">Cộng đồng</a></li>
                        <li><a href="" class="">Blog</a></li>
                        <li><a href="" class="">Thực phẩm</a></li>
                    </ul>
                </div>
                <div class="header_cta d-flex justify-content-center align-items-center">
                    <a href="login.php" class="btn header_cta_sec">Đăng nhập</a>
                    <a href="signup.php" class="btn btn-darkk">Đăng Kí</a>
                </div>
            </div>


        </div>
    </div>

    <div class="examPlan container">
        <div class="col-xxl-10 col-xl-10 col-sm-11 mx-auto my-4">
            <div class="" id="meal-cate">
                <div class="item ">                   
                    <div class="d-grid grid-col-5 my-1" id="mealplan--menu" >
                        <div class="firstcard d-flex flex-column align-items-center rounded shadow  "> 
                            <picture class="rounded scale-105 p-3 overflow-hidden">
                                <img class="rounded" src="assets/images/thitkhotau.jpg"
                                    alt="">
                            </picture>
                            <p class="pt-2">Meat</p>
                        </div>
                        <div class="firstcard d-flex flex-column align-items-center rounded shadow  "> 
                            <picture class="rounded scale-105 p-3">
                                <img class="rounded" src="assets/images/thitkhotau.jpg"
                                    alt="">
                            </picture>
                            <p class="pt-2">Meat</p>
                        </div>
                        <div class="firstcard d-flex flex-column align-items-center rounded shadow  "> 
                            <picture class="rounded scale-105 p-3">
                                <img class="rounded" src="assets/images/thitkhotau.jpg"
                                    alt="">
                            </picture>
                            <p class="pt-2">Meat</p>
                        </div>
                        <div class="firstcard d-flex flex-column align-items-center rounded shadow  "> 
                            <picture class="rounded scale-105 p-3">
                                <img class="rounded" src="assets/images/thitkhotau.jpg"
                                    alt="">
                            </picture>
                            <p class="pt-2">Meat</p>
                        </div>
                        <div class="firstcard d-flex flex-column align-items-center rounded shadow  "> 
                            <picture class="rounded scale-105 p-3">
                                <img class="rounded" src="assets/images/thitkhotau.jpg"
                                    alt="">
                            </picture>
                            <p class="pt-2">Meat</p>
                        </div>
                        
                    </div>
                    
                </div>
                
                <div class="mealcate--nav  justify-content-between align-items-center">
                    <ul class="nav nav-pills d-flex justify-content-between" id="mealTabs" role="tablist">
                        <li class="nav-item" role="presentation">
                          <button class="nav-link active" id="breakfast-tab" data-bs-toggle="tab" data-bs-target="#all" type="button" role="tab">All</button>
                        </li>
                        <li class="nav-item" role="presentation">
                            <button class="nav-link " id="breakfast-tab" data-bs-toggle="tab" data-bs-target="#breakfast" type="button" role="tab">Breakfast</button>
                          </li>
                        <li class="nav-item" role="presentation">
                          <button class="nav-link" id="lunch-tab" data-bs-toggle="tab" data-bs-target="#lunch" type="button" role="tab">Lunch</button>
                        </li>
                        <li class="nav-item" role="presentation">
                          <button class="nav-link" id="dinner-tab" data-bs-toggle="tab" data-bs-target="#dinner" type="button" role="tab">Dinner</button>
                        </li>
                        <li class="nav-item" role="presentation">
                          <button class="nav-link" id="snacks-tab" data-bs-toggle="tab" data-bs-target="#snacks" type="button" role="tab">Snacks</button>
                        </li>
                        <li class="nav-item" role="presentation">
                          <button class="nav-link" id="smoothies-tab" data-bs-toggle="tab" data-bs-target="#smoothies" type="button" role="tab">Smoothies</button>
                        </li>
                      </ul>

                </div>
                
              
                </div>
            </div>

        </div>
        
        
    </div>
    <div class="h-100 w-100 z-3 position-fixed top-0 d-none" style="background-color: rgba(0, 0, 0, 0.7);" id="detail__food">
        
    </div>

    <div class="linkplan d-flex flex-column bg-orange p-4">
        <h1 class="mx-auto">Create a full weekly plan from scratch</h1>
        <button class="btn text-white rounded-5 px-3 mx-auto" style="background-color: var(--orange);"><h3>Get Free Plan</h3></button>
    </div>

    <footer class="main-footer">
        <div class="container">
            <div class="row">
                <div class="footer-top">
                    <div class="col-lg-3 nav_menu">
                        <div class="text">
                            <div class="widget-title">
                                <h3>NUTRIPLANNER</h3>
                            </div>
                            <div class="widget-content">
                                <ul class="info-list clearfix">
                                    <li>
                                        <p><a href="">Web App</a></p>
                                    </li>
                                    <li>
                                        <p><a href="">Mobile App</a></p>

                                    </li>
                                    <li>
                                        <p><a href="">Chrome Extension</a></p>
                                    </li>
                                    <li>
                                        <p><a href="">Food Plus</a></p>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-3 nav_menu">
                        <div class="text">
                            <div class="widget-title">
                                <h3>Features</h3>
                            </div>
                            <div class="widget-content">
                                <ul class="info-list clearfix">
                                    <li>
                                        <p><a href="">Recipe Box</a></p>
                                    </li>
                                    <li>
                                        <p><a href="">Shopping</a></p>

                                    </li>
                                    <li>
                                        <p><a href="">Meal Planner</a></p>
                                    </li>
                                    <li>
                                        <p><a href="">Communities</a></p>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3 nav_menu">
                        <div class="text">
                            <div class="widget-title">
                                <h3>Resources</h3>
                            </div>
                            <div class="widget-content">
                                <ul class="info-list clearfix">
                                    <li>
                                        <p><a href="">Nutrition and <br> Calorie Calculator</a></p>
                                    </li>
                                    <li>
                                        <p><a href="">Recipe Converter</a></p>

                                    </li>
                                    <li>
                                        <p><a href="">Support</a></p>
                                    </li>
                                    <li>
                                        <p><a href="">Blog</a></p>
                                    </li>
                                    <li>
                                        <p><a href="">Open Food Facts</a></p>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3 nav_menu">
                        <div class="text">
                            <div class="widget-title">
                                <h3>Company</h3>
                            </div>
                            <div class="widget-content">
                                <ul class="info-list clearfix">
                                    <li>
                                        <p><a href="">About us</a></p>
                                    </li>
                                    <li>
                                        <p><a href="">Creators</a></p>

                                    </li>
                                    <li>
                                        <p><a href="">Partners</a></p>
                                    </li>
                                    <li>
                                        <p><a href="">Press</a></p>
                                    </li>
                                    <li>
                                        <p><a href="">Careers</a></p>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="footer-bottom">
                    <p class="copyright">
                        © 2025 Nutriplanner. All rights reserved.
                    </p>
                    <ul id="menu-policies" class="menu">
                        <li class="menu-item"><a href="">Privacy Policy</a></li>
                        <li class="menu-item"><a href="">Terms</a></li>
                        <li class="menu-item "><a href="">Security</a>
                        </li>
                        <li class="menu-item"><a href="">Do not sell my data</a></li>
                        <li class="menu-item "><a href="">Promotional Terms</a></li>
                    </ul>
                    <div class="social_links">
                        <a href=""> <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512" width="20" height="20"
                                fill="#3b5998">
                                <path
                                    d="M512 256C512 114.6 397.4 0 256 0S0 114.6 0 256C0 376 82.7 476.8 194.2 504.5V334.2H141.4V256h52.8V222.3c0-87.1 39.4-127.5 125-127.5c16.2 0 44.2 3.2 55.7 6.4V172c-6-.6-16.5-1-29.6-1c-42 0-58.2 15.9-58.2 57.2V256h83.6l-14.4 78.2H287V510.1C413.8 494.8 512 386.9 512 256h0z" />
                            </svg></a>

                        <a href=""> <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512" width="20" height="20"
                                viewBox="0 0 448 512">
                                <path
                                    d="M224.1 141c-63.6 0-114.9 51.3-114.9 114.9s51.3 114.9 114.9 114.9S339 319.5 339 255.9 287.7 141 224.1 141zm0 189.6c-41.1 0-74.7-33.5-74.7-74.7s33.5-74.7 74.7-74.7 74.7 33.5 74.7 74.7-33.6 74.7-74.7 74.7zm146.4-194.3c0 14.9-12 26.8-26.8 26.8-14.9 0-26.8-12-26.8-26.8s12-26.8 26.8-26.8 26.8 12 26.8 26.8zm76.1 27.2c-1.7-35.9-9.9-67.7-36.2-93.9-26.2-26.2-58-34.4-93.9-36.2-37-2.1-147.9-2.1-184.9 0-35.8 1.7-67.6 9.9-93.9 36.1s-34.4 58-36.2 93.9c-2.1 37-2.1 147.9 0 184.9 1.7 35.9 9.9 67.7 36.2 93.9s58 34.4 93.9 36.2c37 2.1 147.9 2.1 184.9 0 35.9-1.7 67.7-9.9 93.9-36.2 26.2-26.2 34.4-58 36.2-93.9 2.1-37 2.1-147.8 0-184.8zM398.8 388c-7.8 19.6-22.9 34.7-42.6 42.6-29.5 11.7-99.5 9-132.1 9s-102.7 2.6-132.1-9c-19.6-7.8-34.7-22.9-42.6-42.6-11.7-29.5-9-99.5-9-132.1s-2.6-102.7 9-132.1c7.8-19.6 22.9-34.7 42.6-42.6 29.5-11.7 99.5-9 132.1-9s102.7-2.6 132.1 9c19.6 7.8 34.7 22.9 42.6 42.6 11.7 29.5 9 99.5 9 132.1s2.7 102.7-9 132.1z" />
                            </svg></a>

                        <a href=""> <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512" width="20"
                                height="20">
                                <path
                                    d="M389.2 48h70.6L305.6 224.2 487 464H345L233.7 318.6 106.5 464H35.8L200.7 275.5 26.8 48H172.4L272.9 180.9 389.2 48zM364.4 421.8h39.1L151.1 88h-42L364.4 421.8z" />
                            </svg></a>

                        <a href=""><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 576 512" width="20" height="20">
                                <path
                                    d="M549.7 124.1c-6.3-23.7-24.8-42.3-48.3-48.6C458.8 64 288 64 288 64S117.2 64 74.6 75.5c-23.5 6.3-42 24.9-48.3 48.6-11.4 42.9-11.4 132.3-11.4 132.3s0 89.4 11.4 132.3c6.3 23.7 24.8 41.5 48.3 47.8C117.2 448 288 448 288 448s170.8 0 213.4-11.5c23.5-6.3 42-24.2 48.3-47.8 11.4-42.9 11.4-132.3 11.4-132.3s0-89.4-11.4-132.3zm-317.5 213.5V175.2l142.7 81.2-142.7 81.2z" />
                            </svg></a>


                    </div>
                </div>
            </div>
        </div>
    </footer>
    <script src="assets/js/main.js"></script>
    <script src="assets/js/bootstrap.min.js"></script>
</body>

</html>