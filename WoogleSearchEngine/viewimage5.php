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
        ?>
        <!DOCTYPE html>
        <html>
        <head>
            <title><?php echo htmlspecialchars($row['caption']); ?></title>
            <link rel="stylesheet" href="stylesviewimage5.css">
        </head>
        <body style="background-color:aqua;">
            <div class="image-container">
                <img src="<?php echo htmlspecialchars($row['imagePath']); ?>" alt="<?php echo htmlspecialchars($row['caption']); ?>" class="full-size-image">
            </div>
            <div class="image-details">
                <p>Caption:<?php echo htmlspecialchars($row['caption']); ?></p>
                <p>Uploaded by: <?php echo "thewinner"; ?></p>
                <p>Upload Date: <?php echo htmlspecialchars($row['timeUploaded']); ?></p>
            </div>
        </body>
        </html>
        <?php
    } else {
        echo "Image not found.";
    }
} else {
    echo "Error: Image ID is not specified.";
    exit;
}

$conn->close();
?>
