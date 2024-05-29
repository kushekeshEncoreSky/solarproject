<?php
class base{
    public $name;

    public function __construct($n)
    {
        $this->name=$n;
    }
    public function show(){
        echo "your name:" .$this->name. "<br>";
    }
}
class derived extends base{
    public function get(){
        echo "your name:" .$this->name. "<br>";
    }
}
$test = new derived("");
$test->show();

?>