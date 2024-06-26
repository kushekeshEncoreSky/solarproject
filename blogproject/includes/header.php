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
    <link rel="stylesheet" href="../assets/css/style.css">
</head>
<body>
    <header>
        <div class="container">
            <div class="header-contain">
                <a href="index.php" class="logo">MetaBlog</a>
                <nav class="navbar">
                    <ul>
                        <li><a href="#">Home</a></li>
                        <li><a href="blog.php">Blog</a></li>
                        <li><a href="single_post.php">Single Post</a></li>
                        <li><a href="pages.php">Pages</a></li>
                        <li><a href="contact.php">Contact</a></li>
                        <li><a href="all_posts.php" class="all-posts-link">All Posts</a></li>
                        <div class="auth-buttons mobile-btn">
                    <?php
                    if ($current_page == 'index.php') {
                        echo '<a href="login.php" class="button">Login</a>';
                        echo '<a href="register.php" class="button">Sign Up</a>';
                    } else {
                        if (isset($_SESSION['user_id'])) {
                            echo '<span>Welcome, ' . htmlspecialchars($_SESSION['username']) . '</span>';
                            echo '<a href="../templates/create_post.php" class="button">Create Post</a>';
                            echo '<a href="../templates/logout.php" class="button">Logout</a>';
                        } else {
                            echo '<a href="login.php" class="button">Login</a>';
                            echo '<a href="register.php" class="button">Sign Up</a>';
                        }
                    }
                    ?>
                </div>
                    </ul>
                </nav>

                <div class="auth-buttons desktop-btn">
                    <?php
                    if ($current_page == 'index.php') {
                        echo '<a href="login.php" class="button">Login</a>';
                        echo '<a href="register.php" class="button">Sign Up</a>';
                    } else {
                        if (isset($_SESSION['user_id'])) {
                            echo '<span>Welcome, ' . htmlspecialchars($_SESSION['username']) . '</span>';
                            echo '<a href="../templates/create_post.php" class="button">Create Post</a>';
                            echo '<a href="../templates/logout.php" class="button">Logout</a>';
                        } else {
                            echo '<a href="login.php" class="button">Login</a>';
                            echo '<a href="register.php" class="button">Sign Up</a>';
                        }
                    }
                    ?>
                </div>
                <div class="mobile-navbar-btn">
                    <ion-icon name="menu-outline" class="mobile-nav-icon show" onclick="toggleMenu()"></ion-icon>
                    <ion-icon name="close-outline" class="mobile-nav-icon hide" onclick="toggleMenu()"></ion-icon>
                </div>
            </div>
        </div>
    </header>

    <script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script>
    <script>
        function toggleMenu() {
            const nav = document.querySelector('.navbar ul');
            const authButtons = document.querySelector('.auth-buttons');
            const openIcon = document.querySelector('.mobile-navbar-btn .mobile-nav-icon.show');
            const closeIcon = document.querySelector('.mobile-navbar-btn .mobile-nav-icon.hide');

            if (nav.classList.contains('active')) {
                nav.classList.remove('active');
                authButtons.classList.remove('active');
                openIcon.style.display = 'block';
                closeIcon.style.display = 'none';
            } else {
                nav.classList.add('active');
                authButtons.classList.add('active');
                openIcon.style.display = 'none';
                closeIcon.style.display = 'block';
            }
        }
    </script>
</body>
</html>
