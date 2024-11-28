<?php
session_start();

if (!isset($_SESSION['admin'])) {
    header("Location: admin.php");
    exit();
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $caption = $_POST['caption'];
    $target_dir = "uploads/";
    $target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
    
    if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
        
       /* $conn = new mysqli("localhost", "username", "password", "woogle_db");
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }*/
        
       /* $sql = "INSERT INTO gallery (caption,imagePath,uploadedBy, timeUploaded)
                VALUES ('$target_file', '$caption', NOW(), '" . $_SESSION['admin'] . "')";*/
/*
 $sql="INSERT INTO gallery (  imagePath,caption,uploadedBy, timeUploaded) 
VALUES ('$target_file', '$caption', '". $_SESSION['admin'] . "', NOW()  )"; */
require 'dbconn.php';

$sql = "INSERT INTO gallery (imagePath, caption, uploadedBy, timeUploaded) 
VALUES ('$target_file', '$caption', '" . $_SESSION['admin'] . "', NOW())";


        
        if ($conn->query($sql) === TRUE) {
            echo "The file ". basename( $_FILES["fileToUpload"]["name"]). " has been uploaded.";
        } else {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }
        
        $conn->close();
    } else {
        echo "Sorry, there was an error uploading your file.";
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Upload New Image</title>
    <link rel="stylesheet" href="stylesupload2.css">

    <style>
        
#buttons {
  display: flex;
  justify-content: center;
  align-items: center;
  height: 50vh; /* Full viewport height to center vertically */
}

#buttons input[type="button"] {
  margin: 0 10px; /* Spacing between buttons */
  padding: 10px 20px;
  font-size: 16px;
  cursor: pointer;
}
    </style>
</head>
<body>
    <div class="upload-container">
        <h1 style="color:#FF69B4; font-family:San Francisco;" >Upload New Image</h1>
        <form action="upload.php" method="post" enctype="multipart/form-data">
            <input type="file" name="fileToUpload" id="fileToUpload">
            <input type="text" name="caption" placeholder="Enter image caption" required>
            <button type="submit">Upload</button>
        </form>
    </div>
    <div id="buttons">
        <input type="button" id="backtologin" name="backtologin" value="Back to Login">
        <input type="button" id="gotosearch"  name="gotosearch" value="Image Search">
    </div>
</body>
<script>

    document.getElementById("backtologin").onclick = function() {
    window.location.href = "admin.php";
};

document.getElementById("gotosearch").onclick = function() {
    window.location.href = "index.php";
};

</script>
</html>
