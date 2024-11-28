<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <form action="brocode.php" method="post">
        <label for="x">X:</label>
        <input type="text" name="x">
        <label for="y">Y:</label>
        <input type="text" name="y">
        <input type="submit" value="Calculate">
    </form>
</body>
</html>
<?php
//$_POST["x"];
$x = $_POST["x"];
$y = $_POST["y"];
$total=null;
$total=pow($x,$y);
echo $total;
?>
