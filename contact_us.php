<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    include '_connection.php'; // Include your database connection file

    // Collect form data
    $firstname = mysqli_real_escape_string($conn, $_POST['firstname']);
    $lastname = mysqli_real_escape_string($conn, $_POST['lastname']);
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $message = mysqli_real_escape_string($conn, $_POST['message']);

    // Prepare and execute the SQL query
    $sql = "INSERT INTO contact_us (firstname, lastname, email, message) 
            VALUES ('$firstname', '$lastname', '$email', '$message')";
    $result = mysqli_query($conn, $sql);

    if ($result) {
        // Show success message
        echo "<script>
            alert('We will contact you soon');
            window.location.href = 'frontend.php'; // Redirect to another page after submission
        </script>";
    } else {
        echo "Error: " . mysqli_error($conn); // Display any error if the insertion fails
    }
}
?>