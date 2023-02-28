const loginForm = document.getElementById("login");

loginForm.addEventListener("submit", function(event) {
  event.preventDefault();

  const username = document.getElementById("username").value;
  const password = document.getElementById("password").value;

  // Retrieve the username and password from local storage
  const storedUsername = localStorage.getItem("username");
  const storedPassword = localStorage.getItem("password");

  // Validate the username and password
  if (username === storedUsername && password === storedPassword) {
    // If the username and password are correct, redirect to the dashboard
    window.location.href = "dashboard.html";
  } else {
    // If the username and password are incorrect, display an error message
    const errorMessage = document.createElement("p");
    errorMessage.textContent = "Invalid username or password";
    loginForm.appendChild(errorMessage);
  }
});