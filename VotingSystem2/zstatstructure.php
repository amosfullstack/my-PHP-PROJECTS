<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Voting System Dashboard</title>
    <link rel="stylesheet" href="zstylesstat.css">
    <link rel="stylesheet" href="zstyle.css">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color:#00a2dc;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }

        .container {
            display: grid;
            grid-template-columns: 1fr 2fr;
            grid-template-rows: 1fr 1fr;
            gap: 10px;
            width: 90%;
            height: 90%;
            background-color: #2d2f77;
            border: 1px solid #ddd;
            border-radius: 4px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        .section {
            padding: 20px;
            color: #fff;
            font-size: 18px;
        }

        .section1 {
            background-color: #2b323b;
            border-radius: 5px;
        }

        .section2 {
            background-color: #4c3b9b;
            grid-row: span 2;
            border-radius: 5px;
        }

        .section3 {
            background-color: #7b8a9d;
            border-radius: 5px;
        }

    </style>
</head>
<body>
    <div class="container">
        <!-- Section 1 -->
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
        </div>

        <!-- Section 2 -->
        <div class="section section2">
            
            <div id="chart">
            <div class="container1">
               <h1>Real-Time Voting Results</h1>
              <canvas id="voteChart"></canvas>
          </div>
                <script src="zscript2.js"></script>
            </div>
        </div>

        <!-- Section 3 -->
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
      <script src="ztimer2.js"></script>
    </div>
</body>
</html>
