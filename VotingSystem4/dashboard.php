<?php
 session_start();

require 'homepage.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Candidate Dashboard</title>
  <style>
    

    .dashboard {
      display: flex;
      flex-wrap: wrap; /* Allows wrapping to next line if window is resized */
      justify-content: center; /* Centers the candidate cards */
      gap: 20px; /* Adds space between the cards */
      padding: 20px;
    }

    .candidate-card {
      background-color: white;
      border-radius: 10px;
      box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
      width: 300px;
      text-align: center;
      padding: 20px;
      transition: transform 0.2s ease-in-out;
      position: relative;
    }

    .candidate-card:hover {
      transform: translateY(-10px);
    }

    .candidate-img {
      width: 150px;
      height: 150px;
      object-fit: cover;
      border-radius: 50%; /* Optional: Makes the image circular */
      margin-bottom: 15px;
    }

    .candidate-name {
      font-size: 1.5em;
      font-weight: bold;
      margin: 10px 0;
    }

    .party-name {
      font-size: 1.2em;
      color: #555;
      margin-bottom: 10px;
    }

    .motto {
      font-style: italic;
      font-size: 1em;
      margin-bottom: 10px;
      color: #007bff;
    }

    .reason {
      font-size: 0.9em;
      margin-bottom: 20px;
    }

    .vote {
      text-align: center;
      color: green;
      margin-top: 20px;
      display: block;
      text-decoration: none;
      background-color: #f0f0f0;
      padding: 10px 20px;
      border: none;
      border-radius: 5px;
      font-size: 1em;
      cursor: pointer;
      transition: background-color 0.3s;
    }

    .vote:hover {
      background-color: #d0f0d0;
    }

    .footer {
      text-align: center;
      margin: 20px;
      font-size: 1.1em;
    }
  </style>
</head>
<body>
  <h1 style="text-align: center;">Dashboard</h1>

  <div class="dashboard">
    
    <?php
  
   require 'dbconn.php';


// Check if user is logged in
if (!isset($_SESSION['username'])) {
    // Redirect to voter_login.php if the user is not logged in
    header('Location: voter_login.php');
    exit();
}

// Retrieving data for candidates
$sql = "SELECT candidates.candidate_id, candidates.photoPath, candidates.position, candidates.party, voters.firstname, voters.lastname
        FROM candidates 
        INNER JOIN voters ON candidates.candidate_id = voters.voter_id";

$results = $conn->query($sql);

if ($conn->connect_error) {
    echo "<p>Data failed to retrieve: " . $conn->connect_error . "</p>";
    exit();
} else {
    if ($results->num_rows > 0) {
        while ($row = $results->fetch_assoc()) {
            echo '<div class="candidate-card">';
            echo '<img src="' . htmlspecialchars($row['photoPath']) . '" alt="Candidate picture" class="candidate-img">';
            echo '<p class="candidate-name">' . htmlspecialchars($row['firstname']) . ' ' . htmlspecialchars($row['lastname']) . '</p>';
            echo '<p class="position">' . htmlspecialchars($row['position']) . '</p>';
            echo '<p class="party-name">' . htmlspecialchars($row['party']) . '</p>';
            // Note: 'textarea' is not included in the SQL query, so removing it here
            echo '</div>';
        }
    } else {
        echo "<p>No candidates found!</p>";
    }
}

// Close the database connection
$conn->close();
?>
   </div>


  <div>
    <a href="candidate.php"> candidate register</a>
  </div>
         
  <div class="footer">
    <p>Voting day will be on Monday at 10:00am to 4:30pm</p>
    <p>YOUR VOTE IS OUR SUCCESS</p>
    <a href="vote.php" class="vote">VOTE NOW</a>
  </div>
</body>
</html>
