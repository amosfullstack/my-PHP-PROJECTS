<?php 
session_start();
require '../dbconn.php';


$username = $password = "";
$usernameErr = $passwordErr = "";
$successMsg = $errorMsg = "";

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
    
    // Validate password
    if (empty($_POST['password'])) {
        $passwordErr = "Password is required";
    } else {
        $password = filterData($_POST['password']);
        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
    }

    // If no errors, proceed with database operations
    if (empty($usernameErr) && empty($passwordErr)) {
        // Check if the username already exists
        $stmt = $conn->prepare("SELECT * FROM admins WHERE username = ?");
        $stmt->bind_param("s", $username);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
            $errorMsg = "Username already exists";
        } else {
            // Insert new user
            $stmt = $conn->prepare("INSERT INTO admins (username, adminpass) VALUES (?, ?)");
            $stmt->bind_param("ss", $username, $hashedPassword);

            if ($stmt->execute()) {
                $_SESSION['username']= $username;
                header('location:voter_register.php');
                
            } else {
                $errorMsg = "Error: failed to submit data";
            }
        }
    }
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Sign Up</title>
    <link rel="stylesheet" href="../voter/voting.css">
    <style>
        /* Centering the container using flexbox */
       

        /* Styling the form container */
        .form-container {
           margin-top: 35px;
            background-color: aliceblue;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1);
            width: 400px; /* Set width for the form */
        }

        /* Styling the input elements */
        input[type="text"],
        input[type="password"] {
            width: 100%;
            border: none;
            padding: 10px;
            margin: 10px 0;
            border-radius: 8px;
            box-sizing: border-box;
        }

        /* Styling the submit button */
        input[type="submit"] {
            width: 25%;
            padding: 10px;
            background-color: blue;
            color: white;
            border: none;
            border-radius: 8px;
            cursor: pointer;
            transition: background-color 0.3s ease, transform 0.3s ease;
        }

        /* Hover effect for the submit button */
        input[type="submit"]:hover {
            background-color: black; /* Change background color on hover */
            transform: scale(1.05);    /* Slightly increase the button size */
        }

        .error {
            color: red;
            font-size: 0.9em;
            display: block;
            margin-top: -10px;
            margin-bottom: 10px;
        }

        .link {
            display: block;
            margin-top: 20px; /* Adjust this value to move the link down */
            text-align: center;
            color: blue;
        }
    </style>
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

    <div class="form-container">
        <form action="" method="POST">
            
            <input type="text" id="username" name="username" placeholder="Username">
            <span class="error"><?php echo $usernameErr; ?></span>

            <input type="password" id="password" name="password" placeholder="Password">
            <span class="error"><?php echo $passwordErr; ?></span>

            <input type="submit" value="Sign Up"><br>

            
            
           
            <span class="error"><?php echo $errorMsg; ?></span>
        </form>
    </div>
</body>
</html>
