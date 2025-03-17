function toggleFavorite(recipeId) {
    let favIcon = document.getElementById("favorite-icon");
    let favText = document.getElementById("favorite-text");

    fetch("toggle_favorite.php", {
        method: "POST",
        headers: { "Content-Type": "application/x-www-form-urlencoded" },
        body: "recipe_id=" + encodeURIComponent(recipeId),
    })
    .then(response => response.json())
    .then(data => {
        favIcon.classList.add("fade-effect"); // Add fade effect

        setTimeout(() => {
            if (data.status === "added") {
                favIcon.classList.replace("fa-regular", "fa-solid");
                favText.textContent = "Saved";
            } else if (data.status === "removed") {
                favIcon.classList.replace("fa-solid", "fa-regular");
                favText.textContent = "Save the recipe";
            }
            favIcon.classList.remove("fade-effect"); // Remove fade effect
        }, 300);
    })
    .catch(error => console.error("Error:", error));
}
