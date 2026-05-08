<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Client Orders - Toko Serba Ada</title>
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
                <a href="orders.php" class="active">Orders</a>
                <a href="categories.php">Categories</a>
                <a href="customers.php">Customers</a>
                <a href="discounts.php">Discounts</a>
                <a href="settings.php">Settings</a>
            </nav>
        </aside>

        <!-- Main Content -->
        <main class="main-content">
            <header class="page-header">
                <h1>Client Orders</h1>
            </header>

            <div class="table-container">
                <div class="table-header-actions">
                    <input type="text" class="search-bar" placeholder="Search orders...">
                    <select class="filter-dropdown">
                        <option value="all">All Statuses</option>
                        <option value="pending">Pending</option>
                        <option value="processing">Processing</option>
                        <option value="delivered">Delivered</option>
                    </select>
                </div>
                <table>
                    <thead>
                        <tr>
                            <th>Order ID</th>
                            <th>Date</th>
                            <th>Customer Name</th>
                            <th>Items Summary</th>
                            <th>Status</th>
                            <th>Total Amount</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>#ORD-1025</td>
                            <td>Oct 24, 2026</td>
                            <td>Alice Johnson</td>
                            <td>3 items (Ceramic Mug, etc.)</td>
                            <td><span class="badge processing">Processing</span></td>
                            <td>$120.00</td>
                            <td><button class="btn btn-secondary">View Details</button></td>
                        </tr>
                        <tr>
                            <td>#ORD-1024</td>
                            <td>Oct 23, 2026</td>
                            <td>Bob Smith</td>
                            <td>1 item (Linen Apron)</td>
                            <td><span class="badge delivered">Delivered</span></td>
                            <td>$45.50</td>
                            <td><button class="btn btn-secondary">View Details</button></td>
                        </tr>
                        <tr>
                            <td>#ORD-1023</td>
                            <td>Oct 22, 2026</td>
                            <td>Charlie Brown</td>
                            <td>2 items (Wooden Spoon...)</td>
                            <td><span class="badge pending">Pending</span></td>
                            <td>$89.99</td>
                            <td><button class="btn btn-secondary">View Details</button></td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </main>
    </div>
    <script src="script.js"></script>
</body>
</html>
