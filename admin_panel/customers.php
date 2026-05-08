<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Customers - Toko Serba Ada</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&family=Playfair+Display:wght@600;700&display=swap" rel="stylesheet">
    <link href="style.css" rel="stylesheet">
</head>
<body>
    <div class="app-container">
        <!-- Sidebar -->
        <aside class="sidebar">
            <div class="brand">Toko Serba Ada</div>
            <nav>
                <a href="dashboard.php">Dashboard</a>
                <a href="orders.php">Orders</a>
                <a href="categories.php">Categories</a>
                <a href="customers.php" class="active">Customers</a>
                <a href="discounts.php">Discounts</a>
                <a href="settings.php">Settings</a>
            </nav>
        </aside>

        <!-- Main Content -->
        <main class="main-content">
            <header class="page-header">
                <h1>Registered Clients</h1>
            </header>

            <div class="table-container">
                <div class="table-header-actions">
                    <input type="text" class="search-bar" placeholder="Search customers...">
                </div>
                <table>
                    <thead>
                        <tr>
                            <th>Customer ID</th>
                            <th>Full Name</th>
                            <th>Email Address</th>
                            <th>Phone Number</th>
                            <th>Total Orders</th>
                            <th>Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>#CUST-089</td>
                            <td>Alice Johnson</td>
                            <td>alice@example.com</td>
                            <td>+1 555-0100</td>
                            <td>12</td>
                            <td><span class="badge active">Active</span></td>
                        </tr>
                        <tr>
                            <td>#CUST-090</td>
                            <td>Bob Smith</td>
                            <td>bob.s@example.com</td>
                            <td>+1 555-0101</td>
                            <td>3</td>
                            <td><span class="badge active">Active</span></td>
                        </tr>
                        <tr>
                            <td>#CUST-091</td>
                            <td>Charlie Brown</td>
                            <td>charlie.b@example.com</td>
                            <td>+1 555-0102</td>
                            <td>0</td>
                            <td><span class="badge inactive">Inactive</span></td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </main>
    </div>
    <script src="script.js"></script>
</body>
</html>
