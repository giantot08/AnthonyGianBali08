<?php
session_start(); // Start the session
include 'db.php'; // Include your database connection

// Check if the user is already logged in
if (isset($_SESSION['username'])) {
    header("Location: login.php"); // Redirect to dashboard if already logged in
    exit;
}

$error = ''; // Variable to hold error messages

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Get the username and password from the form
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Prepare the SQL statement to prevent SQL injection
    $stmt = $conn->prepare("SELECT * FROM users WHERE username = ?");
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $result = $stmt->get_result();

    // Check if the user exists
    if ($result->num_rows > 0) {
        $user = $result->fetch_assoc();
        
        // Verify the password (assuming passwords are hashed)
        if (password_verify($password, $user['password'])) {
            // Password is correct, set session variables
            $_SESSION['username'] = $user['username'];
            header("Location: Dashboard.php"); // Redirect to dashboard
            exit;
        } else {
            $error = 'Invalid username or password.';
        }
    } else {
        $error = 'Invalid username or password.';
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link href="tailwind.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #f8f9fa;
        }
    </style>
</head>
<body class="bg-gray-100">
    <div class="max-w-md mx-auto my-20 p-6 bg-white rounded-lg shadow-md">
        <h1 class="text-2xl font-bold text-center">Login</h1>
        <?php if ($error): ?>
            <div class="mt-4 p-4 bg-red-200 text-red-800 rounded">
                <?php echo $error; ?>
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
            <div class="mt-6">
                <button class="w-full bg-blue-600 text-white font-semibold py-2 rounded-md hover:bg-blue-700" type="submit">Login</button>
            </div>
        </form>
        <ul class="mt-4 text-center">
            <li>
                <a href="register.php" class="text-blue-600 hover:underline">Create An Account</a>
            </li>
        </ul>
    </div>
</body>
</html>