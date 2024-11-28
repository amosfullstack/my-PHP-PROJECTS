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


if (isset($_POST['contact-submit'])) {
    $name = mysqli_real_escape_string($conn, $_POST['firstname']) ;
    $email =mysqli_real_escape_string($conn, $_POST['email']) ;
    $contacts = mysqli_real_escape_string($conn, $_POST['phone']) ;
    $messages = mysqli_real_escape_string($conn, $_POST['subject']) ;

    mysqli_query($conn, "INSERT INTO messages (`user_id`, `name`, `email`, `number`, `message`) VALUES ('$user_id', '$name', '$email ', '$contacts', '$messages')" ) or die ('query failed');
        




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




<section class="contact-us">
    <h2>contact <span>us</span></h2>
</section>
<section class="feedback">
    <div class="get-in-touch">
        <h1>Get In <span>Touch</span> </h1>
        <p>Kwa mawasiliano Na msaada zaidi unaweza kutupata moja kwa moja kupitia mawasiliano hapo chini.</p>
        <div class="mawgri">
            <div class="mawasilia">
                <img src="TESTimg/phone.png">
                <div class="maegri">
                    <h3>phone number</h3>
                    <p>+255 474663648</p>
                </div>
            </div>
            <div class="mawasilia"><img src="TESTimg/email.png"><div class="maegri"><h3>Email Address</h3><p>cajosbeautylab@gmail.com</p></div></div>
            <div class="mawasilia"><img src="TESTimg/web.png"><div class="maegri"><h3>Websites</h3><p>www.ckbeautystore.com</p></div></div>
            <div class="mawasilia"><img src="TESTimg/location.png"><div class="maegri"><h3>Address</h3><p>kariakoo</p></div></div>
        </div>
    </div>
    <div class="feed">
    <div class="Form-container">
            
            <form  method="post">
                <div class="row">
                    <div class="col-50">
                        <input type="text" id="fname" name="firstname" placeholder="Your Name...." required>
                    </div>
                    <div class="col-50">
                    <input type="email" id="email" name="email" placeholder="Your Email Adress...." required>
                    </div>
                </div>
                <div class="row">
                    <div class="col-100">
                        <input type="number" name="phone" id="number" placeholder="Tafadhali andika namba yako ya simu hapa......">
                    </div>
                </div>
                
                <div class="row">
                    <div class="col-100">
                        <textarea name="subject" id="subject" placeholder="Tuandikie Maoni Yako Hapa......" cols="100" rows="5" required></textarea>
                    </div>
                </div>
                <div class="row">
                    <input type="submit" value="Submit" name="contact-submit">
                </div>                
            </form>
        </div>
    </div>
</section>
<section class="consult">
    <img src="TESTimg/woman.png">
    <div class="consinfo">
        <h1>consult the services you need now!</h1>
        <p> Lorem ipsum dolor sit amet consectetur adipisicing elit. Voluptate ipsum quaerat, molestias sapiente tempore a doloremque amet atque maiores at perferendis quo autem repellendus nihil et pariatur laborum fuga ut! </p>
        <div class="consp">
            <ul>
                <li>Fast delivery </li>
                <li>Competitive Price </li>
                <li>Wide Delivery Area </li>
            </ul>
        </div>
        <a href="contact.php">Contact us</a>
    </div>
</section>










































<?php  
    include 'footer.php';
?>

    <script type="text/javascript" src="index.js"></script>
</body>
</html>