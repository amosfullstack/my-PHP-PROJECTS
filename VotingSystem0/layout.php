<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    
</head>
<style>

body{
    width: 100%;
}


.logout{
    margin-left: 5px;
    background-color: #007bff;
    margin-top: 4px;
    width: max-content;
    padding: 10px;
    border-radius: 10px;
    

}
.logout-container{
    width: 100%;
    display: flex;
    justify-content: flex-end;
  
}
.logout:hover{
    background-color:rgb(114, 114, 187) ;
   
    transform: translateY(-5px);
}

</style>
<body>

<div class="Navbar">
    
    <div class="items">
     <img src="../images/sanduku.PNG" alt="">
    </div>
    
    <div class="heading"> 
         <h1>STREET GOVERNMENT VOTING SYSTEM</h1>
     <h4>
     A leader without a vote is a leader without protection.</h4>
</div> 

   
</div>

<div class="logout-container">
        <div class="logout">
        <a href="logout.php">Logout</a>
        </div>
    </div>
</body>
</html>