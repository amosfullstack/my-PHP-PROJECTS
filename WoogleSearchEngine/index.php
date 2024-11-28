<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Woogle Image Search</title>
    <link rel="stylesheet" href="style.css">

    <style>
        #buttons {
    display: flex;
    justify-content: center;
    align-items: center;
    position: relative;
    top: 200px;
    right: 200px;
    height: 200vh; /* Full viewport height to center vertically */
}

#buttons input[type="button"] {
    margin: 0 10px; /* Spacing between buttons */
    cursor: pointer;
}

    </style>

</head>
<body>
    <div class="search-container">
        <h1>Woogle</h1>
        <form action="searchresults4.php" method="get">
            <input type="text"id=searchInput name="query" placeholder="Search for images...">
            <button type="submit" id="searchResult">Search</button>
        </form>
    </div>

    <div id="buttons">
        <input type="button" id="backtologin" name="backtologin" value="Go to Login">
        <input type="button" id="gotoupload"  name="gotoupload" value="Image Upload">
    </div>
    <script src="scripts.js"></script>
<script>

    document.getElementById("backtologin").onclick = function() {
    window.location.href = "admin.php";
};

document.getElementById("gotoupload").onclick = function() {
    window.location.href = "upload.php";
};
document.getElementById("searchResult").onclick = function() {
    window.location.href = "searchresults4.php";
};
</script>

</body>

</html>
