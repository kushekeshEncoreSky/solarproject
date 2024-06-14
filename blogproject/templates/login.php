<?php
include('../includes/db.php');
// include('../includes/header.php');

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
        } else {
            echo "Invalid password.";
        }
    } else {
        echo "No user found.";
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
</head>
<body>
    <div class="form-container">
        <form action="login.php" method="post" class="login-form">
            <h2 class="form-title">WELCOME BACK</h2>
            <p class="form-subtitle">Welcome back! Please enter your details.</p>
            <input type="name" name="username" placeholder="Username" required class="form-input">
            <input type="password" name="password" placeholder="Password" required class="form-input">
            <div class="form-options">
                <!-- <label class="remember-me">
                    <input type="checkbox" name="remember"> Remember me
                </label> -->
                <a href="#" class="forgot-password">Forgot password</a>
            </div>
            <button type="submit" class="form-button">Sign in</button>
            <p class="signup-text">Don't have an account? <a href="register.php" class="signup-link">Sign up for free!</a></p>
        </form>
    </div>
</body>
</html>

<?php include('../includes/footer.php'); ?>


