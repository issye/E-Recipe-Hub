document.addEventListener('DOMContentLoaded', () => {
    const stars = document.querySelectorAll('#rating-stars .fa-star');
    const ratingText = document.getElementById('rating-text');
    const recipeId = document.getElementById('rating-stars').getAttribute('data-recipe-id');
    let selectedRating = 0;

    // Fetch previous rating and highlight stars
    fetch(`get_rating.php?recipe_id=${recipeId}`)
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                highlightStars(data.user_rating);
            }
        })
        .catch(error => console.error('Error fetching rating:', error));

    // Star hover effect
    stars.forEach(star => {
        star.addEventListener('mouseover', () => {
            const value = parseInt(star.getAttribute('data-value'));
            highlightStars(value);
        });

        star.addEventListener('mouseout', () => {
            highlightStars(selectedRating);
        });

        star.addEventListener('click', () => {
            const value = parseInt(star.getAttribute('data-value'));

            if (confirm(`Are you sure you want to rate this recipe ${value} stars?`)) {
                selectedRating = value;
                highlightStars(selectedRating);
                sendRatingToServer(selectedRating);
            }
        });
    });

    function highlightStars(rating) {
        stars.forEach(star => {
            if (parseInt(star.getAttribute('data-value')) <= rating) {
                star.style.color = '#FFD700'; // Yellow for selected stars
            } else {
                star.style.color = '#ccc'; // Grey for unselected stars
            }
        });
    }

    function sendRatingToServer(rating) {
        fetch('rate_recipe.php', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
            },
            body: JSON.stringify({ recipe_id: recipeId, rating: rating }),
        })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    ratingText.innerHTML = `Overall rating: <span id="overall-rating">${data.new_rating}</span>/5`;
                } else {
                    alert('Failed to submit your rating. Please try again.');
                }
            })
            .catch(err => {
                console.error('Error:', err);
                alert('An error occurred. Please try again.');
            });
    }
});


function copyRecipeLink() {
    const recipeId = document.getElementById('rating-stars').getAttribute('data-recipe-id');
    const recipeUrl = `${window.location.origin}/recipe_details.php?id=${recipeId}`;

    // Copy link to clipboard
    const tempInput = document.createElement("input");
    document.body.appendChild(tempInput);
    tempInput.value = recipeUrl;
    tempInput.select();
    document.execCommand("copy");
    document.body.removeChild(tempInput);

    // Show confirmation message
    alert("Recipe link copied: " + recipeUrl);
}

