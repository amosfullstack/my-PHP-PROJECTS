
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title></title>
    <style>
  /* #registervorter{
    position: fixed;
    width:300px;
    height: 200px;
    background:white;
    border: 1px solid black;
    padding: 10px;
    margin:auto;
    top:0;
    right: 0;
    bottom: 0;
    left: 0;
    z-index: 10;
    display: none;

*/
body  {
    background-color: #e9ecef;
} 
.registervoter{
    border:1px solid black;
    margin:auto;
    width: 300px;
    height: 480px;
}
.voterstable{
    background:lightblue;
    margin-top:30px;

} 
input[type="text"]{
    
    width: 200px;
    height:25px;
    border:1px solid black;
    box-sizing:border-box;
    border-radius:5px;
    
}
input[type="number"]{

width: 200px;
height:25px;
border:1px solid black;
box-sizing:border-box;
border-radius:5px;

}
input[type="submit"]{
    background-color: blue;
    color: white;
    border: none;
    width: 100px;
    height: 30px;
    border-radius:8px;
}
input[type="submit"]:hover {
            background-color: #218838;
            transform: scale(1.05);
        }
</style>

</head>
<body  >

<center>
<table border="1" class="voterstable">
    <tr>
        <th>VOTER_ID</th>
        <th>FIRST NAME</th>
        <th>MIDDLE NAME</th>
        <th>LAST NAME</th>
        <th>AGE</th>
        <th>ADDRESS</th>
        <th>REG_DATE</th>
    </tr>
    <?php
    include('dbconn.php');
   $sql= "SELECT * FROM voters";

   $res= $conn->query($sql);
   if($res && $res -> num_rows > 0){ 
    while($row = $res->fetch_assoc()){?>
        <tr>
        <td><?php echo htmlspecialchars($row['voter_id']);?></td>
            <td><?php echo htmlspecialchars($row['firstname']);?></td>
            <td><?php echo htmlspecialchars($row['middlename']);?></td>
             <td><?php echo htmlspecialchars($row['lastname']);?></td>
              <td><?php echo htmlspecialchars($row['age']);?></td>
               <td><?php echo htmlspecialchars($row['address']);?></td>
               <td><?php echo htmlspecialchars($row['Regdate']);?></td>
            <td > 
          <?php echo " <a href='?edit=" .$row['voter_id'] . "' >Edit</a>
          <a href='?delete=" . $row["voter_id"] . "' onclick=\"return confirm('Are you sure you want to delete this record?');\">Delete</a>"?>
            
    </td>
    </tr>
  <?php  }
  }?>
  </table>
  
<?php


// Fetch user data
if(isset($_GET['edit'])){
 $user_id=$_GET['edit'];
$sql = " SELECT * FROM voters WHERE voter_id=?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("s", $user_id);
$stmt->execute();
$result = $stmt->get_result();
if ($result->num_rows > 0) {
    $row= $result->fetch_assoc();
    $voter_id = $row['voter_id'];
    $firstname= $row['firstname'];
    $middlename= $row['middlename'];
    $lastname= $row['lastname'];
    $age= $row['age'];
    $address= $row['address'];
    $Regdate= $row['Regdate'];
  
    
}
?>
<form class="registervoter" id="registervorter" method="POST" action="" >
    <h3>Update Information</h3>
        <label> voterID</label><br>
        <input type="text" name="voter_id" value="<?php echo $voter_id; ?> " required><br>
        <label>Firstame</label><br>
        <input type="text" name="firstname" value="<?php echo $firstname; ?>" required><br>
        <label>Middlename</label><br>
        <input type="text" name="middlename" value="<?php echo $middlename; ?>" required><br>
        <label>lastname</label><br>
        <input type="text" name="lastname" value="<?php echo $lastname; ?>" required><br>
        <label>age</label><br>
        <input type="text" name="age" value="<?php echo $age; ?>" required><br>
        <label>Address</label><br>
        <input type="text" name="address" value="<?php echo $address; ?>" required><br>
        <label>Regdate</label><br>
        <input type="text" name="Regdate" value="<?php echo $Regdate; ?>" required><br><br>
       
       <input type="submit" name="update" value="update" id="update" >
</form>



<?php
}


    // Handle Delete request
    if (isset($_GET['delete'])) {
        $delete_regno = $_GET['delete'];
        $sql = "DELETE FROM voters WHERE voter_id='$delete_regno'";
        if ($conn->query($sql) === TRUE) {
            echo "Record deleted successfully<br>";
        } else {
            echo "Error deleting record: " . $conn->error;
        }
    }

    // Display form
   
// Update user data
if ($_SERVER["REQUEST_METHOD"] == "POST"){
    $voter_id= $_POST['voter_id'];
    $firstname = $_POST['firstname'] ;
    $middlename= $_POST['middlename'];
    $lastname= $_POST['lastname'];
    $age= $_POST['age'];
    $address= $_POST['address'];
    $Regdate= $_POST['Regdate'];
  
   
    

if(isset($_POST['update'])){   

$query = "UPDATE voters SET voter_id =? ,firstname=?,middlename=?,lastname=?,age=?,address=?,Regdate=? WHERE voter_id = ?";
$stmt = $conn->prepare($query);
$stmt->bind_param("ssssisss", $voter_id,$firstname,$middlename,$lastname,$age,$address,$Regdate,$voter_id);

if ($stmt->execute()) {
     header("Location:Viewvoters.php");
    exit();
} else {
    echo "Error updating user: " . $stmt->error;
}
}

}

$conn->close();
?>
<script>
    var popupLink = document.getElementById("popup-link");
    var popupwindow =document.getElementById("registervorter");
    var closebutton =document.getElementById("close-button");
    popupLink.addEventListener("click",function(event){
        event.preventDefault();
        popupwindow.style.display="block";
    });
    closebutton.addEventListener("click",function(){
        popupwindow.style.display="none";

    });
</script>

   </center> 
    </body>
</html>
