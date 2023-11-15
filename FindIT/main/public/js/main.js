// Getting the elements to watch for and error div container
const input = document.getElementById("allInput");
const errorContainer = document.getElementById("errorContainer");
const submit = document.getElementById("submit-btn");

// Adding the event listener to the button
input.addEventListener("click", function() {
  if (input.value.trim() === "") {
    displayErrorMessage("This field can't be empty");
  } else {
    clearErrorMessage();
    // Here we could improve the sending logic
  }
});

// Event listener for loss of focus
input.addEventListener("blur", function() {
  if (input.value.trim() === "") {
    displayErrorMessage("This field can't be empty");
  } else {
    clearErrorMessage();
  }
});

// Error display
function displayErrorMessage(message) {
  errorContainer.textContent = message;
  errorContainer.style.color = "red";
}

// Clear the error message
function clearErrorMessage() {
  errorContainer.textContent = "";
}
