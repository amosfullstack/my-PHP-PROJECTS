<!DOCTYPE html>
<html>
    <body>
        <form action="adultvote.php" method="post">
            <label for="age">Please Enter your Age:</label>
            <input type="text" name="age" placeholder="age"><br><br>
            <label for="checkbox">Select if you Have Voter Id:</label>
            <input type="checkbox" name="checkbox"><br>
            <input type="submit" value="submit">
        </form>
    </body>
</html>

<?php
$age=$_POST["age"];
$voterId=$_POST["checkbox"];

if($age>=18&&$voterId){
    echo "You are eligible to Vote";
}
elseif($age>=18&&!$voterId){
    echo "Please look for the Voter Id";
}
else{
    echo "You are not Eligible to Vote, Go Home";
}
?>