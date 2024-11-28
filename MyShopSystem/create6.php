<?php
// PHP code to read the submitted data
$name = "";
$email = "";
$phone = "";
$address = "";
$errorMessage = "";
$successMessage = "";

// Check if data has been transmitted with POST method
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $name = $_POST["name"];
    $email = $_POST["email"];
    $phone = $_POST["phone"];
    $address = $_POST["address"];

    // Use do-while loop to make sure all fields are filled, else display an error message
    do {
        if (empty($name) || empty($email) || empty($phone) || empty($address)) {
            $errorMessage = "All the fields are required";
            break;
        }

        // Add new client to the database
        // Assume you have a database connection stored in $conn
        $conn = new mysqli("localhost", "username", "password", "database");
        if ($conn->connect_error) {
            $errorMessage = "Connection failed: " . $conn->connect_error;
            break;
        }

        $sql = "INSERT INTO clients (name, Email, phone, address) VALUES ('$name', '$email', '$phone', '$address')";
        if (!$conn->query($sql)) {
            $errorMessage = "Error: " . $sql . "<br>" . $conn->error;
            break;
        }

        // Clear the form fields
        $name = "";
        $email = "";
        $phone = "";
        $address = "";
        $successMessage = "Client added correctly";

        $conn->close();
    } while (false);
}
?>

<!DOCTYPE html>
<html>
    <head>
        <title>My Shop</title>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    </head>
    <body>
        <div class="container my-5">
            <h2>New Client</h2>
            <!-- Displaying the error message here just before the form -->
            <?php if (!empty($errorMessage)) {
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
                        <input type="text" class="form-control" name="name" value="<?php echo htmlspecialchars($name); ?>">
                    </div>
                </div>
                <div class="row mb-3">
                    <label class="col-sm-3 col-form-label">Email</label>
                    <div class="col-sm-6">
                        <input type="email" class="form-control" name="email" value="<?php echo htmlspecialchars($email); ?>">
                    </div>
                </div>
                <div class="row mb-3">
                    <label class="col-sm-3 col-form-label">Phone</label>
                    <div class="col-sm-6">
                        <input type="text" class="form-control" name="phone" value="<?php echo htmlspecialchars($phone); ?>">
                    </div>
                </div>
                <div class="row mb-3">
                    <label class="col-sm-3 col-form-label">Address</label>
                    <div class="col-sm-6">
                        <input type="text" class="form-control" name="address" value="<?php echo htmlspecialchars($address); ?>">
                    </div>
                </div>
                <!-- Displaying the success message -->
                <?php if (!empty($successMessage)) {
                    echo "
                    <div class='row mb-3'>
                        <div class='offset-sm-3 col-sm-6'>
                            <div class='alert alert-success alert-dismissible fade show' role='alert'>
                                <strong>$successMessage</strong>
                                <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
                            </div>
                        </div>
                    </div>
                    ";
                } ?>
                <div class="row mb-3">
                    <div class="offset-sm-3 col-sm-3 d-grid">
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </div>
                    <div class="col-sm-3 d-grid">
                        <a class="btn btn-outline-primary" href="/myShopapp/index.php" role="button">Cancel</a>
                    </div>
                </div>
            </form>
        </div>
    </body>
</html>
