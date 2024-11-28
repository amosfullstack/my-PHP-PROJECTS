<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>LOGIN PAGE</title>
    <style>
        /* Centering the container using flexbox */
        body {
            margin: 0;
            height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
            background-color: #40E0D0; /* Background color of the body */
        }

        /* Styling the form container */
        .form-container {
            border: 2px solid red;
            background-color: lightblue;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1);
            width: 400px; /* Set width for the form */
        }

        /* Styling the input elements */
        input[type="text"],
        input[type="password"] {
            width: 100%;
            border: none;
            padding: 10px;
            margin: 10px 0;
            border-radius: 8px;
            box-sizing: border-box;
        }

        /* Styling the submit button */
        input[type="submit"] {
            width: 100%;
            padding: 10px;
            background-color: #4CAF50;
            color: white;
            border: none;
            border-radius: 8px;
            cursor: pointer;
            transition: background-color 0.3s ease, transform 0.3s ease;
        }

        /* Hover effect for the submit button */
        input[type="submit"]:hover {
            background-color: black; /* Change background color on hover */
            transform: scale(1.05);    /* Slightly increase the button size */
        }
        .link{
          display: block;
          margin-top: 20px; /* Adjust this value to move the link down */
          text-align: center;
          color: blue;
        }
    </style>
</head>
<body>
    <div class="form-container">
        <form action="dashboard.php" method="GET">
            <label for="username"><b>USERNAME</b></label>
            <input type="text" id="username" name="username" placeholder="Username">

            <label for="password"><b>PASSWORD</b></label>
            <input type="password" id="password" name="password" placeholder="Password">

            <input type="submit" value="LOGIN"><br>

            <a class="link" href="#">CHANGE PASSWORD</a>
        </form>
    </div>
</body>
</html>
