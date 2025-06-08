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
    public $preptime;
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
        $preptime,
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
        $this->preptime = $preptime;
        $this->instruction = explode("\n", $instruction);
        $this->image_url = $image_url;
        $this->nutrition = $nutrition;
        $this->tags = $tags;
        $this->type = $type;
        $this->ingredients = $ingredients;
        $this->create_at = $create_at;
        $this->status = $status;
    }
}




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

    $result_tag = [];
    $tags = $connect->prepare($tags_sql);
    $tags->execute([$row['id']]);
    $result_tag = $tags->fetchAll(PDO::FETCH_COLUMN);

    $result_type = [];
    $types = $connect->prepare($types_sql);
    $types->execute([$row['id']]);
    $result_type = $types->fetchAll(PDO::FETCH_COLUMN);


    $Meal = new Meal(
        $row['id'],
        $row['name'],
        $row['description'],
        $row['Calories'],
        $row['prep_time'],
        $row['instructions'],
        $row['image_url'],
        $nutritions,
        $result_tag,
        $result_type,
        $row['ingredients'],
        $row['created_at'], 
        $row['status']
    );
    $meals[] = $Meal;
};


file_put_contents('meals.json', json_encode($meals, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE));
$connect = null;

?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Nutriplanner - Health & Nutri</title>
    <link rel="stylesheet" href="assets/css/reset.css">
    <link rel="icon" type="image/svg+xml" href="./assets/images/logo.svg">
    <link href="assets/css/bootstrap.css" rel="stylesheet">
    <link href="assets/css/style-admin.css" rel="stylesheet">
    <link rel="stylesheet" href="assets/fontawesome-free-6.7.2-web/css/all.min.css">
    <link rel="stylesheet" href="../assets/css/style.css">
    <link rel="stylesheet" href="../assets/css/calculator.css">
</head>


<body>
    <header class="main-header py-2">
        <nav class="navbar navbar-expand-lg navbar-light">
            <div class="container">
                <a href="#" class="logo">
                    <i class="fas fa-seedling"></i>
                    NutriPlanner
                </a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
                    aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarNav">
                    <ul class="nav-links ms-auto">
                        <li class="nav-item"><a class="nav-link" href="#feature">Feature</a></li>
                        <li class="nav-item"><a class="nav-link" href="#">Menu</a></li>
                        <li class="nav-item"><a class="nav-link" href="#favorite">Favorite</a></li>
                        <li class="nav-item"><a class="nav-link" href="#calculator">Calculator</a></li>
                        <li class="nav-item"><a class="nav-link" href="#feedback">Feedback</a></li>
                        <li class="nav-item"><a class="nav-link" href="#contact">Contact</a></li>
                        <li class="nav-item dropdown">
                            <div class="btn-toolbar mb-2 mb-md-0">
                                <div class="dropdown">
                                    <button class="btn btn-sm btn-outline-none dropdown-toggle d-flex justify-content-center align-items-center"
                                        data-bs-toggle="dropdown" type="button">
                                        <img src="../../assets/images/ad.jpg" alt="admin" class="rounded-circle"
                                            width="30" height="30" style="object-fit: fit;">
                                        <span class="text-login">Admin</span>
                                    </button>
                                    <ul class="dropdown-menu">
                                        <li><a class="dropdown-item" href="profile.html">Hồ sơ</a></li>
                                        <li><a class="dropdown-item" href="login.html">Đăng xuất</a></li>
                                    </ul>
                                </div>
                            </div>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>
    </header>

    

    <section class="feature-section" id="feature">
        <div class="feature-container col-xl-10 col-11 mx-auto ">
            <div class="feature-header">
                <h2>Key Features</h2>
                <p>Explore powerful tools that help you plan meals, track nutrition, and achieve your health goals with ease.</p>
            </div>
            <div class="feature-main">
                <a href="#meal-cate" class="feature-box rounded-top ">
                    <div class="feature-icon">
                        <i class="fas fa-list-check"></i>
                    </div>
                    <h3>Personalized Meal Plans</h3>
                    <p>Create meal plans tailored to your goals, whether it's weight loss, muscle gain, or managing specific health conditions.</p>
                </a>
                <a href="#filter" class="feature-box rounded-top">
                    <div class="feature-icon">
                        <i class="fas fa-filter"></i>
                    </div>
                    <h3>Smart Filters</h3>
                    <p>Easily search and filter meals by ingredients, calories, special diets, or food allergies.</p>
                </a>
                <a href="#meal-cate" class="feature-box rounded-top">
                    <div class="feature-icon">
                        <i class="fas fa-chart-pie"></i>
                    </div>
                    <h3>Nutrition Analysis</h3>
                    <p>View detailed nutritional breakdowns such as calories, protein, carbs, fats, and micronutrients for each dish.</p>
                </a>
                <a href="#favorite" class="feature-box rounded-top">
                    <div class="feature-icon">
                        <i class="fas fa-heart"></i>
                    </div>
                    <h3>Favorite Dishes</h3>
                    <p>Bookmark and quickly access your favorite meals to simplify your future meal planning.</p>
                </a>
                <a href="#calculator" class="feature-box rounded-top">
                    <div class="feature-icon">
                        <i class="fas fa-calculator"></i>
                    </div>
                    <h3>Nutrition Calculator</h3>
                    <p>Input ingredients and portion sizes to instantly calculate the total nutritional value of your meal.</p>
                </a>
                <a href="#feedback" class="feature-box rounded-top">
                    <div class="feature-icon">
                        <i class="fas fa-comment-dots"></i>
                    </div>
                    <h3>Comments & Sharing</h3>
                    <p>Comment, share your experiences, and review meals with the NutriPlanner community.</p>
                </a>
            </div>
        </div>
    </section>

    <div class="examPlan container">
        <div class="col-xxl-10 col-xl-10 col-sm-11 mx-auto my-4">
            <section>
                <div class="container" id="filter">
                    <div class="section-header">
                        <h2>Discover Meal Plans</h2>
                        <p>Search and filter hundreds of recipes that fit your nutrition goals and taste preferences.</p>
                    </div>
                    <div class="meal-filter">
                        <div id="searchForm">
                            <div class="search-container">
                                <input type="text" class="search-input" name="search_query" id="input_search" placeholder="Enter meal name...">
                                <button class="search-btn text-dark" id="search-form">
                                    <i class="fas fa-search"></i>
                                    Search
                                </button>
                            </div>
                            <div class="filter">
                                <div class="filter-group">
                                    <label class="filter-title">Meal Type</label>
                                    <select class="filter-select" name="meal_type" id="input_type">
                                        <option value="">All</option>
                                        <option value="1">Breakfast</option>
                                        <option value="2">Lunch</option>
                                        <option value="3">Dinner</option>
                                        <option value="4">Snacks</option>
                                        <option value="5">Drinks</option>
                                    </select>
                                </div>
                                <div class="filter-group">
                                    <label class="filter-title">Diet Type</label>
                                    <select class="filter-select" name="diet_type" id="meal_diet">
                                        <option value="">All</option>
                                        <option value="1">Vegan</option>
                                        <option value="2">Vegetarian</option>
                                        <option value="3">Keto</option>
                                        <option value="4">Paleo</option>
                                        <option value="5">Low Carb</option>
                                        <option value="6">High Protein</option>
                                    </select>
                                </div>
                                <div class="filter-group">
                                    <label class="filter-title">Calories</label>
                                    <select class="filter-select" name="calories" id="meal_calo">
                                        <option value="">All</option>
                                        <option value="under300">Under 300 kcal</option>
                                        <option value="300-500">300 - 500 kcal</option>
                                        <option value="500-800">500 - 800 kcal</option>
                                        <option value="over800">Over 800 kcal</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="meals-grid" id="meals-grid">
                        <!-- Meals will be displayed here -->
                    </div>
                </div>
            </section>

            <div class="" id="meal-cate">
                <div class="item ">
                    <div class="d-grid grid-col-5 my-1" id="mealplan--menu">
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
                </div>
            </div>
        </div>
 
    </div>
    <div class="h-100 w-100 z-3 position-fixed top-0 d-none" style="background-color: rgba(0, 0, 0, 0.7);" id="detail__food">

    </div>

    <div class="mealfavourite bg-light py-3" id="favorite">
        <div class=" col-xl-7 col-sm-11 mx-auto my-4">
            <div class="" id="">
                <div class="item">                   
                    <div class="d-grid grid-col-favourite my-1" id="mealfavourite--menu" > 

                    </div>    
                </div>
                </div>
            </div>

        </div>
    </div>

    <section style="margin-top: 50px; margin-bottom: 50px;" id="calculator">
        <div class="container">
            <div class="header-calculator">
                <h2>Nutrition Calculator</h2>
                <p>Enter ingredients and portions to calculate nutritional values for your dish.</p>
            </div>
            <div class="container-calculator">
                <div class="calculator-form">
                    <h3>Enter Ingredients</h3>
                    <p>Select ingredients and enter the amount in grams to calculate nutrition.</p>
                    <div class="ingredients-list">
                        
                    </div>
                    <div class="action-button">
                        <button class="add-ingredient" id="add-ingredient">Add Ingredient</button>
                        <button class="clear-ingredients" id="clear-ingredients-in-form">Clear Ingredients</button>
                    </div>
                </div>
                <div class="calculator-result">
                    <div class="header-calculator-result">
                        <h3>Nutrition Analysis Results</h3>
                        <div class="header-clear-result">
                            <button class="clear-calculator-result" id="clear-ingredients-in-result">Clear</button>
                        </div>
                    </div>
                    <div class="total-calories" id="total-calories">
                        0.00 kcal
                    </div>
                    <div class="nutrition-results" id="nutrition-results">
                        <div class="nutrition-result-item">
                            <div class="nutrition-result-name">Protein</div>
                            <div class="nutrition-result-value" id="protein-result">0.00g</div>
                        </div>
                        <div class="nutrition-result-item">
                            <div class="nutrition-result-name">Carbs</div>
                            <div class="nutrition-result-value" id="carbs-result">0.00g</div>
                        </div>
                        <div class="nutrition-result-item">
                            <div class="nutrition-result-name">Fat</div>
                            <div class="nutrition-result-value" id="fat-result">0.00g</div>
                        </div>
                        <div class="nutrition-result-item">
                            <div class="nutrition-result-name">Sugar</div>
                            <div class="nutrition-result-value" id="sugar-result">0.00g</div>
                        </div>
                        <div class="nutrition-result-item">
                            <div class="nutrition-result-name">Chất xơ</div>
                            <div class="nutrition-result-value" id="fiber-result">0.00g</div>
                        </div>
                        <div class="nutrition-result-item">
                            <div class="nutrition-result-name">Natri</div>
                            <div class="nutrition-result-value" id="sodium-result">0.00mg</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <div>
        <section class="testimonials-section">
            <h2>What Our Users Say</h2>
            <p class="testimonials-subtext">
                Discover real experiences from the NutriPlanner community about improving eating habits<br>
                and health.
            </p>
            <div class="testimonials-container">
                <!-- Card 1 -->
                <article class="testimonial-card">
                    <div class="quote-icon"><i class="fas fa-quote-left"></i></div>
                    <div class="stars-static">
                        <i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i>
                        <i class="fas fa-star"></i><i class="fas fa-star"></i>
                    </div>
                    <p>NutriPlanner completely changed the way I eat. Tracking nutrition is now easy, and the suggested meals align perfectly with my weight loss goals.</p>
                    <div class="author">
                        <img src="https://i.pravatar.cc/100?img=47" alt="Minh Anh">
                        <div>
                            <div class="author-name">Tat Anh</div>
                            <div class="author-role">Lost 8 kg in 3 months</div>
                        </div>
                    </div>
                </article>
                <!-- Card 2 -->
                <article class="testimonial-card">
                    <div class="quote-icon"><i class="fas fa-quote-left"></i></div>
                    <div class="stars-static">
                        <i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i>
                        <i class="fas fa-star"></i><i class="fas fa-star"></i>
                    </div>
                    <p>As someone with diabetes, finding suitable meal plans has always been a challenge. NutriPlanner helps me easily filter meals that fit my low glycemic index needs.</p>
                    <div class="author">
                        <img src="https://i.pravatar.cc/100?img=12" alt="Quang Hung">
                        <div>
                            <div class="author-name">Kim Hieu</div>
                            <div class="author-role">Managing Type 2 Diabetes</div>
                        </div>
                    </div>
                </article>
                <!-- Card 3 -->
                <article class="testimonial-card">
                    <div class="quote-icon"><i class="fas fa-quote-left"></i></div>
                    <div class="stars-static">
                        <i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i>
                        <i class="fas fa-star"></i><i class="far fa-star"></i>
                    </div>
                    <p>I work out and need a high-protein diet. NutriPlanner’s nutrition calculator helps me track my daily protein intake accurately and easily.</p>
                    <div class="author">
                        <img src="https://i.pravatar.cc/100?img=30" alt="Thanh Truc">
                        <div>
                            <div class="author-name">Huy Duc</div>
                            <div class="author-role">Fitness Trainer</div>
                        </div>
                    </div>
                </article>
            </div>
        </section>
        <!-- Feedback section -->
        <section class="feedback-section" id="feedback">
            <div class="logo">
                <img src="assets/images/Leonardo_Phoenix_10_A_topdown_view_of_a_food_table_divided_in_3.jpg" alt="NutriPlanner Logo" />
            </div>
            <div class="feedback-card">
                <h3>Submit Your Feedback</h3>
                <div class="star-rating" id="starRating">
                    <span data-value="1">☆</span>
                    <span data-value="2">☆</span>
                    <span data-value="3">☆</span>
                    <span data-value="4">☆</span>
                    <span data-value="5">☆</span>
                </div>
                <form id="feedbackForm">
                    <input type="text" placeholder="Full Name" required />
                    <input type="email" placeholder="Email" required />
                    <textarea placeholder="Share your experience..." required rows="3"></textarea>
                    <button type="submit">Submit Feedback</button>
                </form>
            </div>
        </section>
    </div>


    <section class="section contact" id="contact">
        <div class="container">
            <div class="section-header">
                <h2>Contact Us</h2>
                <p>Have questions or need assistance? The NutriPlanner team is always ready to help you.</p>
            </div>
            <div class="contact-container">
                <div class="contact-info">
                    <h3>Contact Information</h3>
                    <div class="contact-details">
                        <div>
                            <div class="contact-icon">
                                <i class="fas fa-map-marker-alt"></i>
                            </div>
                            <div class="contact-text" style="display: inline-block;">
                                <h4>Address</h4>
                                <p>285 Đội Cấn Street, Ba Đình District, Hanoi City</p>
                            </div>
                        </div>      
                        <div>
                            <div class="contact-icon">
                                <i class="fas fa-phone-alt"></i>
                            </div>
                            <div class="contact-text" style="display: inline-block;">
                                <h4>Phone</h4>
                                <p>+84 28 1234 5678</p>
                            </div>
                        </div>
                        <div>
                            <div class="contact-icon">
                                <i class="fas fa-envelope"></i>
                            </div>
                            <div class="contact-text" style="display: inline-block;">
                                <h4>Email</h4>
                                <p>support@nutriplanner.com</p>
                            </div>
                        </div>
                        <div>
                            <div class="contact-icon">
                                <i class="fas fa-clock"></i>
                            </div>
                            <div class="contact-text" style="display: inline-block;">
                                <h4>Working Hours</h4>
                                <p>Monday - Friday: 8:00 AM - 6:00 PM<br>Saturday: 9:00 AM - 12:00 PM</p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="map-container">
                    <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3723.9231239864!2d105.81641017601285!3d21.035761787536657!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3135ab0d127a01e7%3A0xab069cd4eaa76ff2!2zMjg1IFAuIMSQ4buZaSBD4bqlbiwgTGnhu4V1IEdpYWksIEJhIMSQw6xuaCwgSMOgIE7hu5lpIDEwMDAwMCwgVmlldG5hbQ!5e0!3m2!1sen!2s!4v1747836344495!5m2!1sen!2s" width="400" height="300" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
                </div>
            </div>
        </div>
    </section>
    
    <footer class="main-footer">
        <div class="container">
            <div class="row">
                <div class="footer-top">
                    <div class="col-lg-3 nav_menu">
                        <div class="text">
                            <div class="widget-title">
                                <a href="#" class="footer-logo">
                                    <i class="fas fa-seedling"></i>
                                    NutriPlanner
                                </a>
                            </div>
                            <div class="widget-content">
                                <p>Smart nutrition solutions to help you build healthy eating habits and achieve your
                                    health goals.</p>
                                <div class="social-links">
                                    <a href="#" class="social-link"><i class="fab fa-facebook-f"></i></a>
                                    <a href="#" class="social-link"><i class="fab fa-instagram"></i></a>
                                    <a href="#" class="social-link"><i class="fab fa-youtube"></i></a>
                                    <a href="#" class="social-link"><i class="fab fa-linkedin-in"></i></a>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-3 nav_menu">
                        <div class="text">
                            <div class="widget-title">
                                <h3>Quick Links</h3>
                            </div>
                            <div class="widget-content">
                                <ul class="footer-links">
                                    <li><a href="#features">Features</a></li>
                                    <li><a href="#meals">Meals</a></li>
                                    <li><a href="#calculator">Tools</a></li>
                                    <li><a href="#testimonials">Testimonials</a></li>
                                    <li><a href="#contact">Contact</a></li>
                                </ul>

                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3 nav_menu">
                        <div class="text">
                            <div class="widget-title">
                                <h3>Support</h3>

                            </div>
                            <div class="widget-content">
                                <ul class="footer-links">
                                    <li><a href="#">Support Center</a></li>
                                    <li><a href="#">FAQ</a></li>
                                    <li><a href="#">Terms of Use</a></li>
                                    <li><a href="#">Privacy Policy</a></li>
                                    <li><a href="#feedback">Feedback</a></li>
                                </ul>

                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3 nav_menu">
                        <div class="text">
                            <div class="widget-title">
                                <h3>Contact</h3>

                            </div>
                            <div class="widget-content">
                                <div class="contact-info">
                                    <i class="fas fa-map-marker-alt"></i>
                                    <p>123 Nguyen Hue Street, District 1, Ho Chi Minh City</p>
                                </div>
                                <div class="contact-info">
                                    <i class="fas fa-phone-alt"></i>
                                    <p>+84 28 1234 5678</p>
                                </div>
                                <div class="contact-info">
                                    <i class="fas fa-envelope"></i>
                                    <p>support@nutriplanner.com</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="footer-bottom">
                    <p>© 2023 NutriPlanner. Project by Team 3. All rights reserved.</p>
                </div>
            </div>
        </div>
    </footer>

    <script src="assets/js/main.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js"></script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

    <script>
        document.addEventListener('DOMContentLoaded', () => {
            const tabbutton = document.querySelectorAll('.tab-btn');

            tabbutton.forEach(button => {
                button.addEventListener('click', () => {
                    tabbutton.forEach(btn => btn.classList.remove('active'));
                    button.classList.add('active');
                });
            });
        });
    </script>
</body>

</html>