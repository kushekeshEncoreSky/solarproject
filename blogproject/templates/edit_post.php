<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

include('../includes/db.php');
// include('../includes/header.php');

if (isset($_GET['id'])) {
    $post_id = $_GET['id'];
    $user_id = $_SESSION['user_id'];

    // Fetch the post details to be edited
    $sql = "SELECT * FROM posts WHERE id = ? AND user_id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param('ii', $post_id, $user_id);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $post = $result->fetch_assoc();
    } else {
        echo "<p>Post not found or you don't have permission to edit this post.</p>";
        include('../includes/footer.php');
        exit();
    }
} else {
    header("Location: all_posts.php");
    exit();
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $title = $_POST['title'];
    $content = $_POST['content'];
    $image = $_FILES['image']['name'];

    if ($image) {
        $target_dir = "../uploads/";
        $target_file = $target_dir . basename($image);
        move_uploaded_file($_FILES['image']['tmp_name'], $target_file);
        $sql = "UPDATE posts SET title = ?, content = ?, image = ? WHERE id = ? AND user_id = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param('sssii', $title, $content, $image, $post_id, $user_id);
    } else {
        $sql = "UPDATE posts SET title = ?, content = ? WHERE id = ? AND user_id = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param('ssii', $title, $content, $post_id, $user_id);
    }

    if ($stmt->execute()) {
        echo "<p>Post updated successfully.</p>";
        header("Location: view_post.php?id=" . $post_id);
        exit();
    } else {
        echo "<p>Error: " . $stmt->error . "</p>";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Post</title>
    <link rel="stylesheet" href="../assests/css/edit_post.css">
</head>
<body>
    <div class="form-container">
        <h1 class="form-title">Edit Post</h1>
        <form method="post" enctype="multipart/form-data">
            <input type="text" name="title" class="form-input" value="<?php echo htmlspecialchars($post['title']); ?>" required>
            <textarea name="content" id="content" class="form-input resizable" placeholder="Content" required
            onChange="autoResize(this)"></textarea>
            <input type="file" name="image" class="form-input">
            <button type="submit" class="form-button">Update Post</button>
        </form>
    </div>
</body>

<script>
    function autoResize(element) {
        element.style.height = 'auto';
        element.style.height = (element.scrollHeight) + 'px';
    }
</script>
</html>

<?php include('../includes/footer.php'); ?>

<?php $conn->close(); ?>
