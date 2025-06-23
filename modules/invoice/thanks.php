<?php
include_once "../../includes/header.php";
$invoice_id = $_REQUEST['invoice_id'];
require_once "../app/invoice.php";

$invoice = new Invoice();
$invoice_data = $invoice->fetch_invoice($invoice_id);
?>

<style>
        :root {
            --primary-color: #1a56db;
            --secondary-color: #4b5563;
            --background-color: #f9fafb;
            --border-color: #e5e7eb;
            --text-color: #111827;
            --hover-color: #1e40af;
            --accent-color: #3b82f6;
        }

        :root[data-theme="dark"] {
            --primary-color: #3b82f6;
            --secondary-color: #9ca3af;
            --background-color: #1f2937;
            --border-color: #374151;
            --text-color: #f3f4f6;
            --hover-color: #60a5fa;
            --accent-color: #60a5fa;
        }
    .thanks-container {
        max-width: 1000px;
        margin: 3rem auto;
        padding: 2.5rem;
        /* background: var(--white); */
        border-radius: 8px;
        box-shadow: 0 2px 12px rgba(0,0,0,0.15);
    }
    .thanks-header {
        text-align: center;
        margin-bottom: 3rem;
        padding-bottom: 2rem;
        border-bottom: 1px solid var(--border-color);
    }
    .success-banner {
        background: var(--light-gray);
        border: 1px solid var(--border-color);
        color: var(--success);
        padding: 1.5rem;
        border-radius: 6px;
        margin: 2rem 0;
        display: flex;
        align-items: center;
        gap: 1rem;
    }
    .success-banner i {
        font-size: 1.5rem;
    }
    .info-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
        gap: 1.5rem;
        margin: 2rem 0;
    }
    .info-card {
        background: var(--background-color);
        padding: 1.5rem;
        border-radius: 6px;
        border: 1px solid var(--border-color);
    }
    .info-card-header {
        display: flex;
        align-items: center;
        gap: 0.75rem;
        margin-bottom: 1rem;
    }
    .info-card-header i {
        color: var(--accent-color);
        font-size: 1.25rem;
    }

    .text-color {
        color: var(--text-color);
    }

    .action-buttons {
        display: flex;
        flex-wrap: wrap;
        gap: 1rem;
        margin: 2rem 0;
    }
    .action-button {
        padding: 0.75rem 1.5rem;
        border-radius: 6px;
        font-weight: 500;
        display: inline-flex;
        align-items: center;
        gap: 0.5rem;
        transition: all 0.2s ease;
    }
    .action-button i {
        font-size: 1rem;
    }
    .cta-section {
        background: linear-gradient(to right, var(--primary-color), var(--accent-color));
        color: var(--text-color);
        padding: 2rem;
        border-radius: 8px;
        margin: 2rem 0;
        text-align: center;
    }
    .social-share {
        background: var(--background-color);
        padding: 2rem;
        border-radius: 8px;
        border: 1px solid var(--border-color);
        margin-top: 2rem;
    }
    .social-buttons {
        display: flex;
        flex-wrap: wrap;
        gap: 1rem;
        margin-top: 1.5rem;
    }
    .social-btn {
        padding: 0.75rem 1.25rem;
        border-radius: 6px;
        font-size: 0.875rem;
        font-weight: 500;
        flex: 1;
        min-width: 140px;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        gap: 0.5rem;
    }
</style>

<div class="thanks-container">
    <div class="thanks-header">
        <h1 class="h2 fw-bold mb-2">Invoice Generated Successfully</h1>
        <p class="mb-0 text-color">Your invoice has been created and is ready for use</p>
    </div>

    <div class="success-banner">
        <i class="fa-solid fa-circle-check"></i>
        <div>
            <h4 class="h6 fw-bold mb-1">Invoice #<?php echo $invoice_id; ?> Created</h4>
            <p class="mb-0 text-color">Your invoice has been generated and saved to your account</p>
        </div>
    </div>

    <div class="info-grid">
        <div class="info-card">
            <div class="info-card-header">
                <i class="fa-solid fa-download"></i>
                <h4 class="h6 fw-bold mb-0">Download Invoice</h4>
            </div>
            <p class="mb-0 text-color">Download your invoice as PDF for your records or to send to your client</p>
        </div>
        
        <div class="info-card">
            <div class="info-card-header">
                <i class="fa-solid fa-clock-rotate-left"></i>
                <h4 class="h6 fw-bold mb-0">Access Anytime</h4>
            </div>
            <p class="mb-0 text-color">Your invoice is securely stored and accessible from your history</p>
        </div>
    </div>

    <div class="action-buttons">
        <a href="temp.php?invoice_id=<?php echo $invoice_id; ?>" class="action-button btn btn-outline-primary">
            <i class="fa-solid fa-pen-to-square"></i>View Invoice
        </a>
        <a href="invoices.php" class="action-button btn btn-outline-secondary">
            <i class="fa-solid fa-clock-rotate-left"></i>View History
        </a>
        <a href="create.php" class="action-button btn btn-primary">
            <i class="fa-solid fa-plus"></i>Create New Invoice
        </a>
    </div>

    <?php if (!isset($_SESSION['email'])): ?>
    <div class="cta-section">
        <h3 class="h4 fw-bold mb-3">Unlock Premium Features</h3>
        <p class="mb-4 text-color">Create a free account to access your invoices and save them to your account.</p>
        <a href="../auth/register.php" class="btn btn-light btn-lg px-4">Create Free Account</a>
    </div>
    <?php endif; ?>

    <div class="social-share">
        <h3 class="h5 fw-bold mb-2">Share Invoice Generator</h3>
        <p class="text-muted mb-3 text-color">Help others discover our professional invoicing tool</p>
        
        <div class="social-buttons">
            <a href="#" class="social-btn btn btn-success">
                <i class="fa-brands fa-whatsapp"></i>WhatsApp
            </a>
            <a href="#" class="social-btn btn btn-primary">
                <i class="fa-brands fa-facebook-f"></i>Facebook
            </a>
            <a href="#" class="social-btn btn btn-info text-white">
                <i class="fa-brands fa-linkedin-in"></i>LinkedIn
            </a>
            <a href="#" class="social-btn btn btn-dark">
                <i class="fa-brands fa-x-twitter"></i>Twitter
            </a>
        </div>
    </div>
</div>

<?php include_once "../../includes/footer.php"; ?>