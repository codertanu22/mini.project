<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
    
        body {
            padding-top: 70px;
            background-color: #f8f9fa;
        }
        .navbar-brand {
            font-size: 1.5rem;
        }
        .list-group-item {
            background-color: #fff;
            border: 1px solid rgba(0, 0, 0, 0.125);
            border-radius: 0.25rem;
            margin-bottom: 10px;
        }
        .list-group-item a {
            display: block;
            padding: 10px 15px;
            color: #212529;
            text-decoration: none;
        }
       
        .footer {
            position: fixed;
            bottom: 0;
            width: 100%;
            height: 60px;
            line-height: 60px;
            background-color: #343a40;
            color: #ffffff;
            text-align: center;
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
        <h1 class="my-4">Welcome to Admin Dashboard</h1>
        <div class="list-group">
            <div class="list-group-item">
                <a href="pending.php" class="btn btn-primary">Pending Orders</a>
            </div>
            <div class="list-group-item">
                <a href="conform.php" class="btn btn-success">Confirmed Orders</a>
            </div>
            <div class="list-group-item">
                <a href="diliver.php" class="btn btn-info">Delivered Orders</a>
            </div>
        </div>
    </div>

    <footer class="footer">
        <div class="container">
            TS2 Water Suppliers &copy; 2024
        </div>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
