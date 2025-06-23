<?php
require_once "../app/connect.php";

$pageTitle = "Account Settings";
include_once "../../includes/header.php";

// Fetch invoice number
$conn = new connect();
$db = $conn->connect_db();
$stmt = $db->prepare("SELECT `invoice_number` FROM `invoice` ORDER BY `invoice_number` DESC LIMIT 1");
$stmt->execute();
$result = $stmt->get_result();
$nextInvoiceNumber = ($result && $result->num_rows > 0) ? $result->fetch_assoc()['invoice_number'] + 1 : 1;
?>

<main class="app-content">
    <div class="settings-layout">
        <!-- Settings Navigation -->
        <aside class="settings-sidebar">
            <nav class="settings-nav">
                <a href="#general" class="settings-nav-item active">
                    <i class="fas fa-cog"></i>
                    <span>General Settings</span>
                </a>
                <a href="#invoicing" class="settings-nav-item">
                    <i class="fas fa-file-invoice"></i>
                    <span>Invoicing</span>
                </a>
                <a href="#payments" class="settings-nav-item">
                    <i class="fas fa-credit-card"></i>
                    <span>Payments</span>
                </a>
                <?php if (isset($_SESSION['is_admin']) && $_SESSION['is_admin']): ?>
                    <a href="#api" class="settings-nav-item">
                        <i class="fas fa-code"></i>
                        <span>API Access</span>
                    </a>
                <?php endif; ?>
            </nav>
        </aside>

        <!-- Settings Content -->
        <div class="settings-content">
            <div class="settings-header">
                <h1>Account Settings</h1>
                <p>Manage your account preferences and billing settings</p>
            </div>

            <!-- Settings Sections -->
            <div class="settings-sections">
                <!-- Invoicing Section -->
                <section id="invoicing" class="settings-section">
                    <header class="section-header">
                        <h2>
                            <i class="fas fa-file-invoice"></i>
                            Invoicing Settings
                        </h2>
                    </header>

                    <div class="section-content">
                        <div class="setting-item">
                            <div class="setting-info">
                                <h3>Next Invoice Number</h3>
                                <p>Your next invoice will be numbered:
                                    <strong><?php echo htmlspecialchars($nextInvoiceNumber); ?></strong>
                                </p>
                            </div>
                            <div class="setting-action">
                                <button class="btn btn-outline-primary btn-sm" data-bs-toggle="modal"
                                    data-bs-target="#editInvoiceNumberModal">
                                    Edit
                                </button>
                            </div>
                        </div>
                    </div>
                </section>

                <!-- Customization Section -->
                <section id="customization" class="settings-section">
                    <header class="section-header">
                        <h2>
                            <i class="fas fa-palette"></i>
                            Invoice Customization
                        </h2>
                    </header>

                    <div class="section-content">
                        <div class="setting-item">
                            <div class="setting-info">
                                <h3>Invoice Template</h3>
                                <p>Customize the appearance and fields of your invoices</p>
                            </div>
                            <div class="setting-action">
                                <a href="invoice_customization.php" class="btn btn-primary">
                                    Customize Template
                                </a>
                            </div>
                        </div>
                    </div>
                </section>

                <!-- Payment Settings -->
                <section id="payments" class="settings-section">
                    <header class="section-header">
                        <h2>
                            <i class="fas fa-credit-card"></i>
                            Payment Settings
                        </h2>
                    </header>

                    <div class="section-content">
                        <div class="alert alert-warning" role="alert">
                            <div class="alert-icon">
                                <i class="fas fa-exclamation-triangle"></i>
                            </div>
                            <div class="alert-content">
                                <h4>Action Required</h4>
                                <p>Complete your Stripe account setup to start accepting payments</p>
                                <a href="https://connect.stripe.com/login" target="_blank" rel="noopener noreferrer"
                                    class="btn btn-primary mt-2">
                                    Set Up Payments
                                </a>
                            </div>
                        </div>
                    </div>
                </section>

                <?php if (isset($_SESSION['is_admin']) && $_SESSION['is_admin']): ?>
                    <!-- API Settings -->
                    <section id="api" class="settings-section">
                        <header class="section-header">
                            <h2>
                                <i class="fas fa-code"></i>
                                API Settings
                            </h2>
                        </header>

                        <div class="section-content">
                            <!-- API Usage Stats -->
                            <div class="card mb-4">
                                <div class="card-body">
                                    <h3>API Usage</h3>
                                    <div class="api-stats">
                                        <div class="stat-item">
                                            <label>Monthly Requests</label>
                                            <span class="stat-value">0 / 1000</span>
                                        </div>
                                        <div class="stat-item">
                                            <label>Invoices Generated</label>
                                            <span class="stat-value">0</span>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- API Keys -->
                            <div class="api-keys">
                                <div class="d-flex justify-content-between align-items-center mb-3">
                                    <h3>API Keys</h3>
                                    <button class="btn btn-primary btn-sm">
                                        <i class="fas fa-plus"></i> Generate New Key
                                    </button>
                                </div>
                                <div class="table-responsive">
                                    <table class="table">
                                        <thead>
                                            <tr>
                                                <th>Key</th>
                                                <th>Created</th>
                                                <th>Last Used</th>
                                                <th>Actions</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td>
                                                    <div class="api-key">
                                                        <code>sk_************PPNN</code>
                                                        <button class="btn btn-link btn-sm" title="Show key">
                                                            <i class="fas fa-eye"></i>
                                                        </button>
                                                    </div>
                                                </td>
                                                <td>Dec 18, 2024</td>
                                                <td>Never</td>
                                                <td>
                                                    <div class="btn-group">
                                                        <button class="btn btn-outline-danger btn-sm">
                                                            <i class="fas fa-trash"></i>
                                                        </button>
                                                        <button class="btn btn-outline-secondary btn-sm">
                                                            <i class="fas fa-copy"></i>
                                                        </button>
                                                    </div>
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </section>
                <?php endif; ?>
            </div>
        </div>
    </div>
</main>
<style>
    
    :root {
        --sidebar-width: 240px;
        --header-height: 60px;
        --primary-color: #1a56db;
        --secondary-color: #4b5563;
        --danger-color: #ef4444;
        --success-color: #10b981;
        --warning-color: #f59e0b;
        --border-color: #e5e7eb;
        --text-primary: #f9fafb;
        --text-secondary: #9ca3af;
        --bg-primary: #1f2937;
        --bg-secondary: #111827;
    }


    :root {
        --background-color: #f9fafb;
        --text-color: #111827;
        --hover-color: #1e40af;
        --accent-color: #3b82f6;
    }

    :root[data-theme="dark"] {
        --primary-color: #60a5fa;
        --secondary-color: #9ca3af;
        --background-color: #111827;
        --border-color: #374151;
        --text-color: #f9fafb;
        --hover-color: #3b82f6;
        --accent-color: #60a5fa;
    }


    .app-content {
        padding: 2rem;
        background-color: var(--background-color);
        min-height: calc(100vh - var(--header-height));
    }

    .settings-layout {
        display: grid;
        grid-template-columns: var(--sidebar-width) 1fr;
        gap: 2rem;
        max-width: 1400px;
        margin: 0 auto;
        background-color: var(--background-color);
        border-radius: 8px;
        box-shadow: 0 1px 3px rgba(0, 0, 0, 0.3);
    }

    /* Sidebar Styles */
    .settings-sidebar {
        padding: 1.5rem;
        border-right: 1px solid var(--border-color);
        background-color: var(--background-color);
    }

    .settings-nav {
        display: flex;
        flex-direction: column;
        gap: 0.5rem;
    }

    .settings-nav-item {
        display: flex;
        align-items: center;
        gap: 0.75rem;
        padding: 0.75rem 1rem;
        color: var(--text-color);
        text-decoration: none;
        border-radius: 6px;
        transition: all 0.2s ease;
    }

    .settings-nav-item:hover {
        background-color: var(--border-color);
        color: var(--text-color);
    }

    .settings-nav-item.active {
        background-color: var(--border-color);
        color: var(--primary-color);
        font-weight: 500;
    }

    /* Content Styles */
    .settings-content {
        padding: 2rem;
    }

    .settings-header {
        margin-bottom: 2rem;
    }

    .settings-header h1 {
        font-size: 1.875rem;
        color: var(--text-color);
        margin-bottom: 0.5rem;
    }

    .settings-header p {
        color: var(--secondary-color);
        font-size: 1.0625rem;
    }

    .settings-section {
        margin-bottom: 2.5rem;
        padding-bottom: 2.5rem;
        border-bottom: 1px solid var(--border-color);
    }

    .section-header {
        margin-bottom: 1.5rem;
    }

    .section-header h2 {
        font-size: 1.25rem;
        color: var(--text-color);
        display: flex;
        align-items: center;
        gap: 0.5rem;
    }

    .setting-item {
        display: flex;
        justify-content: space-between;
        align-items: center;
        padding: 1.25rem;
        background-color: var(--border-color);
        border-radius: 6px;
        margin-bottom: 1rem;
    }

    .setting-info h3 {
        font-size: 1rem;
        margin-bottom: 0.25rem;
        color: var(--text-color);
    }

    .setting-info p {
        color: var(--secondary-color);
        font-size: 0.875rem;
        margin: 0;
    }

    .api-stats {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
        gap: 1.5rem;
        margin-top: 1rem;
    }

    .stat-item {
        display: flex;
        flex-direction: column;
        gap: 0.5rem;
    }

    .stat-item label {
        color: var(--secondary-color);
        font-size: 0.875rem;
    }

    .stat-value {
        font-size: 1.25rem;
        font-weight: 500;
        color: var(--text-color);
    }

    /* Alert Styles */
    .alert {
        display: flex;
        gap: 1rem;
        padding: 1rem;
    }

    .alert-icon {
        font-size: 1.5rem;
    }

</style>

<?php include_once "../../includes/footer.php"; ?>