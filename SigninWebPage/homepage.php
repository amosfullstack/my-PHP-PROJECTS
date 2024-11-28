<?php
session_start();
include("connect.php");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Homepage</title>
</head>
<body>
    <div style="text-align:center; padding:15%;">
        <p style="font-size:50px; font-weight:bold;">
        Hello 
        <?php 
        if (isset($_SESSION['email'])) {
            $email = $_SESSION['email'];
            $query = mysqli_query($conn, "SELECT users.* FROM `users` WHERE users.email='$email'");
            
            if ($query) {
                $row = mysqli_fetch_array($query);
                if ($row) {
                    echo htmlspecialchars($row['firstName'] . ' ' . htmlspecialchars($row['lastName']));
                } else {
                    echo "No data found for this email.";
                }
            } else {
                echo "Error in query: " . mysqli_error($conn);
            }
        } else {
            echo "Guest";
        }
        ?>
        </p>

        <div>
            <table border="3px" align="center">
                <thead>
                    <tr>
                        <th>Id</th>
                        <th>First name</th>
                        <th>Last name</th>
                        <th>Email</th>
                        <th>Password</th>
                    </tr>
                </thead>
                <tbody>
                    <?php 
                    $sql = "SELECT * FROM users";
                    $results = $conn->query($sql);
                    
                    if ($results->num_rows > 0) {
                        foreach ($results as $row) {
                            ?>
                            <tr>
                                <td><?= htmlspecialchars($row['Id']) ?></td>
                                <td><?= htmlspecialchars($row['firstName']) ?></td>
                                <td><?= htmlspecialchars($row['lastName']) ?></td>
                                <td><?= htmlspecialchars($row['email']) ?></td>
                                <td><?= htmlspecialchars($row['password']) ?></td>
                            </tr>
                            <?php
                        }
                    } else {
                        echo "<tr><td colspan='5'>No records found!</td></tr>";
                    }
                    ?>
                </tbody>
            </table>
        </div>
 
        <a href="logout.php">Logout</a>
    </div>
</body>
</html>

?>
