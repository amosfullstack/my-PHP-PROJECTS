<?php
//connect to the database to insert the New Client
$server="localhost";
$username="root";
$password="";
$database="myshop";

//create a connection
$connection= new mysqli($server, $username, $password, $database);
//php code to read the submitted data
$name="";
$email="";
$phone="";
$address="";
$errorMessage="";
$successMessage="";
//variables are initialised to empty values and we shall use them to fill the form

//check if data has been tranmitted with post method
if( $_SERVER['REQUEST_METHOD']=='POST'){
    $name= $_POST["name"];
    $email= $_POST["email"];
    $phone= $_POST["phone"];
    $address= $_POST["address"];

    //use do while to make sure all fields are filled else display an error message
    do{
        if(empty($name) || empty($email) || empty($phone) || empty($address)){
            $errorMessage ="All the fields are required";
            break;
        }
        

        //Insert a new client Just Here
        $sql= "INSERT INTO clients(name, email, phone, address)".
              "VALUES ('$name','$email','$phone','$address')";
        $result= $connection->query($sql);
        
        //error handling
        if(!$result){
            $errorMessage= "Invalid querry: ". $connection->error;
            break;
        }

        //add new client to the database
        $name="";
        $email="";
        $phone="";
        $address="";
        $successMessage= "Client added correctly";

        //redirect the user to the list of clients
        header("location: /myShopapp/index.php");
        exit;
    }while(false);
}
?>
<!DOCTYPE html>
<html>
    <head>
        <title>My Shop</title>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">>

        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    </head>
    <div class="container my-5">
        <h2>New Client</h2>
<!--Displaying the error message here just before the form-->
   <?php
   if( !empty($errorMessage)){
    echo "
    <div class='alert alert-warning alert-dismissible fade show' role='alert'>
    <strong>$errorMessage</strong>
    <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
    </div>
     ";
   } ?>
        <form method="post">
            <div class="row mb-3">
                <label class="col-sm-3 col-form-label">Name</label>
                <div class="col-sm-6">
                    <input type="text" class="form-control" name="name" value="<?php echo $name; ?>">
                 </div>
            </div>
            <div class="row mb-3">
                <label class="col-sm-3 col-form-label">Email</label>
                <div class="col-sm-6">
                    <input type="text" class="form-control" name="email" value="<?php echo $email;?>">
                 </div>
            </div>
            <div class="row mb-3">
                <label class="col-sm-3 col-form-label">Phone</label>
                <div class="col-sm-6">
                    <input type="text" class="form-control" name="phone" value="<?php echo $phone;?>">
                 </div>
            </div>
            <div class="row mb-3">
                <label class="col-sm-3 col-form-label">Address</label>
                <div class="col-sm-6">
                    <input type="text" class="form-control" name="address" value="<?php echo $address ?>">
                 </div>
            </div>
<!--Displaying the success message if the error message is empty, we display the 
error message just before the two buttons-->
            <?php
            if( !empty($successMessage)){
                echo "
                <div class='row mb-3'>
                  <div class='offset-sm-3 col-sm-6>
                    <div class='alert alert-success alert-dismissible fade show' role='alert'>
                    <strong>$successMessage</strong>
                    <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'>
                    
                    </div>
                  </div>
                </div> 
                
                ";
            }
            ?>
            <div class="row mb-3">
                <div class="offset-sm-3 col-sm-3 d-grid">
                <button type="submit" class="btn btn-primary" >Submit</button>
                </div>
                <div class="col-sm-3 d-grid">
                    <a class="btn btn-outline-primary" href="/myShopapp/index.php" role="button">Cancel</a>
                 </div>
            </div>

        </form>
    </div>
</html>