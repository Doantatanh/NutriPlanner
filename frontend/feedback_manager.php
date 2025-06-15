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
                                        <th class="text-center">Operations</th>
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
                                                <td class="text-center">
                                                    <button class="btn btn-sm btn-info btn-view" data-bs-toggle="modal"
                                                        data-bs-target="#feedbackModal" data-name="<?php echo htmlspecialchars($feedback['fullname']) ?>"  data-email="<?php echo htmlspecialchars($feedback['email']) ?>" data-message="<?php echo htmlspecialchars($feedback['message']) ?>" data-rating="<?php echo $feedback['rating'] ?>"  data-created="<?php echo $feedback['created_at'] ?>"title="Xem chi tiết">
                                                        <i class="fa fa-eye"></i>
                                                    </button>
                                                    <button class="btn btn-sm btn-danger btn-delete "  data-id="<?php echo $feedback['id'] ?>">
                                                        <i class="fa-solid fa-trash"></i>
                                                    </button>
                                                </td>
                                            </tr>
                                        <?php endforeach; ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <!-- Modal Thêm/Sửa Feedback -->
                <div class="modal fade" id="feedbackModal" tabindex="-1" aria-labelledby="feedbackModalLabel"
                    aria-hidden="true">
                    <div class="modal-dialog modal-lg">
                        <div class="modal-content rounded-4 shadow-lg">
                            <div class="modal-header">
                                <h5 class="modal-title w-100 fw-bold" id="feedbackModalLabel">Feedback Details</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                    aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <form id="feedbackReplyForm">
                                    <div class="row g-2 mb-2">
                                        <div class="col-md-6">
                                            <label class="form-label">Sender's name</label>
                                            <input name="name" class="form-control" value="" id="modalName" readonly>
                                        </div>
                                        <div class="col-md-6">
                                            <label class="form-label">Email</label>
                                            <input name="email" class="form-control" value="" id="modalEmail" readonly>
                                        </div>
                                    </div>
                                    <div class="mb-2">
                                        <label class="form-label">Content</label>
                                        <textarea name="content" class="form-control" rows="3" id="modalMessage"readonly>
                                            
                                        </textarea>
                                    </div>
                                    <div class="row g-2 mb-2">
                                        <div class="col-md-6">
                                            <label class="form-label">Review</label>
                                            <div class="star-rating" id="modalRating">
                                                <i class="fa fa-star"></i>
                                                <i class="fa fa-star"></i>
                                                <i class="fa fa-star"></i>
                                                <i class="fa fa-star"></i>
                                                <i class="fa fa-star"></i>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <label class="form-label">Status</label>
                                            <select name="status" class="form-select">
                                                <option value="Đã đọc">Read</option>
                                                <option value="Chưa đọc">Unread</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="mb-2">
                                        <label class="form-label">Answer the user</label>
                                        <textarea class="form-control" name="reply_content" rows="3"
                                            placeholder="Nhập nội dung trả lời..."></textarea>
                                    </div>
                                    <div class="d-flex justify-content-end gap-2 mt-3">
                                        <button type="button" class="btn btn-light border"
                                            data-bs-dismiss="modal">Close</button>
                                        <button class="btn btn-primary px-4" type="submit">Reply via email</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </main>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        document.addEventListener("DOMContentLoaded", function () {
            const deleteButtons = document.querySelectorAll(".btn-delete");

            deleteButtons.forEach(button => {
                button.addEventListener("click", function () {
                    const feedbackId = this.getAttribute("data-id");
                    if (confirm("Are you sure you want to hide this response?")) {
                        fetch("../backend/update_status.php", {
                            method: "POST",
                            headers: {
                                "Content-Type": "application/x-www-form-urlencoded"
                            },
                            body: "id=" + feedbackId
                        })
                        .then(res => res.text())
                        .then(response => {
                            if (response.trim() === "success") {
                                location.reload();
                            } else {
                                alert("Đã xảy ra lỗi!");
                            }
                        });
                    }
                });
            });
            const viewButtons = document.querySelectorAll(".btn-view");
            viewButtons.forEach(button => {
                button.addEventListener("click", function () {
                    const name = this.getAttribute("data-name");
                    const email = this.getAttribute("data-email");
                    const message = this.getAttribute("data-message");
                    const rating = parseInt(this.getAttribute("data-rating"));
                    const createdAt = this.getAttribute("data-created");

                    document.getElementById("modalName").value = name;
                    document.getElementById("modalEmail").value = email;
                    document.getElementById("modalMessage").value = message;

                    const ratingDiv = document.getElementById("modalRating");
                    ratingDiv.innerHTML = "";
                    for (let i = 1; i <= 5; i++) {
                        ratingDiv.innerHTML += `<i class="fa${i <= rating ? 's' : 'r'} fa-star"></i>`;
                    }
                });
            });
        });
    </script>

</body>

</html>