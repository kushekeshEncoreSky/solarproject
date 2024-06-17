<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

include('../includes/db.php');
include('../includes/header.php');
include('./comment_handler.php'); // Include the comment handler

if (isset($_GET['id'])) {
    $post_id = $_GET['id'];

    // Fetch the post details without filtering by user_id
    $sql = "SELECT posts.*, users.username FROM posts JOIN users ON posts.user_id = users.id WHERE posts.id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param('i', $post_id);
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
    header("Location: all_posts.php"); // Redirect to the all posts page if no post ID is provided
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
        <span class="author">By: <?php echo htmlspecialchars($post["username"]); ?></span>
        <span class="date"><?php echo htmlspecialchars($post["created_at"]); ?></span>
        
        <?php if ($_SESSION['user_id'] == $post['user_id']): ?>
            <div class="post-actions" style="display:flex; gap:20px;   align-items: center; margin:10px;">
                <a href="edit_post.php?id=<?php echo $post['id']; ?>" class="button">Edit</a>
                <form method="post" action="delete_post.php" onsubmit="return confirm('Are you sure you want to delete this post?');" style="display:inline;">
                    <input type="hidden" name="post_id" value="<?php echo $post['id']; ?>">
                    <button type="submit" class="button" style="border:none;">Delete</button>
                </form>
            </div>
        <?php endif; ?>
    </div>
</div>

<!-- Comment Section -->
<div class="comments">
    <h3>Comments</h3>
    <?php display_comments($post_id, $conn); ?>

    <?php if (isset($_SESSION['user_id'])): ?>
        <form method="post" action="">
            <input type="hidden" name="post_id" value="<?php echo $post_id; ?>">
            <textarea name="comment" required></textarea>
            <button type="submit">Add Comment</button>
        </form>
    <?php else: ?>
        <p>You must be logged in to comment.</p>
    <?php endif; ?>
</div>

<?php include('../includes/footer.php'); ?>

<?php $conn->close(); ?>
