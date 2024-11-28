<! DOCTYPE html>
<html>
    <title>CIRCLE</title>
    <body>
        <form action="circle.php" method="post">
        <label for="radius">Enter the Radius:</label>
        <input type="text" name="radius">
        <input type="submit" value="Submit">
    </form>
    </body>
</html>
<?php
$radius=$_POST["radius"];
$area= 2* pi()* $radius;
$circumference=2*pi()*$radius;
$volume=4/3*pi()*$radius;
$area=floor($area);
$circumference=ceil($circumference);
$volume=round($volume);
echo "The area of a circle is {$area} <br>";
echo "The circumference of the {$circumference} <br>";
echo "The volume of the circle is {$volume}";

?>