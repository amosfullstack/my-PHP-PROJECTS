<?php
include 'database.php';
session_start();
$admin_id = $_SESSION['user_name'];

if (!isset($admin_id)) {
    header('location:login.php');
}
if (isset($_POST['logout'])) {
    session_destroy();
    header('location:login.php');
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
            $select_wishlist = mysqli_query($conn, "SELECT * FROM wishlist ") or die('query failed');
            if (mysqli_num_rows($select_wishlist)>0) {
                while ($fetch_products = mysqli_fetch_assoc($select_products)) {

        ?>
        <form  method="POST" class="card">
            <img src="image/<?php echo $fetch_products['image']; ?>">
            <div class="price"><?php echo $fetch_products['price']; ?></div>
            <div class="name"><?php echo $fetch_products['name']; ?></div>
            <input type="hidden" name="product_id" value="<?php echo $fetch_products['id']; ?> " >
            <input type="hidden" name="product_name" value="<?php echo $fetch_products['name']; ?> " >
            <input type="hidden" name="product_price" value="<?php echo $fetch_products['price']; ?> " >
            <input type="hidden" name="product_quantity" value="1" min="1" >
            <input type="hidden" name="product_id" value="<?php echo $fetch_products['image']; ?> " >
            <div class="iconot">
            <div class="icon">

                <button type="submit" name="add_to_cart">ADD TO CART</button>
                <a href="view_page.php?pid=<?php echo $fetch_products['id']; ?>">More Details</a>
            </div>
            </div>

        </form>

        <?php

            }
        }
        else {
            echo '<p class="empty"> No Products added yet !</p>';
            
        }
          ?>
    </div>
    
    <?php  
    include 'footer.php';
    ?>

    <script type="text/javascript" src="index.js"></script>
    
</body>
</html>













