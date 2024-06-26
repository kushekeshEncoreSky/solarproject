<?php
session_start();

include('../includes/db.php');

$errorMessage = '';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = $_POST['username'];
    $email = $_POST['email'];
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);

    // Check if username or email already exists
    $sql = "SELECT id FROM users WHERE username = ? OR email = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param('ss', $username, $email);
    $stmt->execute();
    $stmt->store_result();

    if ($stmt->num_rows > 0) {
        $errorMessage = 'Username or email already exists.';
        if ($stmt->num_rows > 0) {
            $stmt->bind_result($id);
            $stmt->fetch();
            if ($id) {
                $errorMessage = 'Username or email already exists.';
            }
        }
    } else {
        $sql = "INSERT INTO users (username, email, password) VALUES (?, ?, ?)";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param('sss', $username, $email, $password);

        if ($stmt->execute()) {
            $_SESSION['success_message'] = 'Registration successful! Redirecting to login...';
            header('Location: register.php');
            exit();
        } else {
            $errorMessage = 'Registration failed. Please try again.';
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../assests/css/style1.css">
    <title>Register</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }
        body {
            font-family: Arial, sans-serif;
        }
        .form-container {
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
            padding: 20px;
            /* background-color: #f4f4f4; */
        }
        .login-form {
            background: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
            max-width: 400px;
            width: 100%;
        }
        .form-title {
            font-size: 24px;
            margin-bottom: 10px;
        }
        .form-subtitle {
            font-size: 14px;
            margin-bottom: 20px;
            color: #555;
        }
        .input-container {
            position: relative;
            margin-bottom: 15px;
        }
        .input-container input {
            width: 100%;
            padding: 10px;
            border: 1px solid #ddd;
            border-radius: 4px;
            font-size: 14px;
        }
        .error-message {
            color: red;
            font-size: 11px;
            margin-top: 5px;
        }
        .form-button {
            width: 100%;
            padding: 10px;
            border: none;
            border-radius: 4px;
            background: #5cb85c;
            color: #fff;
            font-size: 16px;
            cursor: pointer;
        }
        .form-button:hover {
            background: #4cae4c;
        }
        .signup-text {
            text-align: center;
            margin-top: 10px;
        }
        .signup-link {
            color: #5cb85c;
            text-decoration: none;
        }
        .signup-link:hover {
            text-decoration: underline;
        }
        .modal {
            display: none;
            position: fixed;
            z-index: 1;
            left: 0;
            top: 0;
            width: 100%;
            height: 100%;
            overflow: auto;
            background-color: rgba(0, 0, 0, 0.4);
            padding-top: 60px;
        }
        .modal-content {
            background-color: #fefefe;
            margin: 5% auto;
            padding: 20px;
            border: 1px solid #888;
            width: 80%;
            max-width: 300px;
            text-align: center;
        }
        .close {
            color: #aaa;
            float: right;
            font-size: 28px;
            font-weight: bold;
        }
        .close:hover,
        .close:focus {
            color: black;
            text-decoration: none;
            cursor: pointer;
        }

        @media (max-width: 600px) {
            .login-form {
                padding: 15px;
                max-width: 100%;
            }
            .form-title {
                font-size: 20px;
            }
            .form-subtitle {
                font-size: 12px;
            }
            .form-button {
                font-size: 14px;
            }
        }
    </style>
</head>
<body>
    <?php
    if (isset($_SESSION['success_message'])) {
        echo "<script>
                window.onload = function() {
                    document.getElementById('successModal').style.display = 'block';
                    setTimeout(function() {
                        window.location.href = 'login.php';
                    }, 3000); // 3 seconds delay
                }
              </script>";
        unset($_SESSION['success_message']);
    } elseif (!empty($errorMessage)) {
        echo "<script>
                window.onload = function() {
                    document.getElementById('errorModal').style.display = 'block';
                    document.getElementById('errorModalMessage').textContent = '$errorMessage';
                }
              </script>";
    }
    ?>

    <div class="form-container">
        <form action="register.php" method="post" class="login-form" id="registerForm">
            <h2 class="form-title">Register</h2>
            <p class="form-subtitle">Please enter your details to register.</p>
            <div class="input-container">
                <input type="text" name="username" id="username" placeholder="Username" class="form-input" value="<?php echo isset($_POST['username']) ? htmlspecialchars($_POST['username']) : ''; ?>">
                <span id="usernameError" class="error-message"></span>
            </div>
            <div class="input-container">
                <input type="text" name="email" id="email" placeholder="Email" class="form-input" value="<?php echo isset($_POST['email']) ? htmlspecialchars($_POST['email']) : ''; ?>">
                <span id="emailError" class="error-message"></span>
            </div>
            <div class="input-container">
                <input type="password" name="password" id="password" placeholder="Password" class="form-input">
                <span id="passwordError" class="error-message"></span>
            </div>
            <div class="input-container">
                <input type="password" name="confirm_password" id="confirm_password" placeholder="Confirm Password" class="form-input">
                <span id="confirmPasswordError" class="error-message"></span>
            </div>
            <button type="submit" class="form-button">Register</button>
            <p class="signup-text">Already have an account? <a href="login.php" class="signup-link">Sign in here!</a></p>
        </form>
    </div>

    <!-- Modal for success message -->
    <div id="successModal" class="modal">
        <div class="modal-content">
            <span class="close" onclick="document.getElementById('successModal').style.display='none'">&times;</span>
            <p>Registration successful! Redirecting to login...</p>
        </div>
    </div>

    <!-- Modal for error message -->
    <div id="errorModal" class="modal">
        <div class="modal-content">
            <span class="close" onclick="document.getElementById('errorModal').style.display='none'">&times;</span>
            <p id="errorModalMessage">Registration failed. Please try again.</p>
        </div>
    </div>

    <script>
        // JavaScript validation
        const usernameField = document.getElementById('username');
        const emailField = document.getElementById('email');
        const passwordField = document.getElementById('password');
        const confirmPasswordField = document.getElementById('confirm_password');

        // Clear error message when typing
        usernameField.addEventListener('input', () => clearError('usernameError'));
        emailField.addEventListener('input', () => clearError('emailError'));
        passwordField.addEventListener('input', () => clearError('passwordError'));
        confirmPasswordField.addEventListener('input', () => clearError('confirmPasswordError'));

        usernameField.addEventListener('blur', validateUsername);
        emailField.addEventListener('blur', validateEmail);
        passwordField.addEventListener('blur', validatePassword);
        confirmPasswordField.addEventListener('blur', validateConfirmPassword);

        function validateUsername() {
            const usernameValue = usernameField.value.trim();
            const usernameError = document.getElementById('usernameError');
            if (usernameValue === '') {
                usernameError.textContent = 'Username is required.';
            } else {
                usernameError.textContent = '';
            }
        }

        function validateEmail() {
            const emailValue = emailField.value.trim();
            const emailError = document.getElementById('emailError');
            const re = /^[a-zA-Z0-9._-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,6}$/;
            if (emailValue === '') {
                emailError.textContent = 'Email is required.';
            } else if (!re.test(String(emailValue).toLowerCase())) {
                emailError.textContent = 'Please enter a valid email address.';
            } else {
                emailError.textContent = '';
            }
        }

        function validatePassword() {
            const passwordValue = passwordField.value.trim();
            const passwordError = document.getElementById('passwordError');
            const re = /^(?=.*[A-Z])(?=.*\d)(?=.*[\W_]).{6,}$/;
            if (passwordValue === '') {
                passwordError.textContent = 'Password is required.';
            } else if (!re.test(passwordValue)) {
                passwordError.textContent = 'Password must be at least 6 characters long, include one uppercase letter, one number, and one special character.';
            } else {
                passwordError.textContent = '';
            }
        }

        function validateConfirmPassword() {
            const confirmPasswordValue = confirmPasswordField.value.trim();
            const confirmPasswordError = document.getElementById('confirmPasswordError');
            const passwordValue = passwordField.value.trim();
            if (confirmPasswordValue === '') {
                confirmPasswordError.textContent = 'Confirm Password is required.';
            } else if (confirmPasswordValue !== passwordValue) {
                confirmPasswordError.textContent = 'Passwords do not match.';
            } else {
                confirmPasswordError.textContent = '';
            }
        }

        function clearError(errorId) {
            document.getElementById(errorId).textContent = '';
        }

        // Form submission validation
        document.getElementById('registerForm').addEventListener('submit', function(event) {
            validateUsername();
            validateEmail();
            validatePassword();
            validateConfirmPassword();

            const errors = document.querySelectorAll('.error-message');
            let hasError = false;
            errors.forEach(function(error) {
                if (error.textContent !== '') {
                    hasError = true;
                }
            });

            if (hasError) {
                event.preventDefault();
                showError('Please fill in the required fields correctly.');
                clearInvalidFields();
            }
        });

        function clearInvalidFields() {
            const usernameError = document.getElementById('usernameError').textContent;
            const emailError = document.getElementById('emailError').textContent;
            const passwordError = document.getElementById('passwordError').textContent;
            const confirmPasswordError = document.getElementById('confirmPasswordError').textContent;

            if (usernameError) {
                usernameField.value = '';
            }
            if (emailError) {
                emailField.value = '';
            }
            if (passwordError) {
                passwordField.value = '';
            }
            if (confirmPasswordError) {
                confirmPasswordField.value = '';
            }
        }

        function showError(message) {
            const errorModal = document.getElementById('errorModal');
            const errorMessage = errorModal.querySelector('p');
            errorMessage.textContent = message;
            errorModal.style.display = 'block';
        }

        // Close modal when clicking on close button or outside modal
        document.addEventListener('DOMContentLoaded', function() {
            const modals = document.querySelectorAll('.modal');

            modals.forEach(function(modal) {
                modal.addEventListener('click', function(event) {
                    if (event.target === modal || event.target.classList.contains('close')) {
                        modal.style.display = 'none';
                    }
                });
            });
        });
    </script>
</body>
</html>

<?php include('../includes/footer.php'); ?>
