<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="../../assets/css/bootstrap.css" rel="stylesheet">
    <link href="../../assets/css/reset.css" rel=" stylesheet">
    <link rel="stylesheet" href="../../assets/fontawesome-free-6.7.2-web/css/all.min.css">
    <script src=" https://kit.fontawesome.com/1852d76d47.js" crossorigin="anonymous">
    </script>
    <!-- <link rel="stylesheet" href="../../assets/css/style.css"> -->
    <style>
        footer {
            background: #2c3e50;
            color: white;
            padding: 15px 0 30px;
        }

        body {
            font-family: "Poppins", sans-serif;
            color: #2c3e50;
            line-height: 1.6;
            background-color: var(--bg-light);
            overflow-x: hidden;
            position: relative;
        }


        h1,
        h2,
        h3,
        h4 {
            font-family: "Montserrat", sans-serif;
            font-weight: 700;
            line-height: 1.3;
        }

        .footer-logo {
            display: flex;
            align-items: center;
            font-size: 1.8rem;
            font-weight: 700;
            color: #2ecc71 !important;
            text-decoration: none;
            gap: 0.5rem;
            color: #ecf0f1 !important;
            white-space: nowrap;
            margin-bottom: 20px;
        }

        .footer-logo i {
            font-size: 1.8rem;
        }

        .fa-seedling {
            color: #ecf0f1;
        }

        .footer-top {
            display: flex;
            justify-content: space-between;
            flex-wrap: wrap;
            padding: 20px;
            background-color: #2c3e50;
            color: #ecf0f1;
        }

        .nav_menu {
            flex: 1;
            min-width: 200px;
            margin: 10px;
        }

        .widget-title h3 {
            font-size: 1.3rem;
            margin-bottom: 20px;
            position: relative;
            padding-bottom: 10px;
        }

        .widget-title h3::after {
            content: '';
            position: absolute;
            bottom: 0;
            left: 0;
            background: #2ecc71;
            width: 30px;
            height: 2px;
            border-radius: 5px;
        }

        .footer-links {
            list-style: none;
            padding: 0;
        }

        .footer-links li {
            margin-bottom: 5px;
            /* Space between links */
        }

        .footer-links li a {
            color: #ecf0f1;
            text-decoration: none;
            transition: color 0.3s;
            transition: all 0.3s ease;
        }

        .footer-links li a:hover {
            color: #2ecc71 !important;
            padding-left: 5px;
        }

        .footer-bottom {
            text-align: center;
            padding-top: 30px;
            border-top: 1px solid rgba(255, 255, 255, 0.1);
            opacity: 0.7;
            font-size: 0.9rem;
        }

        .contact-info {
            display: flex;
            flex-direction: column;
        }

        .contact-info div {
            display: flex;
            align-items: flex-start;
            margin-bottom: 20px;
            padding: 20px;

        }

        .contact-info i {
            margin-right: 10px;
            margin-top: 5px;
            color: #2ecc71;
        }

        .social-links {
            display: flex;
            gap: 15px;
            padding: 20px 0 0 0;
        }


        .social-link {
            width: 40px;
            height: 40px;
            background: rgba(255, 255, 255, 0.1);
            display: flex;
            align-items: center;
            justify-content: center;
            border-radius: 50%;
            transition: all 0.3s ease;
        }

        .social-link:hover {
            background: #2ecc71;
            transform: translateY(-3px);
        }

        .contact-info {
            margin: 10px 0;
        }

        .contact-info i {
            position: absolute;
            right: 395px;
        }
    </style>
</head>

<body>

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
    <script src="assets/js/bootstrap.min.js"></script>
</body>

</html>