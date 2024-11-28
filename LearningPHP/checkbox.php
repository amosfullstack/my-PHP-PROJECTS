<!DOCTYPE html>
<html>
    <title>Working with radio Buttons</title>
    <body>
        <form action="checkbox.php" method="post">
        <p>Select a payment Method</p>
        <input type="checkbox" value="pizza" name="pizza">Pizza<br>
        <input type="checkbox" value="hamburger" name="hamburger">Hamburger<br>
        <input type="checkbox" value="hotdog" name="hotdog">Hotdog<br>
        <input type="checkbox" value="rice" name="rice">Rice<br>
        <input type="checkbox" value="ugali" name="ugali">Ugali<br>
        <input type="submit" value="submit" name="submit">
      </form>
    </body>
</html>

<?php
if(isset($_POST["submit"])){
    if(isset($_POST["pizza"])){
        echo "You like Pizza  <br>";
    }
    if(isset($_POST["hamburger"])){
        echo "You like Hamburger  <br>";
    }
    if(isset($_POST["hotdog"])){
        echo "You like Hotdog  <br>";
    }
    if(isset($_POST["rice"])){
        echo "You like Rice  <br>";
    }
    if(isset($_POST["ugali"])){
        echo "You like Ugali  <br>";
    }

    if(empty($_POST["pizza"])){
        echo "You DON'T like Pizza  <br>";
    }
    if(empty($_POST["hamburger"])){
        echo "You DON'T like Hamburger  <br>";
    }
    if(empty($_POST["hotdog"])){
        echo "You DON'T like Hotdog  <br>";
    }
    if(empty($_POST["rice"])){
        echo "You DON'T like Rice  <br>";
    }
    if(empty($_POST["ugali"])){
        echo "You DON'T like Ugali <br>";
    }

}
?>