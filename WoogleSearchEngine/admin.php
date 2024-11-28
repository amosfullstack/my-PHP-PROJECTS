<?php
session_start();
require 'dbconn.php';
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $usename = $_POST['username'];
    $password = $_POST['password'];

    
   /* $username="root";
$password="";
$servername="localhost";
$dbname="woogle_db";
$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die( "Connection failed: " . $conn->connect_error );
}
else*/
{
   /*if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }*/
    
    $sql = "SELECT * FROM admin WHERE username='$usename' AND password='$password'";
    $result = $conn->query($sql);
    
    if ($result->num_rows == 1) {
        $_SESSION['admin'] = $usename;
        header("Location: upload.php");
    } else {
        echo "Invalid credentials.";
    }
}

   
    
    $conn->close();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Login</title>
    <link rel="stylesheet" href="stylesadmin.css">
</head>
<body>
    <div class="login-container">
        <h1>Admin Login</h1>
        <form method="POST" action="admin.php">
            <input type="text" name="username" placeholder="Username" required>
            <input type="password" name="password" placeholder="Password" required>
            <button type="submit">Login</button>
        </form>
    </div>
</body>
</html>
