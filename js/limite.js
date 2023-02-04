const inputElements = document.querySelectorAll(".limite");
const maxLength = 10;

inputElements.forEach(input => {
  input.addEventListener("input", function() {
    if (input.value.length > maxLength) {
      input.value = input.value.substring(0, maxLength);
    }
  });
});