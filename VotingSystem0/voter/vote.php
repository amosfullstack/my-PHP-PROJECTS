<?php
session_start();

// Ensure voter_id is set in the session and retrieve it
if (!isset($_SESSION['username'])) {
    header('location:voter_login.php');
    exit();
}
$voter_id = $_SESSION['username'];

require '../layout.php';
include '../dbconn.php';

// Function to fetch candidates from the database
function getCandidates($conn) {
    $sql = "SELECT candidate_id, firstname, lastname, photoPath, position, party FROM candidates INNER JOIN voters WHERE candidates.candidate_id=voters.voter_id ";
    $stmt = $conn->prepare($sql);
    $stmt->execute();
    return $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
}

// Check if the voter has already voted
function hasVoted($conn, $voter_id) {
    $sql_check = "SELECT candidate_id FROM votes WHERE vote_id=?";
    $stmt = $conn->prepare($sql_check);
    $stmt->bind_param('s', $voter_id);
    $stmt->execute();
    $result = $stmt->get_result();
    return $result->num_rows > 0 ? $result->fetch_assoc()['candidate_id'] : false;
}
$voted_candidate_id = hasVoted($conn, $voter_id);

// Handle form submission for voting
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $candidate_id = $_POST['candidate_id'];
    if (!$voted_candidate_id) { // Only allow voting if the user hasn't voted yet
        if (insertVote($conn, $voter_id, $candidate_id)) {
            echo "Vote submitted successfully!";
            $voted_candidate_id = $candidate_id; // Update to reflect the vote
        } else {
            echo "Failed to submit the vote.";
        }
    } else {
        echo " <p>You have already voted.</p>";
    }
}

// Function to insert a vote
function insertVote($conn, $voter_id, $candidate_id) {
    // Validate that the candidate_id exists in the candidates table
    $sql_validate_candidate = "SELECT 1 FROM candidates WHERE candidate_id=?";
    $stmt = $conn->prepare($sql_validate_candidate);
    $stmt->bind_param('s', $candidate_id);
    $stmt->execute();
    if ($stmt->get_result()->num_rows > 0) {
        // Insert the vote
        $sql_vote = "INSERT INTO votes (vote_id, candidate_id) VALUES (?, ?)";
        $stmt = $conn->prepare($sql_vote);
        $stmt->bind_param('ss', $voter_id, $candidate_id);
        return $stmt->execute();
    } else {
        echo "Error: The selected candidate does not exist.";
        return false;
    }
}

// Fetch candidates
$candidates = getCandidates($conn);

// Close the database connection after all operations are done
$conn->close();

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Voting Page</title>
    <link rel="stylesheet" href="voting.css">
    <style>
       
.container-card {
    
    border-radius: 10px;
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
    width: 80%;
    text-align: center;
    padding: 20px;
    transition: transform 0.2s ease-in-out;
    position: relative;
      }
     
     
        article{
            color: #333;
            margin-bottom: 20px;
        }
        .form-group {
            margin-bottom: 10px;
        }
        button {
            background-color: #007bff;
            color: white;
            border: none;
            padding: 10px 20px;
            border-radius: 5px;
            font-size: 16px;
            cursor: pointer;
            margin: 10px;
            text-decoration: none;
            transition: background-color 0.3s ease;
        }
        button:hover {
            background-color: #0056b3;
        }
        img {
            width: 80px;
            height: 80px;
            border-radius: 10%;
            margin: 10px;
        }
        .candidate {
            display: flex;
            align-items: center;
            justify-content: space-between;
            margin-bottom: 5px;
        }
        .candidate span {
            margin: 0;
            flex-grow: 1;
            text-align: left;
        }
        .voted {
            background-color: red !important;
            pointer-events: none;
        }
    </style>
</head>
<div class="container-card" id="block">
    <article>Vote diligently</article>
   
    <form action="" method="post">
        <?php foreach ($candidates as $candidate): ?>
            <div class="candidate">
                <img src="../<?php echo htmlspecialchars($candidate['photoPath']); ?>" alt="Candidate Photo">
                <span>
                    <h3><?php echo htmlspecialchars($candidate['firstname']) . ' ' . htmlspecialchars($candidate['lastname']); ?></h3>
                    <p><?php echo htmlspecialchars($candidate['position']); ?></p>
                    <p><b><?php echo htmlspecialchars($candidate['party']); ?></b></p>
                    <hr>
                </span>
                <button class="<?php echo ($voted_candidate_id == $candidate['candidate_id']) ? 'voted' : ''; ?>" type="submit" name="candidate_id" value="<?php echo htmlspecialchars($candidate['candidate_id']); ?>">
                    <?php echo ($voted_candidate_id == $candidate['candidate_id']) ? 'Voted' : 'Vote'; ?>
                </button>
            </div>
        <?php endforeach; ?>
    </form>
</div>
<script>
    let display=document.getElementById('');
    let block=document.getElementById('');

   window.addEventListener('load',()=>{
  let setTime=30;
  let  timer=setInterval(() => {
  
   //console.log(setTime);
   display.textContent=`${'00'}:${setTime}`;
    setTime--;
    if(setTime < 0)
    {
      clearInterval(timer);
      block.style.display='none';
      display.style.display='none';
    }
  }, 1000);
});
</script>
</body>
</html>
