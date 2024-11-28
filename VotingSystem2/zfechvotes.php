<?php
// Database connection settings
$servername = "localhost";
$username = "root"; // Change this if needed
$password = ""; // Change this if needed
$dbname = "voting_system"; // Make sure this matches your actual database name

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Fetch candidate names and their vote counts
$sql = "SELECT c.candidate_id, v.firstname AS candidate_name, COUNT(vt.vote_id) AS voteCount
        FROM candidates c
        LEFT JOIN voters v ON c.candidate_id = v.voter_id
        LEFT JOIN votes vt ON c.candidate_id = vt.candidate_id
        GROUP BY c.candidate_id";

$results = $conn->query($sql);

$candidateData = [];
if ($results->num_rows > 0) {
    while ($row = $results->fetch_assoc()) {
        $candidateData[] = [
            'candidate_id' => $row['candidate_id'],
            'candidate_name' => $row['candidate_name'],
            'voteCount' => $row['voteCount']
        ];
    }
}

// Return data as JSON
echo json_encode($candidateData);

$conn->close();
?>
