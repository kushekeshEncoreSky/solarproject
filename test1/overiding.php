<?php
 class base {
    public $name="parent class";
     public function calc($a,$b)
     {
        return $a*$b;
     }
 }
  class derived extends base{
    public $name="child class <br>";
    public function calc($a,$b)
    {
       return $a+$b;
    }
  }
  $testing=new derived();
  echo $testing->name;
//   $test=new base();
//   echo $test->name;
  echo  $testing->calc(10,20);

?>