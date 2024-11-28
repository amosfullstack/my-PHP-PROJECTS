
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
   
    
    mysqli_query($conn, "DELETE  FROM messages WHERE id = '$delete_id' " ) or die ('query failed');
    echo '<script>
                    swal("Hongera", "Umefanikiwa kufuta message kikamilifu","success");
         </script>';
    //header('location:admin_message.php');
    

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
    
    <section class="message-container">
        <h1 class="title" style="text-align: center;"> Unread message</h1>
        <div class="box-container">
            <?php
                $select_message = mysqli_query($conn, "SELECT *  FROM messages " ) or die ('query failed');
                if (mysqli_num_rows($select_message)>0) {
                    while ($fetch_message = mysqli_fetch_assoc($select_message)) {

            ?>
            <div class="box">
                <p>user id: <span><?php echo $fetch_message['id']; ?></span> </p>
                <p>name: <span><?php echo $fetch_message['name']; ?></span> </p>
                <p>email: <span><?php echo $fetch_message['email']; ?></span> </p>
                <p><?php echo $fetch_message['message']; ?></p>
                <a href="admin_message.php?delete=<?php echo $fetch_message['id']; ?>;" onclick="return comfirm('delete this message');" class="delete">delete</a>
            </div>
            <?php
                    }
                    
                }
                else {
                    echo '
                    <div class="empty">
                            <p>No message added yet!</p>
                    
                        </div>
                    
                    ';
                }
            ?>
        </div>

    </section>
    
    
    <script type="text/javascript" src="script.js"> </script>
    
</body>
</html>