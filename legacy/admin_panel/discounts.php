<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Discounts - Toko Serba Ada</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&family=Playfair+Display:wght@600;700&display=swap" rel="stylesheet">
    <link href="style.css" rel="stylesheet">
</head>
<body>
    <div class="app-container">
        <!-- Sidebar -->
        <aside class="sidebar">
            <div class="brand">Toko Serba Ada</div>
            <nav>
                <a href="dashboard.html">Dashboard</a>
                <a href="orders.html">Orders</a>
                <a href="categories.html">Categories</a>
                <a href="customers.html">Customers</a>
                <a href="discounts.html" class="active">Discounts</a>
                <a href="settings.html">Settings</a>
            </nav>
        </aside>

        <!-- Main Content -->
        <main class="main-content">
            <header class="page-header">
                <h1>Promotions</h1>
                <button class="btn btn-primary">Create New Discount</button>
            </header>

            <div class="table-container">
                <table>
                    <thead>
                        <tr>
                            <th>Promo Code</th>
                            <th>Discount Value</th>
                            <th>Expiry Date</th>
                            <th>Usage Limit</th>
                            <th>Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>WELCOME10</td>
                            <td>10%</td>
                            <td>Dec 31, 2026</td>
                            <td>500</td>
                            <td><span class="badge active">Active</span></td>
                        </tr>
                        <tr>
                            <td>HOLIDAY5</td>
                            <td>$5</td>
                            <td>Dec 25, 2026</td>
                            <td>1000</td>
                            <td><span class="badge active">Active</span></td>
                        </tr>
                        <tr>
                            <td>SUMMER20</td>
                            <td>20%</td>
                            <td>Aug 31, 2026</td>
                            <td>200</td>
                            <td><span class="badge expired">Expired</span></td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </main>
    </div>
    <script src="script.js"></script>
</body>
</html>
