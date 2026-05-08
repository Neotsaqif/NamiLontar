<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard - Toko Serba Ada</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&family=Playfair+Display:wght@600;700&display=swap" rel="stylesheet">
    <link href="style.css" rel="stylesheet">
</head>
<body>
    <div class="app-container">
        <!-- Sidebar -->
        <aside class="sidebar">
            <div class="brand">Toko Serba Ada</div>
            <nav>
                <a href="dashboard.html" class="active">Dashboard</a>
                <a href="orders.html">Orders</a>
                <a href="categories.html">Categories</a>
                <a href="customers.html">Customers</a>
                <a href="discounts.html">Discounts</a>
                <a href="settings.html">Settings</a>
            </nav>
        </aside>

        <!-- Main Content -->
        <main class="main-content">
            <header class="page-header">
                <h1>Dashboard Overview</h1>
            </header>

            <div class="summary-grid">
                <div class="summary-card">
                    <span class="summary-title">Total Revenue</span>
                    <span class="summary-value">$24,500</span>
                </div>
                <div class="summary-card">
                    <span class="summary-title">Total Orders</span>
                    <span class="summary-value">1,245</span>
                </div>
                <div class="summary-card">
                    <span class="summary-title">Active Customers</span>
                    <span class="summary-value">842</span>
                </div>
            </div>

            <div class="table-container">
                <div class="table-header-actions">
                    <h2 style="font-family: var(--font-sans); font-size: 1.2rem; margin:0; padding:0.5rem 0;">Recent Activity</h2>
                </div>
                <table>
                    <thead>
                        <tr>
                            <th>Order ID</th>
                            <th>Date</th>
                            <th>Customer Name</th>
                            <th>Status</th>
                            <th>Total</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>#ORD-001</td>
                            <td>Oct 24, 2026</td>
                            <td>Alice Johnson</td>
                            <td><span class="badge processing">Processing</span></td>
                            <td>$120.00</td>
                        </tr>
                        <tr>
                            <td>#ORD-002</td>
                            <td>Oct 23, 2026</td>
                            <td>Bob Smith</td>
                            <td><span class="badge delivered">Delivered</span></td>
                            <td>$45.50</td>
                        </tr>
                        <tr>
                            <td>#ORD-003</td>
                            <td>Oct 22, 2026</td>
                            <td>Charlie Brown</td>
                            <td><span class="badge pending">Pending</span></td>
                            <td>$89.99</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </main>
    </div>
    <script src="script.js"></script>
</body>
</html>
