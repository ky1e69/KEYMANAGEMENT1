document.getElementById("registrationForm").addEventListener("submit", function(event) {
    // Get the button and form elements
    const registerBtn = document.getElementById("registerBtn");
    const form = event.target;

    // Prevent multiple form submissions
    event.preventDefault();

    // Add loading state
    registerBtn.innerHTML = '<span class="spinner"></span>Registering...';
    registerBtn.classList.add("btn-loading");
    registerBtn.disabled = true;

    // Simulate form submission delay for demo (replace with actual form submission)
    setTimeout(() => {
        form.submit(); // Submit the form normally after the delay
    }, 1000); // Adjust this time as needed for the effect
});