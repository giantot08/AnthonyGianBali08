<?php
include 'db.php'; // Include the database connection

if ($_SERVER["REQUEST_METHOD"] == "GET" && isset($_GET['id'])) {
    $appointment_id = $_GET['id'];

    // Prepare the SQL statement to delete the appointment
    $stmt = $conn->prepare("DELETE FROM appointments WHERE appointment_id = ?");
    
    // Bind parameters
    $stmt->bind_param("i", $appointment_id); // Assuming appointment_id is an integer

    // Execute the statement
    if ($stmt->execute()) {
        header("Location: appointments.php"); // Redirect to the main page after deletion
        exit;
    } else {
        echo "Error: " . $stmt->error; // Display error if deletion fails
    }

    $stmt->close(); // Close the statement
}

$conn->close(); // Close the database connection
?>