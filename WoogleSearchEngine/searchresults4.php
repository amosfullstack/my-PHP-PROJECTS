<!DOCTYPE html>
<html>
<head>
<title>Image Search Results</title>
<link rel="stylesheet" href="stylessearch.css">
</head>
<style>

</style>
<body style="background-color:aqua;">
<section class="image-search-results">
    <div class="image-container">
        <?php
        require 'dbconn.php';

        $query = $_GET['query'];

        // Escape the query to prevent SQL injection
        $query = $conn->real_escape_string($query);

        $sql = "SELECT * FROM gallery WHERE caption LIKE '%$query%'";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                echo '<article class="image-result">';
                echo '<a href="viewimage5.php?imageID=' . htmlspecialchars($row['imageID']) . '">';
                echo '<img src="' . htmlspecialchars($row['imagePath']) . '" alt="' . htmlspecialchars($row['caption']) . '">';
                echo '</a>';
                echo '<p class="caption">' . htmlspecialchars($row['caption']) . '</p>';
                echo '</article>';
            }
        } else {
            echo "No results found.";
        }

        $conn->close();
        ?>
    </div>
</section>
</body>
    </html>
