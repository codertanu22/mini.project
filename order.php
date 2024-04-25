<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['name'], $_POST['mobile'], $_POST['location'], $_POST['quantity_mineral'], $_POST['quantity_regular'])) {
        $name = $_POST['name'];
        $mobile = $_POST['mobile'];
        $location = $_POST['location'];
        $quantityMineral = $_POST['quantity_mineral'];
        $quantityRegular = $_POST['quantity_regular'];

        $servername = "localhost";
        $username = "root";
        $password = ""; 
        $dbname = "Water_port";

        $conn = new mysqli($servername, $username, $password, $dbname);

        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }

        $stmt = $conn->prepare("INSERT INTO Orders (user_name, mobile_number, location, quantity_mineral, quantity_regular) VALUES (?, ?, ?, ?, ?)");

        $stmt->bind_param("ssddd", $name, $mobile, $location, $quantityMineral, $quantityRegular);

        if ($stmt->execute()) {
            $last_id = $conn->insert_id;
?>
            <script>
                alert("Your order has been placed successfully! Order ID: <?php echo $last_id; ?>");
                window.location.href = "new.php";
            </script>
<?php
        } else {
            echo "Error: " . $stmt->error;
        }

        $stmt->close();
        $conn->close();
    } else {
        echo "Please fill all required fields.";
    }
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Order Now - TS2 Water Suppliers</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        /* Custom CSS */
        body {
            background-color: #f8f9fa;
        }
        .navbar-brand {
            font-size: 1.5rem;
        }
        .info-section {
            background-color: #fff;
            border-radius: 10px;
            padding: 30px;
            margin-top: 30px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
        .form-control {
            border-radius: 20px;
        }
        .btn-primary {
            border-radius: 20px;
        }
        .water-type {
            border: 1px solid #ced4da;
            border-radius: 10px;
            padding: 20px;
            margin-bottom: 20px;
        }
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
                    <a class="nav-link" href="admin.php">Admin</a>
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
        <h2 class="mb-4">Order Now</h2>
        <form method="post">
            <div class="mb-3">
                <label for="name" class="form-label">Your Name</label>
                <input type="text" class="form-control" id="name" name="name" required>
            </div>
            <div class="mb-3">
                <label for="mobile" class="form-label">Mobile Number</label>
                <input type="tel" class="form-control" id="mobile" name="mobile" pattern="[0-9]{10}" required>
                <small class="text-muted">Please enter a 10-digit mobile number.</small>
            </div>
            <div class="mb-3">
                <label for="location" class="form-label">Location</label>
                <select class="form-select" id="location" name="location" required>
                    <option value="">Select Location</option>
                    <option value="Location A">Wagholi</option>
                    <option value="Location B">Hadpsar</option>
                    <option value="Location C">Kharadi</option>
                    <option value="Location C">Vimannagar</option>
                </select>
            </div>
            <div class="mb-3">
                <label for="quantityMineral" class="form-label">Quantity of Mineral Water (liters)</label>
                <input type="number" class="form-control" id="quantityMineral" name="quantity_mineral" min="0">
                <span class="text-muted">Price: ₹20 per liter</span>
            </div>
            <div class="mb-3">
                <label for="quantityRegular" class="form-label">Quantity of Regular Water (liters)</label>
                <input type="number" class="form-control" id="quantityRegular" name="quantity_regular" min="0">
                <span class="text-muted">Price: ₹10 per liter</span>
            </div>
            <button type="submit" class="btn btn-primary">Place Order</button>
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
