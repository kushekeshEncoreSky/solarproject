<?php 
 class calculation{
    PUBLIC $a,$b,$c;

    function sum(){
        $this->c=$this->a+$this->b;
        return $this->c;
    }
     function sub(){
        $this->c=$this->a-$this->b;
        return $this->c;
     }
 }
   $c1=new Calculation();
   $c1->a=10;
   $c1->b=20;
   echo  $c1->sum();
?>