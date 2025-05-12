<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="../assets/css/bootstrap.css" rel="stylesheet">
    <!-- <link rel="stylesheet" href="../assets/css/style.css"> -->
    <link rel="stylesheet" href="../assets/css/responsive.css">
    <style>
        .main-header {
            background-color: #fff;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
            position: sticky;
            top: 0;
            z-index: 1000;
        }

        .container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 0 15px;
        }

        .outer-box {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 15px 0;
        }

        .logo-box img {
            max-width: 150px;
            height: auto;
        }

        .nav ul {
            display: flex;
            list-style: none;
            margin: 0;
            padding: 0;
        }

        .nav ul li {
            margin: 0 15px;
        }

        .nav-link {
            text-decoration: none;
            color: #333;
            font-weight: 500;
            font-size: 16px;
            transition: color 0.3s;
        }

        .nav-link:hover {
            color: #007bff;
        }

        .nav ul li a {
            position: relative;
            text-decoration: none;
            color: #010101;
            font-weight: 500;
            white-space: nowrap;
            display: inline-block;
        }

        .nav ul li a::after {
            position: absolute;
            content: "";
            bottom: -5px;
            left: 50%;
            width: 0;
            height: 2px;
            background-color: #f78014;
            transition: width 0.3s ease, left 0.3s ease;
        }

        .nav ul li a:hover::after {
            width: 100%;
            left: 0;
        }

        a.btn.btn-darkk {
            display: inline-block;
            color: #1ebfc1;
            text-align: center;
            font-weight: 600;
            border-radius: 6px;
            border: 1px solid #1ebfc1;
        }

        a.btn.btn-darkk:hover {
            background: #1ebfc1;
            color: white;
            transition: 0.3s;
        }

        .header_cta {
            display: flex;
            gap: 10px;
        }

        .btn {
            padding: 8px 20px;
            border-radius: 5px;
            text-decoration: none;
            font-size: 14px;
            font-weight: 500;
        }

        .hamburger {
            display: none;
            font-size: 24px;
            cursor: pointer;
        }

        .mobile-only {
            display: none;
        }

        /* Tablet */
        @media (max-width: 768px) {
            .outer-box {
                flex-wrap: wrap;
            }

            .logo-box img {
                max-width: 120px;
            }

            .nav {
                order: 3;
                width: 100%;
                display: none;
                transition: all 0.3s ease;
            }

            .nav.active {
                display: block;
            }

            .nav ul {
                flex-direction: column;
                text-align: center;
                padding: 10px 0;
            }

            .nav ul li {
                margin: 10px 0;
            }

            .hamburger {
                display: block;
                order: 2;
            }

            .header_cta {
                order: 1;
                margin-left: auto;
                gap: 5px;
            }

            .btn {
                padding: 6px 15px;
                font-size: 13px;
            }
        }

        /* Mobile */
        @media (max-width: 480px) {
            .logo-box img {
                max-width: 100px;
            }

            .header_cta {
                flex-direction: column;
                align-items: center;
                width: 100%;
                margin: 10px 0;
            }

            .btn {
                width: 100%;
                text-align: center;
                padding: 8px;
            }

            .hamburger {
                font-size: 20px;
            }

            .mobile-only {
                display: block;
            }
        }
    </style>

</head>

<body>
    <header class="main-header">
        <div class="header-lower">
            <div class="container">
                <div class="outer-box clearfix">
                    <div class="logo-box">
                        <figure class="logo">
                            <a href="index.html"><img src="../assets/images/NUTRIPLANNER.png" alt="NutriPlanner Logo"></a>
                        </figure>
                    </div>
                    <div class="hamburger" aria-label="Toggle menu">☰</div>
                    <div class="nav">
                        <ul>
                            <li><a href="" class="nav-link">Shopping</a></li>
                            <li><a href="" class="nav-link">Meal Planner</a></li>
                            <li><a href="" class="nav-link">Communities</a></li>
                            <li><a href="" class="nav-link">Blog</a></li>
                            <li><a href="" class="nav-link">Food+</a></li>
                            <li class="mobile-only"><a href="login.php" class="nav-link mobile-cta">Sign in</a></li>
                            <li class="mobile-only"><a href="signup.php" class="nav-link mobile-cta">Sign up</a></li>
                        </ul>
                    </div>
                    <div class="header_cta">
                        <a href="login.php" class="btn header_cta_sec">Sign in</a>
                        <a href="signup.php" class="btn btn-darkk header_cta_sec">Sign up</a>
                    </div>
                </div>
            </div>
        </div>
    </header>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <!-- </body>

</html> -->