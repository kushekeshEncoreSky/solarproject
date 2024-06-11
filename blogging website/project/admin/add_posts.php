<?php

include '../components/connect.php';

session_start();

$admin_id = $_SESSION['admin_id'];

if(!isset($admin_id)){
   header('location:admin_login.php');
}

if(isset($_POST['publish']) || isset($_POST['draft'])){

   $name = $_POST['name'];
   $name = filter_var($name, FILTER_SANITIZE_STRING);
   $title = $_POST['title'];
   $title = filter_var($title, FILTER_SANITIZE_STRING);
   $content = $_POST['content'];
   $content = filter_var($content, FILTER_SANITIZE_STRING);
   $category = $_POST['category'];
   $category = filter_var($category, FILTER_SANITIZE_STRING);
   $status = isset($_POST['publish']) ? 'active' : 'deactive';
   
   $image = $_FILES['image']['name'];
   $image = filter_var($image, FILTER_SANITIZE_STRING);
   $image_size = $_FILES['image']['size'];
   $image_tmp_name = $_FILES['image']['tmp_name'];
   $image_folder = '../uploaded_img/'.$image;

   $select_image = $conn->prepare("SELECT * FROM `posts` WHERE image = ? AND admin_id = ?");
   $select_image->execute([$image, $admin_id]);

   if(isset($image) && !empty($image)){
      if($select_image->rowCount() > 0){
         $message[] = 'Image name repeated!';
      }elseif($image_size > 2000000){
         $message[] = 'Image size is too large!';
      }else{
         if(move_uploaded_file($image_tmp_name, $image_folder)){
            // Image moved successfully
         } else {
            $message[] = 'Failed to move the uploaded file.';
         }
      }
   }else{
      $image = '';
   }

   if($select_image->rowCount() > 0 && !empty($image)){
      $message[] = 'Please rename your image!';
   }else{
      $insert_post = $conn->prepare("INSERT INTO `posts`(admin_id, name, title, content, category, image, status) VALUES(?,?,?,?,?,?,?)");
      $insert_post->execute([$admin_id, $name, $title, $content, $category, $image, $status]);
      $message[] = isset($_POST['publish']) ? 'Post published!' : 'Draft saved!';
   }
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Posts</title>

   <!-- Font awesome CDN link -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">

   <!-- Custom CSS file link -->
   <link rel="stylesheet" href="../css/admin_style.css">

</head>
<body>

<?php include '../components/admin_header.php'; ?>

<section class="post-editor">

   <h1 class="heading">Add New Post</h1>

   <form action="" method="post" enctype="multipart/form-data">
      <input type="hidden" name="name" value="<?= $fetch_profile['name']; ?>">
      <p>Post Title <span>*</span></p>
      <input type="text" name="title" maxlength="100" required placeholder="Add post title" class="box">
      <p>Post Content <span>*</span></p>
      <textarea name="content" class="box" required maxlength="10000" placeholder="Write your content..." cols="30" rows="10"></textarea>
      <p>Post Category <span>*</span></p>
      <select name="category" class="box" required>
         <option value="" selected disabled>-- Select Category* --</option>
         <!-- Add your categories here -->
         <option value="nature">Nature</option>
         <option value="education">Education</option>
         <option value="pets and animals">Pets and Animals</option>
         <option value="technology">Technology</option>
         <option value="fashion">Fashion</option>
         <option value="entertainment">Entertainment</option>
         <option value="movies and animations">Movies and Animations</option>
         <option value="gaming">Gaming</option>
         <option value="music">Music</option>
         <option value="sports">Sports</option>
         <option value="news">News</option>
         <option value="travel">Travel</option>
         <option value="comedy">Comedy</option>
         <option value="design and development">Design and Development</option>
         <option value="food and drinks">Food and Drinks</option>
         <option value="lifestyle">Lifestyle</option>
         <option value="personal">Personal</option>
         <option value="health and fitness">Health and Fitness</option>
         <option value="business">Business</option>
         <option value="shopping">Shopping</option>
         <option value="animations">Animations</option>
      </select>
      <p>Post Image</p>
      <input type="file" name="image" class="box" accept="image/jpg, image/jpeg, image/png, image/webp">
      <div class="flex-btn">
         <input type="submit" value="Publish Post" name="publish" class="btn">
         <input type="submit" value="Save Draft" name="draft" class="option-btn">
      </div>
   </form>

</section>

<!-- Custom JS file link -->
<script src="../js/admin_script.js"></script>

</body>
</html>
