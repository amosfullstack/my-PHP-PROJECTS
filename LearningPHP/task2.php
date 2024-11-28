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
