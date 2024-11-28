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

  // delete product from cart 
 if (isset($_GET['delete'])) {
    $delete_id = $_GET['delete'];
   
    mysqli_query($conn, "DELETE  FROM cart WHERE id = '$delete_id' " ) or die ('query failed');
    
    echo '<script>
                    swal("Hongera", "Umefanikiwa kufuta bidhaa kikamilifu","success");
         </script>';
    //header('location:cart.php');
    

}
  // delete product from cart 
  if (isset($_GET['delete_all'])) {
    
   
    mysqli_query($conn, "DELETE  FROM cart WHERE user_id = '$user_id' " ) or die ('query failed');
    
    echo '<script>
                    swal("Hongera", "Umefanikiwa kufuta bidhaa kikamilifu","success");
         </script>';
    //header('location:cart.php');
    

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
        <h1> Shopping Cart</h1>
    </section>



    <div class="shop">



        <?php 
            $grand_total =0;
            $select_cart = mysqli_query($conn, "SELECT * FROM cart ") or die('query failed');
            if (mysqli_num_rows($select_cart)>0) {
                while ($fetch_cart = mysqli_fetch_assoc($select_cart)) {

        ?>
        <div class="card">
           <!-- <div class="iconot">
                <div class="icon">
                    <a href="cart.php?delete=<?php echo $fetch_cart['id']; ?>" onclick="return confirm('do you want to delete this product from your cart')"> DELETE </a>
                    <button type="submit" name="add_to_cart">ADD TO CART</button>
                    <a href="view_page.php?pid=<?php echo $fetch_cart['id']; ?>">More Details</a>
                </div>
            </div>
                -->
            <img src="image/<?php echo $fetch_cart['image']; ?>">
            <div class="price"><?php echo $fetch_cart['price']; ?></div>
            <div class="name"><?php echo $fetch_cart['name']; ?></div>
            <form method="post">
                <input type="hidden" name="update_qty_id" value="<?php echo $fetch_cart['id']; ?>">
                <div class="qty">
                    <input type="number" min="1"  name="update_qty_qty" value="<?php echo $fetch_cart['quantity']; ?>">
                    <input type="submit" value="update" name="update_qty_btn">
                </div>
            </form>
            <div class="total-amt">
                Total Amount : <span> <?php echo $total_amt = ($fetch_cart['price'] * $fetch_cart['quantity']); ?>  </span>
            </div>

        </div>

        <?php
            $grand_total+=$total_amt;


            }
        }
        else {
            echo '<p class="empty"> No Products added yet !</p>';
            
        }
          ?>
    </div>
    <div class="cart_total">
        <p>Total amount payable : <span>TSH<?php echo $grand_total; ?>/=</span></p>
        <a href="homeshop.php" class="btn">Continue Shoping</a>
        <a href="cart.php?delete_all" class="btn"<?php echo ($grand_total)? '': 'disabled'?> " onclick="return confirm('Do you want to delete all items in your cart')">DELETE ALL</a>

    </div>
    
    <?php  
        include 'footer.php';
    ?>

    <script type="text/javascript" src="index.js"></script>
    
</body>
</html>
