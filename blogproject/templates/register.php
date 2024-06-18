<?php
session_start();

include('../includes/db.php');

// Handle form submission
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = $_POST['username'];
    $email = $_POST['email'];
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);

    $sql = "INSERT INTO users (username, email, password) VALUES (?, ?, ?)";
    $stmt = $conn->prepare($sql);

    // Bind parameters
    $stmt->bind_param('sss', $username, $email, $password);

    // Execute statement
    if ($stmt->execute()) {
        echo "<script>
                window.onload = function() {
                    document.getElementById('successModal').style.display = 'block';
                    setTimeout(function() {
                        window.location.href = 'login.php';
                    }, 3000); // 3 seconds delay
                }
              </script>";
    } else {
        echo "<script>
                window.onload = function() {
                    document.getElementById('errorModal').style.display = 'block';
                }
              </script>";
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
        /* Styles for modal and other elements */
        .modal {
            display: none;
            position: fixed;
            z-index: 1;
            left: 0;
            top: 0;
            width: 100%;
            height: 100%;
            overflow: auto;
            background-color: rgba(0,0,0,0.4);
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
        .error-message {
            color: red;
            font-size: 14px;
            margin-top: 5px;
        }
    </style>
</head>
<body>
    <div class="form-container">
        <form action="register.php" method="post" class="login-form" id="registerForm">
            <h2 class="form-title">Register</h2>
            <p class="form-subtitle">Please enter your details to register.</p>
            <input type="text" name="username" id="username" placeholder="Username" required class="form-input">
            <span id="usernameError" class="error-message"></span>
            <input type="email" name="email" id="email" placeholder="Email" required class="form-input">
            <span id="emailError" class="error-message"></span>
            <input type="password" name="password" id="password" placeholder="Password" required class="form-input">
            <span id="passwordError" class="error-message"></span>
            <input type="password" name="confirm_password" id="confirm_password" placeholder="Confirm Password" required class="form-input">
            <span id="confirmPasswordError" class="error-message"></span>
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
            <p>Registration failed. Please try again.</p>
        </div>
    </div>

    <script>
        // JavaScript validation
        const usernameField = document.getElementById('username');
        const emailField = document.getElementById('email');
        const passwordField = document.getElementById('password');
        const confirmPasswordField = document.getElementById('confirm_password');

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
            if (passwordValue === '') {
                passwordError.textContent = 'Password is required.';
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
            }
        });

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
