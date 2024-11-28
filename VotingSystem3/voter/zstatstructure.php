<?php 
require '../layout.php';

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Voting System Dashboard</title>
    <link rel="stylesheet" href="zstylesstat.css">
    <link rel="stylesheet" href="voting.css">

    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <style>
       
    </style>
</head>
<body>
    
<div class="wave-container">
        <div class="logout">
        <a href="logout.php">Logout</a>
        </div>
    </div>
    <div class="container">
        <!-- Section 1 
        <div class="section section1">
        <div class="container2">
        <h1>Time Toward Voting</h1>
        <div id="countdown" class="countdown">
            00:00:00
        </div>
        <div class="progress-bar">
            <div id="progress" class="progress"></div>
        </div>
    </div>
    <script src="zscript.js"></script>
        </div> -->

        <!-- Section 2 -->
    
            
        
            
               <article>Real-Time Voting Results</article>
               <canvas id="voteChart"></canvas>
        
                <script src="zscript2.js"></script>
        
        

        <!-- Section 3 
        <div class="section section3">
        <div class="container2">
        <h1>Time Before Voting Ends</h1>
        <div id="countdown2" class="countdown">
            00:00:00
        </div>
        <div class="progress-bar">
            <div id="progress2" class="progress"></div>
        </div>
      </div>
      <script src="ztimer2.js"></script> -->
    </div>
</body>
</html>
