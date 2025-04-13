document.addEventListener("DOMContentLoaded", () => {
    console.log("Feedback script loaded successfully!");

    let selectedRating = null;

    // Handle emoji selection
    
    const emojis = document.querySelectorAll(".emoji");
    const submitButton = document.getElementById("submitFeedback");
    const feedbackField = document.getElementById("feedback");
    const feedbackMessage = document.getElementById("feedbackMessage");

    if (!emojis.length || !submitButton || !feedbackField || !feedbackMessage) {
        console.error("Missing DOM elements required for feedback handling.");
        return;
    }

    emojis.forEach((emoji) => {
        emoji.addEventListener("click", () => {
            console.log("Emoji clicked:", emoji.dataset.rating);

            emojis.forEach((e) => e.classList.remove("selected")); // Reset all
            emoji.classList.add("selected"); // Highlight selected
            selectedRating = emoji.dataset.rating; // Store rating
        });
    });

    // Handle feedback submission
    submitButton.addEventListener("click", () => {
        console.log("Submit button clicked");

        if (selectedRating && feedbackField.value.trim() !== "") {
            console.log("Rating:", selectedRating);
            console.log("Feedback:", feedbackField.value);

            feedbackMessage.style.display = "block";
            feedbackMessage.textContent = "Thank you for your feedback! 😊";
            feedbackMessage.style.color = "green";

            // Reset fields after submission
            feedbackField.value = "";
            emojis.forEach((e) => e.classList.remove("selected"));
            selectedRating = null;
        } else {
            console.log("Incomplete feedback: Rating or feedback missing");
            feedbackMessage.style.display = "block";
            feedbackMessage.textContent = "Please provide a rating and feedback before submitting.";
            feedbackMessage.style.color = "red";
        }
    });
}); 