<?php 
// Print the content of $_FILES for debugging
// print_r($_FILES);

// $path = "./uploads/";
// $uploadok = 1;
// $isuploaded = isset($_POST["submit"]);
// var_dump($isuploaded);
// echo "<br>";

// if ($isuploaded) {
//     if (isset($_FILES["fileUpload"]) && $_FILES["fileUpload"]["error"] == 0) {
//         $path_name = $path . basename($_FILES["fileUpload"]["name"]); 
//         var_dump($path_name);
//         echo "<br>";

//         $imageFile = strtolower(pathinfo($path_name, PATHINFO_EXTENSION));

//         // Check if image file is an actual image or fake image
//         $check = getimagesize($_FILES["fileUpload"]["tmp_name"]);
//         if ($check !== false) {
//             echo "File is an image - " . $check["mime"] . ".";
//             $uploadok = 1;
//         } else {
//             echo "File is not an image.";
//             $uploadok = 0;
//         }
//     } else {
//         echo "File was not uploaded successfully.";
//         var_dump($_FILES["fileUpload"]["error"]);
//         $uploadok = 0;
//     }
// }

   
   echo $filename=$_FILES['fileUpload']['name']  ;

 $tempname=$_FILES['fileUpload']['tmp_name']  ;
  $destination='uploads/'.$filename;
  move_uploaded_file($tempname,$destination);
?>
