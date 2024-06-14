<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

include('../includes/db.php');
include('../includes/header.php');

if (isset($_GET['id'])) {
    $post_id = $_GET['id'];
    $user_id = $_SESSION['user_id'];

    $sql = "SELECT * FROM posts WHERE id = ? AND user_id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param('ii', $post_id, $user_id);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $post = $result->fetch_assoc();
    } else {
        echo "<p>Post not found.</p>";
        include('../includes/footer.php');
        exit();
    }
} else {
    header("Location: my_posts.php");
    exit();
}
?>

<div class="container">
    <div class="post-detail">
        <?php if (!empty($post["image"])): ?>
            <img src="../uploads/<?php echo htmlspecialchars($post["image"]); ?>" alt="Post Image">
        <?php else: ?>
            <img src="../assets/images/default.jpg" alt="Post Image">
        <?php endif; ?>
        <h1><?php echo htmlspecialchars($post["title"]); ?></h1>
        <p><?php echo htmlspecialchars($post["content"]); ?></p>
        <span class="date"><?php echo htmlspecialchars($post["created_at"]); ?></span>
    </div>
</div>

<?php include('../includes/footer.php'); ?>
