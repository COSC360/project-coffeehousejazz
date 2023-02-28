const loginForm = document.getElementById("login");

loginForm.addEventListener("submit", function(event) {
  event.preventDefault();

  const username = document.getElementById("username").value;
  const password = document.getElementById("password").value;

  // get variables
  const storedUsername = localStorage.getItem("username");
  const storedPassword = localStorage.getItem("password");

  // check if equal
  if (username === storedUsername && password === storedPassword) {
    // the username and password are correct - go to home
    window.location.href = "home.html";
  } else {
    // error
    const errorMessage = document.createElement("p");
    errorMessage.textContent = "Invalid username or password";
    loginForm.appendChild(errorMessage);
  }
});