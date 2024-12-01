<?php
include 'db.php'; // Ensure this file establishes a MySQLi connection

// Fetch all appointments from the database
$result = $conn->query("SELECT * FROM appointments"); // Note: Use the correct table name (case-sensitive)

$appointments = [];
if ($result) {
    while ($row = $result->fetch_assoc()) {
        $appointments[] = $row; // Fetch each row as an associative array
    }
} else {
    echo "Error fetching appointments: " . $conn->error; // Handle any errors
}
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
            <li class="py-3 border-b border-gray-700"><a href="upcoming_appointment.php" class="flex items-center text-white"><i class="fas fa-user mr-2"></i>Pending Appointments</a></li>
            <li class="py-3 border-b border-gray-700"><a href="appointments.php" class="flex items-center text-white"><i class="fas fa-chart-line mr-2"></i> View All Appointments</a></li>
            <li class="py-3 border-b border-gray-700"><a href="create.php" class="flex items-center text-white"><i class="fas fa-user mr-2"></i>Add Appointments</a></li>
            <li class="py-3"><a href="logout.php" class="flex items-center text-white"><i class="fas fa-sign-out-alt mr-2"></i> Logout</a></li>
        </ul>
    </div>

    <div class="main-content flex-1 p-6">
    <h1 class="text-2xl font-bold">Welcome to the Dashboard</h1>
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4 mt-4">
        <a href="appointments.php" class="card bg-white p-5 rounded-lg shadow-md hover:shadow-lg transition-shadow duration-200">
            <div class="flex items-center">
                <i class="fas fa-calendar-check text-2xl text-blue-600 mr-2"></i>
                <div>
                    <h2 class="text-xl font-semibold">Appointments</h2>
                    <p class="text-lg font-bold"><?= count($appointments) ?></p>
                </div>
            </div>
        </a>
        <a href="statistics.php" class="card bg-white p-5 rounded-lg shadow-md hover:shadow-lg transition-shadow duration-200">
            <div class="flex items-center">
                <i class="fas fa-chart-line text-2xl text-green-600 mr-2"></i>
                <div>
                    <h2 class="text-xl font-semibold">Statistics</h2>
                    <p>Here you can find various statistics and data.</p>
                </div>
            </div>
        </a>
    </div>
</div>

</body>
</html>