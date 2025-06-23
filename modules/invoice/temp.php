<?php

require_once "../app/connect.php";
require_once "../app/invoice.php";
include_once "../../includes/header.php";

$invoice = new Invoice();
$invoice_id = $_REQUEST['invoice_id'];
$invoice_data = $invoice->fetch_invoice($invoice_id);

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

$current_currency = $currencyMap[$invoice_data['currency']];

if (isset($_SESSION['user_id'])) {
$uid = $invoice_data['user_id'];
$fetch_visibility = "SELECT * FROM `visibility` WHERE `user_id` = $uid";
$res = $db->query($fetch_visibility);

if ($res) {
    $row_visibility = $res->fetch_assoc();
    $fields = explode(",", $row_visibility['field_visibility']);
}
} else {
    $fields = [];
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Invoice #<?= htmlspecialchars($invoice_data['invoice_number']); ?></title>
    <style>
        :root {
            --primary-color: #1a56db;
            --secondary-color: #4b5563;
            --background-color: #f9fafb;
            --border-color: #e5e7eb;
            --text-color: #111827;
            --hover-color: #1e40af;
            --accent-color: #3b82f6;
            --table-bg: #fff;
        }

        :root[data-theme="dark"] {
            --primary-color: #60a5fa;
            --secondary-color: #9ca3af;
            --background-color: #111827;
            --border-color: #374151;
            --text-color: #f9fafb;
            --hover-color: #3b82f6;
            --accent-color: #60a5fa;
            --table-bg: #1f2937;
        }

        .page-header {
            max-width: 1200px;
            margin: 50px auto 2rem;
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 0 1rem;
            flex-wrap: wrap;
            gap: 1rem;
        }

        .page-title {
            font-size: 1.875rem;
            font-weight: 700;
            color: #111827;
            margin: 0;
        }

        .action-bar {
            background: var(--table-bg);
            padding: 1rem;
            border-radius: 0.75rem;
            box-shadow: 0 1px 3px rgba(0, 0, 0, 0.1);
            margin-bottom: 1.5rem;
            display: flex;
            gap: 1rem;
            flex-wrap: wrap;
        }

        .invoice-container {
            max-width: 1200px;
            margin: 0 auto;
            background: var(--table-bg);
            border-radius: 1rem;
            box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1), 0 2px 4px -2px rgba(0, 0, 0, 0.05);
            padding: 2rem;
        }

        .invoice-header {
            display: grid;
            grid-template-columns: 1fr;
            gap: 2rem;
            margin-bottom: 2rem;
            padding-bottom: 1.5rem;
            border-bottom: 2px solid var(--border-color);
        }

        .company-details {
            display: flex;
            flex-direction: column;
            gap: 0.5rem;
        }

        .company-logo {
            font-size: 1.75rem;
            font-weight: 800;
            color: var(--primary-color);
            margin-bottom: 1rem;
            word-break: break-word;
        }

        .invoice-info {
            text-align: left;
        }

        .invoice-number {
            font-size: 1.25rem;
            font-weight: 700;
            color: var(--primary-color);
            margin-bottom: 1rem;
        }

        .invoice-meta {
            display: grid;
            gap: 0.5rem;
            color: var(--secondary-color);
        }

        .billing-grid {
            display: grid;
            grid-template-columns: 1fr;
            gap: 2rem;
            margin-bottom: 2rem;
        }

        .billing-section h3 {
            font-size: 0.875rem;
            text-transform: uppercase;
            letter-spacing: 0.1em;
            color: var(--secondary-color);
            margin-bottom: 1rem;
            font-weight: 600;
        }

        .billing-details {
            font-size: 0.875rem;
            line-height: 1.5;
        }

        .items-table {
            width: 100%;
            border-collapse: separate;
            border-spacing: 0;
            margin-bottom: 2rem;
            overflow-x: auto;
            display: block;
        }

        .items-table th {
            background: var(--background-color);
            padding: 1rem 0.75rem;
            text-align: left;
            font-weight: 600;
            font-size: 0.75rem;
            text-transform: uppercase;
            letter-spacing: 0.05em;
            border-bottom: 2px solid var(--border-color);
            white-space: nowrap;
        }

        .items-table td {
            padding: 1rem 0.75rem;
            border-bottom: 1px solid var(--border-color);
            color: var(--secondary-color);
            font-size: 0.875rem;
        }

        .amount-column {
            text-align: right;
            font-family: 'SF Mono', 'Monaco', monospace;
        }

        .summary-section {
            width: 100%;
            background: var(--background-color);
            padding: 1.5rem;
            border-radius: 0.75rem;
        }

        .summary-row {
            display: flex;
            justify-content: space-between;
            padding: 0.75rem 0;
            border-bottom: 1px solid var(--border-color);
            font-size: 0.875rem;
        }

        .summary-row.final {
            border-bottom: none;
            font-weight: 700;
            font-size: 1.125rem;
            color: var(--primary-color);
            padding-top: 1rem;
        }

        .notes-section {
            margin-top: 2rem;
            padding-top: 1.5rem;
            border-top: 2px solid var(--border-color);
        }

        .notes-section h3 {
            font-size: 0.875rem;
            color: var(--secondary-color);
            margin-bottom: 0.75rem;
            font-weight: 600;
        }

        .btn {
            padding: 0.625rem 1.25rem;
            border-radius: 0.5rem;
            font-weight: 500;
            text-decoration: none;
            display: inline-flex;
            align-items: center;
            gap: 0.5rem;
            transition: all 0.2s;
            border: none;
            cursor: pointer;
            font-size: 0.875rem;
            white-space: nowrap;
        }

        .btn-primary {
            background: var(--primary-color);
            color: white;
        }

        .btn-primary:hover {
            background: var(--hover-color);
            transform: translateY(-1px);
        }

        .btn-secondary {
            background: white;
            color: var(--secondary-color);
            border: 1px solid var(--border-color);
        }

        .btn-secondary:hover {
            background: var(--background-color);
            transform: translateY(-1px);
        }

        @media screen and (min-width: 768px) {
            .invoice-container {
                padding: 3rem;
            }

            .invoice-header {
                grid-template-columns: repeat(2, 1fr);
                gap: 4rem;
                margin-bottom: 3rem;
            }

            .invoice-info {
                text-align: right;
            }

            .company-logo {
                font-size: 2rem;
            }

            .billing-grid {
                grid-template-columns: repeat(2, 1fr);
                gap: 6rem;
                margin-bottom: 4rem;
            }

            .summary-section {
                margin-left: auto;
                width: 400px;
                padding: 2rem;
            }

            .billing-details {
                font-size: 1rem;
            }

            .items-table {
                display: table;
            }

            .items-table th {
                font-size: 0.875rem;
                padding: 1.25rem 1rem;
            }

            .items-table td {
                font-size: 1rem;
                padding: 1.25rem 1rem;
            }
        }

        @media screen and (max-width: 375px) {
            .action-bar a, button{
                font-size: 12px;
                width: 100% !important;
            }
        }

        @media print {
            body {
                padding: 0;
                background: white;
            }

            .action-bar {
                display: none;
            }

            .invoice-container {
                box-shadow: none;
                max-width: none;
                margin: 0;
                padding: 0;
            }

            .page-header {
                display: none;
            }
        }
    </style>
</head>

<body>
    <div class="page-header">
        <h1 class="page-title">Invoice Details</h1>
        <div class="action-bar">
            <a target="_blank" href="download.php?invoice_id=<?= $invoice_data['invoice_id']; ?>" class="btn btn-primary">
                <i class="fas fa-download"></i> Download PDF
            </a>
            <!-- <button class="btn btn-secondary text-secondary">
                <i class="fas fa-share-alt"></i> Share Invoice
            </button> -->
            <a href="download.php?invoice_id=<?= $invoice_data['invoice_id']; ?>" class="btn btn-secondary text-secondary">
                <i class="fas fa-print"></i> Print
            </a>
        </div>
    </div>

    <div class="invoice-container mb-5">
        <div class="invoice-header">
            <div class="company-details">
                <div class="company-logo">
                    <?php if (!empty($invoice_data['invoice_logo']) ): ?>
                        <img src="company_logo/<?= htmlspecialchars($invoice_data['invoice_logo']); ?>" alt="Company Logo"
                            style="height: 100px;display: block;margin: 0;">
                    <?php endif; ?>
                    <?= htmlspecialchars($invoice_data['company_name']); ?>
                </div>
                <div class="company-address">
                    <!--  -->
                    <?php if (!empty($invoice_data['ship_to'])): ?>
                        <?= htmlspecialchars($invoice_data['ship_to']); ?>
                    <?php endif; ?>
                </div>
            </div>
            <div class="invoice-info">
                <div class="invoice-number">Invoice #<?= htmlspecialchars($invoice_data['invoice_number']); ?></div>
                <div class="invoice-meta">
                    <div>Issue Date: <?= htmlspecialchars($invoice_data['invoice_date']); ?></div>
                    <?php if (!empty($invoice_data['due_date'])): ?>
                        <div>Due Date: <?= htmlspecialchars($invoice_data['due_date']); ?></div>
                    <?php endif; ?>
                    <!-- <div>Status: <span class="badge badge-success text-secondary">Paid</span></div> -->
                </div>
            </div>
        </div>

        <div class="billing-grid">
            <div class="billing-section">
                <h3>Bill To</h3>
                <div class="billing-details">
                    <strong><?= nl2br(htmlspecialchars($invoice_data['invoice_from'])); ?></strong><br>
                    <!-- <?= htmlspecialchars($invoice_data['address'] ?? ''); ?> -->
                </div>
            </div>
            <div class="billing-section">
                <h3>Ship To</h3>
                <div class="billing-details">
                    <strong><?= nl2br(htmlspecialchars($invoice_data['bill_to'])); ?></strong><br>
                    <!-- <?= htmlspecialchars($invoice_data['ship_address'] ?? ''); ?> -->
                </div>
            </div>
        </div>

        <table class="items-table">
            <thead>
                <tr>
                    <th>Item Description</th>
                    <th>Quantity</th>
                    <th class="amount-column">Unit Price</th>
                    <th class="amount-column">Amount</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($invoice_data['items'] as $item): ?>
                    <tr>
                        <td><?= htmlspecialchars($item['item_name']); ?></td>
                        <td><?= htmlspecialchars($item['item_quantity']); ?></td>
                        <td class="amount-column">
                            <?= $current_currency ?>     <?= htmlspecialchars(number_format($item['item_amount'], 2)); ?>
                        </td>
                        <td class="amount-column">
                            <?= $current_currency ?>     <?= htmlspecialchars(number_format($item['item_total'], 2)); ?>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>

        <div class="summary-section">
            <div class="summary-row">
                <span>Subtotal</span>
                <span><?= $current_currency ?><?= htmlspecialchars(number_format($invoice_data['subtotal'], 2)); ?></span>
            </div>
            <?php if (!empty($invoice_data['discount'])): ?>
                <div class="summary-row">
                    <span>Discount</span>
                    <span>-<?= $current_currency ?><?= htmlspecialchars(number_format($invoice_data['discount'], 2)); ?></span>
                </div>
            <?php endif; ?>
            <?php if (!empty($invoice_data['tax_charge'])): ?>
                <div class="summary-row">
                    <span>Tax</span>
                    <span>+<?= htmlspecialchars(number_format($invoice_data['tax_charge'], 2)); ?>%</span>
                </div>
            <?php endif; ?>
            <?php if (!empty($invoice_data['shipping_charge'])): ?>
                <div class="summary-row">
                    <span>Shipping</span>
                    <span>+<?= $current_currency ?><?= htmlspecialchars(number_format($invoice_data['shipping_charge'], 2)); ?></span>
                </div>
            <?php endif; ?>
            <?php if (!empty($invoice_data['paid_amount'])): ?>
                <div class="summary-row">
                    <span>Paid</span>
                    <span>-<?= $current_currency ?><?= htmlspecialchars(number_format($invoice_data['paid_amount'], 2)); ?></span>
                </div>
            <?php endif; ?>
            <div class="summary-row final">
                <span>Total Due</span>
                <span><?= $current_currency ?><?= htmlspecialchars(number_format($invoice_data['remainig_amount'], 2)); ?></span>
            </div>
        </div>


        <div class="notes-section">
            <?php if (!empty($invoice_data['notes'])): ?>
                <h3>Notes</h3>
                <p><?= htmlspecialchars($invoice_data['notes']); ?></p>
            <?php endif; ?>

            <?php if (!empty($invoice_data['terms'])): ?>
                <h3>Terms & Conditions</h3>
                <p><?= htmlspecialchars($invoice_data['terms']); ?></p>
            <?php endif; ?>
        </div>

    </div>
</body>

</html>

<?php include_once "../../includes/footer.php"; ?>