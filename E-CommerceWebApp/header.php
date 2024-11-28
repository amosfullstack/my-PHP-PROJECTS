<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <title>Document</title>
</head>
<body>
    <header class="header">
        <p class="para">Mawasiliano:  (+255) 748 865 103</p>
        <div class="flex">
            <a href="index.php" class="logo" style="color: black;" ><span style="color:brown;font-size:larger;font-family:'Lucida Sans', 'Lucida Sans Regular', 'Lucida Grande', 'Lucida Sans Unicode', Geneva, Verdana, sans-serif;font-weight:bolder;">C</span>& <span style="color:orange;font-size:larger;font-family:'Lucida Sans', 'Lucida Sans Regular', 'Lucida Grande', 'Lucida Sans Unicode', Geneva, Verdana, sans-serif;font-weight:bolder;">K</span> BEAUTY STORE </a>
            <nav class="navbar">
                <a href="index.php">Home</a>
                <a href="about.php">About</a>
                <a href="homeshop.php">Shop</a>
                <a href="order.php">Order</a>
                <a href="contact.php">Contact</a>
            </nav>
            <div class="icons">
                <i class="fa-regular fa-user" id="user-btn"></i>
                
                <?php 
                $select_cart = mysqli_query($conn, "SELECT * FROM cart WHERE user_id = 'user_id' ") or die('query failed');
                $cart_num_row = mysqli_num_rows($select_cart);
                ?>
                <a href="cart.php"><i class="fa-solid fa-cart-shopping"></i> <sup><?php echo $cart_num_row; ?></sup> </a>
                <i class="fa-solid fa-bars" id="menu-btn"></i>
        </div>
        <div class="user-box">
                <p>Username : <span><?php echo $_SESSION['user_name']; ?></span></p>
                <p>Email : <span><?php echo $_SESSION['user_email']; ?></span></p>
                <form method="post">
                    <button type="submit" class="logout-btn" name="logout">log out</button>
                </form>
        </div>
            
        </div>
       
    </header>
    
    
    
    
</body>
</html>