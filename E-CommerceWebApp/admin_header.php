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
        <div class="flex">
            <a href="admin_pannel.php" class="logo" style="color: black;" >C&K BEAUTY STORE </a>
            <nav class="navbar">
                <a href="admin_pannel.php">home</a>
                <a href="admin_product.php">products</a>
                <a href="admin_featured.php">featured</a>
                <a href="admin_order.php">orders</a>
                <a href="admin_user.php">users</a>
                <a href="admin_message.php">message</a>
            </nav>
            <div class="icons">
                <i class="fa-regular fa-user" id="user-btn"></i>
                <i class="fa-solid fa-bars" id="menu-btn"></i>
            </div>
            <div class="user-box">
                <p>Username : <span><?php echo $_SESSION['admin_name']; ?></span></p>
                <p>Email : <span><?php echo $_SESSION['admin_email']; ?></span></p>
                <form method="post">
                    <button type="submit" class="logout-btn" name="logout">log out</button>
                </form>
            </div>
        </div>
    </header>
    <div class="banner">
        <div class="detail">
            <h1>admin dashboard</h1>
            <p>Karibu sana admin <span><?php echo $_SESSION['admin_name']; ?></span> kwenye ukurasa wa admin utapoweza kuangalia na kuratibu bidhaa, watumiaji oders na kuangalia message mpya za wateja. </p>
            
        </div>
    </div>
    
    
</body>
</html>