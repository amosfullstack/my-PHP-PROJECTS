// scripts.js

// Function to show a preview of the image before uploading
function previewImage() {
    const input = document.getElementById('fileToUpload');
    const preview = document.getElementById('imagePreview');
    
    input.addEventListener('change', function() {
        const file = input.files[0];
        if (file) {
            const reader = new FileReader();
            reader.onload = function(event) {
                preview.src = event.target.result;
            }
            reader.readAsDataURL(file);
        }
    });
}

// Function to handle live search
function liveSearch() {
    const searchInput = document.getElementById('searchInput');
    const searchResults = document.getElementById('searchResults');

    searchInput.addEventListener('keyup', function() {
        const query = searchInput.value;

        if (query.length > 0) {
            fetch(`searchresults4.php?query=${query}`)
                .then(response => response.text())
                .then(data => {
                    searchResults.innerHTML = data;
                });
        } else {
            searchResults.innerHTML = "";
        }
    });
}

// Initialize the functions when the DOM is fully loaded
document.addEventListener('DOMContentLoaded', function() {
    previewImage();
    liveSearch();
});
