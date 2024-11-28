<! DOCTYPE html>
<html>
<title>The Document</title>
<body>
   <form action="index.php" method="post">
    <label for="fname">First Name:</label>
    <input type="text" name="fname" placeholder="FirstName"><br><br>
    <label for="lname">Last Name</label>
    <input type="text" name="lname" placeholder="LastName"><br><br>
    <label for="password">Password</label>
    <input type="password" name="password" placeholder="Password"><br><br>
    <input type="submit" value="Submit"><br>
   </for>

</body>
</html>

<?php
$firstname=$_POST["fname"];
$lastname=$_POST["lname"];
echo $firstname ." ";
echo $lastname;
?>