<?php 
 require '../layout.php';
 require 'homepage.php';

 ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage</title>
    <link href="admin.css" rel="stylesheet">
    <link href="../voter//voting.css" rel="stylesheet">
    
</head>
<body>
    
    <center>
        <table  border="1" class="voterstable">
            <tr>
                <th>Candidate ID</th>
                <th>Position</th>
                <th>Photo</th>
                <th>Mission</th>
                <th>Party</th>
                <th>Party Code</th>
                <th>Actions</th>
            </tr>
            <?php
            session_start();
           // include('homepage.php');
            include('../dbconn.php');
            $sql= "SELECT * FROM candidates";
            $res= $conn->query($sql);
            if($res && $res -> num_rows > 0) { 
                while($row = $res->fetch_assoc()){?>
                    <tr>
                        <td><?php echo htmlspecialchars($row['candidate_id']);?></td>
                        <td><?php echo htmlspecialchars($row['position']);?></td>
                        <td><?php echo htmlspecialchars($row['photoPath']);?></td>
                        <td><?php echo htmlspecialchars($row['textarea']);?></td>
                        <td><?php echo htmlspecialchars($row['party']);?></td>
                        <td><?php echo htmlspecialchars($row['partycode']);?></td>
                        <td> 
                            <?php echo " <a href='?edit=" .$row['candidate_id'] . "' >Edit</a> |
                            <a href='?delete=" . $row["candidate_id"] . "' onclick=\"return confirm('Are you sure you want to delete this record?');\">Delete</a>"?>
                        </td>
                    </tr>
            <?php  }
            }?>
        </table>

        <?php
        if(isset($_GET['edit'])){
            $user_id = $_GET['edit'];
            $sql = "SELECT candidate_id,position,photoPath,textarea,party,partycode FROM candidates WHERE candidate_id= ?";
            $stmt = $conn->prepare($sql);
            $stmt->bind_param("s", $user_id);
            $stmt->execute();
            $result = $stmt->get_result();
            if ($result->num_rows > 0) {
                $row = $result->fetch_assoc();
                $candidate_id = $row['candidate_id'];
                $position = $row['position'];
                $photopath = $row['photoPath'];
                $textarea = $row['textarea'];
                $party = $row['party'];
                $partycode = $row['partycode'];
            }
        ?>
        <form class="registervoter" id="registervoter" method="POST" action="">
            <h3>Update Information</h3>
            <label>Candidate ID</label>
            <input type="text" name="candidate_id" value="<?php echo htmlspecialchars($candidate_id); ?>" required>
            <label>Position</label>
            <input type="text" name="position" value="<?php echo htmlspecialchars($position); ?>" required>
            <label>Photo</label>
            <input type="text" name="photoPath" value="<?php echo htmlspecialchars($photopath); ?>" required>
            <label>Mission</label>
            <input type="text" name="textarea" value="<?php echo htmlspecialchars($textarea); ?>" required>
            <label>Party</label>
            <input type="text" name="party" value="<?php echo htmlspecialchars($party); ?>" required>
            <label>Party Code</label>
            <input type="text" name="partycode" value="<?php echo htmlspecialchars($partycode); ?>" required>
            <input type="submit" name="update" value="Update">
        </form>
        <?php
        }
        if (isset($_GET['delete'])) {
            $candidateID = $_GET['delete'];
            $sql = "DELETE FROM candidates WHERE candidate_id='$candidateID'";
            if ($conn->query($sql) ===FALSE) {
               
        
                echo "Error deleting record: " . $conn->error;
            }
        }

        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $candidate_id = $_POST['candidate_id'];
            $position = $_POST['position'];
            $photo = $_POST['photoPath'];
            $textarea = $_POST['textarea'];
            $party = $_POST['party'];
            $partycode = $_POST['partycode'];

            if (isset($_POST['update'])) {
                $query = "UPDATE candidates SET position=?, photoPath=?, textarea=?, party=?, partycode=? WHERE candidate_id=?";
                $stmt = $conn->prepare($query);
                $stmt->bind_param("ssssss", $position, $photo, $textarea, $party, $partycode, $candidate_id);

                if ($stmt->execute()) {
                    header("Location:Managecandidates.php");
                    exit();
                } else {
                    echo "Error updating user: " . $stmt->error;
                }
            }
        }
        $conn->close();
        ?>
    </center>
</body>
</html>
