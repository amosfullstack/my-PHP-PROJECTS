
<?php
session_start();
include('../layout.php');
include('homepage.php');
include('../dbconn.php');
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $timer = mysqli_real_escape_string($conn, $_POST['election_day']);
    $sql = "UPDATE announcements SET election_day = '$timer'WHERE id = 1";
    if(mysqli_query($conn,$sql)){
        echo "<script>alert(' election day updated successfully!');</script>";

    }else{
        echo "Error: ".$sql. "<br>".mysqli_error($conn);
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="../voter/voting.css">
</head>
<body>
    <form action="" method="POST">
    <p>Do you want to set an election day?</p>
    <input type="date" name="election_day" placeholder="Enter a date for election">
    <button type="submit" value="submit">Set</button>


    </form>
</body>
</html>