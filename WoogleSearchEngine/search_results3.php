<!DOCTYPE html>
<html>
<?php
require 'dbconn.php';

$query = $_GET['query'];

// Escape the query to prevent SQL injection
$query = $conn->real_escape_string($query);

$sql = "SELECT * FROM gallery WHERE caption LIKE '%$query%'";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        echo "<div class='image-result'>";
        echo "<a href='view_image.php?imageID=" . htmlspecialchars($row['imageID']) . "'>";
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
</html>
