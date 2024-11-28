<?php
$foods=array("apple","orange","banana","coconut");
echo $foods[0] ."<br>";
echo $foods[1] ."<br>";
echo $foods[2] ."<br>";
echo $foods[3] ."<br><br>";

//Changing the array element
$foods[0]="pineapple";
//Add elements in an array
array_push($foods, "ugali");

//reversing an array
$foods=array_reverse($foods);
//Dispalying an array using a foreach loop

foreach($foods as $food){
    echo $food ."<br>";
}



?>