<?php 
session_start();
require '../dbconn.php';
$handleErr="";
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
            $handleErr = "invalid username or password";
        }
    } else {
    
        echo '<div class="pagemsg">Invalid  username...</div>' ;
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
   
        .pagemsg{
                display: block;
                width: 200px;
                height: 50px;
                border: 2 px solid;
                background-color: green;
                z-index: 9;
            }
            
    
    
   </style>
  
         
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
        <form action="voter_login.php" method="post">
            <div class="form-group">
                <input type="text" name="username" placeholder="Username" required>
            </div>
            <div class="form-group">
                <input type="password" name="password" placeholder="Password" required>
                <?php if($handleErr)
                     {
                        echo $handleErr;
                     }
                ?>
            </div>
            <button type="submit">Login</button><br>
            <p>Forgot 
            <a href="changepass.php"> Password?</a></p>
            <div class="sign-up">
           <a href="voter_register.php">Sign Up</a>
           </div>
        </form>
    </div>
</body>
</html>
