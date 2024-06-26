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
    <!-- <link rel="stylesheet" href="../assests/css/hamberger.css"> -->
    <!-- <link rel="stylesheet" href="../assets/css/style1.css"> -->
</head>
<body>
    <header>
        <div class="container">
            <a href="#" class="logo">MetaBlog</a>
            <nav class="navbar">
                <ul>
                    <li><a href="index.php">Home</a></li>
                    <li><a href="blog.php">Blog</a></li>
                    <li><a href="single_post.php">Single Post</a></li>
                    <li><a href="pages.php">Pages</a></li>
                    <li><a href="contact.php">Contact</a></li>
                    <li><a href="all_posts.php" class="all-posts-link">All Posts</a></li>
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
                <ion-icon name="close-outline" class="mobile-nav-icon close-icon hide" onclick="closeBtn()"></ion-icon>
            </div>
        </div>
    </header>

    <script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script>
    <script>
        function toggleMenu() {
            const nav = document.querySelector('.navbar ul');
            const openIcon = document.querySelector('.mobile-navbar-btn .mobile-nav-icon');
            const closeIcon = document.querySelector('.mobile-navbar-btn .close-icon');

            closeIcon.classList.add('show');
            closeIcon.classList.remove('hide');
            openIcon.classList.add('hide');
            nav.classList.add('active');
        }
        function closeBtn (){
            const closeIcon = document.querySelector('.mobile-navbar-btn .close-icon');
            const nav = document.querySelector('.navbar ul');
            const openIcon = document.querySelector('.mobile-navbar-btn .mobile-nav-icon');
            nav.classList.remove('active');
            openIcon.classList.add('show');
            openIcon.classList.remove('hide');
            closeIcon.classList.add('hide');
        }
    </script>
</body>
</html>
