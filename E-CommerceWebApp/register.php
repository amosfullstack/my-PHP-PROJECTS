



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <script src="https://code.jquery.com/jquery-3.7.1.slim.min.js"></script>
    <script src="https://unpkg.com/sweetalert2@7.8.2/dist/sweetalert2.all.js"></script>

    
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link rel="stylesheet" href="adminstyle.css">
    <title>Register Form</title>

    
    <style>
body{
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
    
    max-width: 600px;
    margin: 5% auto;
    padding: 50px;
    box-shadow: 0px 7px 29px 0px black  ;
}
.form-group{
    margin-bottom: 30px;
}

</style>


</head>
<body>
    <?php
    if (isset($message)) {
        foreach ($message as $message) {
            echo '
            <div class="message">
                <span></span>
                <i class="bi bi-circle" onclick="this.parentElement.remove()"></i>
            </div>
            
            ';
        }
    }
    ?>
    <div class="container">
        
        <?php
            if (isset($_POST['submit-btn'])){
                $fullname =  $_POST['name'];
                $email =  $_POST['email'];
                $password =  $_POST['password'];
                $passwordRepeat =  $_POST['cpassword'];

                $passwordHash = password_hash($password, PASSWORD_DEFAULT);

                $errors = array();

                if (empty($fullname) OR empty($email) OR empty($password)  OR empty($passwordRepeat)) {
                    $message[] = 'Nafasi zote zinahitajika kujazwa';
                    array_push($errors, "Nafasi zote zinahitajika kujazwa");
                    
                }
                if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                    $message[] = 'Email uliyotoa sio sahihi';
                    array_push($errors, "Email uliyotoa sio sahihi");
                    
                }
                if (strlen($password) <8) {
                    $message[] = 'Nywila inatakiwa kuwa angalau na ukubwa wa characters 8';
                    array_push($errors, "Nywila inatakiwa kuwa angalau na ukubwa wa characters 8");
                    
                }
                if ($password!==$passwordRepeat) {
                    $message[] = 'Nywila hazifanani';
                    array_push($errors, "Nywila hazifanani");
                    
                }

                require_once "database.php";

                $sql = "SELECT * FROM users WHERE email = '$email' ";
                $result = mysqli_query($conn, $sql);
                $rowCount = mysqli_num_rows($result);
                if ($rowCount>0) {
                    $message[] = 'Email uliyoingiza tayari imesajiliwa';
                    array_push($errors, "Email uliyoingiza tayari imesajiliwa");

                }
                if (count($errors) >0) {
                    foreach ($errors as $error) {

                        echo '<script>
                            swal("Tatizo", "Ingiza taarifa vizuri na sahihi","warning");
                            </script>';
                        echo "<div class= 'alert alert-danger'>$error </div> ";
                    }
                }
                else{
                    
                    $sql = "INSERT INTO users (name, email, password) VALUES (?, ?, ?)";
                    $stmt = mysqli_stmt_init($conn);
                    $prepareStmt = mysqli_stmt_prepare($stmt,$sql);
                    if ($prepareStmt) {
                        mysqli_stmt_bind_param($stmt, "sss", $fullname,$email,$passwordHash);
                        mysqli_stmt_execute($stmt);
                      /*  echo '<script>
                            swal("Hongera", "Usajili wako umekamilika","success");
                            </script>';
                        echo "<div class= 'alert alert-success'> You are registered successfully. </div> "; */
                        $message[] = 'Usajili wako umekamilika';
                        header("Location:login.php");
                        
                        die();
                        
                    }
                    else{
                        die ("something went wrong");
                    }
                }

            }

        ?>

        <form action="register.php" method="post">
            <div class="form-group">
                <input type="text" class="form-control" name="name" placeholder="Enter your full name"  required>
            </div>
            <div class="form-group">
                <input type="email" class="form-control" name="email" placeholder="Enter your email"  required>
            </div>
            <div class="form-group">
                <input type="password" class="form-control" name="password" placeholder="Enter your password "  required>
            </div>
            <div class="form-group">
                <input type="password" class="form-control" name="cpassword" placeholder="Comfirm your password"   required>
            </div>
            <div class="form-btn">
                <input type="submit" class="btn btn-primary" name="submit-btn" value="register"  >
            </div>
            
            
            <p>Already have an account ? <a href="login.php"> login now</a></p>
        </form>
</div>
    
</body>
</html>