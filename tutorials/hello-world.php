<?php 
echo "hello world </br>";
echo 10+10;
echo "</br>";
echo "hello i am learning php as well </br>"
?>


<?php 
  $str="hello string";
  $x=200;
  $y=44.6;
  echo "string is :$str </br>";
  Echo "Value of x is :$x </br>";
  echo "value of y is :$y </br>"

  
?>
<?php
  function add($a,$b)
  {
     echo $a+$b;
  }
   add(2,3);
   echo "<br>";
   

?>

<?php
   $subject=array("react","salesforce","react-native");
   echo "<pre>" ;
     print_r ($subject);
  echo  "</pre>"
?>

<?php
   $number=array(89,98,97,56);
   echo "<pre>" ;
   print_r ($number);
   echo "</pre>";
   echo $number[2];
   echo "<br>"
?>

<?php
   echo "this is loopping concept <br>";
   echo " kushkesh is learning for loop right now <br> " ;
    for ($index=0; $index <2 ; $index++) { 
        # code...
        echo "The number is $index <br>" ;
    }
?>
<?php
  echo "looping specifically while loop in php <br>";
    $a=0;
   while ($a <= 10) {
    # code...
     echo "the number is $a <br>";
     $a++;
   }

?>
