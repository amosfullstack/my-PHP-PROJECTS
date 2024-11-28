<?php 
session_start();
// Check if user is logged in
if (!isset($_SESSION['system_admin'])) {
    // Redirect to voter_login.php if the user is not logged in
    header('Location: admin_login.php');
    exit();
  }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Announcements</title>
    <link rel="stylesheet" href="../voter/voting.css">
    <style>
        /* Form Styles */
        .announcementform {
            width: 400px;
            max-width: 800px;
            margin: auto;
            background: #fff;
            padding: 5px;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0,0,0,0.1);
        }

        .announcementform input[type="text"],
        .announcementform textarea {
            width: calc(100% - 20px);
            padding: 3px;
            border: 1px solid #ddd;
            border-radius: 5px;
            margin-bottom: 15px;
            box-sizing: border-box;
        }

        .announcementform textarea {
            height: 50px;
            resize: vertical;
        }

        .announcementform button {
            background-color: #007bff;
            color: white;
            border: none;
            padding: 12px 24px;
            cursor: pointer;
            border-radius: 5px;
            font-size: 16px;
            transition: background-color 0.3s, transform 0.3s;
        }

        .announcementform button:hover {
            background-color: #0056b3;
            transform: scale(1.05);
        }

    </style>
</head>
<body>


<?php
include('../layout.php');
include('homepage.php');
include('../dbconn.php');
// Check if user is logged in
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $announcement = mysqli_real_escape_string($conn, $_POST['announcement']);
    $title = mysqli_real_escape_string($conn, $_POST['title']);
    $admin =$_SESSION['system_admin'];
   
    $query = "INSERT INTO announcements (content,title) VALUES ('$announcement', '$title' )";
    if (mysqli_query($conn, $query)) {
        echo "<script>alert('Announcement posted!');</script>";
    } else {
        echo "Error: " . $query . "<br>" . mysqli_error($conn);
    }
}
?>
    <div class="wave-container">
        <div class="wave"></div>
    </div>
    <center>
        <form name="announcementform" class="announcementform" action="" method="POST">
            <h5 class="drop-effect">
               Set Announcement:
            </h5>
            <input type="text" name="title" placeholder="Set title"required ><br><br>
            <textarea id="announcement" name="announcement" placeholder="Enter Announcements here" required></textarea><br><br>
          
            <button type="submit" name="announce">Post</button>
        </form>
    </center>
</body>

</html>
