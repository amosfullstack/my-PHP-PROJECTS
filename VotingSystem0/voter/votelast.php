<?php
session_start();

require '../layout.php';
require '../dbconn.php';

// Start PHP block for fetching results from the database
/*$servername = "localhost";
$username = "root";
$password = "";
$dbname = "voting_system";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}*/



// Fetch candidates and their vote counts from the database
$sql = "SELECT candidates.candidate_id, candidates.position, candidates.photoPath, candidates.textarea, candidates.party,
               COUNT(votes.vote_id) AS vote_count
        FROM candidates 
        LEFT JOIN votes ON candidates.candidate_id = votes.candidate_id
        GROUP BY candidates.candidate_id";
$result = $conn->query($sql);

// Initialize an array to store candidate data
$candidates = [];
$totalVotes = 0;

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $candidates[$row['candidate_id']] = $row;
        $totalVotes += $row['vote_count'];
    }
}

// Fetch voter names for each candidate
$voterNames = [];
$stmt = $conn->prepare("SELECT voter_id, GROUP_CONCAT(CONCAT_WS(' ', firstname, middlename, lastname) SEPARATOR ', ') AS voter_names 
                         FROM voters 
                         GROUP BY voter_id");
if ($stmt === false) {
    die("Failed to prepare statement: " . $conn->error);
}
$stmt->execute();
$results = $stmt->get_result();

if ($results->num_rows > 0) {
    while ($row = $results->fetch_assoc()) {
        $voterNames[$row['voter_id']] = $row['voter_names'];
    }
}
$stmt->close(); // Close the prepared statement

// Close connection
$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Voting Results</title>
    <link rel="stylesheet" href="../voter/voting.css">
    <style>
       
        .contain {
      display: flex;
      flex-wrap: wrap; /* Allows wrapping to next line if window is resized */
      justify-content: center; /* Centers the candidate cards */
      gap: 20px; /* Adds space between the cards */
      padding: 20px;
        }
        .candidate {
           
            background-color: #fff;
            border: 1px solid #ddd;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            width: 100%;
            max-width: 420px;
            max-height: 350px;
            padding: 20px;         
            transition: transform 0.3s;
            
        }
        .candidate:hover {
            transform: scale(1.02);
        }
        .candidate img {
           float: left;
            width: 150px; /* Set fixed width for images */
            height: 150px; /* Set fixed height for images */
            border-radius: 10px;
            padding-right: 10px;
        }
        .candidate h2 {
            color: #333;
            margin: 2px;
        }
        .candidate p {
            color: #666;
            font-size: 15px;
           
        }
        .votes {
            font-weight: bold;
            color: #333;
        }
        .percentage-bar {
            width: 100%;
            background-color: skyblue; /* Sky blue color for the bar */
            border-radius: 5px;
        }
        .percentage {
            font-weight: bold;
            color: #fff;
        }
    </style>
</head>
<body>
<article>Voting Results</article>
    <div class="contain">
       
        <?php foreach ($candidates as $candidateId => $candidate): ?>
            <div class="candidate" id="candidate-<?php echo htmlspecialchars($candidateId); ?>">
                <img src="../<?php echo htmlspecialchars($candidate['photoPath']); ?>" alt="">
                <h2> <?php echo htmlspecialchars($voterNames[$candidateId] ?? 'No voters'); ?></h2>
               
                <p>Party: <?php echo htmlspecialchars($candidate['party']); ?></p>
                <p><?php echo htmlspecialchars($candidate['textarea']); ?></p>
                <p>Votes: <span class="votes"><?php echo $candidate['vote_count']; ?></span></p>
               
                <div class="percentage-bar">
                    <span class="percentage">
                        <?php
                            echo ($totalVotes > 0) ? number_format(($candidate['vote_count'] / $totalVotes) * 100, 2) . '%' : '0%';
                        ?>
                    </span>
                </div>
            </div>
        <?php endforeach; ?>
    </div>
</body>
</html>
