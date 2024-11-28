<?php 
session_start();

require '../dbconn.php';
require '../layout.php';

$username = $password1 = $password2 = "";
$usernameErr = $password1Err = $password2Err = $error = "";

// Function to sanitize input
function filterData($data) {
    return htmlspecialchars(stripslashes(trim($data)));
}

if ($_SERVER['REQUEST_METHOD'] == "POST") {
    // Validate username
    if (empty($_POST['username'])) {
        $usernameErr = "Username is required";
    } else {
        $username = filterData($_POST['username']);
    }
    
    // Validate password1
    if (empty($_POST['password1'])) {
        $password1Err = "Enter new password";
    } else {
        $password1 = filterData($_POST['password1']);
    }
    
    // Validate password2
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

    // Update password in the database if no errors
    if (empty($usernameErr) && empty($password1Err) && empty($password2Err) && empty($error)) {
        $stmt = $conn->prepare("SELECT * FROM admins WHERE username = ?");
        if ($stmt) {
            $stmt->bind_param("s", $username);
            $stmt->execute();
            $results = $stmt->get_result();

            if ($results->num_rows == 1) {
                $stmt = $conn->prepare("UPDATE admins SET adminpass = ? WHERE username = ?");
                if ($stmt) {
                    $stmt->bind_param("ss", $password, $username);
                    if ($stmt->execute()) {
                        $_SESSION['username'] = $username;
                        header('Location: voter_register.php');
                        exit();
                    } else {
                        $error = "Failed to update password. Please try again.";
                    }
                } else {
                    $error = "Failed to prepare update statement.";
                }
            } else {
                $error = "Username not found.";
            }
        } else {
            $error = "Failed to prepare select statement.";
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
    <link rel=" stylesheet" href="../voter/voting.css">
</head>
<body>

<div class="Navbar">
    
    <div class="items">

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
