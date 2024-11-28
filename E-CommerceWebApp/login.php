<?php
include 'database.php';
session_start();

if (isset($_POST['submit-btn'])){
    $email = $_POST['email'];
    $password =  $_POST['password'];
    require_once "database.php";
    $sql = "SELECT * FROM users WHERE email = '$email' ";
    $result = mysqli_query($conn, $sql);
    $user = mysqli_fetch_array($result, MYSQLI_ASSOC);
    if ($user) {
        if (password_verify($password,$user["password"])) {
            $select_user = mysqli_query($conn, "SELECT * FROM users WHERE email = '$email' ") ;

            if (mysqli_num_rows($select_user)>0) {
                $row = mysqli_fetch_assoc($select_user);
                if ($row['user_type'] =='admin') {
                    $_SESSION['admin_name'] = $row['name'];
                    $_SESSION['admin_email'] = $row['email'];
                    $_SESSION['admin_id'] = $row['id'];
                    header("Location:admin_pannel.php");
                    die();
                }
                elseif ($row['user_type']=='user') {
                    $_SESSION['user_name'] = $row['name'];
                    $_SESSION['user_email'] = $row['email'];
                    $_SESSION['user_id'] = $row['id'];
                    header("Location:index.php");
                    die();
                }
                else {
                    echo '<script>
                    swal("Hongera", "Umefanikiwa kulogin","success");
                    </script>';
                }
            }




           /* echo '<script>
            swal("Hongera", "Umefanikiwa kulogin","success");
            </script>'; */
            
            
           
        }
        else{
            echo '<script>
            swal("Makosa", " Umekosea nywila","error");
            </script>';
            echo "<div class= 'alert alert-danger'> Umekosea nywila </div> ";
        }
    }
    else{
        echo '<script>
        swal("Makosa", "Email uliyoingiza haipo","error");
        </script>';
        echo "<div class= 'alert alert-danger'> Email uliyoingiza haipo </div> ";
    }

        
}





?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <script src="https://code.jquery.com/jquery-3.7.1.slim.min.js"></script>
    <script src="https://unpkg.com/sweetalert2@7.8.2/dist/sweetalert2.all.js"></script>

    <link rel="stylesheet" href="adminstyle.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <title>Login Form</title>

    <style>
body{
    width: 100%;
    padding: 50px;
    background-color: white;
}
a{
    text-decoration: none;
}
ul{
    list-style: none;
}
.btn{
    text-transform: uppercase;
    border-radius: 10px;
    cursor: pointer;
}
.container{
    top: 50;
    max-width: 600px;
    margin: 10% auto;
    padding: 50px;
    box-shadow: 0px 7px 29px 0px black  ;
}
.form-group{
    margin-bottom: 30px;
}
@media (max-width:991px) {
    .container{
    
    max-width: 600px;
    margin: 20% auto;
    padding: 50px;
    
}

}
</style>
</head>
<body>
    <div class="container">
        <?php
        ?>
        
        
 
        <form action="login.php" method="post">
            
            <div class="form-group">
                <input type="email" class="form-control" name="email" placeholder="Ingiza email yako"  required>
            </div>
            <div class="form-group">
                <input type="password" class="form-control" name="password" placeholder="Ingiza password yako "  required>
            </div>
            
            <div class="form-btn">
                <input type="submit" class="btn btn-primary" name="submit-btn" value="submit"  >
            </div>
            
            
            <p>You  have no account ? <a href="register.php"> register now</a></p>
        </form>
</div>
    
</body>
</html>