<?php

include_once "../../includes/header.php";
require_once "../app/invoice.php";

$invoice = new Invoice();
$invoice_list = $invoice->history();
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
            --table-bg: #ffffff;
            --text-muted: #6B7280;
            --shadow-color: rgba(0, 0, 0, 0.15);
            --danger-color: #dc3545;
            --danger-hover: #bb2d3b;
            --danger-bg-hover: rgba(220, 53, 69, 0.1);
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
            --text-muted: #9ca3af;
            --shadow-color: rgba(0, 0, 0, 0.3);
            --danger-color: #ef4444;
            --danger-hover: #dc2626;
            --danger-bg-hover: rgba(239, 68, 68, 0.1);
        }

        /* Base styles */
        .invoice-container {
                background-color: var(--background-color);
                box-shadow: 0 4px 12px var(--shadow-color);
                border-radius: 12px;
        }
        .invoice-header {
                border-bottom: 1px solid var(--border-color);
                padding: 1rem;
        }
        .invoice-body {
                padding: 1rem;
        }
        .table {
                margin-bottom: 0;
                background-color: var(--table-bg);
                border-color: var(--border-color);
        }
        .table th {
                font-size: 0.75rem;
                text-transform: uppercase;
                letter-spacing: 0.5px;
                color: var(--text-color);
                font-weight: 600;
                padding: 0.75rem;
                background-color: var(--background-color);
                border-bottom-color: var(--border-color);
        }
        .table td {
                vertical-align: middle;
                color: var(--text-color);
                padding: 0.75rem;
                font-size: 0.875rem;
                border-bottom-color: var(--border-color);
                background-color: var(--table-bg);
        }
        .table tbody {
                background-color: var(--table-bg);
        }
        
        .btn-view {
                background-color: var(--primary-color);
                border: none;
                padding: 0.4rem 1rem;
                border-radius: 6px;
                font-weight: 500;
                transition: all 0.2s;
        }
        .btn-view:hover {
                background-color: var(--hover-color);
                transform: translateY(-1px);
        }
        .btn-delete {
                color: var(--danger-color);
                transition: all 0.2s;
                padding: 0.4rem;
                border-radius: 6px;
        }
        .btn-delete:hover {
                color: var(--danger-hover);
                background-color: var(--danger-bg-hover);
        }
        .create-invoice-btn {
                background-color: var(--accent-color);
                transition: all 0.2s;
                font-weight: 500;
                padding: 0.4rem 1rem;
        }
        .create-invoice-btn:hover {
                background-color: var(--hover-color);
                transform: translateY(-1px);
        }
        .empty-state {
                padding: 2rem 0;
        }
        .empty-state i {
                color: var(--secondary-color);
                margin-bottom: 0.75rem;
        }
        .text-muted {
                color: var(--text-muted) !important;
        }

        /* Mobile devices (below 576px) */
        @media screen and (max-width: 575px) {
            .invoice-header {
                padding: 1rem;
                flex-direction: column;
                gap: 1rem;
            }
            .invoice-body {
                padding: 1rem;
            }
            .table-responsive {
                margin: 0 -1rem;
                overflow-x: auto;
                width: 100%;
            }
            .table {
                min-width: 800px; /* Ensures table maintains minimum width */
                width: 100%;
            }
            .table th,
            .table td {
                min-width: 120px; /* Minimum width for cells */
                white-space: nowrap;
                padding: 0.75rem;
            }
            .table td:last-child {
                min-width: 150px; /* More space for action buttons */
            }
            .btn-view, .btn-delete {
                padding: 0.375rem 0.75rem;
                font-size: 0.875rem;
            }
            .create-invoice-btn {
                width: 100%;
                text-align: center;
            }
        }

        /* Small devices (phones, 576px and up) */
        @media screen and (min-width: 576px) {
            .invoice-header {
                padding: 1.25rem;
            }
            .invoice-body {
                padding: 1.25rem;
            }
            .table-responsive {
                overflow-x: auto;
                width: 100%;
            }
            .table {
                min-width: 800px;
                width: 100%;
            }
            .table th {
                font-size: 0.8rem;
                padding: 0.75rem;
                white-space: nowrap;
            }
            .table td {
                font-size: 0.9rem;
                padding: 0.75rem;
                white-space: nowrap;
            }
        }

        /* Medium devices (tablets, 768px and up) */
        @media screen and (min-width: 768px) {
            .invoice-header {
                padding: 1.5rem;
            }
            .invoice-body {
                padding: 1.5rem;
            }
            .table th {
                font-size: 0.85rem;
                padding: 1rem;
            }
            .table td {
                font-size: 0.925rem;
                padding: 1rem;
            }
            .btn-view, .create-invoice-btn {
                padding: 0.5rem 1.25rem;
            }
        }

        /* Large devices (desktops, 992px and up) */
        @media screen and (min-width: 992px) {
            .invoice-header {
                padding: 1.5rem 2rem;
            }
            .invoice-body {
                padding: 2rem;
            }
            .table th {
                font-size: 0.875rem;
                padding: 1rem;
            }
            .table td {
                font-size: 0.95rem;
                padding: 1rem;
            }
            .empty-state {
                padding: 3rem 0;
            }
        }

        /* Extra large devices (large desktops, 1200px and up) */
        @media screen and (min-width: 1200px) {
            .invoice-container {
                max-width: 1140px;
                margin: 0 auto;
            }
        }

        /* Print styles */
        @media print {
            .invoice-container {
                box-shadow: none;
                max-width: none;
                margin: 0;
                padding: 0;
            }
            .btn-view, .btn-delete, .create-invoice-btn {
                display: none;
            }
        }
</style>
</style>


<div class="container py-5">
        <div class="invoice-container">
                <div class="invoice-header d-flex justify-content-between align-items-center">
                        <div>
                                <h3 class="mb-0 fw-bold">Invoice History</h3>
                                <p class="text-muted mb-0 mt-1">Manage and track your invoices</p>
                        </div>
                        <a href="create.php" class="btn create-invoice-btn text-white px-4 py-2">
                                <i class="fas fa-plus me-2"></i>Create Invoice
                        </a>
                </div>

                <div class="invoice-body">
                        <div class="table-responsive">
                                <table class="table">
                                        <thead>
                                                <tr>
                                                        <th>Customer</th>
                                                        <th>Reference</th>
                                                        <th>Issue Date</th>
                                                        <th>Due Date</th>
                                                        <th>Amount</th>
                                                        <th class="text-center">Actions</th>
                                                </tr>
                                        </thead>
                                        <tbody>
                                                <?php if ($invoice_list === "No Data Found!" || empty($invoice_list)): ?>
                                                        <tr>
                                                                <td colspan="6" class="text-center empty-state py-5">
                                                                        <i class="fas fa-file-invoice fa-3x d-block"></i>
                                                                        <h5 class="fw-medium mb-1">No Invoices Found</h5>
                                                                        <p class="text-muted mb-0">Create your first invoice to get started</p>
                                                                </td>
                                                        </tr>
                                                <?php else: ?>
                                                        
                                                        <?php foreach ($invoice_list as $invoice_list_id => $invoice_data):

                                                                
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
                                                                        
                                                                        ?>

                                                                <tr>
                                                                        <td class="fw-medium"><?php echo nl2br($invoice_data['bill_to']); ?></td>
                                                                        <td><span class="text-muted">#</span><?php echo $invoice_data['invoice_number']; ?></td>
                                                                        <td><?php echo $invoice_data['invoice_date']; ?></td>
                                                                        <td><?php echo $invoice_data['due_date']; ?></td>
                                                                        <td class="fw-medium"><?php echo $current_currency; ?><?php echo number_format($invoice_data['remainig_amount'], 2); ?></td>
                                                                        <td class="text-center">
                                                                                <a href="temp.php?invoice_id=<?php echo $invoice_data['invoice_id']; ?>" 
                                                                                   class="btn btn-view btn-sm text-white me-2">
                                                                                        <i class="fas fa-eye me-1"></i>View
                                                                                </a>
                                                                                <a href="delete_invoice.php?invoice_id=<?php echo $invoice_data['invoice_id']; ?>" 
                                                                                   class="btn-delete text-decoration-none">
                                                                                        <i class="fas fa-trash-alt"></i>
                                                                                </a>
                                                                        </td>
                                                                </tr>
                                                        <?php endforeach; ?>
                                                <?php endif; ?>
                                        </tbody>
                                </table>
                        </div>
                </div>
        </div>
</div>

<?php include_once "../../includes/footer.php"; ?>