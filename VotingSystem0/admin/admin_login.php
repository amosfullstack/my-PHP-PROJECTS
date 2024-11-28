<?php 
session_start();


require '../dbconn.php';

$error="";
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
   
    //this is the admin login page

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
            $_SESSION['system_admin']=$row['username'];
            header('location:viewvoters.php');
        }
    }

   
     else {
         $error = "invalid username or password";
        
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
    <title>Admin Login</title>
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

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Page1</title>
    
</head>

<div class="Navbar">
    
    <div class="items">
     <img src="../images/sanduku.PNG" alt="">
    </div>
    
    <div class="heading"> 
         <h1>STREET GOVERNMENT VOTING SYSTEM</h1>
     <h4>
     A man without a vote is a man without protection.</h4>
</div> 
</div>

  
    <div class="container">
        <h2> Login</h2>
        <form action="admin_login.php" method="post">
            <div class="form-group">
                <input type="text" name="username" placeholder="Username" required>
            </div>
            <div class="form-group">
                <input type="password" name="password" placeholder="Password" required>
            </div>
            <?php  if($error){ echo $error;} ?><br>
            <button type="submit">Login</button>
            <p>forgot
            <a href="adminchangepass.php">password?</a></p>
           <div class="sign-up">
           <a href="admin_signup.php">Sign Up</a>
           </div>
        </form>
    </div>
</body>
</html>
