<?php 
    for ($i=0; $i < 5; $i++) { 
        # code...
        for ($j=0; $j <=$i; $j++) { 
            # code...
            echo "*";
        }
        echo "<br>";
    }



?>

<?php

$originalArray = array(1, 2, 3, 4, 5);
echo "<pre>";
echo "original array is here <br>";
print_r($originalArray);
echo "</pre>";
$reversedArray = array();
$length = count($originalArray);

for ($i = $length - 1; $i >= 0; $i--) {
    $reversedArray[] = $originalArray[$i];
}

echo "<pre>";
echo "Reverse array is here <br>";
print_r($reversedArray);
echo "</pre>";
?>


<?php 
   function isprime($number)
   {
    if($number<=1)
    {
        return false;
    }
    for ($i=02; $i*$i <=$number ; $i++) { 
        # code...
         if($number%$i==0)
         {  return false;
             echo "<br>";
            }
    }
    return true;
    echo "<br>";
   }

   $num =14;
   $is_prime=isprime($num);
    if($is_prime)
    {    echo "<br>";
        echo $num. "is a prime number <br>";
    }else{
        echo "<br>";
        echo $num."<br> is not a prime number <br>";  
    }

?>


<?php

function armstrongCheck($number){
	$sum = 0; 
	$x = $number; 
	while($x != 0) 
	{ 
		$rem = $x % 10; 
		$sum = $sum + $rem*$rem*$rem; 
		$x = $x / 10; 
	} 
	
	if ($number == $sum)
		return 1;
	
	return 0; 
}

$number = 300;
$flag = armstrongCheck($number);
if ($flag == 1)
   echo " yes,it is an armstrong number: $number <br>";
	
else
	echo "no it is not an armstrong number :$number <br>"
?>


<?php

function bubbleSort($arr) {
	$n = count($arr);

	for ($i = 0; $i < $n - 1; $i++) {
		for ($j = 0; $j < $n - $i - 1; $j++) {
			
		
			if ($arr[$j] > $arr[$j + 1]) {
				$temp = $arr[$j];
				$arr[$j] = $arr[$j + 1];
				$arr[$j + 1] = $temp;
			}
		}
	}

	return $arr;
}


$arr = [64, 34, 25, 12, 22, 11, 90];
$sortedArray = bubbleSort($arr);


echo "Sorted array: "
	. implode(", ", $sortedArray);

?>


<?php 



function insertionSort(&$arr, $n)
{
    for ($i = 1; $i < $n; $i++)
    {
        $key = $arr[$i];
        $j = $i-1;

        while ($j >= 0 && $arr[$j] > $key)
        {
            $arr[$j + 1] = $arr[$j];
            $j = $j - 1;
        }
        
        $arr[$j + 1] = $key;
    }
}
function printArray(&$arr, $n)
{
    for ($i = 0; $i < $n; $i++)
        echo $arr[$i]." ";
    echo "\n";
}
$arr = array(12, 11, 13, 5, 6);
$n = sizeof($arr);
insertionSort($arr, $n);
printArray($arr, $n);

?>

