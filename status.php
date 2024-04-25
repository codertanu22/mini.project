<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['order_id'])) {
        $order_id = $_POST['order_id'];

        $servername = "localhost";
        $username = "root";
        $password = ""; 
        $dbname = "Water_port";

        $conn = new mysqli($servername, $username, $password, $dbname);

        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }

        $sql = "SELECT quantity_mineral, quantity_regular, status FROM Orders WHERE order_id = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("i", $order_id);
        $stmt->execute();
        $result = $stmt->get_result();

        $totalAmount = 0;

        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            $orderTotal = ($row["quantity_mineral"] * 20) + ($row["quantity_regular"] * 10);
            $totalAmount = $orderTotal;
        } else {
            echo "<script>alert('Please enter a valid order ID.');</script>";
        }
    } else {
        echo "<script>alert('Please provide an order ID.');</script>";
    }
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Order Status - TS2 Water Suppliers</title>
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
        .order-details {
            border: 1px solid #ced4da;
            border-radius: 10px;
            padding: 20px;
            margin-bottom: 20px;
        }
        .form-control {
            border-radius: 20px;
        }
        .btn-primary {
            border-radius: 20px;
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
                    <a class="nav-link" href="order.php">Order Now</a>
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
        <h2 class="mb-4">Order Status</h2>
        <form id="statusForm" action="" method="post">
            <div class="mb-3">
                <label for="orderNumber" class="form-label">Enter Order Number</label>
                <input type="text" class="form-control" id="orderNumber" name="order_id" required>
            </div>
            <button type="submit" class="btn btn-primary">Check Status</button>
        </form>
        <div id="statusResult" class="mt-3" style="display: <?php echo isset($totalAmount) && $totalAmount > 0 ? 'block' : 'none'; ?>">
            <div class="order-details">
                <h4>Order Details</h4>
                <p><strong>Order Number:</strong> <?php echo isset($order_id) ? $order_id : ''; ?></p>
                <p><strong>Type of Water:</strong></p>
                <ul>
                    <li>Mineral: <?php echo isset($row['quantity_mineral']) ? $row['quantity_mineral'] : ''; ?></li>
                    <li>Regular: <?php echo isset($row['quantity_regular']) ? $row['quantity_regular'] : ''; ?></li>
                </ul>
                <p><strong>Total Price:</strong> ₹<?php echo isset($totalAmount) ? $totalAmount : ''; ?></p>
                <p><strong>Status:</strong> <?php echo isset($row['status']) ? $row['status'] : ''; ?></p>
            </div>
        </div>
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
