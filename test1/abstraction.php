<?php 
  abstract class Base {
     abstract function printdata();
  }
//   abstract class derived{
//     abstract function calc();
//   }
   class derived2 extends Base {
        function printdata(){
            echo "today date is 29thy may 2024";
        }
   }
    $x=new derived2();
    echo $x->printdata();
?>