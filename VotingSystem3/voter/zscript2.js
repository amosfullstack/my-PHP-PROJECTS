document.addEventListener("DOMContentLoaded", function() {
    const ctx = document.getElementById('voteChart').getContext('2d');
    let voteChart;

    function fetchVoteData() {
        fetch('zfechvotes.php')
            .then(response => response.json())
            .then(data => {
                // Use candidate names for the labels in the chart
                const candidates = data.map(item => item.candidate_name);
                const votes = data.map(item => item.voteCount);

                if (voteChart) {
                    voteChart.destroy(); // Destroy the previous chart instance if it exists
                }

                // Initialize the chart with fetched data
                voteChart = new Chart(ctx, {
                    type: 'bar', // Type of chart
                    data: {
                        labels: candidates, // Candidate names for the chart labels
                        datasets: [{
                            label: 'Number of Votes',
                            data: votes,
                            backgroundColor: 'rgba(75, 192, 192, 0.2)', // Bar color
                            borderColor: 'rgba(75, 192, 192, 1)', // Bar border color
                            borderWidth: 1 // Border width of the bars
                        }]
                    },
                    options: {
                        scales: {
                            y: {
                                beginAtZero: true // Ensure y-axis starts at zero
                            }
                        }
                    }
                });
            })
            .catch(error => console.error('Error fetching vote data:', error));
    }

    // Fetch vote data every 5 seconds for real-time updates
    setInterval(fetchVoteData, 5000);
    fetchVoteData(); // Initial fetch to display data immediately
});
