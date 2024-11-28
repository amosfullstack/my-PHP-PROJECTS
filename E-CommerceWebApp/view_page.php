<?php
include 'database.php';
session_start();
$user_id = $_SESSION['user_name'];

if (!isset($user_id)) {
    header('location:login.php');
}
if (isset($_POST['logout'])) {
    session_destroy();
    header('location:login.php');
}

// adding product in cart
if (isset($_POST['add_to_cart'])) {
    $product_id = $_POST['product_id'];
    $product_name = $_POST['product_name'];
    $product_price = $_POST['product_price'];
    $product_image = $_POST['product_image'];
    $product_quantity = 1;

    $cart_num = mysqli_query($conn, "SELECT * FROM cart WHERE name='$product_name' AND user_id='$user_id' ") or die('query failed');
    if (mysqli_num_rows($cart_num)>0) {
        echo '<script>
                     swal("samahani", "Bidhaa uliyochagua tayari ipo kwenye cart","warning");
             </script>';
        
    }
    else {
        mysqli_query($conn, "INSERT INTO cart ( `user_id` , `pid`, `name`, `price`, `quantity`, `image`) VALUES ('$user_id', '$product_id', '$product_name', '$product_price', '$product_quantity', '$product_image')") or die('query failed');
        
        echo '<script>
                     swal("Hongera", "Bidhaa imeongezwa kwenye cart yako kikamilifu","success");
            </script>';

    }
}





?>
<style type="text/css">
    <?php  
        include 'index.css';
     ?>
</style>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>C & K shop page</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link rel="stylesheet" href="index.css">

    <link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Roboto:wght@300;400&display=swap" rel="stylesheet">
</head>
<body>
<?php  
    include 'header.php';
?>

<section class="shopus">
    <h1>product detail</h1>
</section>



    <div class="shop">
        <?php 
           if (isset($_GET['pid'])) {
            $pid = $_GET['pid'];
            $select_products = mysqli_query($conn, "SELECT * FROM products WHERE id='$pid'") or die('query failed');

            if (mysqli_num_rows($select_products)>0) {
                while ($fetch_products = mysqli_fetch_assoc($select_products)) {
                    
             

        ?>
        <form  method="POST" class="card">
            <img src="image/<?php echo $fetch_products['image']; ?>">
            <div class="price"><?php echo $fetch_products['price']; ?></div>
            <div class="name"><?php echo $fetch_products['name']; ?></div>
            <input type="hidden" name="product_id" value="<?php echo $fetch_products['id']; ?> " >
            <input type="hidden" name="product_name" value="<?php echo $fetch_products['name']; ?> " >
            <input type="hidden" name="product_price" value="<?php echo $fetch_products['price']; ?> " >
            
            <input type="hidden" name="product_id" value="<?php echo $fetch_products['image']; ?> " >
            <div class="iconot">
            <div class="icon">
                <button type="submit" name="add_to_cart">ADD TO CART</button>
                <input type="number" name="product_quantity" value="1" min="0" class="quantity" >


            </div>
            </div>

        </form>

        <?php
           }
        }
        
       }

          ?>
    </div>
    
    <?php  
    include 'footer.php';
    ?>

    <script type="text/javascript" src="index.js"></script>
    
</body>
</html>













