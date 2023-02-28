const signupForm = document.getElementById("submit");

signupForm.addEventListener("submit", function(event) {
  alert("reached")
  const username = document.getElementById("username").value;
  const email = document.getElementById("email").value;
  const password = document.getElementById("password").value;
  const confirmPassword = document.getElementById("confirmpassword").value;
  event.preventDefault();
  // check if the passwords match
  if (password !== confirmPassword) {
    // error
    const errorMessage = document.createElement("p");
    errorMessage.textContent = "Passwords don't match";
    signupForm.appendChild(errorMessage);
  } else {
    // store the username, email, and password
    localStorage.setItem("username", username);
    localStorage.setItem("email", email);
    localStorage.setItem("password", password);
    // goes to login page
    window.location.href = "login.html";
  }
});