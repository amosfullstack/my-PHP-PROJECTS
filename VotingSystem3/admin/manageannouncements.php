<?php 
    require '../layout.php';
    require 'homepage.php';
     ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title></title>
    <link rel="stylesheet" href="admin.css">
    <link rel="stylesheet" href="../voter/voting.css">
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
    background-color: gray;
    overflow-x: hidden;
} 
.registervoter{
    border:1px solid black;
    margin:auto;
    width: 300px;
    height: 480px;
}
.voterstable{
    background:lightblue;
    margin:30px 50px;
    margin-right: 50px;
    width: 80%;

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
        <th>ANNOUNCEMENT TITLE</th>
        
        <th>CONTENT</th>
        
    </tr>
    <?php
    include('../dbconn.php');
   $sql= "SELECT * FROM announcements";

   $res= $conn->query($sql);
   if($res && $res -> num_rows > 0){ 
    while($row = $res->fetch_assoc()){?>
        <tr>
        <td><?php echo htmlspecialchars($row['title']);?></td>
            <td><?php echo htmlspecialchars($row['content']);?></td>
          <td>
          <?php echo " <a href='?edit=" .$row['title'] . "' >Edit</a>
          <a href='?delete=" . $row["title"] . "' onclick=\"return confirm('Are you sure you want to delete this record?');\">Delete</a>"?>
            
    </td>
    </tr>
  <?php  }
  }?>
  </table>
  
<?php


// Fetch user data
if(isset($_GET['edit'])){
 $title=$_GET['edit'];
$sql = " SELECT * FROM announcements WHERE title=?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("s", $title);
$stmt->execute();
$result = $stmt->get_result();
if ($result->num_rows > 0) {
    $row= $result->fetch_assoc();
    $title = $row['title'];
    $content= $row['content'];
  
    
}
?>
<form class="registervoter" id="registervorter" method="POST" action="" >
    <h3>Update Information</h3>
        <label> title</label><br>
        <input type="text" name="title" value="<?php echo $title; ?> " required><br>
        <label>content</label><br>
        <input type="text" name="content" value="<?php echo $content; ?>" required><br>
      
       <input type="submit" name="update" value="update" id="update" >
</form>



<?php
}


    // Handle Delete request
    if (isset($_GET['delete'])) {
        $delete_title = $_GET['delete'];
        $sql = "DELETE FROM announcements WHERE title='$delete_title'";
        if ($conn->query($sql) === TRUE) {
            echo "Record deleted successfully<br>";
        } else {
            echo "Error deleting record: " . $conn->error;
        }
    }

    // Display form
   
// Update user data
if ($_SERVER["REQUEST_METHOD"] == "POST"){
    $title= $_POST['title'];
    $content = $_POST['content'] ;
   
    

if(isset($_POST['update'])){   

$query = "UPDATE announcements SET title =? ,content=? WHERE title = ?";
$stmt = $conn->prepare($query);
$stmt->bind_param("sss", $title,$content,$title);

if ($stmt->execute()) {
     header("Location:manageannouncements.php");
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
