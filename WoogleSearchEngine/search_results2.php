<?php
require 'dbconn.php';

$query = $_GET['query'];

$sql = "SELECT * FROM gallery WHERE caption LIKE '%$query%'";
$result = $conn->query($sql);

if ($result === FALSE) {
    die("Error in SQL query: " . $conn->error);
}

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        // Debug output to check the imageID
        echo "<div class='image-result'>";
        echo "<a href='view_image.php?id=" . htmlspecialchars($row['imageID']) . "'>";
        echo "<img src='" . htmlspecialchars($row['imagePath']) . "' alt='" . htmlspecialchars($row['caption']) . "'>";
        echo "</a>";
        echo "<p>" . htmlspecialchars($row['caption']) . "</p>";
        echo "</div>";
    }
} else {
    echo "No results found.";
}

$conn->close();
?>
