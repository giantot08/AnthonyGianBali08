<?php
session_start(); // Start the session
include 'db.php'; // Include your database connection

$error = ''; // Variable to hold error messages
$success = ''; // Variable to hold success messages

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Get the username and password from the form
    $username = $_POST['username'];
    $password = $_POST['password'];
    $confirm_password = $_POST['confirm_password'];

    // Validate input
    if (empty($username) || empty($password) || empty($confirm_password)) {
        $error = 'All fields are required.';
    } elseif ($password !== $confirm_password) {
        $error = 'Passwords do not match.';
    } else {
        // Check if the username already exists
        $stmt = $conn->prepare("SELECT * FROM users WHERE username = ?");
        $stmt->bind_param("s", $username);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
            $error = 'Username already exists.';
        } else {
            // Hash the password
            $hashed_password = password_hash($password, PASSWORD_DEFAULT);

            // Insert the new user into the database
            $stmt = $conn->prepare("INSERT INTO users (username, password) VALUES (?, ?)");
            $stmt->bind_param("ss", $username, $hashed_password);

            if ($stmt->execute()) {
                $success = 'Account created successfully! You can now log in.';
            } else {
                $error = 'Error creating account. Please try again.';
            }
        }
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create Account</title>
    <link href="tailwind.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #f8f9fa;
        }
    </style>
</head>
<body class="bg-gray-100">
    <div class="max-w-md mx-auto my-20 p-6 bg-white rounded-lg shadow-md">
        <h1 class="text-2xl font-bold text-center">Create Account</h1>
        <?php if ($error): ?>
            <div class="mt-4 p-4 bg-red-200 text-red-800 rounded">
                <?php echo $error; ?>
            </div>
        <?php endif; ?>
        <?php if ($success): ?>
            <div class="mt-4 p-4 bg-green-200 text-green-800 rounded">
                <?php echo $success; ?>
            </div>
        <?php endif; ?>
        <form method="POST" action="">
            <div class="mt-4">
                <label class="block text-sm font-medium text-gray-700">Username</label>
                <input class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm p-2" type="text" name="username" required>
            </div>
            <div class="mt-4">
                <label class="block text-sm font-medium text-gray-700">Password</label>
                <input class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm p-2" type="password" name="password" required>
            </div>
            <div class="mt-4">
                <label class="block text-sm font-medium text-gray-700">Confirm Password</label>
                <input class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm p-2" type="password" name="confirm_password" required>
            </div>
            <div class="mt-6">
                <button class="w-full bg-blue-600 text-white font-semibold py-2 rounded-md hover:bg-blue-700" type="submit">Create Account</button>
            </div>
        </form>
        <p class="mt-4 text-center">
            Already have an account? <a href="login.php" class="text-blue-600 hover:underline">Login here</a>
        </p>
    </div>
</body>
</html>