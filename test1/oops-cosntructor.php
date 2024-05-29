<?php 
class Person {
    public $name;
    public $age;

    function __construct($name = "rahulsir", $age = 25) {
        $this->name = $name;
        $this->age = $age;
    }

    function show() {
        echo $this->name . " " . $this->age . "\n";
    }
}

$p1 = new Person("kushkesh", 26);
$p1->show();
?>
