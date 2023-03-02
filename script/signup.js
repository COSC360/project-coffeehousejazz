window.onload = () => {
  let signForm = document.querySelector("signup");
  let requiredInput = document.querySelectorAll(".required");
  // event lister #1, checks submit button
  signForm.addEventListener("submit", (e) => {
    requiredInput.forEach(input => {
      e.preventDefault();
      if (input.type == "text" && input.value.length == 0) {
        input.parentElement.classList.add("hello");
        e.preventDefault();
      } else if (input.value === "") {
        input.classList.add("hello");
        e.preventDefault();
      }
      //store this information for later
      const username = document.getElementById("username").value;
      const email = document.getElementById("email").value;
      const password = document.getElementById("password").value;
      const confirmPassword = document.getElementById("confirmpassword").value;
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