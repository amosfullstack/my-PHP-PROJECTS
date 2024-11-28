document.addEventListener("DOMContentLoaded", function() {
    // Set the voting end date and time
    const endDate = new Date("2024-08-31T23:59:59").getTime(); // Replace with actual voting end date and time
    const countdownElement = document.getElementById("countdown");
    const progressElement = document.getElementById("progress");

    // Update the countdown every 1 second
    const countdownInterval = setInterval(function() {
        const now = new Date().getTime();
        const timeRemaining = endDate - now;

        // Calculate time components
        const days = Math.floor(timeRemaining / (100 * 60 * 60 * 24));
        const hours = Math.floor((timeRemaining % (100 * 60 * 60 * 24)) / (1000 * 60 * 60));
        const minutes = Math.floor((timeRemaining % (100 * 60 * 60)) / (1000 * 60));
        const seconds = Math.floor((timeRemaining % (100 * 60)) / 1000);

        // Display the countdown
        countdownElement.innerHTML = `${String(days).padStart(2, '0')}:${String(hours).padStart(2, '0')}:${String(minutes).padStart(2, '0')}:${String(seconds).padStart(2, '0')}`;

        // Update progress bar
        const totalDuration = endDate - new Date("2024-08-01T00:00:00").getTime(); // Replace with actual voting start date and time
        const progressPercentage = ((totalDuration - timeRemaining) / totalDuration) * 100;
        progressElement.style.width = `${progressPercentage}%`;

        // If the countdown is over, redirect to results page
        if (timeRemaining <= 0) {
            clearInterval(countdownInterval);
            window.location.href = "results.html"; // Replace with actual results page URL
        }
    }, 100);
});
