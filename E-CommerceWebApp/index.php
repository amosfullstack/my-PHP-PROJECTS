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
if (isset($_POST['add_to_cart'])) {
    $product_id = $_POST['product_id'];
    $product_name = $_POST['product_name'];
    $product_price = $_POST['product_price'];
    $product_image = $_POST['product_image'];
    $product_quantity = $_POST['product_quantity'];

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





<html lang="en">
<head>
    <meta charset="UTF-8">

    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
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
  
    <section class="introduction">
        <div class="intro-text">
            <p>Punguzo La Bei Hadi 40%</p>
            <h1> Vipodozi vya Asili Vya Aloe Vera </h1>
            <button><a href="#index.html">Angalia Zaidi</a></button>
        </div>
    </section>


    <section class="whyus">
        <h1>Why Shop With Us</h1>
        <div class="urembo"><div class="maroon"><div class="circle"></div></div></div>
        <div class="three">
            <div class="fastdel">
                <div class="fastdelimg"><img src="TESTimg/delivery.png"></div>
                <h1>Fast Delivery</h1>
                <p> Lorem ipsum dolor sit amet consectetur adipisicing elit. Officiis alias expedita neque consequatur accusamus dolore ex, </p>
            </div>
            <div class="fastdel">
                <div class="fastdelimg"><img src="TESTimg/together.png"></div>
                <h1>Free shipping</h1>
                <p> Lorem ipsum dolor sit amet consectetur adipisicing elit. Officiis alias expedita neque consequatur accusamus dolore ex,   </p>
            </div>
            <div class="fastdel">
                <div class="fastdelimg"><img src="TESTimg/best.png"></div>
                <h1>Best Quality</h1>
                <p> Lorem ipsum dolor sit amet consectetur adipisicing elit. Officiis alias expedita neque consequatur accusamus dolore ex,  </p>
            </div>

        </div>
    </section>

    <main>
        <div class="urembo"><div class="maroon"><div class="circle"></div></div></div>
        <div class="product-container" id="scroll-items">
            <div class="Scrollitems">
                <div class="poduct">
                    <img src="products/IMG-20240325-WA0035.jpg" alt="Aloe">
                    <h3>Mafuta ya aloe Vera</h3>
                </div>
                <div class="poduct">
                    <img src="products/IMG-20240325-WA0012.jpg" alt="Aloe">
                    <h3>Mafuta ya aloe Vera</h3>
                </div>
                <div class="poduct">
                    <img src="products/IMG-20240325-WA0043.jpg" alt="Aloe">
                    <h3>Mafuta ya aloe Vera</h3>
                </div>
                <div class="poduct">
                    <img src="products/IMG-20240325-WA0024.jpg" alt="Aloe">
                    <h3>Mafuta ya aloe Vera</h3>
                </div>
                <div class="poduct">
                    <img src="products/IMG-20240325-WA0022.jpg" alt="Aloe">
                    <h3>Mafuta ya aloe Vera</h3>
                </div>
                <div class="poduct">
                    <img src="products/IMG-20240325-WA0041.jpg" alt="Aloe">
                    <h3>Mafuta ya aloe Vera</h3>
                </div>
                <div class="poduct">
                    <img src="products/IMG-20240325-WA0018.jpg" alt="Aloe">
                    <h3>Mafuta ya aloe Vera</h3>
                </div>
                <div class="poduct">
                    <img src="products/IMG-20240325-WA0019.jpg" alt="Aloe">
                    <h3>Mafuta ya aloe Vera</h3>
                </div>
                <div class="poduct">
                    <img src="products/IMG-20240325-WA0020.jpg" alt="Aloe">
                    <h3>Mafuta ya aloe Vera</h3>
                </div>
                <div class="poduct">
                    <img src="products/IMG-20240325-WA0025.jpg" alt="Aloe">
                    <h3>Mafuta ya aloe Vera</h3>
                </div>
                <div class="poduct">
                    <img src="products/IMG-20240325-WA0023.jpg" alt="Aloe">
                    <h3>Mafuta ya aloe Vera</h3>
                </div>
                <div class="poduct">
                    <img src="products/IMG-20240325-WA0039.jpg" alt="Aloe">
                    <h3>Mafuta ya aloe Vera</h3>
                </div>
            </div>
        </div>
        <div class="indicator">
            <span class="dot filled" onclick="showItems(0)"></span>
            <span class="dot" onclick="showItems(-50)"></span>
        </div>
      <!--  <div class="About">
            <div class="Aboutphoto"><img src="images/landing4.jpg" alt=""></div>
            <div class="Aboutinfo">
                <h1>Kuhusu C&K Beauty Store</h1>
                <p>C&K Store Ni kampuni iliyoanzishwa kwaajili ya kuuza cosmetics na Bidhaa zote za urembo kwa wakaka na wadada <br>
                    Tunafanya delivery ndani na nje ya Dar es Salaam.Hoduma Zetu ni bora na tunakuhakikishia Bidhaa tunazokuuzia hazikusabishii Magonjwa Ya ngozi wala kukuchubua.
                    Jukumu letu ni kukupa bidhaa bora wakati huo tukijali afya yako ya ngozi na Furaha yetu kuona unapendeza unavutia na kuridhika na huduma zetu.
                </p>
            </div>
        </div>
-->
        <div class="twoitems">
            <div class="item0 uno"><div class="hombre"><p>Punguzo la 25%</p><h1>Mafuta Ya Ngozi Ya Nivea</h1><button><a href="#index.html">Angalia Zaidi</a></button></div></div>
            <div class="item0 dos"><div class="hombre"><p>Punguzo la 25%</p><h1>Mafuta Ya Asili Ya Kannies</h1><button><a href="#index.html">Angalia Zaidi</a></button></div></div>
        </div>
    </main>
    <section class="trending">
        <h1>Bidhaa zinazotamba</h1>
        <div class="urembo"><div class="maroon"><div class="circle"></div></div></div>
        <div class="trendmenu">
            <ul>
                <li> <a href="#index.html" id="active">Matunzo Ya Ngozi</a></li>
                <li> <a href="#index.html">Matunzo Ya Nywele</a></li>
                <li> <a href="#index.html" > Manukato </a></li>
            </ul>
        </div>


        


    <div class="shop">
        <?php 
            $select_products = mysqli_query($conn, "SELECT * FROM featured_products ") or die('query failed');
            if (mysqli_num_rows($select_products)>0) {
                while ($fetch_products = mysqli_fetch_assoc($select_products)) {

        ?>
        <form  method="POST" class="card">
            <img  src="images/<?php echo $fetch_products['image']; ?>">
            <div class="price"><?php echo $fetch_products['price']; ?>/=</div>
            <div class="name"><?php echo $fetch_products['name']; ?></div>
            <input type="hidden" name="product_id" value="<?php echo $fetch_products['id']; ?> " >
            <input type="hidden" name="product_name" value="<?php echo $fetch_products['name']; ?> " >
            <input type="hidden" name="product_price" value="<?php echo $fetch_products['price']; ?> " >
            <input type="hidden" name="product_quantity" value="1" min="1" >
            <input type="hidden" name="product_image" value="<?php echo $fetch_products['image']; ?> " >
            <div class="iconot">
            <div class="icon">
                <button type="submit" name="add_to_cart">ADD TO CART</button>
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
    

















<!--

        <div class="trending-product-container">
            <div class="trending-product">
                <div class="trendimg"><img src="products/IMG-20240325-WA0015.jpg" alt="Aloe"></div>
                <div class="stars"> <i class="fa fas star"></i> </div>
                <h3>Lotion Ya Johnson's</h3>
                <div class="price"><h4><s>2500 TSH</s></h4><h3>1500 TSH</h3></div>
                <div class="buybtn"><button><a href="">Nunua Sasa</a></button></div>
            </div>
            <div class="trending-product">
                <div class="trendimg"><img src="products/IMG-20240325-WA0016.jpg" alt="Aloe"></div>
                <div class="stars"> <i class="fa fas star"></i> </div>
                <h3>Lotion Ya Papaya</h3>
                <div class="price"><h3>1500 TSH</h3></div>
                <div class="buybtn"><button><a href="">Nunua Sasa</a></button></div>
            </div>
            <div class="trending-product">
                <div class="trendimg"><img src="products/IMG-20240325-WA0044.jpg" alt="Aloe"></div>
                <div class="stars"> <i class="fa fas star"></i> </div>
                <h3>Mafuta Ya Ngozi Ya Portia</h3>
                <div class="price"><h4><s>2500 TSH</s></h4><h3>1500 TSH</h3></div>
                <div class="buybtn"><button><a href="">Nunua Sasa</a></button></div>
            </div>
            <div class="trending-product">
                <div class="trendimg"><img src="products/IMG-20240325-WA0038.jpg" alt="Aloe"></div>
                <div class="stars"> <i class="fa fas star"></i> </div>
                <h3>Lotion Ya Nivea</h3>
                <div class="price"><h4><s>2500 TSH</s></h4><h3>1500 TSH</h3></div>
                <div class="buybtn"><button><a href="">Nunua Sasa</a></button></div>
            </div>
            <div class="trending-product">
                <div class="trendimg"><img src="products/IMG-20240325-WA0029.jpg" alt="Aloe"></div>
                <div class="stars"> <i class="fa fas star"></i> </div>
                <h3>Mafuta ya Olive Oil</h3>
                <div class="price"></h4><h3>1500 TSH</h3></div>
                <div class="buybtn"><button><a href="">Nunua Sasa</a></button></div>
            </div>
            <div class="trending-product">
                <div class="trendimg"><img src="products/IMG-20240325-WA0018.jpg" alt="Aloe"></div>
                <div class="stars"> <i class="fa fas star"></i> </div>
                <h3>Cream Ya Rinju</h3>
                <div class="price"><h4><s>2500 TSH</s></h4><h3>1500 TSH</h3></div>
                <div class="buybtn"><button><a href="">Nunua Sasa</a></button></div>
            </div>
            <div class="trending-product">
                <div class="trendimg"><img src="products/IMG-20240325-WA0019.jpg" alt="Aloe"></div>
                <div class="stars"> <i class="fa fas star"></i> </div>
                <h3>Portia Face Wash</h3>
                <div class="price"><h3>1500 TSH</h3></div>
                <div class="buybtn"><button><a href="">Nunua Sasa</a></button></div>
            </div>
            <div class="trending-product">
                <div class="trendimg"><img src="products/IMG-20240325-WA0014.jpg" alt="Aloe"></div>
                <div class="stars"> <i class="fa fas star"></i> </div>
                <h3>Mafuta Ya Amara Kwa Wanaume</h3>
                <div class="price"><h4><s>2500 TSH</s></h4><h3>1500 TSH</h3></div>
                <div class="buybtn"><button><a href="">Nunua Sasa</a></button></div>
            </div>
            <div class="trending-product">
                <div class="trendimg"><img src="products/IMG-20240325-WA0042.jpg" alt="Aloe"></div>
                <div class="stars"> <i class="fa fas star"></i> </div>
                <h3>Deodorant Ya Nivea</h3>
                <div class="price"><h3>1500 TSH</h3></div>
                <div class="buybtn"><button><a href="">Nunua Sasa</a></button></div>
            </div>
        </div>

    </section>



    


-->


<?php  
    include 'footer.php';
?>

    <script type="text/javascript" src="index.js"></script>
</body>
</html>