const form = document.querySelector("form");
const fields = document.querySelectorAll(".form-control");
const submitBtn = document.querySelector('button[type="submit"]');

submitBtn.addEventListener("click", (e) => {
  const errorMessage = document.querySelector(".error");
  if (errorMessage) {
    form.removeChild(errorMessage);
  }
  if ([...fields].some((field) => !field.value)) {
    e.preventDefault();
    const error = document.createElement("p");
    error.className = "error";
    error.innerText = "All fields are required";
    form.insertBefore(error, submitBtn);

    [...fields].forEach((field) => {
      if (!field.value) {
        field.classList.add("required-field");
      } else {
        field.classList.remove("required-field");
      }
    });
  }
});
