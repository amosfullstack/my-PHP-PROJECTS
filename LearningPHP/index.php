<?php
for ($i = 200; $i >= 0; $i--) {
    if ($i % 2 == 0) {
        echo "<strong style='color: green;'>$i</strong><br>";
    } else {
        echo "<em style='color: red;'>$i</em><br>";
    }
}
?>
