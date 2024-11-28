<?php
session_start();
if (!isset($_SESSION['username'])) {
    // Redirect to cadidate.php if the user is logged in
    header('location:admin_login.php');
  
  }
require '../dbconn.php';
require '../layout.php';
require 'homepage.php';

if($_SERVER['REQUEST_METHOD'] == 'POST') {
    $firstname = htmlspecialchars($_POST['firstname']);
    $middlename = htmlspecialchars($_POST['middlename']);
    $lastname = htmlspecialchars($_POST['lastname']);
    $address = htmlspecialchars($_POST['address']);
    $date = htmlspecialchars($_POST['date']);
    $password = password_hash( htmlspecialchars($_POST['password']), PASSWORD_DEFAULT);

  

    if($conn->connect_error) {
        echo "Failed to upload voters data: " . $conn->connect_error;
    } else {
        //calculate age of voter

        $birthdate= new DateTime($date);
        $today= new DateTime();
        $age= $today->diff($birthdate)->y;
        
        // Prepare and bind
       if($birthdate < $today && $age>=18)
       {
        $stmt = $conn->prepare("INSERT INTO voters ( firstname,middlename, lastname, BOD,age,address, password) VALUES (?,?,?, ?, ?,?, ?)");

        $stmt->bind_param("ssssiss",  $firstname, $middlename,$lastname,$date,$age, $address, $password);
         
        // Execute the statement
        if ($stmt->execute()) {

            //retrieve the last auto_increment id of inserted data
          $voter_id=$conn->insert_id;

          //Generate auto increment  pattern based on id
          $code = "VT-" . str_pad($voter_id, 4, '0', STR_PAD_LEFT);
 
          //prepare and update  the 
          $updateStmt = $conn->prepare("UPDATE voters SET voter_id = ? WHERE id = ?");
          if ($updateStmt) {
              $updateStmt->bind_param("si", $code, $voter_id);
              if ($updateStmt->execute()) {
                  echo "New record created successfully with code: " . $code;
              } else {
                  echo "Update error: " . $updateStmt->error;
              }
              $updateStmt->close();
          } else {
              echo "Prepare update failed: " . $conn->error;
          }
          //Retrieve and display new data
          $data = $conn->query("SELECT * FROM voters WHERE voter_id = '$voter_id'");
          if ($data) {
              $row = $data->fetch_assoc();
              print_r($row);
          } else {
              echo "Query error: " . $conn->error;
          }
      } else {
          echo "Error: " . $stmt->error;
      }
      
      // Close the statement and connection
      $stmt->close();
      
    
    $conn->close();
       }
        else
       {
        echo "only adults allowed to vote, you are under 18";
       // header('location:admin_upload_voters.php');
       // exit;
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
    
</head>
<body>

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
            <input type="date" name="date" placeholder="birthday" required>
        </div>
        <div class="form-group">
            <input type="password" name="password" placeholder="Password" required>
        </div>
        <button type="submit">Upload Voter</button>
    </form>
</div>

</body>
</html>

