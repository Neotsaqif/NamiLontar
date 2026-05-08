<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Categories - Toko Serba Ada</title>
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
                <a href="categories.html" class="active">Categories</a>
                <a href="customers.html">Customers</a>
                <a href="discounts.html">Discounts</a>
                <a href="settings.html">Settings</a>
            </nav>
        </aside>

        <!-- Main Content -->
        <main class="main-content">
            <header class="page-header">
                <h1>Product Categories</h1>
                <button class="btn btn-primary">Add New Category</button>
            </header>

            <div class="table-container">
                <table>
                    <thead>
                        <tr>
                            <th>Category Name</th>
                            <th>Description</th>
                            <th>Item Count</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>Kitchenware</td>
                            <td>Artisanal cooking tools and ceramics.</td>
                            <td>42</td>
                            <td>
                                <button class="btn btn-secondary">Edit</button>
                                <button class="btn" style="color: var(--status-red-text);">Delete</button>
                            </td>
                        </tr>
                        <tr>
                            <td>Textiles</td>
                            <td>Handwoven aprons, towels, and rugs.</td>
                            <td>18</td>
                            <td>
                                <button class="btn btn-secondary">Edit</button>
                                <button class="btn" style="color: var(--status-red-text);">Delete</button>
                            </td>
                        </tr>
                        <tr>
                            <td>Home Decor</td>
                            <td>Vases, sculptures, and wall art.</td>
                            <td>25</td>
                            <td>
                                <button class="btn btn-secondary">Edit</button>
                                <button class="btn" style="color: var(--status-red-text);">Delete</button>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </main>
    </div>
    <script src="script.js"></script>
</body>
</html>
