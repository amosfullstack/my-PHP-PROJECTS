<?php
$age=32;
if($age>=100){
    echo "You are too Old enter the site";
}
elseif($age>18){
    echo "You may enter the site";
}
elseif($age<18){
    echo "You are too young to enter the site";
}
elseif($age<0){
    echo "You an not enter the site, You are Just Born";
}
else{
    echo "Please enter the valid age";
}
?>