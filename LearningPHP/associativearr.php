<?php
$capitals=array("USA"=>"Washington",
                 "Japan"=>"Tokyo",
                 "Tanzania"=>"Dodoma",
                 "Korea"=>"Seoul",
                 "India"=>"Bangalesh");

//Printing one value
echo $capitals["USA"] ."<br>";   

//Printing All the values using for each loop
foreach($capitals as $key=>$value){
    echo "{$key}={$value} <br>";
}

//
$values = array_values($capitals);
foreach($values as $value){
echo "{$value}";
}
                 ?>