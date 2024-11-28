<!DoCTYPE html>
<html>
    <head>
    <title>My Shop</title>
    </head>
 <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">>
    <body>
        <div class="container my-5>">
        <h2>List of Clients</h2>
        <a class="btn btn-primary" href="/myShopapp/create.php" role="button">New Client</a>
        <br>
        <table class="table">
            <thead>
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Email</th>
                <th>Phone</th>
                <th>Address</th>
                <th>Created At</th>
                <th>Action</th>
            </tr>
          </thead>
          <tbody>
           <?php 
           //connecting to the database
           $servername= "localhost";
           $username="root";
           $password="";
           $database="myshop";

           //creating connection to the database
           $connection = new mysqli($servername,$username,$password,$database);

           //check connection
           if($connection->connect_error){
            die("connection failed: ". $connection->connect_error);
           }
           //read data from the database and store then i a variable
           $sql="SELECT * FROM clients";
           $result= $connection->query($sql);

           //check if query has been executed correctly
           if(!$result){
            die("Invalid query: ". $connection->error);
           }

           //read all rows from the database using the while loop and all rows that we read should be dispaled in the html table
           while($row=$result->fetch_assoc()){
            echo "
             <tr>
                <td>$row[id]</td>
                <td>$row[name]</td>
                <td>$row[email]</td>
                <td>$row[phone]</td>
                <td>$row[address]</td>
                <td>$row[created_at]</td>
                <td>
                    <a class='btn btn-primary btn-sm' href='/myShopapp/edit.php? id=$row[id]'>Edit</a>
                    <a class='btn btn-danger btn-sm' href='/myShopapp.delete.php? id=$row[id]'>Delete</a>
                </td>
            </tr>
            ";
           }
           
           
           ?>

            <tr>
                <td>10</td>
                <td>Bill Gates</td>
                <td>bill@gmail.com</td>
                <td>+1112223334</td>
                <td>New York,USA</td>
                <td>18/05/2022</td>
                <td>
                    <a class="btn btn-primary btn-sm" href="/myShopapp/edit.php">Edit</a>
                    <a class="btn btn-danger btn-sm" href="/myShopapp.delete.php" >Delete</a>
                </td>
            </tr>
          </tbody>

        </table>
</div>
    </body>
<html>