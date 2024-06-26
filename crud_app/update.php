

<?php
 include 'db_con.php';?>
 <?php
//  echo "<pre>";
//  print_r($_POST);
//  echo "</pre>";

       
     if(isset($_GET['RollNumber'])){
        $RollNumber=$_GET['RollNumber'];  
     }
   
     $query="select * from `students` where `RollNumber`='$RollNumber'";
     $result=mysqli_query($connection,$query);
     if(!$result){
        die("query Failed".mysqli_error());
     }
     else{
         $row=mysqli_fetch_assoc($result);
        //   print_r($row);
        }
 ?>

 <?php
   if(isset($_POST['update_students']))
   {
    // echo "hello";die;
    if(isset($_GET['id_new'])){
        $id_new=$_GET['id_new'];
    }
    $Name=$_POST['f_name'];
    $age= $_POST['age'];
    $email=$_POST['email'];
    $query="update `students` set `Name`='$Name',`age`='$age',`email`='$email' where `RollNumber`='$id_new'";
    echo $query;

    $result=mysqli_query($connection,$query);
     if(!$result){
        die("query Failed".mysqli_error());
     }
     else{
         header('location:home.php?msgg=update-is-sucessful');
     }
   }
 
 ?>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" 
  integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <title>Home</title>
<form action="update.php?id_new=<?php echo $RollNumber;?>" method="post">
 <div class="form-group">
 <label for="f_name"> Name </label>
 <input type="text" name="f_name" class="form-control" value="<?php echo $row['Name']?>"> 
</div>
<div class="form-group">
 <label for="f_name"> age </label>
 <input type="text" name="age" class="form-control" value="<?php echo $row['age']?>"> 
</div>
<div class="form-group">
 <label for="f_name"> email </label>
 <input type="text" name="email" class="form-control" value="<?php echo $row['email']?>"> 
</div>
<div>
<input type="Submit" class="btn btn-primary" name="update_students" value="Update">
</div> 
</form>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" 
    integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>