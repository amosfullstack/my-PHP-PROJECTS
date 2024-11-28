<?php
session_start();

require '../dbconn.php';

// Define a variable to track if the popup should be shown
$showPopup = false;

if($_SERVER['REQUEST_METHOD'] == 'POST') {
    $firstname = htmlspecialchars($_POST['firstname']);
    $middlename = htmlspecialchars($_POST['middlename']);
    $lastname = htmlspecialchars($_POST['lastname']);
    $address = htmlspecialchars($_POST['address']);
    $date = htmlspecialchars($_POST['date']);
    $password = password_hash(htmlspecialchars($_POST['password']), PASSWORD_DEFAULT);

    if($conn->connect_error) {
        echo "Failed to upload voters data: " . $conn->connect_error;
    } else {
        $birthdate = new DateTime($date);
        $today = new DateTime();
        $age = $today->diff($birthdate)->y;
        
        if ($birthdate < $today && $age >= 18) {
            $stmt = $conn->prepare("INSERT INTO voters (firstname, middlename, lastname, BOD, age, address, password) VALUES (?, ?, ?, ?, ?, ?, ?)");
            $stmt->bind_param("ssssiss", $firstname, $middlename, $lastname, $date, $age, $address, $password);
            
            if ($stmt->execute()) {
                $voter_id = $conn->insert_id;
                $code = "VT-" . str_pad($voter_id, 4, '0', STR_PAD_LEFT);

                $updateStmt = $conn->prepare("UPDATE voters SET voter_id = ? WHERE id = ?");
                if ($updateStmt) {
                    $updateStmt->bind_param("si", $code, $voter_id);
                    if ($updateStmt->execute()) {
                        $_SESSION['username'] = $code;
                        $showPopup = true;
                    } else {
                        echo "Update error: " . $updateStmt->error;
                    }
                    $updateStmt->close();
                } else {
                    echo "Prepare update failed: " . $conn->error;
                }
            } else {
                echo "Error: " . $stmt->error;
            }
            
            $stmt->close();
            $conn->close();
        } else {
            echo "Only adults allowed to vote; you are under 18.";
        }
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin - Upload Voters</title>
    <link rel="stylesheet" href="../voter/voting.css">
    <style>
        #popup {
            position: fixed;
            top: 50%;
            left: 50%;
            width: 300px;
            height: 100px;
            box-shadow: 0px 0px 15px rgba(0, 0, 0, 0.1);
            transform: translate(-50%, -50%);
            background-color: rgb(160, 209, 252);
            padding: 20px;
            border: 1px solid rgb(36, 247, 141);
            z-index: 1;
            display: none;
            text-align: center;
            padding: 20px;
            border-radius: 10px;
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
        <h4>A man without a vote is a man without protection.</h4>
    </div>
</div>

<!-- Show popup if the flag is set to true -->
<div id="popup" <?php if ($showPopup) echo 'style="display:block;"'; ?>>
    <p>Remember your username</p>
    <p>Username: <?php echo $_SESSION['username'];
    echo "<br>"; 
          echo " '<p> <a href='?ok=" .$showPopup. " ' >Ok </a> </p>";
          if(isset($_GET['ok'])){
            header('location:dashboard.php');
            exit();
          }
    ?></p>
</div>

<div class="container">
    <article>Admin - Upload Voters</article>
    <form action="voter_register.php" method="post">
        <div class="form-group">
            <input type="text" name="firstname" placeholder="First Name" required>
        </div>
        <div class="form-group">
            <input type="text" name="middlename" placeholder="Middle Name" required>
        </div>
        <div class="form-group">
            <input type="text" name="lastname" placeholder="Last Name" required>
        </div>
        <div class="form-group">
            <input type="text" name="address" placeholder="Address" required>
        </div>
        <div class="form-group">
            <input type="date" name="date" placeholder="Birthday" required>
        </div>
        <div class="form-group">
            <input type="password" name="password" placeholder="Password" required>
        </div>
        <button type="submit">Upload Voter</button>
    </form>
</div>

<script>
    // JavaScript is not needed to show the popup if using PHP to handle it
</script>
</body>
</html>
