<?php
require_once '../backend/configuration/Database.php';
$db = new Database();
$conn = $db->getConnection();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    header('Content-Type: application/json');
    // header('Access-Control-Allow-Headers: Content-Type');

    // Database connection
    

    // Get data from request
    $data = json_decode(file_get_contents('php://input'), true);

    // Validate data
    if (!isset($data['username']) || !isset($data['password']) || !isset($data['email'])) {
        echo json_encode(['success' => false, 'message' => 'Missing required fields']);
        exit();
    }

    $username = trim($data['username']);
    $password = $data['password'];
    $email = trim($data['email']);

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
        $stmt = $conn->prepare("INSERT INTO Users (username, password, email) VALUES (?, ?, ?)");
        $stmt->execute([$username, $hashed_password, $email]);

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
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register - NutriPlanner</title>
    <link rel="icon" type="image/svg+xml" href="../assets/images/logo.svg">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <style>
        .register-container {
            max-width: 500px;
            width: 100%;
            margin: 20px auto;
            padding: 30px;
            background: white;
            border-radius: 10px;
            box-shadow: 0 0 20px rgba(0, 0, 0, 0.1);
        }

        .register-header {
            text-align: center;
            margin-bottom: 30px;
        }

        .register-title {
            color: #2c3e50;
            font-size: 2em;
            margin-bottom: 10px;
        }

        .register-form-control {
            border-radius: 5px;
            padding: 12px;
            margin-bottom: 15px;
            width: 100%;
        }

        .register-btn {
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

        .register-btn:hover {
            background-color: #219a52;
        }

        .register-link {
            text-align: center;
            margin-top: 20px;
        }

        .register-alert {
            display: none;
            margin-top: 20px;
        }

        /* Responsive styles */
        @media screen and (max-width: 768px) {
            .register-container {
                margin: 15px;
                padding: 20px;
            }

            .register-title {
                font-size: 1.8em;
            }

            .register-form-control {
                padding: 10px;
            }
        }

        @media screen and (max-width: 480px) {
            .register-container {
                margin: 10px;
                padding: 15px;
            }

            .register-title {
                font-size: 1.5em;
            }

            .register-header p {
                font-size: 0.9em;
            }

            .register-form-control {
                padding: 8px;
                font-size: 0.9em;
            }

            .register-btn {
                padding: 10px;
                font-size: 0.9em;
            }

            .register-link {
                font-size: 0.9em;
            }
        }

        /* Landscape mode for mobile */
        @media screen and (max-height: 480px) and (orientation: landscape) {
            .register-body {
                align-items: flex-start;
            }

            .register-container {
                margin: 10px auto;
            }
        }

        /* Dark mode support */
        @media (prefers-color-scheme: dark) {
            .register-body {
                background-color: #1a1a1a;
            }

            .register-container {
                background: #2d2d2d;
                box-shadow: 0 0 20px rgba(0, 0, 0, 0.3);
            }

            .register-title {
                color: #ffffff;
            }

            .register-form-control {
                background-color: #3d3d3d;
                border-color: #4d4d4d;
                color: #ffffff;
            }

            .register-form-control::placeholder {
                color: #999999;
            }

            .register-link {
                color: #ffffff;
            }

            .register-link a {
                color: #27ae60;
            }
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

        .password-field .register-form-control {
            padding-right: 40px;
        }

        /* Dark mode support for password toggle */
        @media (prefers-color-scheme: dark) {
            .password-toggle {
                color: #999;
            }

            .password-toggle:hover {
                color: #27ae60;
            }
        }
    </style>
</head>

<body>
    <div class="container">
        <div class="register-container">
            <div class="register-header">
                <h1 class="register-title">Create Account</h1>
                <p>Join NutriPlanner to explore the world of healthy cuisine</p>
            </div>

            <form id="registerForm">
                <div class="mb-3">
                    <input type="text" class="form-control register-form-control" id="username" name="username" placeholder="Username" required>
                </div>
                <div class="mb-3">
                    <input type="email" class="form-control register-form-control" id="email" name="email" placeholder="Email" required>
                </div>
                <div class="mb-3 password-field">
                    <input type="password" class="form-control register-form-control" id="password" name="password" placeholder="Password" required>
                    <button type="button" class="password-toggle" onclick="togglePassword('password')">
                        <i class="fas fa-eye"></i>
                    </button>
                </div>
                <div class="mb-3 password-field">
                    <input type="password" class="form-control register-form-control" id="confirmPassword" name="confirmPassword" placeholder="Confirm Password" required>
                    <button type="button" class="password-toggle" onclick="togglePassword('confirmPassword')">
                        <i class="fas fa-eye"></i>
                    </button>
                </div>
                <button type="submit" class="register-btn">Register</button>
            </form>

            <div class="alert alert-danger register-alert" id="errorAlert" role="alert"></div>
            <div class="alert alert-success register-alert" id="successAlert" role="alert"></div>

            <div class="register-link">
                <p>Already have an account? <a href="login.php">Login</a></p>
            </div>
        </div>
    </div>

    <script>
        document.getElementById('registerForm').addEventListener('submit', async (e) => {
            e.preventDefault();

            const username = document.getElementById('username').value;
            const email = document.getElementById('email').value;
            const password = document.getElementById('password').value;
            const confirmPassword = document.getElementById('confirmPassword').value;

            // Reset alerts
            document.getElementById('errorAlert').style.display = 'none';
            document.getElementById('successAlert').style.display = 'none';

            // Validate password match
            if (password !== confirmPassword) {
                showError('Passwords do not match');
                return;
            }

            try {
                const response = await fetch('register.php', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                    },
                    body: JSON.stringify({
                        username,
                        email,
                        password
                    })
                });

                const data = await response.json();

                if (data.success) {
                    showSuccess('Registration successful! Redirecting...');
                    setTimeout(() => {
                        window.location.href = 'login.php';
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

        // Add password strength indicator
        document.getElementById('password').addEventListener('input', function(e) {
            const password = e.target.value;
            const strength = checkPasswordStrength(password);
            updatePasswordStrengthIndicator(strength);
        });

        function checkPasswordStrength(password) {
            let strength = 0;

            // Length check
            if (password.length >= 8) strength++;

            // Contains number
            if (/\d/.test(password)) strength++;

            // Contains lowercase
            if (/[a-z]/.test(password)) strength++;

            // Contains uppercase
            if (/[A-Z]/.test(password)) strength++;

            // Contains special character
            if (/[^A-Za-z0-9]/.test(password)) strength++;

            return strength;
        }

        function updatePasswordStrengthIndicator(strength) {
            const strengthText = ['Very Weak', 'Weak', 'Medium', 'Strong', 'Very Strong'];
            const strengthColors = ['#ff4444', '#ffbb33', '#ffeb3b', '#00C851', '#007E33'];

            // Remove existing strength indicator if any
            const existingIndicator = document.getElementById('passwordStrength');
            if (existingIndicator) {
                existingIndicator.remove();
            }

            // Create new strength indicator
            const indicator = document.createElement('div');
            indicator.id = 'passwordStrength';
            indicator.style.marginTop = '-10px';
            indicator.style.marginBottom = '15px';
            indicator.style.fontSize = '0.9em';
            indicator.style.color = strengthColors[strength - 1];
            indicator.textContent = `Password Strength: ${strengthText[strength - 1]}`;

            // Insert after password field
            const passwordField = document.getElementById('password').parentElement;
            passwordField.parentNode.insertBefore(indicator, passwordField.nextSibling);
        }
    </script>
</body>

</html>