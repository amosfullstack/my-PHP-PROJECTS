<?php
session_start();

// Check if the session variables are set
if (!isset($_SESSION['firstName'], $_SESSION['lastName'], $_SESSION['party'], $_SESSION['description'], $_SESSION['photoPath'])) {
    echo "No candidate details to display.";
    exit;
}

$firstName = $_SESSION['firstName'];
$lastName = $_SESSION['lastName'];
$party = $_SESSION['party'];
$description = $_SESSION['description'];
$photoPath = $_SESSION['photoPath'];
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Candidate Details</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f7f9fc;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
        }
        .container {
            background-color: white;
            padding: 2em;
            border-radius: 10px;
            box-shadow: 0px 0px 15px rgba(0, 0, 0, 0.1);
            width: 100%;
            max-width: 500px;
            text-align: center;
        }
        h1 {
            color: #333;
            margin-bottom: 1.5em;
        }
        img {
            max-width: 100%;
            height: auto;
            margin-top: 1em;
            border-radius: 5px;
            box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1);
        }
    </style>
</head>
<body>

<div class="container">
    <h1>Candidate Details</h1>
    <p><strong>First Name:</strong> <?php echo htmlspecialchars($firstName); ?></p>
    <p><strong>Last Name:</strong> <?php echo htmlspecialchars($lastName); ?></p>
    <p><strong>Political Party:</strong> <?php echo htmlspecialchars($party); ?></p>
    <p><strong>Why are you better than other candidates?</strong></p>
    <p><?php echo nl2br(htmlspecialchars($description)); ?></p>
    <img src="<?php echo htmlspecialchars($photoPath); ?>" alt="Candidate Photo">
</div>

</body>
</html>
