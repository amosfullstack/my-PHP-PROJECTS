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
       body {
            background-color: thistle;
            margin: 0;
            padding: 0;
            font-family: Arial, sans-serif;
            display: flex;
            flex-direction: column;
            align-items: center;
            min-height: 100vh;
            border: 4px solid black;
            
        }
        .navbar {
            width: 100%;
            background-color: darkorchid;
            display: flex;
            justify-content: space-around;
            padding: 10px;
            box-sizing: border-box;
            border-bottom: 3px solid green;
        }
        .navbar a {
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
  top: 0;
  left: 0;
  background-color: green;
  overflow-x: hidden;
  transition: 0.5s;
  padding-top: 60px;
        
        }
        .sidebar a {
            color: white;
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
    
    <nav class="navbar">
    <button id="main" class="openbtn" onclick="openNav()">☰ </button> 
        <a href="#">Logout</a>
        
       
    </nav>
    <div class="sidebar" id="sidebar">
    <a href="javascript:void(0)" class="closebtn" onclick="closeNav()">X</a>
    <a href="voter_login.php">Home</a>
        <a href="dashboard.php">Dashboard</a>
        <a href="Announcements.php">News</a>
        <a href="voter_register.php">Register voters</a>
        <a href="Managecandidates.php">candidates</a>
        <a href="Viewvoters.php">voters</a>
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