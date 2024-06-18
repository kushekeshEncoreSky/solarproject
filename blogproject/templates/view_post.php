

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
            <div class="post-actions" style="display:flex; gap:20px; align-items: center; margin:10px;">
                <a href="edit_post.php?id=<?php echo $post['id']; ?>" class="button">Edit</a>
                <form method="post" action="delete_post.php" onsubmit="return confirm('Are you sure you want to delete this post?');" style="display:inline;">
                    <input type="hidden" name="post_id" value="<?php echo $post['id']; ?>">
                    <button type="submit" class="button" style="border:none;">Delete</button>
                </form>
            </div>
        <?php endif; ?>
    </div>
</div>
<style>
    /* General container and post details styles */
.container {
    max-width: 1240px;
    padding: 20px;
    margin: 0 auto;
}

.post-detail img {
    max-width: 100%;
    height: auto;
    margin-bottom: 20px;
}

.post-detail h1 {
    font-size: 2em;
    margin-bottom: 10px;
}

.post-detail p {
    font-size: 1.2em;
    line-height: 1.6;
    margin-bottom: 20px;
}

.post-detail .author, .post-detail .date {
    display: block;
    font-size: 0.9em;
    color: #666;
}

.post-actions a, .post-actions button {
    background-color: #0073e6;
    color: #fff;
    padding: 10px 15px;
    text-decoration: none;
    border-radius: 5px;
    transition: background-color 0.3s ease;
}

.post-actions a:hover, .post-actions button:hover {
    background-color: #005bb5;
}

/* Comment section styles */
.comments {
    margin-top: 40px;
    padding: 20px;
    background-color: #f9f9f9;
    border-radius: 10px;
    box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
}

.comments h3 {
    margin-bottom: 20px;
    font-size: 1.5em;
    color: #333;
}

.comment {
    margin-bottom: 20px;
    padding: 10px;
    border-bottom: 1px solid #ddd;
}

.comment:last-child {
    border-bottom: none;
}

.comment .comment-author {
    font-weight: bold;
    margin-bottom: 5px;
}

.comment .comment-date {
    font-size: 0.9em;
    color: #666;
    margin-bottom: 10px;
}

.comment .comment-text {
    font-size: 1em;
    line-height: 1.5;
}

.comment-form {
    margin-top: 20px;
    display: flex;
    flex-direction: column;
}

.comment-form textarea {

   
    width: 100%;
    padding: 10px;
    margin-bottom: 10px;
    border: 1px solid #ddd;
    border-radius: 5px;
    font-size: 1em;
    resize: vertical;
}

.comment-form button {
    align-self: flex-end;
    background-color: #28a745;
    color: #fff;
    padding: 10px 20px;
    border: none;
    border-radius: 5px;
    font-size: 1em;
    cursor: pointer;
    transition: background-color 0.3s ease;
}

.comment-form button:hover {
    background-color: #218838;
}
 .kushkesh
 {
    width:80%;
 }
</style>

<!-- Comment Section -->
<div class="comments">
    <h3>Comments</h3>
    <?php display_comments($post_id, $conn); ?>

    <?php if (isset($_SESSION['user_id'])): ?>
        <h2 style="text-align:center;"> Suggest your thoughts through comments</h2>
        <form method="post" action="" class="comment-form">
            <input type="hidden" name="post_id" value="<?php echo $post_id; ?>">
            <div class="kushkesh">
            <textarea name="comment" required></textarea>
            <button type="submit">Add Comment</button>
            </div>
         
        </form>
    <?php else: ?>
        <p>You must be logged in to comment.</p>
    <?php endif; ?>
</div>

<?php include('../includes/footer.php'); ?>

<?php $conn->close(); ?>
