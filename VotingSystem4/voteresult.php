<?php
// Start PHP block for fetching results from the database
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "voting_system2";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Query to get vote counts for candidates
$sql = "SELECT candidate_id, COUNT(vote_id) AS vote_count FROM votes GROUP BY candidate_id"; // Updated table name to 'votes'
$result = $conn->query($sql);

$data = [
    'amosVotes' => 0,
    'dignaVotes' => 0,
    'totalVotes' => 0
];

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        if ($row['candidate_id'] == "VT-0001") { // Assuming "VT-0001" is the ID for Amos John
            $data['amosVotes'] = $row['vote_count'];
        } elseif ($row['candidate_id'] == "VT-0001") { // Assuming "VT-0002" is the ID for Digna John
            $data['dignaVotes'] = $row['vote_count'];
        }
        $data['totalVotes'] += $row['vote_count'];
    }
}

// Close connection
$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Voting Results</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: blanchedalmond;
            margin: 0;
            padding: 0;
        }
        .container {
            width: 80%;
            margin: 20px auto;
            padding: 20px;
            display: flex;
            flex-direction: column; /* Arrange items vertically */
            align-items: center; /* Center-align items */
            gap: 50px; /* Add spacing between candidates */
        }
        h1 {
            text-align: center;
            color: #333;
            width: 100%;
            margin-bottom: 30px;
        }
        .candidate {
            background-color: lightyellow;
            border: 1px solid #ddd;
            border-radius: 10px;
            box-shadow: 0 0 10px grey;
            width: 100%;
            max-width: 400px;
            padding: 20px;
            text-align: center;
            transition: transform 0.3s;
        }
        .candidate:hover {
            transform: scale(1.02);
        }
        .candidate img {
            width: 200px; /* Set fixed width for images */
            height: 200px; /* Set fixed height for images */
            border-radius: 200px;
            margin-bottom: 10px;
        }
        .candidate h2 {
            color: #333;
            margin: 10px 0;
        }
        .candidate p {
            color: #666;
            font-size: 18px;
            margin: 5px 0;
        }
        .votes {
            font-weight: bold;
            color: #333;
        }
        .percentage-bar {
            width: 100%;
            background-color: skyblue; /* Sky blue color for the bar */
            border-radius: 5px;
            padding: 5px;
            margin-top: 10px;
        }
        .percentage {
            font-weight: bold;
            color: #fff;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Voting Results</h1>
        <div class="candidate" id="amos-john">
            <img src="Ellon.png" alt="Amos John">
            <h2>Amos John</h2>
            <p>Party: CCM</p>
            <p>Votes: <span class="votes" id="votes-amos"><?php echo $data['amosVotes']; ?></span></p>
            <div class="percentage-bar">
                <span class="percentage" id="percent-amos"><?php echo ($data['totalVotes'] > 0) ? number_format(($data['amosVotes'] / $data['totalVotes']) * 100, 2) . '%' : '0%'; ?></span>
            </div>
        </div>
        <div class="candidate" id="digna-john">
            <img src="Jane.png" alt="Digna John">
            <h2>Digna John</h2>
            <p>Party: CHADEMA</p>
            <p>Votes: <span class="votes" id="votes-digna"><?php echo $data['dignaVotes']; ?></span></p>
            <div class="percentage-bar">
                <span class="percentage" id="percent-digna"><?php echo ($data['totalVotes'] > 0) ? number_format(($data['dignaVotes'] / $data['totalVotes']) * 100, 2) . '%' : '0%'; ?></span>
            </div>
        </div>
    </div>
</body>
</html>
