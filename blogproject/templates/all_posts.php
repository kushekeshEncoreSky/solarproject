<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

include('../includes/db.php');
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>All Posts</title>
    <link rel="stylesheet" href="../assests/css/style.css">
</head>
<body>
    <?php include '../includes/header.php'; ?>
    <h1 class="section-title" style="text-align: center;">All Posts</h1>
    <div class="container">
        <div class="grid">
            <?php
            $sql = "SELECT posts.*, users.username FROM posts JOIN users ON posts.user_id = users.id ORDER BY posts.created_at DESC";
            $result = $conn->query($sql);

            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    echo '<div class="post-card">';
                    if (!empty($row["image"])) {
                        echo '<img src="../uploads/' . htmlspecialchars($row["image"]) . '" alt="Post Image">';
                    } else {
                        echo '<img src="assets/images/default.jpg" alt="Post Image">';
                    }
                    echo '<div class="post-info">';
                    echo '<h2 class="post-title"><a href="view_post.php?id=' . $row["id"] . '">' . htmlspecialchars($row["title"]) . '</a></h2>';
                    echo '<div class="post-meta">';
                    echo '<span class="author">' . htmlspecialchars($row["username"]) . '</span>';
                    echo '<span class="date">' . htmlspecialchars($row["created_at"]) . '</span>';
                    echo '</div>';
                    echo '</div>';
                    echo '</div>';
                }
            } else {
                echo "No posts found.";
            }
            $conn->close();
            ?>
        </div>
    </div>

    <?php include('../includes/footer.php'); ?>
</body>
</html>
