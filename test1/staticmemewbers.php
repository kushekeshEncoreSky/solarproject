<?php
 class base{
    public  static $name="EncoreSky Technologies";
    public static function show(){
        echo self::$name;
    }
     public function __construct(){
        self::show();
    }
 }
    
// echo base::$name;
//  base::show();
$test=new base();
$test->show();
?>