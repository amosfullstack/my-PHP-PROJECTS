<!DOCTYPE html>
<html>
<head>
    <title>Election Management System</title>
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
          height: 75%;
width: 0px;
position: fixed;
display: flex;

flex-direction: column;
z-index: 1;
top: 120px;
left: 0;
background-color:rgb(200, 230, 252);
overflow-x: hidden;
transition: 0.5s;
padding-top: 10px;
border-radius: 10px;
      
      }
      .sidebar a {
          color:black;
          text-decoration: none;
          padding: 10px;
          width: 100%;
          text-align: center;
          border-bottom: 1px solid #fff;
      }
      .sidebar a:hover {
          background-color: #0056b3;
      }
      .openbtn{
        float: left;
        top: 125px;
        position: absolute;
      }
      


    </style>
</head>
<body>
    <div class="sidebar" id="sidebar">
        <a href="javascript:void(0)" class="closebtn" onclick="closeNav()">×</a>
        <a href="Announcements.php">Add News</a>
        <a href="Managecandidates.php">Manage Candidates</a>
        <a href="Viewvoters.php">View Voters</a>
        <a href="manageannouncements.php">Manage Announcements</a>
        <a href="update.php">Set an Election Day</a>
        <a href="../voter/zstatstructure.php">Votes Chart</a>
       
    </div>

    <div id="main" class="navbar1">
        <button class="openbtn" onclick="openNav()">☰</button>
       
      <!--  <div class="content">
            <h1>Welcome to the Election Management System</h1>
            <p>Your voice matters! Exercise your right to vote and help shape the future of your community.</p>
            <p>To register as a voter, please visit the "Register Voters" tab.</p>
            <p>To view the list of candidates and their manifestos, please visit the "Manage Candidates" tab.</p>
            <p>To stay updated on the latest news and announcements, please visit the "Add News" and "Manage Announcements" tabs.</p>
            <p>To view the voting results, please visit the "Votes Chart" tab.</p>
        </div>-->
    </div>
   
    <script>
        function openNav() {
            document.getElementById("sidebar").style.width = "250px";
            document.getElementById("main").style.display= "none";
        }

        function closeNav() {
            document.getElementById("sidebar").style.width= "0";
            document.getElementById("main").style.display = "block";
        }
    </script>
</body>
</html>
