<!DOCTYPE html>
<html>
    <title>
        LOGIN FORM
    </title>
    <body>
        <form action="isset2.php" method="post">
            <label for="username">Username:</label>
           <input type="text" name="username"><br><br>
           <label for="password">Password:</label>
           <input type="password" name="password"><br>
           <input type="submit" value="Login" name="login">
           
        </form>
    </body>
</html>
<?php
if(isset($_POST["login"])){
    $username=$_POST["username"];
    $password=$_POST["password"];

    if(empty($username)){
        echo "Username is Missing <br>";
    }
    elseif(empty($password)){
        echo "Password is missing <br>";
    }
    else{
        echo "Hello {$username}! <br>";
    }

}

//using the foreach loop to print the key and value
foreach($_POST as $key=>$value){
    echo "$key=$value <br>";
}
?>