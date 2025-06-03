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
    <link rel="stylesheet" href="../../assets/css/style.css">
    <!-- <link rel="stylesheet" href="../assets/css/responsive.css"> -->
    <style>
        .main-header {
            background-color: #ffffff;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
            position: fixed;
            width: 100%;
            top: 0;
            z-index: 1000;
            height: 70px;
        }

        .logo {
            display: flex;
            align-items: center;
            font-size: 1.5rem;
            font-weight: bold;
            color: #2ecc71 !important;
            text-decoration: none;
            gap: 0.5rem;
            white-space: nowrap;
        }

        .logo i {
            font-size: 1.8rem;
        }

        .fa-seedling {
            color: #2ecc71;
        }

        .nav-links {
            display: flex;
            align-items: center;
            gap: 0.8rem;
            list-style: none;
            margin: 0;
            padding: 0;
            flex-wrap: nowrap;
        }

        .nav-links li {
            padding: 0 15px;
        }


        body {
            padding-top: 70px;
            font-family: "Poppins", sans-serif;
        }

        .btn-sm {
            padding: 0.25rem 0.5rem;
            font-size: 0.75rem;
        }

        .btn {
            border-radius: 0.35rem;
            font-size: 0.85rem;
            font-weight: 600;
        }

        .text-login {
            position: relative;
            bottom: 10px;
            left: 2px;
        }

        .dropdown-toggle::after {
            display: inline-block;
            margin-left: .255em;
            vertical-align: .255em;
            content: "";
            border-top: .3em solid;
            border-right: .3em solid transparent;
            border-bottom: 0;
            border-left: .3em solid transparent;
        }

        .nav-links li a {
            color: #333;
            text-decoration: none;
            transition: color 0.3s ease;
            white-space: nowrap;
        }

        .nav-links li a:hover {
            color: #2ecc71 !important;
        }

        @media (max-width: 768px) {
            .nav-links {
                background-color: #2ecc71;
                margin-top: 20px;
                flex-direction: column;
                width: 100%;
            }

            .nav-links li {
                padding: 10px 0;
            }

            .nav-links li a {
                width: 100%;
                color: #fff !important;
            }

            .text-login {
                color: #fff;
            }

            .dropdown.dropdown.dropdown-item {
                color: #333 !important;
            }
        }
    </style>

</head>

<body>
    <header class="main-header">
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
                        <li class="nav-item"><a class="nav-link" href="#">Feature</a></li>
                        <li class="nav-item"><a class="nav-link" href="#">Menu</a></li>
                        <li class="nav-item"><a class="nav-link" href="#">Calculator</a></li>
                        <li class="nav-item"><a class="nav-link" href="#">Testimonials</a></li>
                        <li class="nav-item"><a class="nav-link" href="#">Feedback</a></li>
                        <li class="nav-item"><a class="nav-link" href="#">Contact</a></li>
                        <li class="nav-item dropdown">
                            <div class="btn-toolbar mb-2 mb-md-0">
                                <div class="dropdown">
                                    <button class="btn btn-sm btn-outline-none dropdown-toggle"
                                        data-bs-toggle="dropdown" type="button">
                                        <img src="../../assets/images/admin.jpg" alt="admin" class="rounded-circle"
                                            width="30">
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
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
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