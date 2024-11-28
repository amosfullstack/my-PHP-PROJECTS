
<?php
include 'database.php';
session_start();
$admin_id = $_SESSION['admin_name'];

if (!isset($admin_id)) {
    header('location:login.php');
}
if (isset($_POST['logout'])) {
    session_destroy();
    header('location:login.php');
}


if (isset($_POST['add_product'])) {
    $product_name =$_POST['name'];
    $product_price =$_POST['price'];
    $product_detail =$_POST['detail'];
    $image =$_FILES['image']['name'];
    $image_size =$_FILES['image']['size'];
    $image_tmp_name =$_FILES['image']['tmp_name'];
    $image_folder ='images/'.$image;

    move_uploaded_file($image_tmp_name, $image_folder);

    $select_product_name = mysqli_query($conn, "SELECT name  FROM featured_products WHERE name = '$product_name' " ) or die ('query failed');
    if (mysqli_num_rows($select_product_name)>0) {
        echo '<script>
        swal("Tatizo", "Jina la product tayari lipo","warning");
        </script>';
    }
    else {
        $insert_product = mysqli_query($conn, "INSERT INTO featured_products (`name`, `price`, `product_detail`, `image`) VALUES ('$product_name', '$product_price', '$product_detail ', '$image')" ) or die ('query failed');
        
        if ($insert_product) {
            if ($image_size > 2000000) {
                echo '<script>
                swal("Tatizo", "picha uliyoingiza ina size kubwa sana","warning");
                </script>';
                
            }
            else {
                
                echo '<script>
                    swal("Hongera", "Umefanikiwa kuongeza bidhaa kikamilifu","success");
                    </script>';
            }
        }
    }

}
// delete products from database
if (isset($_GET['delete'])) {
    $delete_id = $_GET['delete'];
    $select_delete_image = mysqli_query($conn, "SELECT image  FROM featured_products WHERE id = '$delete_id' " ) or die ('query failed');
    $fetch_delete_image =mysqli_fetch_assoc($select_delete_image);
    unlink('images/'.$fetch_delete_image['image']);

    mysqli_query($conn, "DELETE  FROM featured_products WHERE id = '$delete_id' " ) or die ('query failed');
    mysqli_query($conn, "DELETE  FROM cart WHERE pid = '$delete_id' " ) or die ('query failed');
    mysqli_query($conn, "DELETE  FROM wishlist WHERE pid = '$delete_id' " ) or die ('query failed');
    echo '<script>
                    swal("Hongera", "Umefanikiwa kufuta bidhaa kikamilifu","success");
         </script>';
    //header('location:admin_product.php');
    

}

    //update product
    if (isset($_POST['update_product'])) {
        $update_id = $_POST['update_id'];
        $update_name = $_POST['update_name'];
        $update_price = $_POST['update_price'];
        $update_detail = $_POST['update_detail'];
        $update_image = $_FILES['update_image']['name'];
        $update_image_tmp_name = $_FILES['update_image']['tmp_name'];
        $update_image_folder = 'images/'.$update_image;

        $update_query = mysqli_query($conn, "UPDATE  featured_products SET id= '$update_id',name='$update_name', price='$update_price', product_detail='$update_detail', image='$update_image' WHERE id ='$update_id' " ) or die ('query failed');
        if ($update_query) {
            move_uploaded_file($update_image_tmp_name, $update_image_folder);
            header('location:admin_product.php');
        }

    }

?>
<style type="text/css">
    <?php
    include 'adminstyle.css'; 
    
    ?>
</style>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://code.jquery.com/jquery-3.7.1.slim.min.js"></script>
    <script src="https://unpkg.com/sweetalert2@7.8.2/dist/sweetalert2.all.js"></script>

    
    <link rel="stylesheet" href="adminstyle.css">
    <title>admin pannel</title>
</head>
<body>
    <?php include 'admin_header.php'; ?>
    <div class="line2"></div>
    <section class="add-products form-container">
        <form action="" enctype="multipart/form-data" method="post">
            <div class="input-field">
                <label> product name</label>
                <input type="text" name="name" id="" required>
            </div>
            <div class="input-field">
                <label> product price</label>
                <input type="text" name="price" id="" required>
            </div>
            <div class="input-field">
                <label> product detail</label>
                <textarea name="detail" required></textarea>
            </div>
            <div class="input-field">
                <label> product image</label>
                <input type="file" name="image" accept="image/jpg,image/jpeg,image/png,image/webp" required>
            </div>
            <input type="submit" value="add product" name="add_product" class="btn">
        </form>
    </section>
    <section class="show-products">
        <div class="box-container">
            <?php
                $select_products = mysqli_query($conn, "SELECT *  FROM featured_products " ) or die ('query failed');
                if (mysqli_num_rows($select_products)>0) {
                    while ($fetch_products = mysqli_fetch_assoc($select_products)) {
                        ?>
                        <div class="box">
                            <img src="images/<?php echo $fetch_products['image'] ?>" >
                            <p>price : $<?php echo $fetch_products['price'] ?> </p>
                            <h4><?php echo $fetch_products['name'] ?></h4>
                            <details> <?php echo $fetch_products['product_detail'] ?></details>
                            <a href="admin_product.php?edit=<?php echo $fetch_products['id']; ?>" class="edit">edit</a>
                            <a href="admin_product.php?delete=<?php echo $fetch_products['id']; ?>" class="delete" onclick="return comfirm( 'want to delete this product' );">delete</a>
                            
                    
                        </div>
                        <?php

                    }
                
                }
                else {
                    echo '
                    <div class="empty">
                            <p>No products added yet!</p>
                    
                        </div>
                    
                    ';
                }

            ?>
        </div>
    </section>

    <section class="update-container">
        <?php 
            if (isset($_GET['edit'])) {
                $edit_id = $_GET['edit'];
                $edit_query = mysqli_query($conn, "SELECT *  FROM featured_products WHERE id = '$edit_id' " ) or die ('query failed');
                if (mysqli_num_rows($edit_query) >0) {
                    while ($fetch_edit = mysqli_fetch_assoc($edit_query) ) {
        ?>
        <form action="" method="POST" enctype="multipart/form-data">
            <img src="images/<?php echo $fetch_edit['image']; ?>">
            <input type="hidden" name="update_id" value="<?php echo $fetch_edit['id']; ?> " >
            <input type="text" name="update_name" value="<?php echo $fetch_edit['name']; ?> " >
            <input type="number" name="update_price" min ="0" value="<?php echo $fetch_edit['price']; ?> " >
            <textarea name="update_detail"><?php echo $fetch_edit['product_detail']; ?></textarea>
            <input type="file" name="update_image" accept="images/jpg,image/jpeg,image/png,image/webp">
            <input type="submit" value="update" name="update_product" class="edit">
            <input type="reset" value = "cancel" class="option-btn btn" id="close-form">

        </form>

        <?php

                    }
                }
                
            
                echo "<script> document.querySelector('.update-container').style.display ='block'</script>";
            
            }
            
         ?>
    </section>
    
    
    <script type="text/javascript" src="script.js"> </script>
    
</body>
</html>