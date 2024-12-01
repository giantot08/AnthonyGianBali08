<?php
include 'db.php'; // Make sure this file establishes a MySQLi connection

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST['name'];
    $phone = $_POST['phone'];
    $service = $_POST['service'];
    $appointment_time = $_POST['appointment_time'];

    // Prepare the SQL statement
    $stmt = $conn->prepare("INSERT INTO appointments (client_name, phone_number, service, appointment_time) VALUES (?, ?, ?, ?)");
    
    // Bind parameters
    $stmt->bind_param("ssss", $name, $phone, $service, $appointment_time);

    // Execute the statement
    if ($stmt->execute()) {
        // Redirect to read.php if successful
        header("Location: appointments.php");
        exit();
    } else {
        echo "Error: " . $stmt->error; // Handle any errors
    }

    // Close the statement
    $stmt->close();
}

// Close the database connection
$conn->close();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
    <link href="tailwind.min.css" rel="stylesheet">
</head>
<body class="flex bg-gray-100">

    <div class="sidebar w-64 bg-gray-800 text-white h-screen p-5">
        <h2 class="text-center text-xl font-bold">Anthony Bali Salon</h2>
        <ul class="mt-4">
            <li class="py-3 border-b border-gray-700"><a href="Dashboard.php" class="flex items-center text-white"><i class="fas fa-tachometer-alt mr-2"></i> Dashboard</a></li>
            <li class="py-3 border-b border-gray-700"><a href="appointments.php" class="flex items-center text-white"><i class="fas fa-user mr-2"></i>Pending Appointments</a></li>
            <li class="py-3 border-b border-gray-700"><a href="appointments.php" class="flex items-center text-white"><i class="fas fa-chart-line mr-2"></i> View All Appointments</a></li>
            <li class="py-3 border-b border-gray-700"><a href="create.php" class="flex items-center text-white"><i class="fas fa-user mr-2"></i>Add Appointments</a></li>
            <li class="py-3"><a href="logout.php" class="flex items-center text-white"><i class="fas fa-sign-out-alt mr-2"></i> Logout</a></li>
        </ul>
    </div>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create Appointment</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
</head>
<body class="bg-gray-100">

<div class="container mx-auto p-6">
    <h1 class="text-3xl font-bold text-center mb-6">Create Appointment</h1>
    <form action="create.php" method="POST" class="bg-white shadow-md rounded px-8 pt-6 pb-8 mb-4">
        <div class="mb-4">
            <label for="name" class="block text-gray-700 text-sm font-bold mb-2">Client Name:</label>
            <input type="text" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="name" name="name" required>
        </div>
        
        <div class="mb-4">
            <label for="phone" class="block text-gray-700 text-sm font-bold mb-2">Phone Number:</label>
            <input type="tel" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="phone" name="phone" required>
        </div>
        
        <div class="mb-4">
            <label for="service" class="block text-gray-700 text-sm font-bold mb-2">Select Service:</label>
            <select class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="service" name="service" required>
                <option value="">--Please choose an option--</option>
                <option value="haircut">Haircut</option>
                <option value="coloring">Hair Coloring</option>
                <option value="manicure">Manicure</option>
                <option value="pedicure">Pedicure</option>
                <option value="facial">Facial</option>
                <option value="massage">Massage</option>
            </select>
        </div>
        
        <div class="mb-4">
            <label for="appointment_time" class="block text-gray-700 text-sm font-bold mb-2">Appointment Time:</label>
            <input type="datetime-local" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="appointment_time" name="appointment_time" required>
        </div>
        
        <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">Book Appointment</button>
    </form>
</div>
</body>
</html>