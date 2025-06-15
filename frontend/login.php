<?php
session_start();

// Database connection
$db_host = 'localhost';
$db_user = 'root';
$db_pass = '';
$db_name = 'nutriplanner';

// Handle POST request (AJAX login)
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    header('Content-Type: application/json');

    try {
        $conn = new PDO("mysql:host=$db_host;dbname=$db_name", $db_user, $db_pass);
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    } catch (PDOException $e) {
        echo json_encode(['success' => false, 'message' => 'Database connection failed']);
        exit();
    }

    // Get data from request
    $data = json_decode(file_get_contents('php://input'), true);

    // Validate data
    if (!isset($data['username']) || !isset($data['password'])) {
        echo json_encode(['success' => false, 'message' => 'Missing required fields']);
        exit();
    }

    $username = trim($data['username']);
    $password = $data['password'];

    try {
        // Check if user exists
        $stmt = $conn->prepare("SELECT id, username, password, role FROM Users WHERE username = ?");
        $stmt->execute([$username]);
        $user = $stmt->fetch(PDO::FETCH_ASSOC);

        if (!$user) {
            echo json_encode(['success' => false, 'message' => 'Invalid username or password']);
            exit();
        }

        // Verify password
        if (!password_verify($password, $user['password'])) {
            echo json_encode(['success' => false, 'message' => 'Invalid username or password']);
            exit();
        }

        // Store user data in session
        $_SESSION['user_id'] = $user['id'];
        $_SESSION['username'] = $user['username'];
        $_SESSION['role'] = $user['role'];

        echo json_encode([
            'success' => true,
            'message' => 'Login successful',
            'user' => [
                'username' => $user['username'],
                'role' => $user['role']
            ]
        ]);
    } catch (PDOException $e) {
        echo json_encode(['success' => false, 'message' => 'Login failed: ' . $e->getMessage()]);
    }
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - NutriPlanner</title>
    <link rel="icon" type="image/svg+xml" href="../assets/images/logo.svg">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <style>
        .login-body {
            background-color: #f8f9fa;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            min-height: 100vh;
            display: flex;
            align-items: center;
        }

        .login-container {
            max-width: 400px;
            width: 100%;
            margin: 20px auto;
            padding: 30px;
            background: white;
            border-radius: 10px;
            box-shadow: 0 0 20px rgba(0, 0, 0, 0.1);
        }

        .login-header {
            text-align: center;
            margin-bottom: 30px;
        }

        .login-title {
            color: #2c3e50;
            font-size: 2em;
            margin-bottom: 10px;
        }

        .login-form-control {
            border-radius: 5px;
            padding: 12px;
            margin-bottom: 15px;
            width: 100%;
        }

        .login-btn {
            background-color: #27ae60;
            border: none;
            padding: 12px;
            width: 100%;
            border-radius: 5px;
            color: white;
            font-weight: bold;
            margin-top: 10px;
            transition: background-color 0.3s ease;
        }

        .login-btn:hover {
            background-color: #219a52;
        }

        .register-link {
            text-align: center;
            margin-top: 20px;
        }

        .login-alert {
            margin-top: 20px;
        }

        .password-field {
            position: relative;
        }

        .password-toggle {
            position: absolute;
            right: 10px;
            top: 50%;
            transform: translateY(-50%);
            background: none;
            border: none;
            color: #666;
            cursor: pointer;
            padding: 5px;
            z-index: 2;
        }

        .password-toggle:hover {
            color: #27ae60;
        }

        .password-field .login-form-control {
            padding-right: 40px;
        }

        /* Responsive styles */
        @media screen and (max-width: 768px) {
            .login-container {
                margin: 15px;
                padding: 20px;
            }

            .login-title {
                font-size: 1.8em;
            }

            .login-form-control {
                padding: 10px;
            }
        }

        @media screen and (max-width: 480px) {
            .login-container {
                margin: 10px;
                padding: 15px;
            }

            .login-title {
                font-size: 1.5em;
            }

            .login-header p {
                font-size: 0.9em;
            }

            .login-form-control {
                padding: 8px;
                font-size: 0.9em;
            }

            .login-btn {
                padding: 10px;
                font-size: 0.9em;
            }

            .register-link {
                font-size: 0.9em;
            }
        }

        /* Dark mode support */
        @media (prefers-color-scheme: dark) {
            .login-body {
                background-color: #1a1a1a;
            }

            .login-container {
                background: #2d2d2d;
                box-shadow: 0 0 20px rgba(0, 0, 0, 0.3);
            }

            .login-title {
                color: #ffffff;
            }

            .login-form-control {
                background-color: #3d3d3d;
                border-color: #4d4d4d;
                color: #ffffff;
            }

            .login-form-control::placeholder {
                color: #999999;
            }

            .register-link {
                color: #ffffff;
            }

            .register-link a {
                color: #27ae60;
            }

            .password-toggle {
                color: #999;
            }

            .password-toggle:hover {
                color: #27ae60;
            }
        }
    </style>
</head>

<body class="login-body">
    <div class="container">
        <div class="login-container">
            <div class="login-header">
                <h1 class="login-title">Welcome Back</h1>
                <p>Login to your NutriPlanner account</p>
            </div>

            <?php if (isset($error_message)): ?>
                <div class="alert alert-danger login-alert" role="alert">
                    <?php echo htmlspecialchars($error_message); ?>
                </div>
            <?php endif; ?>

            <form id="loginForm" method="POST" action="login.php">
                <div class="mb-3">
                    <input type="text" class="form-control login-form-control" id="username" name="username" placeholder="Username" required>
                </div>
                <div class="mb-3 password-field">
                    <input type="password" class="form-control login-form-control" id="password" name="password" placeholder="Password" required>
                    <button type="button" class="password-toggle" onclick="togglePassword('password')">
                        <i class="fas fa-eye"></i>
                    </button>
                </div>
                <button type="submit" class="login-btn">Login</button>
            </form>

            <div class="alert alert-danger login-alert" id="errorAlert" role="alert" style="display: none;"></div>
            <div class="alert alert-success login-alert" id="successAlert" role="alert" style="display: none;"></div>

            <div class="register-link">
                <p>Don't have an account? <a href="register.php">Register</a></p>
            </div>
        </div>
    </div>

    <script>
        document.getElementById('loginForm').addEventListener('submit', async (e) => {
            e.preventDefault();

            const username = document.getElementById('username').value;
            const password = document.getElementById('password').value;

            // Reset alerts
            document.getElementById('errorAlert').style.display = 'none';
            document.getElementById('successAlert').style.display = 'none';

            try {
                const response = await fetch('login.php', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                    },
                    body: JSON.stringify({
                        username,
                        password
                    })
                });

                const data = await response.json();

                if (data.success) {
                    showSuccess('Login successful! Redirecting...');
                    setTimeout(() => {
                        // Redirect based on user role
                        if (data.user.role === 'Admin') {
                            window.location.href = '../frontend/admin.php';
                        } else {
                            window.location.href = '../index.php';
                        }
                    }, 2000);
                } else {
                    showError(data.message);
                }
            } catch (error) {
                showError('An error occurred, please try again later');
            }
        });

        function showError(message) {
            const errorAlert = document.getElementById('errorAlert');
            errorAlert.textContent = message;
            errorAlert.style.display = 'block';
        }

        function showSuccess(message) {
            const successAlert = document.getElementById('successAlert');
            successAlert.textContent = message;
            successAlert.style.display = 'block';
        }

        function togglePassword(fieldId) {
            const passwordField = document.getElementById(fieldId);
            const toggleButton = passwordField.nextElementSibling;
            const icon = toggleButton.querySelector('i');

            if (passwordField.type === 'password') {
                passwordField.type = 'text';
                icon.classList.remove('fa-eye');
                icon.classList.add('fa-eye-slash');
            } else {
                passwordField.type = 'password';
                icon.classList.remove('fa-eye-slash');
                icon.classList.add('fa-eye');
            }
        }
    </script>
</body>

</html>