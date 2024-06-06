<?php
 class employee{
    public $name;
    public $age;
    public $salary;
    function __construct($name,$age,$salary)
    {
        $this->name=$name;
        $this->age=$age;
        $this->salary=$salary;
    }
     function info(){
        echo "<h3> Employee profile </h3>";
        echo "Employee name: ". $this->name. "<br>";
        echo "Employee age: ". $this->age. "<br>";
        echo "Employee salary: ". $this->salary. "<br>";
     }
 }

 class manager extends employee{
    
    function __construct(){
        echo "Manager constructor";
    }
 }
 $e1=new employee("rahul sir",25, "1.25lakhs");
 $m1=new employee("ram",25,"2lakh");
 $m1->info();
 $e1->info();
?>