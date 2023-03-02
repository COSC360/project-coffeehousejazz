window.onload = () => {
  let loginForm = document.querySelector("login");
  let requiredInput = document.querySelectorAll(".required");
  // event lister #1, checks submit button
  loginForm.addEventListener("submit", (e) => {
    requiredInput.forEach(input => {
      e.preventDefault();
      if (input.type == "text" && input.value.length == 0) {
        input.parentElement.classList.add("hello");
        e.preventDefault();
      } else if (input.value === "") {
        input.classList.add("hello");
        e.preventDefault();
      }
    //store the username and password for later
    const username = document.getElementById("username").value;
    const password = document.getElementById("password").value;
  });
});
// event listener #2, checks when changed
// valid inputs
requiredInput.forEach(input => {
  input.addEventListener("change", () => {
    // remove the highlight when filled out
    if (input.type == "text" && input.checked)
      input.parentElement.classList.remove("hello");
    else
      input.classList.remove("hello");
  });
});
}