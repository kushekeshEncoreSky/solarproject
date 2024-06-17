<?php
function display_comments($post_id, $conn) {
    $sql = "SELECT comments.*, users.username FROM comments JOIN users ON comments.user_id = users.id WHERE comments.post_id = ? ORDER BY comments.created_at DESC";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $post_id);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            echo '<div class="comment">';
            echo '<p class="comment-author">' . htmlspecialchars($row["username"]) . ':</p>';
            echo '<p class="comment-content">' . htmlspecialchars($row["content"]) . '</p>'; // Change from "comment" to "content"
            echo '<p class="comment-date">' . htmlspecialchars($row["created_at"]) . '</p>';
            echo '</div>';
        }
    } else {
        echo '<p>No comments yet.</p>';
    }
    $stmt->close();
}

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["comment"])) {
    if (isset($_SESSION["user_id"])) {
        $user_id = $_SESSION["user_id"];
        $post_id = $_POST["post_id"];
        $comment = $_POST["comment"];

        $sql = "INSERT INTO comments (post_id, user_id, content) VALUES (?, ?, ?)"; // Change from "comment" to "content"
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("iis", $post_id, $user_id, $comment);

        if ($stmt->execute()) {
            echo "Comment added successfully.";
        } else {
            echo "Error: " . $stmt->error;
        }
        $stmt->close();
    } else {
        echo "You must be logged in to comment.";
    }
}
?>
