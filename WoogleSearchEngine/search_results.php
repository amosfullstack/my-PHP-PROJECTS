<?php
/*$conn = new mysqli("$servername", "$username", "$password", "$dbname");

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}*/

require 'dbconn.php';

$query = $_GET['query'];

    $sql = "SELECT * FROM gallery WHERE caption LIKE '%$query%'";
    $result = $conn->query($sql);
    





    if ($result->num_rows > 0) {
        while($row = $result->fetch_assoc()) {
            echo "<div class='image-result'>";
            echo "<a href='view_image.php?id=" . htmlspecialchars($row['imageID']) . "'>";
            echo "<img src='" . $row['imagePath'] . "' alt='" . $row['caption'] . "'>";
            echo "</a>";
            echo "<p>" . $row['caption'] . "</p>";
            echo "</div>";
        }
    } else {
        echo "No results found.";
    }
    

$conn->close();
?>
