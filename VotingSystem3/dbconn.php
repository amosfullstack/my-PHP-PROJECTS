<?php
$servername='localhost';
$username='root';
$password="";
$dbname='voting_system';



$conn= new mysqli($servername,$username,$password, $dbname);
if($conn->connect_error)
{
    die( "Error connection failed...") . $conn->connect_error;
}
/*$sql = "CREATE TABLE  voters 
(
voter_id varchar(25) NOT NULL,
username varchar(25) NOT NULL,
email varchar(25) NOT NULL,
password varchar(25) NOT NULL

)
";
$conn->query($sql);
if($conn->connect_error)
{
    echo "invalid.." . $conn->connect_error;
}
else{
    echo "table created successfully";
}*/
/*
$admin='SAVT-01';
$pass=password_hash('1234', PASSWORD_DEFAULT);
$sql=$conn->prepare("INSERT INTO admins (username,adminpass) VALUES(?,?)");
$sql->bind_param("ss",$admin,$pass);
$sql->execute();*/
?>