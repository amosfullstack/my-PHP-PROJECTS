<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Candidate Dashboard</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f7f9fc;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
        }
        .container {
            background-color: white;
            padding: 2em;
            border-radius: 10px;
            box-shadow: 0px 0px 15px rgba(0, 0, 0, 0.1);
            width: 100%;
            max-width: 500px;
        }
        h1 {
            text-align: center;
            color: #333;
            margin-bottom: 1.5em;
        }
        .form-group {
            margin-bottom: 1.5em;
        }
        label {
            display: block;
            margin-bottom: 0.5em;
            font-weight: bold;
            color: #555;
        }
        input[type="text"],
        select,
        input[type="file"],
        textarea {
            width: 100%;
            padding: 0.75em;
            border: 1px solid #ccc;
            border-radius: 5px;
            box-sizing: border-box;
            font-size: 1em;
            margin-top: 0.5em;
        }
        textarea {
            resize: vertical;
            height: 100px;
        }
        button {
            width: 100%;
            padding: 0.75em;
            background-color: #007bff;
            color: white;
            border: none;
            border-radius: 5px;
            font-size: 1em;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }
        button:hover {
            background-color: #0056b3;
        }
    </style>
</head>
<body>

<div class="container">
    <h1>Candidate Dashboard</h1>
    <form id="candidateForm" enctype="multipart/form-data" action="dashboard.php" method="post">
        <div class="form-group">
            <label for="firstName">First Name:</label>
            <input type="text" id="firstName" name="firstName" required>
        </div>
        <div class="form-group">
            <label for="lastName">Last Name:</label>
            <input type="text" id="lastName" name="lastName" required>
        </div>
        <div class="form-group">
            <label for="party">Political Party:</label>
            <input type="text" id="party" name="party" required>
        </div>
        <div class="form-group">
            <label for="photo">Photo:</label>
            <input type="file" id="photo" name="photo" accept="image/*" required>
        </div>
        <div class="form-group">
            <label for="description">Why are you better than other candidates?</label>
            <textarea id="description" name="description" required></textarea>
        </div>
        <button type="submit">Upload Candidate</button>
    </form>
</div>

</body>
</html>
