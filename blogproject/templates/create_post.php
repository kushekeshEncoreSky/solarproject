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
                echo "<script>alert('Error moving the uploaded file.');</script>";
            }
        } else {
            echo "<script>alert('The uploads directory is not writable.');</script>";
        }
    }

    // Insert post into database
    $sql = "INSERT INTO posts (title, content, user_id, image) VALUES (?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param('ssis', $title, $content, $user_id, $image);

    if ($stmt->execute()) {
        header("Location: my_posts.php");
        exit();
    } else {
        echo "<script>alert('Failed to create post.');</script>";
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
        max-width: 600px;
        width: 100%;
        text-align: center;
    }

    .form-title {
        font-size: 1.5em;
        margin-bottom: 10px;
        color: #333;
    }

    .form-input {
        width: calc(100% - 20px); /* Adjusted to account for padding */
        padding: 10px;
        margin-bottom: 20px;
        border: 1px solid #ddd;
        border-radius: 5px;
        box-sizing: border-box; /* Ensure padding is included in width */
    }

    .form-button {
        width: 100%;
        padding: 10px;
        background-color: #007bff;
        color: #fff;
        border: none;
        border-radius: 5px;
        cursor: pointer;
        font-size: 1em;
    }

    .form-button:hover {
        background-color: #0056b3;
    }

    .image-preview {
        display: none;
        margin-top: 20px;
        max-width: 100%;
        height: auto;
    }

    @media (max-width: 768px) {
        .form-input {
            width: calc(100% - 16px); /* Adjusted for smaller screens */
            padding: 8px;
        }
    }
</style>
</head>
<body>

<div class="form-container">
    <form action="create_post.php" method="post" enctype="multipart/form-data" onsubmit="return validateImage();">
        <h2 class="form-title">Create Post</h2>
        <input type="text" name="title" class="form-input" placeholder="Title" required>
        <textarea name="content" id="content" class="form-input resizable" placeholder="Content" required
        oninput="autoResize(this)"></textarea>

        <input type="file" name="image" id="image" class="form-input" accept="image/*" onchange="previewImage();" required>
        <img id="imagePreview" class="image-preview" src="#" alt="Image Preview" />

        <button type="submit" class="form-button">Create Post</button>
    </form>
</div>

<?php include('../includes/footer.php'); ?>

<script>
    function validateImage() {
        const fileInput = document.getElementById('image');
        const filePath = fileInput.value;
        const allowedExtensions = /(\.jpg|\.jpeg|\.png|\.gif)$/i;
        if (!allowedExtensions.exec(filePath)) {
            alert('Please upload a valid image file (jpg, jpeg, png, gif).');
            fileInput.value = '';
            return false;
        }
        return true;
    }

    function autoResize(element) {
        element.style.height = 'auto';
        element.style.height = (element.scrollHeight) + 'px';
    }

    function previewImage() {
        const file = document.getElementById('image').files[0];
        if (file) {
            const reader = new FileReader();
            reader.onload = function(e) {
                const imgPreview = document.getElementById('imagePreview');
                imgPreview.src = e.target.result;
                imgPreview.style.display = 'block';
            }
            reader.readAsDataURL(file);
        }
    }
</script>

</body>
</html>
