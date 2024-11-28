<?php
/*$conn = new mysqli("localhost", "username", "password", "woogle_db");

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}*/
require 'dbconn.php';

if (isset($_GET['imageID'])) {
    $id = $_GET['imageID'];
    // Continue with your query
    
$id = $_GET['imageID'];
$sql = "SELECT * FROM gallery WHERE imageID=$id";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    echo "<h1>" . $row['caption'] . "</h1>";
    echo "<img src='" . htmlspecialchars($row['imagePath']) . "' alt='" . $row['caption'] . "'>";
    echo "<p>Uploaded by: " . $row['uploadedBy'] . "</p>";
    echo "<p>Upload Date: " . $row['timeUploaded'] . "</p>";
} else {
    echo "Image not found.";
}

} else {
    echo "Error: Image ID is not specified.";
    exit;
}



$conn->close();
?>
