
<?php
// Database connection parameters
$servername = "localhost";
$username = "root"; // Replace with your MySQL username
$password = ""; // Replace with your MySQL password
$dbname = "water_port"; // Replace with your database name

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Fetch all admin records from the database
$sql = "SELECT username, password FROM admin";
$result = $conn->query($sql);

// Initialize variables to store admin credentials
$adminCredentials = [];

// Check if at least one admin record is found
if ($result->num_rows > 0) {
    // Loop through each admin record and store credentials
    while ($row = $result->fetch_assoc()) {
        $adminCredentials[] = [
            'username' => $row['username'],
            'password' => $row['password']
        ];
    }
} else {
    // Display an alert if no admin record is found
    echo "<script>alert('Admin credentials not found in the database.');</script>";
}

// Close database connection
$conn->close();

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Check if username and password are set
    if (isset($_POST['username'], $_POST['password'])) {
        // Retrieve the entered username and password
        $enteredUsername = $_POST['username'];
        $enteredPassword = $_POST['password'];

        // Validate the credentials by checking against stored admin credentials
        $authenticated = false;
        foreach ($adminCredentials as $admin) {
            if ($enteredUsername === $admin['username'] && $enteredPassword === $admin['password']) {
                $authenticated = true;
                break;
            }
        }

        // Redirect to the dashboard if authenticated
        if ($authenticated) {
            header("Location: dashboard.php");
            exit();
        } else {
            // Display an alert for incorrect credentials
            echo "<script>alert('Incorrect username or password. Please try again.');</script>";
        }
    } else {
        // Display an alert if username or password is not set
        echo "<script>alert('Please enter both username and password.');</script>";
    }
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Login - TS2 Water Suppliers</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        /* Custom CSS */
    </style>
</head>
<body>
<nav class="navbar navbar-expand-lg navbar-dark bg-primary">
    <div class="container">
        <a class="navbar-brand" href="new.php">TS2 Water Suppliers</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
                aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ms-auto">
                <li class="nav-item">
                    <a class="nav-link" href="new.php">Home</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="order.php">Order Now</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="about.php">About</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="status.php">Order Status</a>
                </li>
            </ul>
        </div>
    </div>
</nav>
<div class="container">
    <div class="info-section">
        <h2>Admin Login</h2>
        <form action="admin.php" method="post">
            <div class="mb-3">
                <label for="username" class="form-label">Username</label>
                <input type="text" class="form-control" name="username" id="adminUsername" required>
            </div>
            <div class="mb-3">
                <label for="password" class="form-label">Password</label>
                <input type="password" class="form-control" id="adminPassword" name="password" required>
            </div>
            <button type="submit" class="btn btn-primary">Login</button>
        </form>
    </div>
</div>
<footer class="footer mt-auto py-3 bg-light">
    <div class="container text-center">
        <span class="text-muted">TS2 Water Suppliers &copy; 2024</span>
    </div>
</footer>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
