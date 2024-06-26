<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

include('../includes/db.php');

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['post_id'])) {
    $post_id = $_POST['post_id'];
    $user_id = $_SESSION['user_id'];

    // Ensure the user owns the post they're trying to delete
    $sql = "DELETE FROM posts WHERE id = ? AND user_id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param('ii', $post_id, $user_id);

    if ($stmt->execute()) {
        echo "<p>Post deleted successfully.</p>";
        header("Location: ../templates/all_posts.php");
        exit();
    } else {
        echo "<p>Error: " . $stmt->error . "</p>";
    }
}

$conn->close();
?>
