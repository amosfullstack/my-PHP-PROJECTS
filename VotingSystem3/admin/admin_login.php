<?php 
session_start();
require '../dbconn.php';
require '../layout.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
   

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

   
     else {
    
        echo '<div class="pagemsg">Invalid  username...</div>' ;
    }

    // Close the statement
    $sql->close();
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Voter Login</title>
    <link rel="stylesheet" href="../voter/voting.css">
    
</head>
<body>
   <style>
   
        .pagemsg{
                display: block;
                width: 200px;
                height: 50px;
                border: 2 px solid;
                background-color: green;
                z-index: 9;
            }
            
    
    
   </style>
  
    <div class="container">
        <h1> Login</h1>
        <form action="admin_login.php" method="post">
            <div class="form-group">
                <input type="text" name="username" placeholder="Username" required>
            </div>
            <div class="form-group">
                <input type="password" name="password" placeholder="Password" required>
            </div>
            <button type="submit">Login</button>
            <p>change password</p>
            <a href="adminchangepass.php">change password</a>
           <div class="sign-up">
           <a href="login.php">Sign Up</a>
           </div>
        </form>
    </div>
</body>
</html>
