

<?php
include('../includes/db.php');

$error_message = "";

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = $_POST['username'];
    $password = $_POST['password'];

    $sql = "SELECT * FROM users WHERE username = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param('s', $username);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $user = $result->fetch_assoc();
        if (password_verify($password, $user['password'])) {
            session_start();
            $_SESSION['user_id'] = $user['id'];
            $_SESSION['username'] = $user['username'];
            header("Location: my_posts.php");
            exit();
        } else {
            $error_message = "Invalid password or username.";
        }
    } else {
        $error_message = "No user found.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../assests/css/style1.css">
    <title>Login</title>
    <style>
        .modal {
            display: none; 
            position: fixed; 
            z-index: 1; 
            left: 0;
            top: 0;
            width: 100%;
            height: 100%;
            overflow: auto; 
            background-color: rgb(0,0,0); 
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
    </style>
</head>
<body>
    <?php if (!empty($error_message)): ?>
        <div id="errorModal" class="modal">
            <div class="modal-content">
                <span class="close">&times;</span>
                <p><?php echo $error_message; ?></p>
            </div>
        </div>
    <?php endif; ?>

    <div class="form-container">
        <form action="login.php" method="post" class="login-form">
            <h2 class="form-title">WELCOME BACK</h2>
            <p class="form-subtitle">Welcome back! Please enter your details.</p>
            <input type="name" name="username" placeholder="Username" required class="form-input">
            <input type="password" name="password" placeholder="Password" required class="form-input">
            <div class="form-options">
                <a href="#" class="forgot-password">Forgot password</a>
            </div>
            <button type="submit" class="form-button">Sign in</button>
            <p class="signup-text">Don't have an account? <a href="register.php" class="signup-link">Sign up for free!</a></p>
        </form>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            var modal = document.getElementById('errorModal');
            if (modal) {
                modal.style.display = "block";

                var closeBtn = modal.querySelector('.close');
                closeBtn.onclick = function() {
                    modal.style.display = "none";
                }

                window.onclick = function(event) {
                    if (event.target == modal) {
                        modal.style.display = "none";
                    }
                }
            }
        });
    </script>
</body>
</html>

<?php include('../includes/footer.php'); ?>
