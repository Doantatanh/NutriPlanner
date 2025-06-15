<?php
session_start();
$username = $_SESSION['username'];

$host = "localhost";
$dbname = "nutriplanner";
$port = "3306";
$user = "root";
$pass = "";

try {
    $conn = new PDO("mysql:host=$host;dbname=$dbname;port=$port", $user, $pass);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $sqlTotalDish = "SELECT COUNT(*) AS total FROM meals";
    $stmt = $conn->prepare($sqlTotalDish);
    $stmt->execute();
    $result = $stmt->fetch(PDO::FETCH_ASSOC);
    $totalDish = $result['total'];

        $sqlTotalUsers = "SELECT COUNT(*) AS total FROM users";
        $stmt = $conn->prepare($sqlTotalUsers);
        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        $totalUsers = $result['total'];

        $sqlTotalFeedback = "SELECT COUNT(*) AS total FROM feedbacks    ";
        $stmt = $conn->prepare($sqlTotalFeedback);
        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        $totalFeedback = $result['total'];

        $sqlRecentMeals = "SELECT * FROM meals ORDER BY created_at DESC LIMIT 12";
        $stmt = $conn->prepare($sqlRecentMeals);
        $stmt->execute();
        $recentMeals = $stmt->fetchAll(PDO::FETCH_ASSOC);

    } catch (PDOException $e) {
        echo "Fail connection" . $e->getMessage(); 
    }
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="../assets/fontawesome-free-6.7.2-web/css/all.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="../assets/css/style-admin.css">
    <link href="../assets/css/reset.css" rel=" stylesheet">
    <link rel="stylesheet" href="">
</head>

<body>
    <div class="container-fluid">
        <div class="row">
            <!-- sidebar -->
            <nav id="sidebar" class="col-md-3 col-lg-2 d-md-block bg-dark sidebar collapse">
                <div class="position-sticky pt-3">
                    <div class="logo-admin text-center pt-3 d-flex align-items-center justify-content-center">
                        <a href="#"> <i class="fas fa-seedling"></i>
                            <span>NutriPlanner</span>
                        </a>
                    </div>
                    <ul class="nav flex-column">
                        <li class="nav-item">
                            <a href="./admin.php" class="nav-link active text-white tab-btn">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                                    style="margin-right: 5px; transform: translateY(-3px);" class="bi bi-speedometer2"
                                    viewBox="0 0 16 16">
                                    <path
                                        d="M8 4a.5.5 0 0 1 .5.5V6a.5.5 0 0 1-1 0V4.5A.5.5 0 0 1 8 4M3.732 5.732a.5.5 0 0 1 .707 0l.915.914a.5.5 0 1 1-.708.708l-.914-.915a.5.5 0 0 1 0-.707M2 10a.5.5 0 0 1 .5-.5h1.586a.5.5 0 0 1 0 1H2.5A.5.5 0 0 1 2 10m9.5 0a.5.5 0 0 1 .5-.5h1.5a.5.5 0 0 1 0 1H12a.5.5 0 0 1-.5-.5m.754-4.246a.39.39 0 0 0-.527-.02L7.547 9.31a.91.91 0 1 0 1.302 1.258l3.434-4.297a.39.39 0 0 0-.029-.518z" />
                                    <path fill-rule="evenodd"
                                        d="M0 10a8 8 0 1 1 15.547 2.661c-.442 1.253-1.845 1.602-2.932 1.25C11.309 13.488 9.475 13 8 13c-1.474 0-3.31.488-4.615.911-1.087.352-2.49.003-2.932-1.25A8 8 0 0 1 0 10m8-7a7 7 0 0 0-6.603 9.329c.203.575.923.876 1.68.63C4.397 12.533 6.358 12 8 12s3.604.532 4.923.96c.757.245 1.477-.056 1.68-.631A7 7 0 0 0 8 3" />
                                </svg>
                                Dashboard
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="./meal_manager.html" class="nav-link text-white tab-btn">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                                    style="margin-right: 5px; transform: translateY(-3px);" class="bi bi-egg-fried"
                                    viewBox="0 0 16 16">
                                    <path d="M8 11a3 3 0 1 0 0-6 3 3 0 0 0 0 6" />
                                    <path
                                        d="M13.997 5.17a5 5 0 0 0-8.101-4.09A5 5 0 0 0 1.28 9.342a5 5 0 0 0 8.336 5.109 3.5 3.5 0 0 0 5.201-4.065 3.001 3.001 0 0 0-.822-5.216zm-1-.034a1 1 0 0 0 .668.977 2.001 2.001 0 0 1 .547 3.478 1 1 0 0 0-.341 1.113 2.5 2.5 0 0 1-3.715 2.905 1 1 0 0 0-1.262.152 4 4 0 0 1-6.67-4.087 1 1 0 0 0-.2-1 4 4 0 0 1 3.693-6.61 1 1 0 0 0 .8-.2 4 4 0 0 1 6.48 3.273z" />
                                </svg>
                                Meal manager
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="./user_manager.php" class="nav-link text-white tab-btn">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                                    style="margin-right: 5px; transform: translateY(-3px);" class="bi bi-people"
                                    viewBox="0 0 16 16">
                                    <path
                                        d="M15 14s1 0 1-1-1-4-5-4-5 3-5 4 1 1 1 1zm-7.978-1L7 12.996c.001-.264.167-1.03.76-1.72C8.312 10.629 9.282 10 11 10c1.717 0 2.687.63 3.24 1.276.593.69.758 1.457.76 1.72l-.008.002-.014.002zM11 7a2 2 0 1 0 0-4 2 2 0 0 0 0 4m3-2a3 3 0 1 1-6 0 3 3 0 0 1 6 0M6.936 9.28a6 6 0 0 0-1.23-.247A7 7 0 0 0 5 9c-4 0-5 3-5 4q0 1 1 1h4.216A2.24 2.24 0 0 1 5 13c0-1.01.377-2.042 1.09-2.904.243-.294.526-.569.846-.816M4.92 10A5.5 5.5 0 0 0 4 13H1c0-.26.164-1.03.76-1.724.545-.636 1.492-1.256 3.16-1.275ZM1.5 5.5a3 3 0 1 1 6 0 3 3 0 0 1-6 0m3-2a2 2 0 1 0 0 4 2 2 0 0 0 0-4" />
                                </svg>
                                User management
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="./feedback_manager.php" class="nav-link text-white tab-btn">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                                    style="margin-right: 5px; transform: translateY(-3px);" class="bi bi-chat-dots"
                                    viewBox="0 0 16 16">
                                    <path
                                        d="M5 8a1 1 0 1 1-2 0 1 1 0 0 1 2 0m4 0a1 1 0 1 1-2 0 1 1 0 0 1 2 0m3 1a1 1 0 1 0 0-2 1 1 0 0 0 0 2" />
                                    <path
                                        d="m2.165 15.803.02-.004c1.83-.363 2.948-.842 3.468-1.105A9 9 0 0 0 8 15c4.418 0 8-3.134 8-7s-3.582-7-8-7-8 3.134-8 7c0 1.76.743 3.37 1.97 4.6a10.4 10.4 0 0 1-.524 2.318l-.003.011a11 11 0 0 1-.244.637c-.079.186.074.394.273.362a22 22 0 0 0 .693-.125m.8-3.108a1 1 0 0 0-.287-.801C1.618 10.83 1 9.468 1 8c0-3.192 3.004-6 7-6s7 2.808 7 6-3.004 6-7 6a8 8 0 0 1-2.088-.272 1 1 0 0 0-.711.074c-.387.196-1.24.57-2.634.893a11 11 0 0 0 .398-2" />
                                </svg>
                                Feedback
                            </a>
                        </li>
                    </ul>
                </div>
            </nav>
            <!-- main -->
            <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
                <div
                    class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
                    <h1 class="h2 fw-bold">Dashboard</h1>
                    <div class="btn-toolbar mb-2 mb-md-0">
                        <div class="dropdown">
                            <button class="btn btn-sm btn-outline-none dropdown-toggle dropdown-toggle d-flex justify-content-center align-items-center"
                                data-bs-toggle="dropdown" type="button">
                                <img src="../assets/images/admin.png" alt="admin" class="rounded-circle" width="30">
                                <span class="text-login">Admin</span>
                            </button>
                            <ul class="dropdown-menu">
                                <li><a class="dropdown-item" href="profile.html">Profile</a></li>
                                <li><a class="dropdown-item" href="./login.php">Log out</a></li>
                            </ul>
                        </div>
                    </div>
                </div>
                <!-- Dashboard stats -->
                <div class="row">
                    <div class="col-md-4 mb-4">
                        <div class="card bg-primaryy text-white ">
                            <div class="card-body">
                                <h5 class="card-title">TOTAL MEALS</h5>
                                <h2 class="display-4 "><?php echo $totalDish; ?></h2>
                            </div>
                            <div class="card-footer d-flex">
                                <a href="./meal_manager.html">View Details</a>
                                <span class="ms-auto">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                                        class="bi bi-chevron-right" viewBox="0 0 16 16">
                                        <path fill-rule="evenodd"
                                            d="M4.646 1.646a.5.5 0 0 1 .708 0l6 6a.5.5 0 0 1 0 .708l-6 6a.5.5 0 0 1-.708-.708L10.293 8 4.646 2.354a.5.5 0 0 1 0-.708" />
                                    </svg>
                                </span>
                            </div>
                        </div>

                    </div>

                    

                    <div class="col-md-4 mb-4">
                        <div class="card text-white  bg-primary">
                            <div class="card-body">
                                <h5 class="card-title">TOTAL USERS</h5>
                                <h2 class="display-4"><?php echo $totalUsers; ?></h2>
                            </div>
                            <div class="card-footer d-flex">
                                <a href="./user_manager.php">View Details</a>
                                <span class="ms-auto">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                                        class="bi bi-chevron-right" viewBox="0 0 16 16">
                                        <path fill-rule="evenodd"
                                            d="M4.646 1.646a.5.5 0 0 1 .708 0l6 6a.5.5 0 0 1 0 .708l-6 6a.5.5 0 0 1-.708-.708L10.293 8 4.646 2.354a.5.5 0 0 1 0-.708" />
                                    </svg>
                                </span>
                            </div>
                        </div>

                    </div>

                    <div class="col-md-4 mb-4">
                        <div class="card bg-danger text-white">
                            <div class="card-body">
                                <h5 class="card-title">TOTAL FEEDBACK</h5>
                                <h2 class="display-4"><?php echo $totalFeedback; ?></h2>
                            </div>
                            <div class="card-footer d-flex">
                                <a href="./feedback_manager.php">View Details</a>
                                <span class="ms-auto">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                                        class="bi bi-chevron-right" viewBox="0 0 16 16">
                                        <path fill-rule="evenodd"
                                            d="M4.646 1.646a.5.5 0 0 1 .708 0l6 6a.5.5 0 0 1 0 .708l-6 6a.5.5 0 0 1-.708-.708L10.293 8 4.646 2.354a.5.5 0 0 1 0-.708" />
                                    </svg>
                                </span>
                            </div>
                        </div>

                    </div>
                </div>
                <!-- Recent meals -->
                <div class="card mb-4">
                    <div class="card-header">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                            class="bi bi-table" viewBox="0 0 16 16">
                            <path
                                d="M0 2a2 2 0 0 1 2-2h12a2 2 0 0 1 2 2v12a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2zm15 2h-4v3h4zm0 4h-4v3h4zm0 4h-4v3h3a1 1 0 0 0 1-1zm-5 3v-3H6v3zm-5 0v-3H1v2a1 1 0 0 0 1 1zm-4-4h4V8H1zm0-4h4V4H1zm5-3v3h4V4zm4 4H6v3h4z" />
                        </svg>
                        <span class="card-title-header"> Bữa Ăn Mới Thêm Gần Đây</span>
                    </div>
                    <div class="card-body">
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Tên Bữa Ăn</th>
                                    <th>Danh Mục</th>
                                    <th>Calo</th>
                                    <th>Loại Chế Độ Ăn</th>
                                    <th>Ngày Tạo</th>

                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($recentMeals as $meal): ?>
                                    <tr>
                                        <td><?php echo htmlspecialchars($meal['id']); ?></td>
                                        <td><?php echo htmlspecialchars($meal['name']); ?></td>
                                        <td><?php echo htmlspecialchars($meal['tags']); ?></td>
                                        <td><?php echo htmlspecialchars($meal['Calories']); ?></td>
                                        <td><?php echo htmlspecialchars($meal['type']); ?></td>
                                        <td><?php echo date('d/m/Y', strtotime($meal['created_at'])); ?></td>
                                    </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </main>
        </div>
    </div>
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