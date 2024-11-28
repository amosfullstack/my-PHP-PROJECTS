<?php
//connect to the database
$server="localhost";
$username="root";
$password="";
$database="myshop";

//create a connection
$connection= new mysqli($server, $username, $password, $database);

//initialize the varibales
$id="";
$name="";
$email="";
$phone="";
$address="";

$errorMessage="";
$successMessage="";

if( $_SERVER['REQUEST_METHOD']=='GET'){
    //GET method: Show data of the client
    if(!isset($_GET["id"])){
        header("location: /myShopapp/index.php");
        exit;
    }
    $id= $_GET["id"];
    //read the row of the selected client from the databese
    $sql="SELECT * FROM clients WHERE id = $id";
    $result= $connection->query($sql);
    $row= $result->fetch_assoc();

    //if we do not have any data from the database we have to redirect the user to the index page and exit the execution of the file
    if(!$row){
        header("location: /myshop/index.php");
        exit;
    }

    //otherwise we can read the data from the databse and store them in the four variables
    $name= $row["name"];
    $email=$row["email"];
    $phone=$row["phone"];
    $address=$row["address"];
}
else{
    //POST method: Update the data of the client
    //lets read the data of the form
    $name= $row["name"];
    $email=$row["email"];
    $phone=$row["phone"];
    $address=$row["address"];

    //Now we can make sure that no varibale is empty
    do{
        if(empty($name) || empty($email) || empty($phone) || empty($address)){
            $errorMessage ="All the fields are required";
            break;
        }

        //sql query to update the data of clients
        $sql="UPDATE clients".
             "SET name='$name', email='$email',phone='$phone',address='$address'".
             "WHERE id=$id";

             //executing the sql querry
             $result=$connection->query($sql);

             //check whether the query has been excecuted correctly or not
             if(!$result){
                $errorMessage= "Invalid query: " .$connection->error;
                break;
             }
    //Display the success message otherwise

             $successMessage=" Client Updated Correctly";

             //redirect the user to the index page
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
            <input type="hidden" name="id" value="<?php echo $id?>">
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