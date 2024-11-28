<?php 
session_start();
require '../dbconn.php';

$username = $password1 = $password2 = "";
$usernameErr = $password1Err = $password2Err = $error = "";

function filterData($data) {
    return htmlspecialchars(stripslashes(trim($data)));
}

if ($_SERVER['REQUEST_METHOD'] == "POST") {
    // Validate input
    if (empty($_POST['username'])) {
        $usernameErr = "Username is required";
    } else {
        $username = filterData($_POST['username']);
    }
    
    if (empty($_POST['password1'])) {
        $password1Err = "Enter new password";
    } else {
        $password1 = filterData($_POST['password1']);
    }
    
    if (empty($_POST['password2'])) {
        $password2Err = "Confirm new password";
    } else {
        $password2 = filterData($_POST['password2']);
    }
    
    // Check if passwords match
    if ($password1 === $password2) {
        $password = password_hash($password1, PASSWORD_DEFAULT);
    } else {
        $error = "Passwords do not match";
    }
    
    // Update password in database
    if (empty($usernameErr) && empty($password1Err) && empty($password2Err) && empty($error)) {
        $stmt = $conn->prepare("SELECT * FROM voters WHERE voter_id = ?");
        $stmt->bind_param("s", $username);
        $stmt->execute();
        $results = $stmt->get_result();
        
        if ($results->num_rows == 1) {
            $stmt = $conn->prepare("UPDATE voters SET password = ? WHERE voter_id = ?");
            $stmt->bind_param("ss", $password, $username);
            if ($stmt->execute()) {
                $_SESSION['username'] = $username;
                header('Location: dashboard.php');
                exit();
            } else {
                $error = "Failed to update password. Please try again.";
            }
        } else {
            $error = "User not found.";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel=" stylesheet" href="voting.css">
</head>
<body>
        
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

<form action="" method="POST">
<div>

<input type="text" name="username" placeholder="username">
<span class="error"><?php echo $usernameErr;?></span>

<input type="text" name="password1" placeholder="enter New password">
<span class="error"><?php echo $password1Err;?></span>

<input type="text" name="password2" placeholder="Confirm your New password">
<span class="error"><?php echo $password2Err;?></span>
<input type="submit" value="Change">
<span class="error"><?php echo $error;?></span>
</div>


</form> 

</div>
</body>
</html>
