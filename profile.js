// Function to handle the edit profile action
function editProfile() {
    // Prompt user to edit profile information
    const username = prompt("Edit your username:");
    const name = prompt("Edit your name:");

    // Check if the user entered any new details
    if (username && name) {
        document.getElementById("username").textContent = username;
        document.getElementById("name").textContent = name;
        alert("Profile updated successfully!");
    } else {
        alert("No changes made to the profile.");
    }
}

// Function to handle the logout action
function logout() {
    // Confirm the logout action
    const confirmLogout = confirm("Are you sure you want to log out?");

    if (confirmLogout) {
        // If confirmed, you can redirect to a logout page or clear the session
        // Here we simulate a logout by redirecting to the homepage or login page.
        window.location.href = "index.html"; // Adjust this to your actual logout URL
    } else {
        // If not confirmed, do nothing
        console.log("Logout canceled.");
    }
}
