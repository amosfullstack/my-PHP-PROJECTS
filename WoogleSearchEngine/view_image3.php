<?php
require 'dbconn.php';

if (isset($_GET['imageID'])) {
    $id = $_GET['imageID'];

    // Validate and sanitize the ID
    if (!filter_var($id, FILTER_VALIDATE_INT)) {
        echo "Invalid image ID.";
        exit;
    }

    $id = $conn->real_escape_string($id);

    $sql = "SELECT * FROM gallery WHERE imageID = $id";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        echo "<h1>" . htmlspecialchars($row['caption']) . "</h1>";
        echo "<img src='" . htmlspecialchars($row['imagePath']) . "' alt='" . htmlspecialchars($row['caption']) . "'>";
        echo "<p>Uploaded by: " . htmlspecialchars($row['uploadedBy']) . "</p>";
        echo "<p>Upload Date: " . htmlspecialchars($row['timeUploaded']) . "</p>";
    } else {
        echo "Image not found.";
    }

} else {
    echo "Error: Image ID is not specified.";
    exit;
}

$conn->close();
?>
