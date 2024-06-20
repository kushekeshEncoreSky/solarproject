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
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Post Details</title>
    <style>
        body {
            font-family: 'Arial', sans-serif;
            background-color: #f9f9f9;
            margin: 0;
            padding: 0;
        }

        .container {
            max-width: 1240px;
            margin: 0 auto;
            padding: 20px;
            text-align: center; /* Center the content */
        }

        .post-detail {
            margin: auto;
            max-width: 840px;
            margin-bottom: 40px;
            text-align: center;
        }

        .banner-image {
            width: 100%;
            height: auto;
            margin-bottom: 20px;
        }

        .post-content {
            max-width: 800px;
            margin: 0 auto;
            text-align: left; /* Left-align the post content */
        }

        .post-content h1 {
            font-size: 2em;
            margin-bottom: 10px;
        }

        .post-content p {
            font-size: 1.2em;
            line-height: 1.6;
            margin-bottom: 20px;
        }

        .author, .date {
            display: block;
            font-size: 0.9em;
            color: #666;
            margin-bottom: 5px;
        }

        .post-actions {
            display: flex;
            justify-content: center;
            gap: 20px;
            margin-top: 20px;
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

        .comments {
            margin-top: 40px;
            padding: 20px;
            background-color: #f9f9f9;
            border-radius: 10px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
            max-width: 800px;
            margin: 0 auto;
            /* text-align: center; Center the comments section */
        }

        .comment-section-header {
            display: flex;
            align-items: center;
            justify-content: space-between;
            margin-bottom: 20px;
        }

        .comment-section-header h3 {
            margin: 0;
            font-size: 1.5em;
        }

        .comment-section-header .review-icon {
            display: flex;
            align-items: center;
        }

        .comment-section-header .review-icon img {
            width: 24px;
            height: 24px;
            margin-right: 8px;
        }

        .comment {
            /* display: flex;
            align-items: flex-start; */
            padding: 10px 0;
            border-bottom: 1px solid #ddd;
        }

        .comment:last-child {
            border-bottom: none;
        }

        .comment-avatar {
            flex-shrink: 0;
            margin-right: 10px;
        }

        .comment-avatar img {
            width: 40px;
            height: 40px;
            border-radius: 50%;
        }

        .comment-content {
            flex-grow: 1;
        }

        .comment-content .comment-author {
            display: flex;
            /* align-items: center; */
            margin-bottom: 5px;
        }

        .comment-content .comment-author span {
            margin-left: 5px;
            font-size: 0.9em;
            color: #666;
        }

        .comment-content .comment-text {
            font-size: 1em;
            line-height: 1.5;
        }

        .comment-form {
            display: flex;
            flex-direction: column;
            margin-top: 20px;
            align-items: flex-start;
        }

        .comment-form textarea {
            width: 100%;
            padding: 10px;
            margin-bottom: 10px;
            border: 1px solid #ddd;
            border-radius: 5px;
            resize: vertical;
            font-size: 1em;
            min-height: 100px; /* Minimum height to start with */
            overflow-y: hidden; /* Hide vertical scrollbar */
        }

        .comment-form button {
            align-self: flex-end;
            background-color: #0073e6;
            color: #fff;
            padding: 10px 20px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }

        .comment-form button:hover {
            background-color: #005bb5;
        }
    </style>
    <script>
        function autoResize(element) {
            element.style.height = 'auto';
            element.style.height = (element.scrollHeight) + 'px';
        }
    </script>
</head>
<body>

<div class="container">
    <div class="post-detail">
        <?php if (!empty($post["image"])): ?>
            <img src="../uploads/<?php echo htmlspecialchars($post["image"]); ?>" alt="Post Image" class="banner-image">
        <?php else: ?>
            <img src="../assets/images/default.jpg" alt="Post Image" class="banner-image">
        <?php endif; ?>
        <div class="post-content">
            <h1><?php echo htmlspecialchars($post["title"]); ?></h1>
            <p><?php echo nl2br(htmlspecialchars($post["content"])); ?></p>
            <span class="author">By: <?php echo htmlspecialchars($post["username"]); ?></span>
            <span class="date"><?php echo htmlspecialchars($post["created_at"]); ?></span>
            
            <?php if ($_SESSION['user_id'] == $post['user_id']): ?>
                <div class="post-actions">
                    <a href="edit_post.php?id=<?php echo $post['id']; ?>" class="button">Edit</a>
                    <form method="post" action="delete_post.php" onsubmit="return confirm('Are you sure you want to delete this post?');">
                        <input type="hidden" name="post_id" value="<?php echo $post['id']; ?>">
                        <button type="submit" class="button">Delete</button>
                    </form>
                </div>
            <?php endif; ?>
        </div>
    </div>
</div>

<div class="comments">
    <div class="comment-section-header">
        <h3>Comments</h3>
        <div class="review-icon">
            <!-- <img src="path_to_review_icon.png" alt="Review Icon"> -->
            <!-- <span>Review</span> -->
        </div>
    </div>

    <?php if (isset($_SESSION['user_id'])): ?>
        <form method="post" action="" class="comment-form">
            <input type="hidden" name="post_id" value="<?php echo $post_id; ?>">
            <textarea name="comment" required placeholder="Type your comment here..." oninput="autoResize(this)"></textarea>
            <button type="submit">Add Comment</button>
        </form>
    <?php else: ?>
        <p>You must be logged in to comment.</p>
    <?php endif; ?>

    <?php display_comments($post_id, $conn); ?>
</div>

<?php include('../includes/footer.php'); ?>

<?php $conn->close(); ?>
</body>
<script>
    function autoResize(element) {
        element.style.height = 'auto';
        element.style.height = (element.scrollHeight) + 'px';
    }
</script>

</html>
