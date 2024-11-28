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
            <?php
            for ($i = 200; $i >= 0; $i--) {
                if ($i % 2 == 0) {
                    echo "<strong style='color: green;'>$i</strong><br>";
                } else {
                    echo "<em style='color: red;'>$i</em><br>";
                }
            }
            ?>
        </div>
        <div class="section2">
            <?php
            for ($i = 0; $i <= 6; $i++) {
                for ($j = 0; $j <= 6; $j++) {
                    if ($j < $i) {
                        echo "<em style='color: red;'>$j</em> ";
                    } else {
                        echo "<strong style='color: green;'>$j</strong> ";
                    }
                }
                echo "<br>";
            }
            ?>
        </div>
        <div class="section3">
            <?php
            function calculate_area($radius) {
                return pi() * pow($radius, 2);
            }

            echo "<table border='1'>
            <tr>
                <th>Radius</th>";
            for ($radius = 2; $radius <= 11; $radius++) {
                echo "<th>$radius</th>";
            }
            echo "</tr><tr>
                <th>Area</th>";
            for ($radius = 2; $radius <= 11; $radius++) {
                $area = calculate_area($radius);
                echo "<td>" . round($area, 2) . "</td>";
            }
            echo "</tr></table>";
            ?>
        </div>
    </div>
</body>
</html>
