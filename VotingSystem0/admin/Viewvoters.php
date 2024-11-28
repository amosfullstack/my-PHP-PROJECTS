<?php 
session_start();
if(!isset($_SESSION['system_admin'])){
    header('location:admin_login.php');
    exit();
}

    require '../layout.php';
    require 'homepage.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin - Manage Voters</title>
    <link rel="stylesheet" href="admin.css">
    <link rel="stylesheet" href="../voter/voting.css">
    <style>
        .registervoter {
            border: 1px solid black;
            margin: auto;
            width: 300px;
            height: 650px;
            display: none; /* Initially hidden */
            position: fixed;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            background-color: white;
            box-shadow: 0px 0px 15px rgba(0, 0, 0, 0.1);
            border-radius: 10px;
            z-index: 10;
            padding: 20px;
        }
        .voterstable {
            background: lightblue;
            margin-top: 30px;
            width: 100%;
            border-collapse: collapse;
        }
        .voterstable th, .voterstable td {
            padding: 10px;
            border: 1px solid black;
            text-align: center;
        }
        input[type="text"], input[type="number"] {
            width: 200px;
            height: 30px;
            border: 1px solid black;
            box-sizing: border-box;
            border-radius: 5px;
            padding: 5px;
        }
        input[type="submit"] {
            background-color: blue;
            color: white;
            border: none;
            width: 100px;
            height: 40px;
            border-radius: 8px;
            cursor: pointer;
        }
        input[type="submit"]:hover {
            background-color: #218838;
            transform: scale(1.05);
        }
        #popup {
            position: fixed;
            top: 50%;
            left: 50%;
            width: 300px;
            height: 600px;
            box-shadow: 0px 0px 15px rgba(0, 0, 0, 0.1);
            transform: translate(-50%, -50%);
            background-color: rgb(160, 209, 252);
            border: 1px solid rgb(36, 247, 141);
            z-index: 1;
            display: block;
            text-align: center;
            border-radius: 10px;
        }
    </style>
</head>
<body>

<center>
    <table class="voterstable">
        <tr>
            <th>VOTER_ID</th>
            <th>FIRST NAME</th>
            <th>MIDDLE NAME</th>
            <th>LAST NAME</th>
            <th>AGE</th>
            <th>ADDRESS</th>
            <th>REG_DATE</th>
            <th>ACTION</th>
        </tr>
        <?php
        include('../dbconn.php');
        $sql = "SELECT * FROM voters";
        $res = $conn->query($sql);
        if ($res && $res->num_rows > 0) {
            while ($row = $res->fetch_assoc()) {
                echo "<tr>
                    <td>" . htmlspecialchars($row['voter_id']) . "</td>
                    <td>" . htmlspecialchars($row['firstname']) . "</td>
                    <td>" . htmlspecialchars($row['middlename']) . "</td>
                    <td>" . htmlspecialchars($row['lastname']) . "</td>
                    <td>" . htmlspecialchars($row['age']) . "</td>
                    <td>" . htmlspecialchars($row['address']) . "</td>
                    <td>" . htmlspecialchars($row['Regdate']) . "</td>
                    <td>
                        <a href='?edit=" . htmlspecialchars($row['voter_id']) . "'>Edit</a> |
                        <a href='?delete=" . htmlspecialchars($row['voter_id']) . "' onclick=\"return confirm('Are you sure you want to delete this record?');\">Delete</a>
                    </td>
                </tr>";
            }
        }
        ?>
    </table>
  
    <?php
    // Fetch user data for editing
    if (isset($_GET['edit'])) {
        $user_id = $_GET['edit'];
        $sql = "SELECT * FROM voters WHERE voter_id=?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("s", $user_id);
        $stmt->execute();
        $result = $stmt->get_result();
        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            $voter_id = $row['voter_id'];
            $firstname = $row['firstname'];
            $middlename = $row['middlename'];
            $lastname = $row['lastname'];
            $age = $row['age'];
            $address = $row['address'];
            $Regdate = $row['Regdate'];
        }
    ?>
    <form class="registervoter" id="popup" method="POST" action="">
        <div id="closebtn">X</div>
        <h3>Update Information</h3>
        <label>Voter ID</label><br>
        <input type="text" name="voter_id" value="<?php echo htmlspecialchars($voter_id); ?>" required><br>
        <label>Firstname</label><br>
        <input type="text" name="firstname" value="<?php echo htmlspecialchars($firstname); ?>" required><br>
        <label>Middlename</label><br>
        <input type="text" name="middlename" value="<?php echo htmlspecialchars($middlename); ?>" required><br>
        <label>Lastname</label><br>
        <input type="text" name="lastname" value="<?php echo htmlspecialchars($lastname); ?>" required><br>
        <label>Age</label><br>
        <input type="number" name="age" value="<?php echo htmlspecialchars($age); ?>" required><br>
        <label>Address</label><br>
        <input type="text" name="address" value="<?php echo htmlspecialchars($address); ?>" required><br>
        <label>Regdate</label><br>
        <input type="text" name="Regdate" value="<?php echo htmlspecialchars($Regdate); ?>" required><br><br>
        <button type="submit" name="update" value="update" id="update" >Update</button>
    </form>
    <?php
    }

    // Handle Delete request
    if (isset($_GET['delete'])) {
        $delete_regno = $_GET['delete'];
        $sql = "DELETE FROM voters WHERE voter_id=?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("s", $delete_regno);
        if ($stmt->execute()) {
            echo "Record deleted successfully<br>";
        } else {
            echo "Error deleting record: " . $stmt->error;
        }
        $stmt->close();
    }

    // Update user data
    if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['update'])) {
        $voter_id = $_POST['voter_id'];
        $firstname = $_POST['firstname'];
        $middlename = $_POST['middlename'];
        $lastname = $_POST['lastname'];
        $age = $_POST['age'];
        $address = $_POST['address'];
        $Regdate = $_POST['Regdate'];

        $query = "UPDATE voters SET firstname=?, middlename=?, lastname=?, age=?, address=?, Regdate=? WHERE voter_id=?";
        $stmt = $conn->prepare($query);
        $stmt->bind_param("sssssss", $firstname, $middlename, $lastname, $age, $address, $Regdate, $voter_id);

        if ($stmt->execute()) {
            echo "Record updated successfully<br>";
        } else {
            echo "Error updating record: " . $stmt->error;
        }
        $stmt->close();
    }

    $conn->close();
    ?>
</center>

<script>
    var popupWindow = document.getElementById("popup");
    var closeButton = document.getElementById("closebtn");

    if (closeButton) {
        closeButton.addEventListener("click", function() {
            popupWindow.style.display = "none";
        });
    }

</script>

</body>
</html>
