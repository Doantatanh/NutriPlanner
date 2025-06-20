<?php
require_once '../backend/configuration/Database.php';
$db = new Database();
$conn = $db->getConnection();

try{
    $sql = "SELECT id,rating,fullname, message,email, created_at FROM feedbacks WHERE status = 0 ORDER BY created_at DESC";
    $feedbacks = $conn->query($sql);
}catch(PDOException $e){
    echo "Fail connection" . $e->getMessage();
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Feedback Management</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="../assets/fontawesome-free-6.7.2-web/css/all.min.css">
    <link rel="stylesheet" href="../assets/css/style-admin.css">
    <link href="../assets/css/reset.css" rel="stylesheet">
    <style>
        body {
            background: #f8f9fa;
        }

        .modal-lg {
            max-width: 700px;
        }

        .star-rating i {
            color: #ffc107;
        }
    </style>
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
                            <a href="./admin.php" class="nav-link text-white tab-btn">
                                <i class="fa fa-tachometer-alt me-2"></i> Dashboard
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="./meal_manager.html" class="nav-link text-white tab-btn">
                                <i class="fa fa-utensils me-2"></i> Meal manager
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="./user_manager.php" class="nav-link text-white tab-btn">
                                <i class="fa fa-users me-2"></i> User management
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="./feedback_manager.php" class="nav-link active text-white tab-btn">
                                <i class="fa fa-comments me-2"></i> Feedback
                            </a>
                        </li>
                    </ul>
                </div>
            </nav>
            <!-- main content -->
            <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
                <div
                    class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-4 pb-3 mb-4 border-bottom">
                    <h1 class="h2 fw-bold">Feedback Management</h1>
                    <div class="btn-toolbar mb-2 mb-md-0">
                        <div class="dropdown">
                            <button class="btn btn-sm btn-outline-none dropdown-toggle d-flex align-items-center justify-content-center" data-bs-toggle="dropdown"
                                type="button">
                                <img src="../assets/images/admin.png" alt="admin" class="rounded-circle border"
                                    width="36">
                                <span class="text-login fw-semibold ms-2">Admin</span>
                            </button>
                            <ul class="dropdown-menu">
                                <li><a class="dropdown-item" href="profile.html">Profile</a></li>
                                <li><a class="dropdown-item" href="./login.php">Log out</a></li>
                            </ul>
                        </div>
                    </div>
                </div>

                <div class="card shadow-sm rounded-4 border-0">
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-hover align-middle">
                                <thead class="table-light">
                                    <tr>
                                        <th>ID</th>
                                        <th>Sender's name</th>
                                        <th>Email</th>
                                        <th>Content</th>
                                        <th>Review</th>
                                        <th>Date sent</th>
                                    </tr>
                                </thead>
                                <tbody>
                                        <?php foreach ($feedbacks as $feedback): ?>
                                            <tr>
                                                <td><?php echo $feedback['id'] ?></td>
                                                <td><?php echo htmlspecialchars($feedback['fullname']) ?></td>
                                                <td><?php echo htmlspecialchars($feedback['email']) ?></td>
                                                <td><?php echo htmlspecialchars($feedback['message']) ?></td>
                                                <td><?php echo $feedback['rating'] ?> ★</td>
                                                <td><?php echo $feedback['created_at'] ?></td>
                                            </tr>
                                        <?php endforeach; ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </main>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    

</body>

</html>