<?php
session_start();
if (!isset($_SESSION['system_admin'])) {
    header('location:admin_login.php');
    exit();
}
include('../layout.php');
include('homepage.php');
include('../dbconn.php');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['election_day']) && isset($_POST['election_end'])) {
        $timer = mysqli_real_escape_string($conn, $_POST['election_day']);
        $end = mysqli_real_escape_string($conn, $_POST['election_end']);

        // Ensure to update the correct record
        $sql = "UPDATE announcements SET election_day = '$timer', election_end = '$end' "; // Add appropriate condition
        if (mysqli_query($conn, $sql)) {
            echo "<script>alert('Election day updated successfully!');</script>";
        } else {
            echo "Error: " . $sql . "<br>" . mysqli_error($conn);
        }
    } else {
        echo "<script>alert('Please fill in both fields.');</script>";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update Election Dates</title>
    <link rel="stylesheet" href="../voter/voting.css">
</head>
<body>
    <div class="container">
        <form action="" method="POST">
            <article>Election duration.</article>
            <label for="election_day">The start of election.</label>
            <input type="date" name="election_day" placeholder="The Start of election">

            <label for="election_end">The end of election.</label>
            <input type="date" name="election_end" placeholder="The End of election">
            <button type="submit" value="submit">Set</button>
        </form>
    </div>
</body>
</html>
