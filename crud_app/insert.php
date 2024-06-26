<?php
include 'db_con.php'; 
if(isset($_POST['add_students'])){
  
    $f_name=$_POST['f_name'];
    $age=$_POST['age'];
    $email=$_POST['email'];
 
    if($f_name==""|| empty($f_name)){
        echo "hello it is in ifcond";
        header('location:home.php?message=you-neeed-to-fill-the-box');
    }
    else{
        echo "hello it is in else";
        $query="insert into `students` (`name`,`age`,`email`) values ('$f_name','$age','$email')";
        $result=mysqli_query($connection,$query);
        if(!$result)
        {
            die("Query Failed".mysqli_error());
        }
        else{
            header('location:home.php?msg=you-data-been-added-to-successful');
        }
    }
}




?>