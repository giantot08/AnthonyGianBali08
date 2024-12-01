<?php
include 'db.php'; // Ensure this file establishes a MySQLi connection

// Fetch all appointments from the database
$result = $conn->query("SELECT * FROM appointments"); //

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
    <title>Upcoming Appointments</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
    <link href="tailwind.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #f8f9fa;
        }
    </style>
</head>
<body class="bg-gray-100">
    <div class="flex-1 p-6">
        <h1 class="text-3xl font-bold text-center text-gray-800 mb-6">Upcoming Appointments</h1>
        <div class="overflow-x-auto">
            <table class="min-w-full bg-white border border-gray-300">
                <thead>
                    <tr>
                        <th class="py-2 px-4 border-b-2 border-gray-300 bg-blue-600 text-white">Appointment ID</th>
                        <th class="py-2 px-4 border-b-2 border-gray-300 bg-blue-600 text-white">Client Name</th>
                        <th class="py-2 px-4 border-b-2 border-gray-300 bg-blue-600 text-white">Phone Number</th>
                        <th class="py-2 px-4 border-b-2 border-gray-300 bg-blue-600 text-white">Service</th>
                        <th class="py-2 px-4 border-b-2 border-gray-300 bg-blue-600 text-white">Appointment Time</th>
                        <th class="py-2 px-4 border-b-2 border-gray-300 bg-blue-600 text-white">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (empty($appointments)): ?>
                        <tr>
                            <td colspan="6" class="py-2 px-4 text-center">No upcoming appointments found.</td>
                        </tr>
                    <?php else: ?>
                        <?php foreach ($appointments as $appointment): ?>
                        <tr>
                            <td class="py-2 px-4 border-b border-gray-300"><?php echo htmlspecialchars($appointment['appointment_id']); ?></td>
                            <td class="py-2 px-4 border-b border-gray-300"><?php echo htmlspecialchars($appointment['client_name']); ?></td>
                            <td class="py-2 px-4 border-b border-gray-300"><?php echo htmlspecialchars($appointment['phone_number']); ?></td>
                            <td class="py-2 px-4 border-b border-gray-300"><?php echo htmlspecialchars($appointment['service']); ?></td>
                            <td class="py-2 px-4 border-b border-gray-300"><?php echo htmlspecialchars($appointment['appointment_time']); ?></td>
                            <td class="py-2 px-4 border-b border-gray-300">
                                <a href="update.php?id=<?php echo $appointment['appointment_id']; ?>" class="text-blue-500 hover:underline">Edit</a>
                                <a href="delete.php?id=<?php echo $appointment['appointment_id']; ?>" class="text-red-500 hover:underline" onclick="return confirm('Are you sure you want to delete this appointment?');">Delete</a>
                            </td>
                        </tr>
                        <?php endforeach; ?>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>
</body>
</html>
