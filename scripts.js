document.getElementById("myForm").addEventListener("submit", function(event) {
    event.preventDefault(); // Prevent form submission
  
    // Get form values
    const name = document.getElementById("name").value;
    const age = document.getElementById("age").value;
    const weight = document.getElementById("weight").value;
    const email = document.getElementById("email").value;
    const healthReport = document.getElementById("healthReport").files[0];
  
    // Create FormData object to send form data
    const formData = new FormData();
    formData.append("name", name);
    formData.append("age", age);
    formData.append("weight", weight);
    formData.append("email", email);
    formData.append("healthReport", healthReport);
  
    // Send form data using AJAX or fetch API to PHP script for handling
  
    // Example using fetch API
    fetch("process.php", {
      method: "POST",
      body: formData
    })
      .then(response => response.text())
      .then(data => {
        console.log(data); // Display response from PHP script
        // Reset form after successful submission
        document.getElementById("myForm").reset();
      })
      .catch(error => {
        console.error("Error:", error);
      });
  });
  