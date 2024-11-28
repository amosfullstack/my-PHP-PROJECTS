<!DOCTYPE html>
<html>
    <body>
        <form action="switchgrades.php" method="post">
            <label for="grade">Please Enter your Grade:</label><br>
            <input type="text" name="grade">
            <input type="submit" value="submit">
        </form>
    </body>
</html>
<?php
$grade=$_POST["grade"];
switch($grade){
    case "A":
        echo "You did Great";
        break;
    case "B":
        echo "You did Good";
        break;
    case "C":
        echo "You did Normal";
        break;
    case "D":
        echo "Pull Up your Socks";
        break;
    case "E":
        echo "You are Just eating";
        break;
    case "F":
        echo "You Failed";
        break;
    default:
        echo "{$grade} is Unclassified Or Invalid";                      
}
?>