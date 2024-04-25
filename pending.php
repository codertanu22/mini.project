<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pending Orders - TS2 Water Suppliers</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
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
        .btn-primary {
            border-radius: 20px;
        }
    </style>
</head>
<body>
<nav class="navbar navbar-expand-lg navbar-dark bg-primary">
    <div class="container">
        <a class="navbar-brand" href="#">TS2 Water Suppliers</a>
        <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
            <li class="nav-item">
                <a class="nav-link" href="new.php">Logout</a>
            </li>
        </ul>
    </div>
</nav>


<div class="container">
    <div class="info-section">
        <h2 class="mb-4">Pending Orders</h2>
        <?php
        $servername = "localhost";
        $username = "root";
        $password = "";
        $dbname = "Water_port";

        $conn = new mysqli($servername, $username, $password, $dbname);

        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }

        if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["confirm_order"])) {
            $order_id = $_POST["order_id"];
            $update_sql = "UPDATE Orders SET status = 'confirmed' WHERE order_id = $order_id";
            if ($conn->query($update_sql) === TRUE) {
                header("Location: " . $_SERVER['PHP_SELF']);
                exit();
            } else {
                echo "Error updating record: " . $conn->error;
            }
        }

        $sql = "SELECT * FROM Orders WHERE status = 'pending'";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            $mineralQuantity = 0;
            $regularQuantity = 0;
            while($row = $result->fetch_assoc()) {
                $orderTotal = ($row["quantity_mineral"] * 20) + ($row["quantity_regular"] * 10);
                $mineralQuantity += $row["quantity_mineral"];
                $regularQuantity += $row["quantity_regular"];
                ?>
                <div class="order-details">
                    <h4>Order ID: <?php echo $row["order_id"]; ?></h4>
                    <p>Mineral Water Quantity: <?php echo $row["quantity_mineral"]; ?> liters</p>
                    <p>Regular Water Quantity: <?php echo $row["quantity_regular"]; ?> liters</p>
                    <p>Total Amount: $<?php echo $orderTotal; ?></p>
                    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
                        <input type="hidden" name="order_id" value="<?php echo $row["order_id"]; ?>">
                        <button type="submit" name="confirm_order" class="btn btn-primary">Confirm</button>
                    </form>
                </div>
                <?php
            }
            ?>
            <div class="order-details">
                <h4>Total Quantities</h4>
                <p>Mineral Water Total Quantity: <?php echo $mineralQuantity; ?> liters</p>
                <p>Regular Water Total Quantity: <?php echo $regularQuantity; ?> liters</p>
            </div>
            <?php
        } else {
            echo "<p>No pending orders found.</p>";
        }

        $conn->close();
        ?>
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
