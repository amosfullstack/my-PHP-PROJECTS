<!DOCTYPE html>
<html>
    <title>Working with radio Buttons</title>
    <body>
        <form action="radio.php" method="post">
        <p>Select a payment Method</p>
        <input type="radio" value="visa" name="credit-card">Visa<br>
        <input type="radio" value="mastercard" name="credit-card">Mastercard<br>
        <input type="radio" value="americanexpress" name="credit-card">American Express<br>
        <input type="submit" value="submit" name="submit">
      </form>
    </body>
</html>
<?php
if(isset($_POST["submit"])){
    $credit_card=$_POST["credit-card"];
    if($credit_card=="visa"){
        echo "You selected {$credit_card}";
    }
    elseif($credit_card=="mastercard"){
        echo "You selected {$credit_card}";
    }
    elseif($credit_card=="americanexpress"){
        echo "You selected {$credit_card}";
    }
    else{
        echo "Please select a payment method";
    }
}

?>