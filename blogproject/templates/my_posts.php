<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

include('../includes/db.php');
include('../includes/header.php');

$user_id = $_SESSION['user_id'];

$sql = "SELECT * FROM posts WHERE user_id = ? ORDER BY created_at DESC";
$stmt = $conn->prepare($sql);
$stmt->bind_param('i', $user_id);
$stmt->execute();
$result = $stmt->get_result();

?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>My Posts</title>
<link rel="stylesheet" href="../assests/css/style.css">
<!-- <style>
  /* Styles for grid layout */
  .grid {
    display: grid;
    grid-template-columns: repeat(auto-fill, minmax(300px, 1fr)); /* Adjusted to auto-fill */
    gap: 20px; /* Adjust the gap between cards as needed */
    margin-top: 20px; /* Example margin for spacing */
  }

  /* Styles for post cards */
  .post-card {
    border: 1px solid #ccc; /* Border style */
    padding: 20px; /* Padding inside the card */
    transition: box-shadow 0.3s ease; /* Smooth transition for hover effect */
    display: flex; /* Ensures children elements are aligned in a row */
    flex-direction: column; /* Stack children elements vertically */
  }

  /* Hover effect */
  .post-card:hover {
    box-shadow: 0 0 10px rgba(0, 0, 0, 0.1); /* Example box shadow on hover */
  }

  /* Styles for post information */
  .post-title {
    font-size: 1.2rem; /* Example font size */
    font-weight: bold; /* Example font weight */
    margin-bottom: 10px; /* Example margin for spacing */
  }

  .post-meta {
    font-size: 0.9rem; /* Example font size for date */
    color: #999; /* Example color for date text */
  }
</style> -->
</head>
<body>
    <h1 class="section-title">My Posts</h1>
<div class="container">
  
    <div class="grid">
        <?php
        $count = 0; // Initialize a counter
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                echo '<div class="post-card">';
                if (!empty($row["image"])) {
                    echo '<img src="../uploads/' . htmlspecialchars($row["image"]) . '" alt="Post Image">';
                } else {
                    echo '<img src="../assets/images/default.jpg" alt="Post Image">';
                }
                echo '<div class="post-info">';
                echo '<h2 class="post-title"><a href="view_post.php?id=' . $row["id"] . '">' . htmlspecialchars($row["title"]) . '</a></h2>';
                echo '<div class="post-meta">';
                echo '<span class="date">' . htmlspecialchars($row["created_at"]) . '</span>';
                echo '</div>';
                echo '</div>';
                echo '</div>';

                $count++;
                // if (!($count % 3 )== 0) {
                //     echo '<div style="clear:both;"></div>'; // Clearfix after every third post
                // }
            }
        } else {
            echo "<p>You have no posts yet.</p>";
        }
        ?>
    </div>
</div>

<?php include('../includes/footer.php'); ?>
</body>
</html>
