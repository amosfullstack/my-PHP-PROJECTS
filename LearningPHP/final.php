<!DOCTYPE html>
<html>
<head>
    <title>My PHP App</title>
    <style>
        .container {
            display: grid;
            grid-template-columns: 1fr 1fr;
            grid-template-rows: auto auto;
            gap: 10px;
            padding: 20px;
        }
        .header {
            grid-column: 1 / span 2;
            text-align: center;
            background-color: orange;
            padding: 10px;
        }
        .section1, .section2 {
            background-color: lightblue;
            padding: 10px;
        }
        .section2 {
            grid-column: 1 / span 2;
        }
        .section3 {
            background-color: lightgreen;
            padding: 10px;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <h1>My PHP App</h1>
        </div>
        <div class="section1">
            <?php include 'index.php'; ?>
        </div>
        <div class="section2">
            <?php include 'task2.php'; ?>
        </div>
        <div class="section3">
            <?php include 'task3.php'; ?>
        </div>
    </div>
</body>
</html>
