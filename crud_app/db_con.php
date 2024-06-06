<?php

define("HOSTNAME","localhost");
define("USERNAME","root");
define("PASSWORD","root");
define("DATABASE","crud_operation");

$connection=mysqli_connect(HOSTNAME,USERNAME,PASSWORD,DATABASE);
if(!$connection){
    die("connection failed");
}
// else{
//     ECHO "yess";
// }
?>