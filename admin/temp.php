<?php
require_once "../modules/app/connect.php";
require_once "../modules/app/invoice.php";

$invoice_id = $_REQUEST['invoice_id'];
$conn = new connect();
$invoice = new Invoice();
$invoice_info = $invoice->fetch_invoice($invoice_id);

$currencyMap = [
        "INR" => "₹",
        "EUR" => "€", 
        "GBP" => "£",
        "USD" => "$",
        "AUD" => "A$",
        "CAD" => "C$",
        "JPY" => "¥",
        "CNY" => "¥",
        "CHF" => "CHF",
        "SGD" => "S$",
        "NZD" => "NZ$", 
        "HKD" => "HK$",
        "SEK" => "kr",
        "NOK" => "kr",
        "KRW" => "₩",
        "ZAR" => "R",
        "BRL" => "R$",
        "MXN" => "$",
        "RUB" => "₽",
        "MYR" => "RM",
        "IDR" => "Rp"
];

$current_currency = $currencyMap[$invoice_info['currency']];
?>

<!DOCTYPE html>
<html lang="en">

<head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Invoice #<?php echo $invoice_info['invoice_id']; ?></title>

        <!-- CSS -->
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.1/css/all.min.css">

        <style>
                :root {
                        --primary-color: #2563eb;
                        --secondary-color: #475569;
                        --accent-color: #3b82f6;
                        --background-color: #f1f5f9;
                        --text-color: #1e293b;
                }

                body {
                        background: var(--background-color);
                        font-family: 'Inter', sans-serif;
                        color: var(--text-color);
                        line-height: 1.6;
                }

                .invoice-container {
                        background: #fff;
                        border-radius: 16px;
                        box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1);
                        margin: 2rem auto;
                        max-width: 1200px;
                        transition: all 0.3s ease;
                }

                .invoice-header {
                        padding: 2.5rem;
                        border-bottom: 2px solid var(--background-color);
                        background: linear-gradient(to right, var(--primary-color), var(--accent-color));
                        color: white;
                        border-radius: 16px 16px 0 0;
                }

                .company-logo {
                        max-height: 100px;
                        width: auto;
                        filter: drop-shadow(0 4px 6px rgba(0, 0, 0, 0.1));
                }

                .invoice-body {
                        padding: 2.5rem;
                }

                .table {
                        margin: 2rem 0;
                        border-collapse: separate;
                        border-spacing: 0 8px;
                }

                .table th {
                        background: var(--background-color);
                        font-weight: 600;
                        padding: 1.25rem;
                        color: var(--secondary-color);
                }

                .table td {
                        padding: 1.25rem;
                        background: white;
                        border-top: 1px solid var(--background-color);
                }

                .total-section {
                        background: var(--background-color);
                        padding: 2rem;
                        border-radius: 12px;
                        margin-top: 2rem;
                }

                .action-buttons .btn {
                        min-width: 140px;
                        padding: 0.75rem 1.5rem;
                        font-weight: 500;
                        transition: all 0.3s ease;
                }

                .btn-success {
                        background: var(--accent-color);
                        border: none;
                }

                .btn-success:hover {
                        background: var(--primary-color);
                        transform: translateY(-2px);
                }

                .text-muted {
                        color: var(--secondary-color) !important;
                }

                .section-title {
                        font-size: 1.25rem;
                        color: var(--primary-color);
                        margin-bottom: 1.5rem;
                        font-weight: 600;
                }

                .detail-card {
                        background: white;
                        padding: 1.5rem;
                        border-radius: 12px;
                        box-shadow: 0 2px 4px rgba(0, 0, 0, 0.05);
                        height: 100%;
                }

                @media (max-width: 768px) {
                        .invoice-container {
                                margin: 1rem;
                        }

                        .invoice-header {
                                padding: 1.5rem;
                        }

                        .action-buttons {
                                margin-top: 1rem;
                        }

                        .action-buttons .btn {
                                width: 100%;
                                margin-bottom: 0.5rem;
                        }
                }
        </style>
</head>

<body>
        <div class="container-fluid">
                <div class="invoice-container">
                        <!-- Header Section -->
                        <div class="invoice-header">
                                <div class="row align-items-center">
                                        <div class="col-md-6">
                                                <a href="index.php" class="btn btn-light mb-3">
                                                        <i class="fas fa-arrow-left"></i> Back
                                                </a>
                                                <h2 class="mb-2">Invoice #<?php echo $invoice_info['invoice_id']; ?></h2>
                                                <div class="text-light">
                                                        <i class="fas fa-calendar-alt me-2"></i><?php echo $invoice_info['invoice_date']; ?>
                                                        <i class="fas fa-user ms-3 me-2"></i><?php echo $invoice_info['bill_to']; ?>
                                                </div>
                                        </div>
                                        <div class="col-md-6 text-md-end">
                                                <div class="action-buttons">
                                                        <a href="../modules/invoice/download.php?invoice_id=<?php echo $invoice_info['invoice_id']; ?>" 
                                                           class="btn btn-light me-2">
                                                                <i class="fas fa-download me-2"></i>Download
                                                        </a>
                                                        <button class="btn btn-light">
                                                                <i class="fas fa-share-alt me-2"></i>Share
                                                        </button>
                                                </div>
                                        </div>
                                </div>
                        </div>

                        <div class="invoice-body">
                                <!-- Company Info -->
                                <div class="row mb-5">
                                        <div class="col-md-6">
                                                <div class="detail-card">
                                                        <img src="../modules/invoice/company_logo/<?= htmlspecialchars($invoice_data['invoice_logo']); ?>"
                                                             class="company-logo mb-3">
                                                        <div class="text-muted"><?php echo $invoice_info['invoice_from']; ?></div>
                                                </div>
                                        </div>
                                        <div class="col-md-6">
                                                <div class="detail-card text-md-end">
                                                        <h3 class="mb-2"><?php echo $invoice_info['company_name']; ?></h3>
                                                        <div class="text-muted">Invoice #<?php echo $invoice_info['invoice_id']; ?></div>
                                                </div>
                                        </div>
                                </div>

                                <!-- Billing Details -->
                                <div class="row mb-5">
                                        <div class="col-md-6">
                                                <div class="detail-card">
                                                        <h5 class="section-title">Bill To</h5>
                                                        <div><?php echo $invoice_info['bill_to']; ?></div>
                                                </div>
                                        </div>
                                        <div class="col-md-6">
                                                <div class="detail-card">
                                                        <h5 class="section-title">Ship To</h5>
                                                        <div><?php echo $invoice_info['ship_to']; ?></div>
                                                </div>
                                        </div>
                                </div>

                                <!-- Invoice Details -->
                                <div class="row mb-5">
                                        <div class="col-md-6">
                                                <div class="detail-card">
                                                        <table class="table table-borderless mb-0">
                                                                <tr>
                                                                        <td class="text-muted">Invoice Date:</td>
                                                                        <td><?php echo $invoice_info['invoice_date']; ?></td>
                                                                </tr>
                                                                <tr>
                                                                        <td class="text-muted">Payment Terms:</td>
                                                                        <td><?php echo $invoice_info['payment_terms']; ?></td>
                                                                </tr>
                                                        </table>
                                                </div>
                                        </div>
                                        <div class="col-md-6">
                                                <div class="detail-card">
                                                        <table class="table table-borderless mb-0">
                                                                <tr>
                                                                        <td class="text-muted">Due Date:</td>
                                                                        <td><?php echo $invoice_info['due_date']; ?></td>
                                                                </tr>
                                                                <tr>
                                                                        <td class="text-muted">PO Number:</td>
                                                                        <td><?php echo $invoice_info['po_number']; ?></td>
                                                                </tr>
                                                        </table>
                                                </div>
                                        </div>
                                </div>

                                <!-- Items Table -->
                                <div class="table-responsive mb-5">
                                        <table class="table">
                                                <thead>
                                                        <tr>
                                                                <th>Item</th>
                                                                <th class="text-end">Quantity</th>
                                                                <th class="text-end">Rate</th>
                                                                <th class="text-end">Amount</th>
                                                        </tr>
                                                </thead>
                                                <tbody>
                                                        <?php foreach ($invoice_info['items'] as $item): ?>
                                                                <tr>
                                                                        <td><?= htmlspecialchars($item['item_name']); ?></td>
                                                                        <td class="text-end"><?= htmlspecialchars($item['item_quantity']); ?></td>
                                                                        <td class="text-end"><?= $current_currency ?> <?= htmlspecialchars(number_format($item['item_amount'], 2)); ?></td>
                                                                        <td class="text-end"><?= $current_currency ?> <?= htmlspecialchars(number_format($item['item_total'], 2)); ?></td>
                                                                </tr>
                                                        <?php endforeach; ?>
                                                </tbody>
                                        </table>
                                </div>

                                <!-- Totals Section -->
                                <div class="row">
                                        <div class="col-md-6">
                                                <div class="detail-card">
                                                        <h5 class="section-title">Notes</h5>
                                                        <div class="mb-4"><?php echo $invoice_info['notes']; ?></div>
                                                        <h5 class="section-title">Terms</h5>
                                                        <div><?php echo $invoice_info['terms']; ?></div>
                                                </div>
                                        </div>
                                        <div class="col-md-6">
                                                <div class="total-section">
                                                        <table class="table table-borderless mb-0">
                                                                <tr>
                                                                        <td>Subtotal:</td>
                                                                        <td class="text-end"><?= $current_currency ?><?php echo $invoice_info['subtotal']; ?></td>
                                                                </tr>
                                                                <tr>
                                                                        <td>Discount:</td>
                                                                        <td class="text-end"><?= $current_currency ?><?php echo $invoice_info['discount']; ?></td>
                                                                </tr>
                                                                <tr>
                                                                        <td>Tax:</td>
                                                                        <td class="text-end"><?= $current_currency ?><?php echo $invoice_info['tax_charge']; ?></td>
                                                                </tr>
                                                                <tr>
                                                                        <td>Shipping:</td>
                                                                        <td class="text-end"><?= $current_currency ?><?php echo $invoice_info['shipping_charge']; ?></td>
                                                                </tr>
                                                                <tr class="border-top">
                                                                        <td class="fw-bold">Total:</td>
                                                                        <td class="text-end fw-bold"><?= $current_currency ?><?php echo $invoice_info['total_amount']; ?></td>
                                                                </tr>
                                                                <tr>
                                                                        <td>Amount Paid:</td>
                                                                        <td class="text-end"><?= $current_currency ?><?php echo $invoice_info['paid_amount']; ?></td>
                                                                </tr>
                                                                <tr>
                                                                        <td class="fw-bold">Balance Due:</td>
                                                                        <td class="text-end fw-bold"><?= $current_currency ?><?php echo $invoice_info['remainig_amount']; ?></td>
                                                                </tr>
                                                        </table>
                                                </div>
                                        </div>
                                </div>
                        </div>
                </div>
        </div>

        <!-- Scripts -->
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
        <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
</body>

</html>