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
    <link rel="stylesheet" href="../assets/css/calculator.css">

    <style>
        /* CSS Search */

        .section-header {
            text-align: center;
        }

        .section-header h2 {
            font-size: 2.5rem;
            position: relative;
            margin-bottom: 15px;
        }

        .section-header h2::after {
            content: "";
            position: absolute;
            background: var(--primary);
            width: 50px;
            height: 3px;
            bottom: -10px;
            left: 50%;
            transform: translateX(-50%);
            border-radius: 5px;
        }

        .section-header p {
            color: var(--text-light);
            font-size: 1.1rem;
        }

        .search-container {
            display: flex;
            gap: 10px;
            margin-bottom: 20px;
        }

        .search-input {
            padding: 12px 20px;
            flex-grow: 1;
            border: 1px solid #ddd;
            border-radius: 50px;
            font-family: "Poppins", sans-serif;
            font-size: 1rem;
            transition: all 0.3s ease;
        }

        .search-input:focus {
            border-color: var(--primary);
            box-shadow: 0 0 2px rgba(46, 204, 113, 0.5);
        }

        .search-btn {
            padding: 12px 20px;
            border-radius: 50px;
            background: var(--primary);
            color: #fff;
            font-weight: 600;
            cursor: pointer;
            font-family: "Poppins", sans-serif;
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .search-btn:hover {
            background: var(--primary-dark);
        }

        .filter {
            display: flex;
            gap: 15px;
            flex-wrap: wrap;
            margin-bottom: 30px;
        }

        .filter-group {
            display: flex;
            flex-direction: column;
            flex: 1;
            min-width: 180px;
        }

        .filter-title {
            font-weight: 600;
            font-size: 0.9rem;
            margin-bottom: 8px;
            color: var(--text-dark);
        }

        .filter-select {
            padding: 10px 15px;
            border: 1px solid #ddd;
            border-radius: 8px;
            font-family: "Poppins", sans-serif;
            outline: none;
            background-color: #fff;
            transition: all 0.3s ease;
            font-size: 0.813rem;
        }

        .filter-select:focus {
            border-color: var(--primary);
        }

        .meal-tabs {
            display: flex;
            justify-content: center;
            gap: 15px;
            margin-bottom: 15px;
        }

        .tab-btn {
            padding: 10px 20px;
            border-radius: 50px;
            font-weight: 500;
            background: var(--bg-light);
            cursor: pointer;
            transition: all 0.3s ease;
            border: none;
            font-family: "Poppins", sans-serif;
        }

        .tab-btn.active {
            background: var(--primary);
            color: #fff;
        }

        .meal-card {
            border-radius: 18px;
            box-shadow: 0 4px 24px 0 rgba(0, 0, 0, 0.08);
            background: #fff;
            overflow: hidden;
            margin: 16px 0;
            transition: box-shadow 0.2s;
            display: flex;
            flex-direction: column;
            position: relative;
            min-width: 320px;
            max-width: 350px;
        }

        .meal-card .meal-image-wrapper {
            position: relative;
            width: 100%;
            height: 180px;
            overflow: hidden;
            border-top-left-radius: 18px;
            border-top-right-radius: 18px;
        }

        .meal-card .meal-img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            display: block;
        }

        .meal-card .favorite-btn {
            position: absolute;
            top: 14px;
            right: 14px;
            background: #fff;
            border: none;
            border-radius: 50%;
            width: 36px;
            height: 36px;
            display: flex;
            align-items: center;
            justify-content: center;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.10);
            color: #e74c3c;
            font-size: 1.2rem;
            cursor: pointer;
            z-index: 2;
            transition: background 0.2s;
        }

        .meal-card .favorite-btn:hover {
            background: #ffeaea;
        }

        .meal-content {
            padding: 18px 18px 14px 18px;
            display: flex;
            flex-direction: column;
            gap: 8px;
        }

        .meal-header {
            display: flex;
            align-items: center;
            gap: 8px;
        }

        .meal-checkbox {
            accent-color: #2ecc71;
            width: 18px;
            height: 18px;
        }

        .meal-title {
            font-size: 1.1rem;
            font-weight: 600;
            margin: 0;
        }

        .meal-tags {
            display: flex;
            gap: 8px;
            flex-wrap: wrap;
            margin-bottom: 6px;
        }

        .meal-tag {
            background: #f3f6fa;
            color: #2ecc71;
            border-radius: 12px;
            padding: 2px 12px;
            font-size: 0.85rem;
            font-weight: 500;
            text-transform: lowercase;
            letter-spacing: 0.5px;
            border: none;
            display: inline-block;
        }

        .meal-tag:nth-child(2) {
            color: #3498db;
            background: #eaf6fb;
        }

        .meal-tag:nth-child(3) {
            color: #9b59b6;
            background: #f5eafd;
        }

        .meal-tag:nth-child(4) {
            color: #e67e22;
            background: #fdf3e6;
        }

        .meal-stats {
            display: flex;
            gap: 18px;
            margin-top: 8px;
        }

        .meal-stat {
            display: flex;
            align-items: center;
            gap: 5px;
            color: #2ecc71;
            font-size: 1rem;
            font-weight: 500;
        }

        .meal-stat i {
            font-size: 1.1em;
        }

        .meals-grid {
            display: flex;
            flex-wrap: wrap;
            justify-content: start;
            gap: 32px 24px;
            margin-top: 24px;
        }

        .meal-card {
            flex: 0 1 calc(33.333% - 24px);
            max-width: calc(33.333% - 24px);
            min-width: 320px;
            box-sizing: border-box;
        }

        @media (max-width: 992px) {
            .meal-card {
                flex: 0 1 calc(50% - 24px);
                max-width: calc(50% - 24px);
            }
        }

        @media (max-width: 600px) {
            .meal-card {
                flex: 0 1 100%;
                max-width: 100%;
            }
        }
    </style>
</head>


<body>
    <?php
    include("./frontend/Components/header.php")
    ?>

    <section>
        <div class="container">
            <div class="section-header">
                <h2>Discover the Menu</h2>
                <p>Search and filter hundreds of recipes that match your nutritional goals and taste preferences.</p>
            </div>
            <div class="meal-filter">
                <form id="searchForm" method="GET" action="../backend/search.php">
                    <div class="search-container">
                        <input type="text" class="search-input" name="search_query" placeholder="Search for dishes or ingredients...">
                        <button type="submit" class="search-btn">
                            <i class="fas fa-search"></i>
                            Search
                        </button>
                    </div>
                    <div class="filter">
                        <div class="filter-group">
                            <label class="filter-title">Meal Type</label>
                            <select class="filter-select" name="meal_type">
                                <option value="all">All</option>
                                <option value="1">Breakfast</option>
                                <option value="2">Lunch</option>
                                <option value="3">Dinner</option>
                                <option value="4">Snacks</option>
                                <option value="5">Drinks</option>
                            </select>
                        </div>
                        <div class="filter-group">
                            <label class="filter-title">Diet Type</label>
                            <select class="filter-select" name="diet_type">
                                <option value="all">All</option>
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
                            <select class="filter-select" name="calories">
                                <option value="all">All</option>
                                <option value="under300">Under 300 kcal</option>
                                <option value="300-500">300 - 500 kcal</option>
                                <option value="500-800">500 - 800 kcal</option>
                                <option value="over800">Over 800 kcal</option>
                            </select>
                        </div>
                    </div>
                </form>
            </div>
            <div class="meal-tabs">
                <button class="tab-btn active" data-type="all">All</button>
                <button class="tab-btn" data-type="breakfast">Breakfast</button>
                <button class="tab-btn" data-type="lunch">Lunch</button>
                <button class="tab-btn" data-type="dinner">Dinner</button>
                <button class="tab-btn" data-type="snack">Snacks</button>
                <button class="tab-btn" data-type="smoothie">Drinks</button>
            </div>

            <div class="meals-grid" id="meals-grid"></div>

        </div>
    </section>


    <div class="examPlan container" id="default-meal-list">
        <div class="col-xxl-10 col-xl-10 col-sm-11 mx-auto my-4">
            <div class="" id="meal-cate">
                <div class="item">
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

    <section style="margin-top: 50px; margin-bottom: 50px; ">
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
                        <div class="ingredient-item">
                            <select id="ingredient-option">
                                <option value="Rice">Rice</option>
                                <option value="Chicken Breast">Chicken Breast</option>
                                <option value="Avocado">Avocado</option>
                                <option value="Spinach">Spinach</option>
                                <option value="Banana">Banana</option>
                                <option value="Pumpkin">Pumpkin</option>
                                <option value="Quinoa">Quinoa</option>
                                <option value="Soybeans">Soybeans</option>
                                <option value="Sweet Potato">Sweet Potato</option>
                                <option value="Egg">Egg</option>
                                <option value="Oats">Oats</option>
                                <option value="Salmon">Salmon</option>
                                <option value="Lentils">Lentils</option>
                                <option value="Tomato">Tomato</option>
                                <option value="Apple">Apple</option>
                                <option value="Almonds">Almonds</option>
                                <option value="Greek Yogurt">Greek Yogurt</option>
                                <option value="Mushroom">Mushroom</option>
                                <option value="Black Beans">Black Beans</option>
                                <option value="Cabbage">Cabbage</option>
                            </select>
                            <input type="number" placeholder="Gram">
                        </div>
                    </div>
                    <button class="add-ingredient" id="add-ingredient">Add Ingredient</button>
                    <button class="button calculate-btn" id="calculate-btn">Calculate Nutrition</button>
                </div>
                <div class="calculator-result">
                    <h3>Nutrition Analysis Results</h3>
                    <div class="total-calories" id="total-calories">
                        0 kcal
                    </div>
                    <div class="nutrition-results" id="nutrition-results">
                        <div class="nutrition-result-item">
                            <div class="nutrition-result-name">Protein</div>
                            <div class="nutrition-result-value" id="protein-result">0g</div>
                        </div>
                        <div class="nutrition-result-item">
                            <div class="nutrition-result-name">Carbs</div>
                            <div class="nutrition-result-value" id="carbs-result">0g</div>
                        </div>
                        <div class="nutrition-result-item">
                            <div class="nutrition-result-name">Chất béo</div>
                            <div class="nutrition-result-value" id="fat-result">0g</div>
                        </div>
                        <div class="nutrition-result-item">
                            <div class="nutrition-result-name">Đường</div>
                            <div class="nutrition-result-value" id="sugar-result">0g</div>
                        </div>
                        <div class="nutrition-result-item">
                            <div class="nutrition-result-name">Chất xơ</div>
                            <div class="nutrition-result-value" id="fiber-result">0g</div>
                        </div>
                        <div class="nutrition-result-item">
                            <div class="nutrition-result-name">Natri</div>
                            <div class="nutrition-result-value" id="sodium-result">0g</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <div class="d-none popup-overlay" id="pop-login-form">
        <div class="popup-content bg-white p-4 rounded shadow">
            <form class="form">
                <div class="d-flex justify-content-between align-items-center mb-3">
                    <h4>Login Form</h4>
                    <span class="close-popup-login" id="close-popup-login">X</span>
                </div>
                <div class="mb-3">
                    <label for="email" class="form-label">Email:</label>
                    <input type="email" class="form-control" id="email-login">
                </div>
                <div class="mb-3">
                    <label for="email" class="form-label">Password:</label>
                    <input type="password" class="form-control" id="password-login">
                </div>
                <p>Don't have an account? <a id="to-register" style="cursor: pointer;"> Register here</a></p>
                <button type="submit" class="bttn">Log In</button>
            </form>
        </div>
    </div>

    <div class="d-none popup-overlay" id="pop-register-form">
        <div class="popup-content bg-white p-4 rounded shadow">
            <form>
                <div class="d-flex justify-content-between align-items-center mb-3">
                    <h4>Register Form</h4>
                    <span class="close-popup-login" id="close-pop-register">X</span>
                </div>
                <div class="mb-3">
                    <label class="form-label">User Name:</label>
                    <input class="form-control" id="username-signup">
                </div>
                <div class="mb-3">
                    <label class="form-label">Email:</label>
                    <input class="form-control" id="email-signup">
                </div>
                <div class="mb-3">
                    <label class="form-label">Passwork:</label>
                    <input type="password" class="form-control" id="passwork-signup">
                </div>
                <div class="mb-3">
                    <p class="mt-2">Already have an account?
                        <a id="to-login" style="cursor: pointer;">Log in here</a>
                    </p>
                    <button type="submit" class="bttn">Log In</button>
                </div>
            </form>
        </div>
    </div>

    <div class="linkplan d-flex flex-column bg-orange p-4">
        <h1 class="mx-auto">Create a full weekly plan from scratch</h1>
        <button class="btn text-white rounded-5 px-3 mx-auto" style="background-color: var(--orange);">
            <h3>Get Free Plan</h3>
        </button>
    </div>
    <div class="mealfavourite bg-light py-3">
        <div class=" col-xl-7 col-sm-11 mx-auto my-4">
            <div class="" id="">
                <div class="item">
                    <div class="d-grid grid-col-favourite my-1" id="mealfavourite--menu">
                        <!-- <div class="meals-grid" id="meals-grid"> -->
                    </div>
                </div>
            </div>
        </div>

    </div>
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
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        // Xử lý sự kiện khi trang web đã load xong
        document.addEventListener('DOMContentLoaded', () => {
            // Lấy tất cả các nút tab
            const tabbutton = document.querySelectorAll('.tab-btn');

            // Thêm sự kiện click cho từng nút
            tabbutton.forEach(button => {
                button.addEventListener('click', () => {
                    // Xóa class active ở tất cả các nút
                    tabbutton.forEach(btn => btn.classList.remove('active'));
                    // Thêm class active cho nút được click
                    button.classList.add('active');
                });
            });
        });
    </script>
</body>

</html>