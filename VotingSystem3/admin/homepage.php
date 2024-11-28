<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>homepage</title>
</head>
<body>
    <div id="body"></div>
    <style>
      
        .navbar1 {
            width: 100%;
            display: flex;
            padding: 10px;
            box-sizing: border-box;
            
        }
        button{
            height: 50px;
        }
        .navbar1 a {
            color: white;
            text-decoration: none;
            padding: 10px;
        }
        .sidebar {
            height: 100%;
  width: 0px;
  position: fixed;
  display: flex;
  flex-direction: column;
  z-index: 1;
  top: 200px;
  left: 0;
  background-color: #1f6fff;
  overflow-x: hidden;
  transition: 0.5s;
  padding-top: 60px;
  border-radius: 10px;
        
        }
        .sidebar a {
            color: #fff;
            text-decoration: none;
            padding: 10px;
            width: 100%;
            text-align: center;
            border-bottom: 1px solid #fff;
        }
        .sidebar a:hover {
            background-color: #0056b3;
        }
        
    </style>
    
    <nav class="navbar1">
    <button id="main" class="openbtn" onclick="openNav()">☰ </button> 
       <div  class="logout">
       <a href="logout.php">Logout</a>
       </div> 
        
       
    </nav>
    <div class="sidebar" id="sidebar">
    <a href="javascript:void(0)" class="closebtn" onclick="closeNav()">X</a>
    <a href="admin_login.php">Home</a>
        <a href="Announcements.php">Add News</a>
        <a href="voter_register.php">Register voters</a>
        <a href="Managecandidates.php">manage candidates</a>
        <a href="Viewvoters.php">view  voters</a>
        <a href="manageannouncements.php">manage announcements</a>
        <a href="update.php">Set an election day</a>
        <a href="../voter/zstatstructure.php">votes chart</a>
    </div>
    <script>
function openNav() {
  document.getElementById("sidebar").style.width = "200px";
  document.getElementById("main").style.display = "none";
  document.getElementsByTagName('body').style.left ="250px;"
}

function closeNav() {
  document.getElementById("sidebar").style.width = "0";
  document.getElementById("main").style.display= "block";
}
</script>
   
</body>
</html>