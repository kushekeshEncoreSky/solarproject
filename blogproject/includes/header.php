<?php
if (!isset($_SESSION)) {
    session_start();
}

$current_page = basename($_SERVER['PHP_SELF']);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>MetaBlog</title>
    <link rel="stylesheet" href="../assests/css/style.css">
    <!-- <link rel="stylesheet" href="../assests/css/edit_post.css"> -->
</head>
<body>
    <header>
        <div class="container">
            <a href="index.php" class="logo">MetaBlog</a>
            <nav>
                <ul>
                    <li><a href="index.php">Home</a></li>
                    <li><a href="blog.php">Blog</a></li>
                    <li><a href="single_post.php">Single Post</a></li>
                    <li><a href="pages.php">Pages</a></li>
                    <li><a href="contact.php">Contact</a></li>
                    <li><a href="all_posts.php">All Posts</a></li> <!-- Add All Posts link -->
                </ul>
            </nav>
            <div class="auth-buttons">
                <?php
                if ($current_page == 'index.php') {
                    echo '<a href="login.php" class="button">Login</a>';
                    echo '<a href="register.php" class="button">Sign Up</a>';
                } else {
                    if (isset($_SESSION['user_id'])) {
                        echo '<span>Welcome, ' . htmlspecialchars($_SESSION['username']) . '</span>';
                        echo '<a href="../templates/create_post.php" class="button">Create Post</a>';
                        echo '<a href="../templates/logout.php" class="button">Logout</a>'; // Changed to logout.php
                    } else {
                        echo '<a href="login.php" class="button">Login</a>';
                        echo '<a href="register.php" class="button">Sign Up</a>';
                    }
                }
                ?>
            </div>
        </div>
    </header>


