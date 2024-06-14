<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

include('../includes/db.php');

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $title = $_POST['title'];
    $content = $_POST['content'];
    $user_id = $_SESSION['user_id'];

    // Handle file upload
    $image = null;
    if (isset($_FILES['image']) && $_FILES['image']['error'] == UPLOAD_ERR_OK) {
        $target_dir = "../uploads/"; // Use the relative path
        $target_file = $target_dir . basename($_FILES["image"]["name"]);

        // Check if the uploads directory is writable
        if (is_writable($target_dir)) {
            if (move_uploaded_file($_FILES["image"]["tmp_name"], $target_file)) {
                $image = basename($_FILES["image"]["name"]);
            } else {
                echo "Error moving the uploaded file.";
            }
        } else {
            echo "The uploads directory is not writable.";
        }
    }

    // Insert post into database
    $sql = "INSERT INTO posts (title, content, user_id, image) VALUES (?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);

    // Check if image is null and set appropriate parameter type
    if ($image !== null) {
        $stmt->bind_param('ssis', $title, $content, $user_id, $image);
    } else {
        $stmt->bind_param('ssis', $title, $content, $user_id, $image);
    }

    if ($stmt->execute()) {
        echo "Post created successfully.";
    } else {
        echo "Failed to create post.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Create Post</title>
<style>
    body {
        font-family: 'Arial', sans-serif;
        background-color: #f9f9f9;
        margin: 0;
        padding: 0;
        display: flex;
        justify-content: center;
        align-items: center;
        height: 100vh;
    }

    .form-container {
        background-color: #fff;
        padding: 40px;
        border-radius: 10px;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        max-width: 400px;
        width: 100%;
        text-align: center;
    }

    .form-title {
        font-size: 1.5em;
        margin-bottom: 10px;
        color: #333;
    }

    .form-subtitle {
        color: #777;
        margin-bottom: 30px;
    }

    .form-input {
        width: 100%;
        padding: 10px;
        margin-bottom: 20px;
        border: 1px solid #ddd;
        border-radius: 5px;
    }

    .form-options {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 20px;
    }

    .remember-me {
        display: flex;
        align-items: center;
        font-size: 0.9em;
    }

    .forgot-password {
        color: #0073e6;
        text-decoration: none;
        font-size: 0.9em;
    }

    .form-button {
        width: 100%;
        padding: 10px;
        background-color: #ff4d4d;
        color: #fff;
        border: none;
        border-radius: 5px;
        cursor: pointer;
        font-size: 1em;
    }

    .form-button:hover {
        background-color: #cc0000;
    }

    .signup-text {
        margin-top: 20px;
        color: #777;
    }

    .signup-link {
        color: #ff4d4d;
        text-decoration: none;
    }

    .signup-link:hover {
        text-decoration: underline;
    }
</style>
</head>
<body>

<div class="form-container">
    <form action="create_post.php" method="post" enctype="multipart/form-data">
        <h2 class="form-title">Create Post</h2>
        <input type="text" name="title" class="form-input" placeholder="Title" required>
        <textarea name="content" class="form-input" placeholder="Content" required></textarea>
        <input type="file" name="image" class="form-input">
        <button type="submit" class="form-button">Create Post</button>
    </form>
</div>

<?php include('../includes/footer.php'); ?>

</body>
</html>
