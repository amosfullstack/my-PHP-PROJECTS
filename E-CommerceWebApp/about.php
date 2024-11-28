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






?>
<style type="text/css">
    <?php  
    include 'index.css';
     ?>
</style>





<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>C&K Beauty Store</title>
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

<section class="about-us">
    <div class="abot">
    <h2>About <span>us</span></h2>
    <p>Lorem ipsum dolor sit amet consectetur, adipisicing elit. Est error deserunt voluptatum molestias iure nisi aperiam, quia dicta ab voluptas molestiae debitis amet excepturi commodi! Ea facilis totam exercitationem nobis.</p>
    </div>
</section>
<section class="our-mission">
    
    <div class="abotmiss">
        <h1>Our mission</h1>
        <p>Lorem ipsum dolor sit, amet consectetur adipisicing elit. Dignissimos, similique magnam, sit quod minima officiis modi doloremque dolorem libero commodi unde saepe repellat aliquid, reiciendis aperiam ipsam. Beatae, impedit assumenda!</p>
        <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Possimus modi laboriosam magnam! Placeat consectetur ipsa, omnis ex exercitationem numquam dolorum nam commodi neque iste corrupti tenetur, autem sunt? Adipisci, placeat!</p>
    </div>
    <div class="abotimg"><img src="TESTimg/6bfb797f8cfd5e0f52b558d15d98bcb9.jpg" alt=""></div>
</section>
<section class="meetleader">
    <h1>Meet Our Team</h1>
    <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Possimus modi laboriosam magnam! Placeat consectetur ipsa, omnis ex exercitationem numquam dolorum nam commodi neque iste corrupti tenetur, autem sunt? Adipisci, placeat!</p>
    
    <div class="leaders">
    <div class="learder">
        <div class="team">
            <img src="TESTimg/contactu.jpg" alt="leader1">
            <h3>kelvin mafie</h3>
            <div class="socil">
                <i class="fa-brands fa-instagram fa-xl"></i>
                <i class="fa-brands fa-facebook fa-xl"></i>
                <i class="fa-brands fa-twitter fa-xl"></i>
            </div>

        </div>
    </div>
    <div class="learder">
        <div class="team">
            <img src="TESTimg/contactu.jpg" alt="leader1">
            <h3>calvin mwakasaka</h3>
            <div class="socil">
                <i class="fa-brands fa-instagram fa-xl"></i>
                <i class="fa-brands fa-facebook fa-xl"></i>
                <i class="fa-brands fa-twitter fa-xl"></i>
            </div>

        </div>
    </div>
    </div>
</section>
<section class="clients">
    <h1 style="text-align: center;">What Our Clients Says</h1>
    <div class="cliens">
    <div class="client">
        <p>Lorem ipsum, dolor sit amet consectetur adipisicing elit. Corrupti amet ex consequuntur id voluptates ducimus eius officia? Reiciendis amet quis possimus, quisquam dolorem inventore modi nisi. Totam reiciendis optio ipsam!</p>
        <h1>happy</h1>
        <img src="TESTimg/321cefc7f9b9aee2dff826663e0b54db.jpg" alt="">
    </div>
    <div class="client">
        <p>Lorem ipsum, dolor sit amet consectetur adipisicing elit. Corrupti amet ex consequuntur id voluptates ducimus eius officia? Reiciendis amet quis possimus, quisquam dolorem inventore modi nisi. Totam reiciendis optio ipsam!</p>
        <h1>happy</h1>
        <img src="TESTimg/321cefc7f9b9aee2dff826663e0b54db.jpg" alt="">
    </div>
    <div class="client">
        <p>Lorem ipsum, dolor sit amet consectetur adipisicing elit. Corrupti amet ex consequuntur id voluptates ducimus eius officia? Reiciendis amet quis possimus, quisquam dolorem inventore modi nisi. Totam reiciendis optio ipsam!</p>
        <h1>happy</h1>
        <img src="TESTimg/321cefc7f9b9aee2dff826663e0b54db.jpg" alt="">
    </div>
    </div>
</section>






<?php  
    include 'footer.php';
?>

    <script type="text/javascript" src="index.js"></script>
</body>
</html>