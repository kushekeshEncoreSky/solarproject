<?php
include('../includes/db.php');
// include('../includes/header.php');

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = $_POST['username'];
    $email = $_POST['email'];
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);

    $sql = "INSERT INTO users (username, email, password) VALUES (?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param('sss', $username, $email, $password);

    if ($stmt->execute()) {
        echo "Registration successful.";
        header("Location: login.php");
    } else {
        echo "Registration failed.";
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
</head>
<body>
    <div class="form-container">
        <form action="register.php" method="post" class="login-form">
            <h2 class="form-title">Register</h2>
            <p class="form-subtitle">Please enter your details to register.</p>
            <input type="text" name="username" placeholder="Username" required class="form-input">
            <input type="email" name="email" placeholder="Email" required class="form-input">
            <input type="password" name="password" placeholder="Password" required class="form-input">
            <button type="submit" class="form-button">Register</button>
            <p class="signup-text">Already have an account? <a href="login.php" class="signup-link">Sign in here!</a></p>
        </form>
    </div>
</body>
</html>

<?php include('../includes/footer.php'); ?>
