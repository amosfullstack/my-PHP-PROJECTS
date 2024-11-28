<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Candidate Dashboard</title>
  <style>
    body {
      font-family: Arial, sans-serif;
      background-color: #cce7f0; /* Light blue background */
      margin: 0;
      padding: 0;
    }

    .dashboard {
      display: flex;
      flex-wrap: wrap; /* Allows wrapping to next line if window is resized */
      justify-content: center; /* Centers the candidate cards */
      gap: 20px; /* Adds space between the cards */
      padding: 20px;
    }

    .candidate-card {
      background-color: white;
      border-radius: 10px;
      box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
      width: 300px;
      text-align: center;
      padding: 20px;
      transition: transform 0.2s ease-in-out;
    }

    .candidate-card:hover {
      transform: translateY(-10px);
    }

    .candidate-img {
      width: 150px;
      height: 150px;
      object-fit: cover;
      margin-bottom: 15px;
    }

    .candidate-name {
      font-size: 1.5em;
      font-weight: bold;
      margin: 10px 0;
    }

    .party-name {
      font-size: 1.2em;
      color: #555;
      margin-bottom: 10px;
    }

    .motto {
      font-style: italic;
      font-size: 1em;
      margin-bottom: 10px;
      color: #007bff;
    }

    .reason {
      font-size: 0.9em;
      margin-bottom: 20px;
    }
    p{
      text-align: center;
    }
    .vote{
      text-align: center;
      color: green;
      margin-top: 20px;
      display: flex;
      justify-content: center;
    }
  </style>
</head>
<body>

  <div class="dashboard">
    <!-- Candidate 1 -->
    <div class="candidate-card">
      <img src="images/Ellon.png" alt="Candidate Picture" class="candidate-img">
      <div class="candidate-name">Ellon Musk</div>
      <div class="party-name">Democratic Party</div>
      <div class="motto">"Together for Change"</div>
      <div class="reason">I am contesting to improve education and healthcare for all citizens.</div>
    </div>

    <!-- Candidate 2 -->
    <div class="candidate-card">
      <img src="images/Jane.png" alt="Candidate Picture" class="candidate-img">
      <div class="candidate-name">Jane Smith</div>
      <div class="party-name">Republican Party</div>
      <div class="motto">"Building a Better Future"</div>
      <div class="reason">I am contesting to create more job opportunities and enhance security in our nation.</div>
    </div>
  </div>
   <p>Voting day will be on Monday at 10:00am to 16:30pm <br> YOUR VOTE IS OUR SUCCESS</p>
   <button><a href="#" class="vote">VOTE NOW</a></button> 
  </body>
</html>
