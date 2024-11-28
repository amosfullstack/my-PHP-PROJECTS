<?php 
session_start();
//require 'homepage.php';
require 'dbconn.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Sanitize user input using prepared statements
    $stmt = $conn->prepare("SELECT * FROM voters WHERE voter_id = ?");
    $stmt->bind_param("s", $_POST['username']);
    $stmt->execute();
    $result = $stmt->get_result();

    //admin login
    $sql = $conn->prepare("SELECT * FROM admins WHERE username = ?");
    $sql->bind_param("s", $_POST['username']);
    $sql->execute();
    $admin = $sql->get_result();

    if($admin->num_rows==1)
    {
        $row=$admin->fetch_assoc();
        if(password_verify($_POST['password'],$row['adminpass']))
        {
            $_SESSION['username']=$row['username'];
            header('location:voter_register.php');
        }
    }

    if ($result->num_rows == 1) {
        $row = $result->fetch_assoc();

        // Verify password using password_verify()
        if (password_verify($_POST['password'], $row['password'])) {
            // Set session variables
            $_SESSION['firstname'] = $row['firstname'];
            $_SESSION['lastname'] = $row['lastname'];
            $_SESSION['username'] = $row['voter_id'];
        
            // Do not store the password in the session
             header('location:dashboard.php');
        } else {
            echo "Invalid  password...";
        }
    } else {
        echo "Invalid username...";
    }

    // Close the statement
    $stmt->close();
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Voter Login</title>
    <link rel="stylesheet" href="voting.css">
    
</head>
<body>
   <style>
    body{
        background-color: thistle;
            margin: 0;
            padding: 0;
            font-family: Arial, sans-serif;
            display: flex;
            flex-direction: column;
            align-items: center;
            min-height: 100vh;
            border: 4px solid black;
            
    }
    
   </style>
    <div class="container">
        <h1>Voter Login</h1>
        <form action="voter_login.php" method="post">
            <div class="form-group">
                <input type="text" name="username" placeholder="Username" required>
            </div>
            <div class="form-group">
                <input type="password" name="password" placeholder="Password" required>
            </div>
            <button type="submit">Login</button>
          
        </form>
    </div>
</body>
</html>
