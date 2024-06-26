<?php
  include 'db_con.php';?>
  <?php
    if(isset($_GET['RollNumber'])){
        $id=$_GET['RollNumber'];
    }
  $query="delete from `students` where `RollNumber`='$id'";
  $result=mysqli_query($connection,$query);
  if(!$result){
    die("Query failed");
  }
  else {
    header('location:home.php?delete="you have deleted"');
  }
  
  ?>