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


// delete products from database
if (isset($_GET['delete'])) {
    $delete_id = $_GET['delete'];
   
    
    mysqli_query($conn, "DELETE  FROM orders WHERE id = '$delete_id' " ) or die ('query failed');
    echo '<script>
                    swal("Hongera", "Umefanikiwa kufuta kumuondoa mtumiaji kikamilifu","success");
         </script>';
    //header('location:admin_order.php');
    

}

    //updateing payment status
    if (isset($_POST['update_order'])) {
        $order_id = $_POST['order_id'];
        $update_payment = $_POST['update_payment'];

        mysqli_query($conn, "UPDATE  orders SET payment_status = '$update_payment' WHERE id = '$order_id' " ) or die ('query failed');
        echo '<script>
                    swal("Hongera", "Umefanikiwa kufanya mabadiliko katika order kikamilifu","success");
         </script>';

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
    
    <section class="order-container">
        <h1 class="title" style="text-align: center;"> total orders</h1>
        <div class="box-container">
            <?php
                $select_orders = mysqli_query($conn, "SELECT *  FROM orders " ) or die ('query failed');
                if (mysqli_num_rows($select_orders)>0) {
                    while ($fetch_orders = mysqli_fetch_assoc($select_orders)) {

            ?>
            <div class="box">
                <p>user name: <span><?php echo $fetch_orders['name']; ?></span> </p>
                <p>user id: <span><?php echo $fetch_orders['user_id']; ?></span> </p>
                <p>placed on: <span><?php echo $fetch_orders['placed_on']; ?></span> </p>
                <p> number: <span> <?php echo $fetch_orders['number']; ?></span></p>
                <p> email: <span> <?php echo $fetch_orders['email']; ?></span></p>
                <p> total price: <span> <?php echo $fetch_orders['total_price']; ?></span></p>
                <p> method: <span> <?php echo $fetch_orders['method']; ?></span></p>
                <p> address: <span> <?php echo $fetch_orders['address']; ?></span></p>
                <p> total product: <span> <?php echo $fetch_orders['total_products']; ?></span></p>
                <form  method="post">
                    <input type="hidden" name="order_id" value="<?php echo $fetch_orders['id']; ?>">
                    <select name="update_payment">
                        <option disabled selected><?php echo $fetch_orders['payment_status']; ?></option>
                        <option value="pending">pending</option>
                        <option value="complete">complete</option>
                    </select>
                    <input type="submit" value="update payment" name="update_order" class="btn">
                    <a href="admin_order.php?delete=<?php echo $fetch_orders['id']; ?>;" onclick="return comfirm('delete this message');" class="delete">delete</a>
                </form>
                
            </div>
            <?php
                    } 
                    
                }
                else {
                    echo '
                    <div class="empty">
                            <p>No order placed  yet!</p>
                    
                        </div>
                    
                    ';
                }
            ?>
        </div>

    </section>
    
    
    <script type="text/javascript" src="script.js"> </script>
    
</body>
</html>