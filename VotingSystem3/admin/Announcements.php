<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Announcements</title>
    <link rel="stylesheet" href="../voter/voting.css">
    <style>
        /* Base Styles */
       

        /* Wave Animation Styles */
       

        @keyframes wave-animation {
            0% {
                transform: translateX(0);
            }
            100% {
                transform: translateX(-50%);
            }
        }

        

        /* Header Animation */
        h3.drop-effect {
            font-size: 2.5rem;
            font-weight: bold;
            color: #333;
            text-align: center;
            margin-top: 20px;
            margin-bottom: 30px;
        }

        h3.drop-effect span {
            display: inline-block;
            opacity: 0;
            transform: translateY(-20px);
            animation: drop 0.8s forwards;
        }

        @keyframes drop {
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        h3.drop-effect span:nth-child(1) { animation-delay: 0s; }
        h3.drop-effect span:nth-child(2) { animation-delay: 0.1s; }
        h3.drop-effect span:nth-child(3) { animation-delay: 0.2s; }
        h3.drop-effect span:nth-child(4) { animation-delay: 0.3s; }
        h3.drop-effect span:nth-child(5) { animation-delay: 0.4s; }
        h3.drop-effect span:nth-child(6) { animation-delay: 0.5s; }
        h3.drop-effect span:nth-child(7) { animation-delay: 0.6s; }
        h3.drop-effect span:nth-child(8) { animation-delay: 0.7s; }
        h3.drop-effect span:nth-child(9) { animation-delay: 0.8s; }
        h3.drop-effect span:nth-child(10) { animation-delay: 0.9s; }
        h3.drop-effect span:nth-child(11) { animation-delay: 1s; }
        h3.drop-effect span:nth-child(12) { animation-delay: 1.1s; }
        h3.drop-effect span:nth-child(13) { animation-delay: 1.2s; }

        /* Form Styles */
        .announcementform {
            width: 80%;
            max-width: 600px;
            margin: auto;
            background: #fff;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0,0,0,0.1);
        }

        .announcementform input[type="text"],
        .announcementform textarea {
            width: calc(100% - 20px);
            padding: 10px;
            border: 1px solid #ddd;
            border-radius: 5px;
            margin-bottom: 15px;
            box-sizing: border-box;
        }

        .announcementform textarea {
            height: 150px;
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
session_start();
include('../layout.php');
include('homepage.php');
include('../dbconn.php');
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $announcement = mysqli_real_escape_string($conn, $_POST['announcement']);
    $title = mysqli_real_escape_string($conn, $_POST['title']);
   
    $query = "INSERT INTO announcements (content, title) VALUES ('$announcement', '$title')";
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
            <h3 class="drop-effect">
                <span>A</span>
                <span>n</span>
                <span>n</span>
                <span>o</span>
                <span>u</span>
                <span>n</span>
                <span>c</span>
                <span>e</span>
                <span>m</span>
                <span>e</span>
                <span>n</span>
                <span>t</span>
                <span>s</span>
            </h3>
            <input type="text" name="title" placeholder="Set title"required ><br><br>
            <textarea id="announcement" name="announcement" placeholder="Enter Announcements here" required></textarea><br><br>
          
            <button type="submit" name="announce">Post</button>
        </form>
    </center>
</body>

</html>
