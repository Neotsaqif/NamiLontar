<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Settings - Toko Serba Ada</title>
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
                <a href="discounts.html">Discounts</a>
                <a href="settings.html" class="active">Settings</a>
            </nav>
        </aside>

        <!-- Main Content -->
        <main class="main-content">
            <header class="page-header">
                <h1>Website Preferences</h1>
            </header>

            <form action="#" method="POST">
                <!-- Card 1: General Information -->
                <div class="card settings-section">
                    <h2>General Information</h2>
                    <div class="form-group">
                        <label for="store_name">Store Name</label>
                        <input type="text" id="store_name" name="store_name" value="Toko Serba Ada">
                    </div>
                    <div style="display: flex; gap: 1.5rem;">
                        <div class="form-group" style="flex: 1;">
                            <label for="contact_email">Contact Email</label>
                            <input type="email" id="contact_email" name="contact_email" value="admin@tokoserbaada.com">
                        </div>
                        <div class="form-group" style="flex: 1;">
                            <label for="contact_phone">Phone Number</label>
                            <input type="text" id="contact_phone" name="contact_phone" value="+1 555-0000">
                        </div>
                    </div>
                </div>

                <!-- Card 2: Localization -->
                <div class="card settings-section">
                    <h2>Localization</h2>
                    <div style="display: flex; gap: 1.5rem;">
                        <div class="form-group" style="flex: 1;">
                            <label for="currency">Currency</label>
                            <select id="currency" name="currency">
                                <option value="USD">USD ($)</option>
                                <option value="EUR">EUR (€)</option>
                                <option value="IDR">IDR (Rp)</option>
                            </select>
                        </div>
                        <div class="form-group" style="flex: 1;">
                            <label for="timezone">Timezone</label>
                            <select id="timezone" name="timezone">
                                <option value="UTC">UTC (Universal Time Coordinated)</option>
                                <option value="PST">PST (Pacific Standard Time)</option>
                                <option value="EST">EST (Eastern Standard Time)</option>
                                <option value="WIB" selected>WIB (Western Indonesia Time)</option>
                            </select>
                        </div>
                    </div>
                </div>

                <!-- Card 3: Store Policies -->
                <div class="card settings-section">
                    <h2>Store Policies</h2>
                    <div class="form-group">
                        <label for="refund_policy">Refund Policy</label>
                        <textarea id="refund_policy" name="refund_policy" rows="4">Returns are accepted within 30 days of purchase. Items must be unused and in original packaging.</textarea>
                    </div>
                    <div class="form-group">
                        <label for="privacy_policy">Privacy Policy</label>
                        <textarea id="privacy_policy" name="privacy_policy" rows="4">We respect your privacy. Your personal information is only used to process your orders and improve our service.</textarea>
                    </div>
                </div>

                <div class="settings-actions">
                    <button type="submit" class="btn btn-primary" style="font-size: 1.1rem; padding: 0.8rem 2rem;">Save Changes</button>
                </div>
            </form>
        </main>
    </div>
    <script src="script.js"></script>
</body>
</html>
