<?php
session_start();


if (!isset($_SESSION['username'])) {
    header("Location: frontend/login.php");
    exit();
}


$username = $_SESSION['username'];
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
                <a href="#banner" class="logo">
                    <i class="fas fa-seedling"></i>
                    NutriPlanner
                </a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
                    aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarNav">
                    <ul class="nav-links ms-auto">
                        <li class="nav-item"><a class="nav-link " href="#feature">Feature</a></li>
                        <li class="nav-item"><a class="nav-link" href="#favourite">Favorite</a></li>
                        <li class="nav-item"><a class="nav-link" href="#meals">Meals</a></li>
                        <li class="nav-item"><a class="nav-link" href="#calculator">Calculator</a></li>
                        <li class="nav-item"><a class="nav-link" href="#feedback">Feedback</a></li>
                        <li class="nav-item"><a class="nav-link" href="#contact">Contact</a></li>
                        <li class="nav-item dropdown">
                            <div class="btn-toolbar mb-2 mb-md-0">
                                <div class="dropdown">
                                    <button class="btn btn-sm btn-outline-none dropdown-toggle d-flex justify-content-center align-items-center"
                                        data-bs-toggle="dropdown" type="button">
                                        <img src="../../assets/images/admin.png" alt="admin" class="rounded-circle"
                                            width="30" height="30" style="object-fit: fit;">
                                        <span class="text-login"><?php echo $username ?></span>
                                    </button>
                                    <ul class="dropdown-menu">
                                        <li><a class="dropdown-item" href="profile.html">Profile</a></li>
                                        <li><a class="dropdown-item" href="frontend/login.php">Log out</a></li>
                                    </ul>
                                </div>
                            </div>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>
    </header>

    <section class="banner-section" id="banner">
        <div class="container banner-container">
            <div class="banner-content">
                <h1>Smart <span>menu</span> for optimal health</h1>
                <p>NutriPlanner helps you build personalized nutrition plans, track your diet, and achieve your health goals in a scientific and simple way.</p>
                <div class="banner-component">
                    <div class="component">
                        <i class="fas fa-utensils"></i>
                        <div class="component-container">
                            <div class="component-number">50+</div>
                            <div class="component-text">Recipes</div>
                        </div>
                    </div>
                    <div class="component">
                        <i class="fas fa-users"></i>
                        <div class="component-container">
                            <div class="component-number">5+</div>
                            <div class="component-text">Users</div>
                        </div>
                    </div>
                    <div class="component">
                        <i class="fas fa-award"></i>
                        <div class="component-container">
                            <div class="component-number">99%</div>
                            <div class="component-text">Satisfaction</div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="banner-image">
                <img src="assets/images/top-view-food-frame-with-copy-space_23-2148821147 (1).jpg">
            </div>
        </div>
    </section>


    <section class="feature-section" id="feature">
        <div class="feature-container col-xl-10 col-xxl-9 col-11 mx-auto ">
            <div class="section-header">
                <h2>Key Features</h2>
                <p>Explore powerful tools that help you plan meals, track nutrition, and achieve your health goals with ease.</p>
            </div>
            <div class="feature-main">
                <div class="feature-box rounded-top ">
                    <a href="#meals">
                        <div class="d-flex align-items-center">
                            <div class="feature-icon">
                                <i class="fas fa-list-check"></i>
                            </div>
                            <h4 class="mx-2">Personalized Meal Plans</h4>
                        </div>
                        <p>Create meal plans tailored to your goals, whether it's weight loss, or managing specific health conditions.</p>
                    </a>
                </div>
                <div class="feature-box rounded-top">
                    <a href="#meals">
                        <div class="d-flex align-items-center">
                            <div class="feature-icon">
                                <i class="fas fa-filter"></i>
                            </div>
                            <h4 class="mx-2">Smart Filters</h4>
                        </div>
                        <p>Easily search and filter meals by ingredients, calories, special diets, or food allergies.</p>
                    </a>
                </div>
                <div class="feature-box rounded-top">
                    <a href="#meals-grid">
                        <div class="d-flex align-items-center">
                            <div class="feature-icon">
                                <i class="fas fa-chart-pie"></i>
                            </div>
                            <h4 class="mx-2">Nutrition Analysis</h4>
                        </div>
                        <p>View detailed nutritional breakdowns such as calories, protein, carbs, fats, and micronutrients for each dish.</p>
                    </a>
                </div>
                <div class="feature-box rounded-top">
                    <a href="#favourite">
                        <div class="d-flex align-items-center">
                            <div class="feature-icon">
                                <i class="fas fa-heart"></i>
                            </div>
                            <h4 class="mx-2">Favorite Dishes</h4>
                        </div>
                        <p>Bookmark and quickly access your favorite meals to simplify your future meal planning.</p>
                    </a>
                </div>
                <div class="feature-box rounded-top">
                    <a href="#calculator">
                        <div class="d-flex align-items-center">
                            <div class="feature-icon">
                                <i class="fas fa-calculator"></i>
                            </div>
                            <h4 class="mx-2">Nutrition Calculator</h4>
                        </div>
                        <p>Input ingredients and portion sizes to instantly calculate the total nutritional value of your meal.</p>
                    </a>
                </div>
                <div class="feature-box rounded-top">
                    <a href="#feedback-comment">
                        <div class="d-flex align-items-center">
                            <div class="feature-icon">
                                <i class="fas fa-comment-dots"></i>
                            </div>
                            <h4 class="mx-2">Comments & Sharing</h4>
                        </div>
                        <p>Comment, share your experiences, and review meals with the NutriPlanner community.</p>
                    </a>
                </div>
            </div>
        </div>
    </section>

    <!-- Meal Plan Section -->
    <!-- Meal Plan Section -->
    <section class="section meals" id="meals">
        <div class="container">
            <div class="section-header">
                <h2>Explore the menu</h2>
                <p>Search and filter hundreds of recipes tailored to your nutritional goals and taste.</p>
            </div>

            <div class="meal-filter">
                <div id="searchForm">

                    <div class="filters">

                        <div class="filter-group flex-fill">
                            <label class="filter-title">Diet</label>
                            <div class="hashtag-input-wrapper">
                                <input type="text" id="hashtagInput" placeholder="Enter hashtag và press Enter or (,)" data-has-listeners="true">
                                <div class="">
                                    <ul id="hashtagList" class="hashtag-list"></ul>
                                </div>

                            </div>
                        </div>
                        <div class="filter-container  d-flex">
                            <div class="filter-group col-6  pe-2">
                                <label class="filter-title">Meal Type</label>
                                <select class="hashtag-input-wrapper" name="meal_type" id="input_type">
                                    <option value="">All</option>
                                    <option value="Breakfast">Breakfast</option>
                                    <option value="Lunch">Lunch</option>
                                    <option value="Dinner">Dinner</option>
                                    <option value="Snacks">Snacks</option>
                                    <option value="Smoothies">Smoothies</option>
                                </select>
                            </div>
                            <div class="filter-group col-6  ps-2">
                                <label class="filter-title">Calories</label>
                                <select class="hashtag-input-wrapper" name="calories" id="meal_calo">
                                    <option value="">All</option>
                                    <option value="under300">Under 300 kcal</option>
                                    <option value="300-500">300 - 500 kcal</option>
                                    <option value="500-800">500 - 800 kcal</option>
                                    <option value="over800">Over 800 kcal</option>
                                </select>
                            </div>
                        </div>

                    </div>
                    <div class="search-container">
                        <input type="text" class="search-input" name="search_query" id="input_search" placeholder="Enter meal name...">
                        <button class="search-btn text-white" id="search-form">
                            <i class="fas fa-search"></i>
                            Search
                        </button>
                    </div>
                </div>
            </div>
            <div class="">
                <div class="meals-grid " id="meals-grid">

                </div>
                <!-- From Uiverse.io by zebra76966 -->



            </div>
            <div class="text-center my-2">
                <button class="c-button px-2 " id="load-more">
                    <span class="c-main">
                        Load More
                        <span class="">+</span></span>

                    </span>
                </button>
            </div>

        </div>
    </section>


    <div class="h-100 w-100 z-3 position-fixed top-0 d-none" style="background-color: rgba(0, 0, 0, 0.7);" id="detail__food">
    </div>

    <div class="mealfavourite bg-light py-3">
        <div class="section-header" id="favourite">
            <h2>Favorite meals</h2>
            <p>Bookmark and quickly access your favorite meals to simplify your future meal planning.</p>
        </div>
        <div class=" col-xl-9 col-sm-11 mx-auto my-4">
            <div class="" id="">
                <div class="item">
                    <div class="d-grid grid-col-favourite my-1" id="mealfavourite--menu">

                    </div>
                </div>
            </div>
        </div>

    </div>
    </div>

    <section class="bg-white py-3" id="calculator">
        <div class="container">
            <div class="section-header">
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
                            <div class="nutrition-result-name">Fiber</div>
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

    <div style="background: rgb(227, 247, 239);padding: 50px 0;">
        <section class="testimonials-section " id="feedback-comment">
            <div class="section-header" id="header-feedback">
                <h2>What Our Users Say</h2>
                <p class="testimonials-subtext">
                    Discover real experiences from the NutriPlanner community about improving eating habits
                    and health.
                </p>
            </div>
            <div id="carouselExampleIndicators" class="carousel slide" data-bs-ride="carousel" data-bs-interval="3000">
                <div class="carousel-indicators">
                    <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
                    <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="1" aria-label="Slide 2"></button>
                    <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="2" aria-label="Slide 3"></button>
                </div>
                <div class="carousel-inner col-xl-7 col-11 mx-auto">
                    <div class="carousel-item active  ">
                        <div class="d-flex gap-4 justify-content-around mx-auto my-3">
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
                    </div>
                    <div class="carousel-item  ">
                    <div class="d-flex gap-4 justify-content-around mx-auto my-3">
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
                    </div>
                    <div class="carousel-item  ">
                    <div class="d-flex gap-4 justify-content-around  mx-auto my-3">
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
                    </div>
                </div>
                <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="prev">
                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                    <span class="visually-hidden">Previous</span>
                </button>
                <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="next">
                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                    <span class="visually-hidden">Next</span>
                </button>
            </div>



        </section>
        <!-- Feedback section -->
        <section class="feedback-section">
            <div class="logo">
                <img loading="lazy" src="assets/images/Leonardo_Phoenix_10_A_topdown_view_of_a_food_table_divided_in_3.jpg" alt="NutriPlanner Logo" />
            </div>
            <div class="feedback-card" id="feedback">
                <h3>Submit Your Feedback</h3>
                <div class="star-rating" id="starRating">
                    <span data-value="1">☆</span>
                    <span data-value="2">☆</span>
                    <span data-value="3">☆</span>
                    <span data-value="4">☆</span>
                    <span data-value="5">☆</span>
                </div>
                <form id="feedbackForm">
                    <input type="text" placeholder="Full Name" name="fullname" required />
                    <input type="hidden" name="rating" id="ratingInput">
                    <input type="email" placeholder="Email" name="email" required />
                    <textarea placeholder="Share your experience..." name="message" required rows="3"></textarea>
                    <button type="submit">Submit Feedback</button>
                </form>
            </div>
        </section>
    </div>


    <section class="section contact p-0" id="contact">
        <div class="container-fluid shadow bg-white py-5 ">
            <div class="section-header ">
                <h2>Contact Us</h2>
                <p>Do you have questions or need support? The NutriPlanner team is always ready to assist you.</p>
            </div>

            <div class="col-xl-10 col-11 d-flex mx-auto justify-content-around ">
                <div class="contact-info1 mx-3">
                    <h3>Contact Information</h3>
                    <div class="contact-details">
                        <div>
                            <div class="contact-icon">
                                <i class="fas fa-map-marker-alt"></i>
                            </div>
                            <div class="contact-text" style="display: inline-block;">
                                <h4>Address</h4>
                                <p>285 Doi Can Street, Ba Dinh District, Hanoi City</p>
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
                                <h4>Business Hours</h4>
                                <p>Monday - Friday: 8:00 - 18:00<br>Saturday: 9:00 - 12:00</p>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="map-container flex-fill">
                    <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3723.9231239864!2d105.81641017601285!3d21.035761787536657!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3135ab0d127a01e7%3A0xab069cd4eaa76ff2!2zMjg1IFAuIMSQ4buZaSBD4bqlbiwgTGnhu4V1IEdpYWksIEJhIMSQw6xuaCwgSMOgIE7hu5lpIDEwMDAwMCwgVmlldG5hbQ!5e0!3m2!1sen!2s!4v1747836344495!5m2!1sen!2s" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
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
                                <div class="contact-infoo ">
                                    <i class="fas fa-map-marker-alt"></i>
                                    <p class="mb-0 ms-2 my-2">123 Nguyen Hue Street, District 1, Ho Chi Minh City</p>
                                </div>
                                <div class="contact-infoo ">
                                    <i class="fas fa-phone-alt"></i>
                                    <p class=" ms-2 my-2">+84 28 1234 5678</p>
                                </div>
                                <div class="contact-infoo ">
                                    <i class="fas fa-envelope"></i>
                                    <p class="ms-2 my-2">support@nutriplanner.com</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="footer-bottom">
                    <p>© 2025 NutriPlanner. Project by Team 3. All rights reserved.</p>
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
    <script>
        document.addEventListener("DOMContentLoaded", () => {
            const hashtagInput = document.getElementById("hashtagInput");
            const hashtagList = document.getElementById("hashtagList");

            const renderHashtags = () => {
                hashtagList.innerHTML = "";
                hashtags.forEach((tag, index) => {
                    const li = document.createElement("li");
                    li.className = "hashtag-item";

                    const span = document.createElement("span");
                    span.className = "value__tag"; // 👈 Thêm class vào đây
                    span.textContent = tag; // An toàn

                    const button = document.createElement("button");
                    button.type = "button";
                    button.className = "remove-tag";
                    button.dataset.index = index;
                    button.textContent = "x";

                    li.appendChild(span);
                    li.appendChild(button);
                    hashtagList.appendChild(li);
                });
            };

            // Hàm để thêm một hashtag
            const addHashtag = (tag) => {
                const cleanedTag = tag.trim().toLowerCase(); // Xóa khoảng trắng và chuyển về chữ thường
                if (cleanedTag && !hashtags.includes(cleanedTag)) {
                    // Chỉ thêm nếu không rỗng và chưa tồn tại
                    hashtags.push(cleanedTag);
                    console.log(hashtags);
                    renderHashtags();
                }
            };

            // Hàm để xóa một hashtag
            const removeHashtag = (index) => {
                hashtags.splice(index, 1); // Xóa phần tử tại vị trí index
                renderHashtags();
            };


            hashtagInput.addEventListener("keydown", (e) => {
                console.log("danhan");
                if (e.key === "Enter" || e.key === ",") {

                    e.preventDefault();
                    const inputValue = hashtagInput.value;
                    if (inputValue) {
                        addHashtag(inputValue);
                        hashtagInput.value = ""; // Xóa nội dung trong input sau khi thêm
                    }
                }
            });

            // Lắng nghe sự kiện click trên các nút 'x' (xóa hashtag)
            hashtagList.addEventListener("click", (e) => {
                if (e.target.classList.contains("remove-tag")) {
                    const index = parseInt(e.target.dataset.index); // Lấy index từ data-index
                    removeHashtag(index);
                }
            });

            // (Tùy chọn) Xử lý dán văn bản có nhiều hashtag
            hashtagInput.addEventListener("paste", (e) => {
                e.preventDefault();
                const pasteData = e.clipboardData.getData("text");
                const tags = pasteData
                    .split(/[\s,]+/)
                    .filter((tag) => tag.trim() !== ""); // Tách theo khoảng trắng hoặc dấu phẩy
                tags.forEach((tag) => addHashtag(tag));
                hashtagInput.value = "";
            });

        });
    </script>
</body>

</html>