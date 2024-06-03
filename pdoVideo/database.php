<?php

$server = 'localhost';
$user = 'root';
$password = 'root';
$db = 'phppdo';
$pdo = new PDO("mysql:host=$server;dbname=$db", $user, $password);
 $query=$pdo->query('SELECT * FROM 	employees');
//  $row=$query->fetch();
//  // we got the first row;
//  print_r($row);
//  echo "<pre>";
//  while($row=$query->fetch())
//  {  
//     print_r($row);

//  }
//  echo "</pre>";
// while($row=$query->fetch(PDO::FETCH_ASSOC)){
//     echo "</br>";
//     echo $row['name'];
// }
//  while($row=$query->fetch(PDO::FETCH_OBJ)){
//     echo $row->department,"<br>";
//  }
 class user{
    public $name;
    public $department;
    public $namedepartment;

  public function __construct() {
        $this->namedepartment = $this->name . ' ' . $this->department;
    }
 }

//   class user{
//     private $records=[];
//     public function __set($name,$department){
//         $this->records[$name]=$department;
//     }
//     public function __get($name){
//         if(array_key_exists($name,$this->records)) return $this->records[$name]=$department;
//     }
//   }
 echo "<pre>";
 $query->setFetchMode(PDO::FETCH_CLASS,'user');
 while($row=$query->fetch())
 {
    echo $row->namedepartment;
    echo "</br>";
             
 }
?>