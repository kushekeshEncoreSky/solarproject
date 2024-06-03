<?php
try{
    ini_set('display_errors', 1);
    ini_set('display_startup_errors', 1);
    error_reporting(E_ALL);

    $server = 'localhost';
    $user = 'root';
    $password = 'root';
    $db = 'phppdo';
    
 
    $dbcon = new PDO("mysql:host=$server;dbname=$db", $user, $password);  
    // $insertquery="insert into studentstable(name,age,class,gender) values('vinod',26,12,'male')";
    // $dbcon->query($insertquery);
    // $insertquery=" insert into studentstable(name,age,class,gender) values('bhadauriya',40,12,'male')";
    // $dbcon->exec($insertquery);

    $selectquery="select * from studentstable where id=1";
    $state=$dbcon->query($selectquery);
    $result=$state->fetch(PDO::FETCH_OBJ);
    //   $idnum=1;
    // $selectquery="select * from  studentstable where  id=:idnum";
    //     $stmt=$dbcon->prepare($selectquery);
    //     $stmt->bindparam(':idnum',$idnum);
    //     $stmt->execute();
    //     $result=$stmt->fetch();
    echo "<br>" ,"<pre>";
    print_r($result);   
    echo "</pre>";
    // echo $result['age'];
    echo $result->age;
}
 catch(PDOException $e)
 {
    echo 'error:' .$e->getMessage();
 }
   
?>
