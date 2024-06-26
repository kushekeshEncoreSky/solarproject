  <?php  include "db_con.php";?>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" 
  integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <title>Home</title>
</head>
<body>
   
    <h1>crud applications</h1>
    <button data-bs-toggle="modal" data-bs-target="#exampleModal"> Add students</button>
    <table>
        <thead>
            <tr>
              <th> RollNumber</th>
              <th> First Name</th>
              <th> email</th>
               <th> Age </th>
              <th>Update</th>
              <th>Delete</th>

            </tr>
        </thead>
           <tbody>
            <?php 
             $query="select * from `students`";
             $result=mysqli_query($connection,$query);
             if(!$result){
                die("query Failed".mysqli_error());
             }
             else{
                  while($row=mysqli_fetch_assoc($result)){
       
                    echo " <tr>
                    <td>".$row['RollNumber'].
                    "</td>
                    <td>".$row['Name']."</td>
                    <td>".
                    $row['age']."</td>
                    <td>".$row['email']."</td>
                    <td> <a href='update.php?RollNumber=". $row['RollNumber']."'>Update </a> </td>
                    <td> <a href='delete.php?RollNumber=".$row['RollNumber']."'>Delete </a> </td>
                    
                    </tr>";
                    
                  }
             }
            
            ?>
         
           </tbody>
    </table>
    <?php
      if(isset($_GET['message'])){
        echo "<h6>".$_GET['message']."</h6>";
      }
      if(isset($_GET['msg'])){
        echo "<h6>".$_GET['msg']."</h6>";
      }
    
    ?>
    <form action="insert.php" method="post"> 
    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Form change</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
     
     
         <div class="form-group">
            <label for="f_name"> Name </label>
            <input type="text" name="f_name" class="form-control"> 
         </div>
         <div class="form-group">
            <label for="f_name"> age </label>
            <input type="text" name="age" class="form-control"> 
         </div>
         <div class="form-group">
            <label for="f_name"> email </label>
            <input type="text" name="email" class="form-control"> 
         </div>
     
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        <input type="Submit" class="btn btn-primary" name="add_students" value="ADD">
      </div>
    </div>
  </div>
</div>
</form>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" 
    integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>

</body>
</html>