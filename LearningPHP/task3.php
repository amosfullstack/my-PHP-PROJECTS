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
