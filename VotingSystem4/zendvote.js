document.addEventListener("DOMContentLoaded", () => {
    const timerDisplay = document.getElementById('timer');

     
    let timer;
    let timeRemaining = 1200; // 2 minutes

    const updateTimer = () => {
        if (timeRemaining <= 0) {
            alert('Voting Time Ended, please see the Election results');
            document.body.innerHTML = '<h1 style="color: Blue;">Results Page</h1>';
            return;
        }
        timeRemaining -= 1;
        const minutes = Math.floor(timeRemaining / 60);
        const seconds = timeRemaining % 60;
        timerDisplay.textContent = `${minutes}:${seconds.toString().padStart(2, '0')}`;
    };

    timer = setInterval(updateTimer, 1000);

});