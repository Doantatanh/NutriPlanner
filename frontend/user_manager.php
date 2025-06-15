<?php
require_once '../backend/configuration/Database.php';
$db = new Database();
$conn = $db->getConnection();


// Lấy danh sách user
if (isset($_GET['action']) && $_GET['action'] === 'get_users') {
    header('Content-Type: application/json');
    $sql = "SELECT id, username, email, role, created_at FROM users ORDER BY created_at DESC";
    $stmt = $conn->prepare($sql);
    $stmt->execute();
    $users = $stmt->fetchAll(PDO::FETCH_ASSOC);
    echo json_encode(['data' => $users]);
    exit;
}

// Thêm user
if (isset($_POST['action']) && $_POST['action'] === 'add_user') {
    $username = $_POST['username'];
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
    $email = $_POST['email'];
    $role = $_POST['role'];
    // Check username length
    if (strlen($username) < 3 || strlen($username) > 50) {
        echo json_encode(['success' => false, 'message' => 'Username must be between 3 and 50 characters']);
        exit();
    }

    // Validate email format
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        echo json_encode(['success' => false, 'message' => 'Invalid email format']);
        
        exit();
    }

    // Check password length
    if (strlen($password) < 6) {
        echo json_encode(['success' => false, 'message' => 'Password must be at least 6 characters']);
        exit();
    }

    
         try {
        // Check if username exists
        $stmt = $conn->prepare("SELECT id FROM Users WHERE username = ?");
        $stmt->execute([$username]);
        if ($stmt->rowCount() > 0) {
            echo json_encode(['success' => false, 'message' => 'Username already exists']);
            exit();
        }

        // Check if email exists
        $stmt = $conn->prepare("SELECT id FROM Users WHERE email = ?");
        $stmt->execute([$email]);
        if ($stmt->rowCount() > 0) {
            echo json_encode(['success' => false, 'message' => 'Email already exists']);
            exit();
        }

        // Hash password
        $hashed_password = password_hash($password, PASSWORD_DEFAULT);

        // Add new user to database
            $stmt = $conn->prepare("INSERT INTO users (username, password, email, role) VALUES (?, ?, ?, ?)");
            $stmt->execute([$username, $password, $email, $role]);

        echo json_encode([
            'success' => true,
            'message' => 'Registration successful',
            'user' => [
                'username' => $username,
                'email' => $email
            ]
        ]);
    } catch (PDOException $e) {
        echo json_encode(['success' => false, 'message' => 'Registration failed: ' . $e->getMessage()]);
    }
    exit;

}

// Xóa user
if (isset($_POST['action']) && $_POST['action'] === 'delete_user') {
    $id = $_POST['id'];
    $stmt = $conn->prepare("DELETE FROM users WHERE id = ?");
    $stmt->execute([$id]);
    echo json_encode(['success' => true]);
    exit;
}

// Sửa user
if (isset($_POST['action']) && $_POST['action'] === 'edit_user') {
    $id = $_POST['id'];
    $username = $_POST['username'];
    $email = $_POST['email'];
    $role = $_POST['role'];
    $sql = "UPDATE users SET username=?, email=?, role=?";
    $params = [$username, $email, $role];
    if (!empty($_POST['password'])) {
        $sql .= ", password=?";
        $params[] = password_hash($_POST['password'], PASSWORD_DEFAULT);
    }
    $sql .= " WHERE id = ?";
    $params[] = $id;
    $stmt = $conn->prepare($sql);
    $stmt->execute($params);
    echo json_encode(['success' => true]);
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Management</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="../assets/fontawesome-free-6.7.2-web/css/all.min.css">
    <link rel="stylesheet" href="../assets/css/style-admin.css">
    <link href="../assets/css/reset.css" rel="stylesheet">
    <style>
        body {
            background: #f8f9fa;
        }

        .modal-lg {
            max-width: 600px;
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
                            <a href="user_manager.php" class="nav-link active text-white tab-btn">
                                <i class="fa fa-users me-2"></i> User management
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="./feedback_manager.php" class="nav-link text-white tab-btn">
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
                    <h1 class="h2 fw-bold">User Management</h1>
                    <div class="btn-toolbar mb-2 mb-md-0">
                        <div class="dropdown">
                            <button class="btn btn-sm btn-outline-none dropdown-toggle" data-bs-toggle="dropdown"
                                type="button">
                                <img src="../assets/images/admin.png" alt="admin" class="rounded-circle border"
                                    width="36">
                                <span class="text-login fw-semibold ms-2">Admin</span>
                            </button>
                            <ul class="dropdown-menu">
                                <li><a class="dropdown-item" href="profile.html">Hồ sơ</a></li>
                                <li><a class="dropdown-item" href="login.html">Đăng xuất</a></li>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="d-flex justify-content-between align-items-center mb-4">
                    <button class="btn btn-success add-user-btn" data-bs-toggle="modal" data-bs-target="#userModal">
                        <i class="fa fa-plus"></i> Thêm người dùng
                    </button>
                </div>
                <div class="card shadow-sm rounded-4 border-0">
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-hover align-middle">
                                <thead class="table-light">
                                    <tr>
                                        <th>ID</th>
                                        <th>Username</th>
                                        <th>Password</th>
                                        <th>Email</th>
                                        <th>Role</th>
                                        <th>Ngày tạo</th>
                                        <th class="text-center">Thao Tác</th>
                                    </tr>
                                </thead>
                                <tbody id="user-table-body"></tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <!-- Modal Thêm/Sửa User -->
                <div class="modal fade" id="userModal" tabindex="-1" aria-labelledby="userModalLabel"
                    aria-hidden="true">
                    <div class="modal-dialog modal-lg">
                        <div class="modal-content rounded-4 shadow-lg">
                            <div class="modal-header">
                                <h5 class="modal-title w-100 fw-bold" id="userModalLabel">Thêm Người Dùng
                                </h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                    aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <form id="userForm">
                                    <div class="row g-2 mb-2">
                                        <div class="col-md-6">
                                            <label class="form-label">Username</label>
                                            <input required name="username" class="form-control">
                                        </div>
                                        <div class="col-md-6">
                                            <label class="form-label">Password</label>
                                            <input required name="password" type="password" class="form-control">
                                        </div>
                                    </div>
                                    <div class="row g-2 mb-2">
                                        <div class="col-md-6">
                                            <label class="form-label">Email</label>
                                            <input required name="email" type="email" class="form-control">
                                        </div>
                                        <div class="col-md-6">
                                            <label class="form-label">Role</label>
                                            <select name="role" class="form-select">
                                                <option value="Admin">Admin</option>
                                                <option value="User">User</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="d-flex justify-content-end gap-2 mt-3">
                                        <button type="button" class="btn btn-light border"
                                            data-bs-dismiss="modal">Hủy</button>
                                        <button class="btn btn-primary px-4" type="submit">Lưu Người Dùng</button>
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
        function loadUsers() {
            fetch('user_manager.php?action=get_users')
                .then(res => res.json())
                .then(data => {
                    const tbody = document.getElementById('user-table-body');
                    tbody.innerHTML = '';
                    data.data.forEach(user => {
                        tbody.innerHTML += `
                    <tr>
                        <td>${user.id}</td>
                        <td>${user.username}</td>
                        <td>••••••••</td>
                        <td>${user.email}</td>
                        <td>
                            <span class="badge bg-${user.role.toLowerCase() === 'admin' ? 'primary' : 'secondary'}">
                                ${user.role.charAt(0).toUpperCase() + user.role.slice(1)}
                            </span>
                        </td>
                        <td>${new Date(user.created_at).toLocaleDateString('vi-VN')}</td>
                        <td class="text-center">
                            <button class="btn btn-sm btn-primary" onclick="showEditUser(${user.id},'${user.username}','${user.email}','${user.role}')"><i class="fa-solid fa-pencil"></i></button>
                            <button class="btn btn-sm btn-danger" onclick="deleteUser(${user.id})"><i class="fa-solid fa-trash"></i></button>
                        </td>
                    </tr>
                `;
                    });
                });
        }

        document.addEventListener('DOMContentLoaded', function() {
            loadUsers();

            // Thêm user
            document.getElementById('userForm').onsubmit = function(e) {
                e.preventDefault();
                const form = e.target;
                const formData = new FormData(form);
                formData.append('action', 'add_user');
                fetch('user_manager.php', {
                    method: 'POST',
                    body: formData
                }).then(res => res.json()).then(data => {
                    if (data.success) {
                        form.reset();
                        var modal = bootstrap.Modal.getInstance(document.getElementById('userModal'));
                        modal.hide();
                        loadUsers();
                    }else{
                        alert(data.message);
                    }
                });
            };
        });

        // Xóa user
        function deleteUser(id) {
            if (confirm('Bạn có chắc muốn xóa user này?')) {
                const formData = new FormData();
                formData.append('action', 'delete_user');
                formData.append('id', id);
                fetch('user_manager.php', {
                    method: 'POST',
                    body: formData
                }).then(res => res.json()).then(data => {
                    if (data.success) loadUsers();
                });
            }
        }

        // Sửa user (hiển thị modal và cập nhật)
        function showEditUser(id, username, email, role) {
            const modal = new bootstrap.Modal(document.getElementById('userModal'));
            document.querySelector('#userModalLabel').innerText = 'Sửa Người Dùng';
            const form = document.getElementById('userForm');
            form.username.value = username;
            form.email.value = email;
            form.role.value = role.charAt(0).toUpperCase() + role.slice(1).toLowerCase();
            form.password.value = '';
            form.onsubmit = function(e) {
                e.preventDefault();
                const formData = new FormData(form);
                formData.append('action', 'edit_user');
                formData.append('id', id);
                fetch('user_manager.php', {
                    method: 'POST',
                    body: formData
                }).then(res => res.json()).then(data => {
                    if (data.success) {
                        modal.hide();
                        loadUsers();
                        // Reset lại form về trạng thái thêm mới
                        form.onsubmit = defaultAddUser;
                        document.querySelector('#userModalLabel').innerText = 'Thêm Người Dùng';
                        form.reset();
                    }
                });
            };
            modal.show();
        }

        // Đặt lại sự kiện mặc định cho form thêm user
        function defaultAddUser(e) {
            e.preventDefault();
            const form = e.target;
            const formData = new FormData(form);
            formData.append('action', 'add_user');
            fetch('user_manager.php', {
                method: 'POST',
                body: formData
            }).then(res => res.json()).then(data => {
                if (data.success) {
                    form.reset();
                    var modal = bootstrap.Modal.getInstance(document.getElementById('userModal'));
                    modal.hide();
                    loadUsers();
                }
            });
        }
        document.getElementById('userModal').addEventListener('hidden.bs.modal', function() {
            const form = document.getElementById('userForm');
            form.onsubmit = defaultAddUser;
            document.querySelector('#userModalLabel').innerText = 'Thêm Người Dùng';
            form.reset();
        });
    </script>

</body>

</html>