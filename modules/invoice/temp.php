<?php
require_once "../app/connect.php";
require_once "../app/invoice.php";
include_once "../../includes/header.php";

$invoice = new Invoice();

$invoice_id = $_REQUEST['invoice_id'];
$invoice_data = $invoice->fetch_invoice($invoice_id);

?>

<style>
        header {
                background-color: #fff !important;
        }
</style>
<div class="container my-5 p-0">
        <div class="card mt-sm-3 pb-8">
                <div class="p-5 pb-0">
                        <div class="row align-items-center">
                                <div class="col-sm mb-2 mb-sm-0">

                                        <div class="d-sm-flex align-items-sm-center"><button class="btn border mx-2">
                                                        <a href="invoices.php"
                                                                class="text-secondary text-decoration-none"><i
                                                                        class="fa-solid fa-arrow-left fs-6 text-secondary fw-bold"></i></a>
                                                </button>
                                                <h1 class="page-header-title">Invoice
                                                        #<?= htmlspecialchars($invoice_data['invoice_number']); ?></h1>
                                                <span class="ms-2 ms-sm-3">
                                                        <i class="fas fa-calendar-alt"></i>
                                                        <?= htmlspecialchars($invoice_data['invoice_date']); ?>
                                                </span>
                                                <span class="ms-2 ms-sm-3">
                                                        <i class="fas fa-user"></i>
                                                        <?= htmlspecialchars($invoice_data['bill_to']); ?>
                                                </span>
                                        </div>
                                </div>
                        </div>

                        <div class="row" style="margin-left: 70px;">
                                <button class="btn btn-md btn-success d-flex justify-content-between align-items-center"
                                        style="width: auto;">
                                        <i class="fa-solid fa-arrow-down"></i>
                                        <span class="btn-title mx-2"> <a class="text-white text-decoration-none"
                                                        href="download.php?invoice_id=<?php echo $invoice_data['invoice_id']; ?>">
                                                        Download </a> </span>
                                </button>
                                <button class="btn btn-md btn-primary d-flex justify-content-between align-items-center ms-3 mx-2"
                                        style="width: auto;">
                                        <!-- <i class="fa-brands fa-facebook-f"></i> -->
                                        <span class="btn-title mx-2"> Share</span>
                                </button>
                        </div>
                </div>
                <hr />
                <div class="row px-1">
                        <div class="col-md-6 px-md-5 pt-5">
                                <div style="max-width: 350px;">
                                        <img src="company_logo/<?php echo $invoice_data['invoice_logo']; ?>"
                                                class="img-fluid" style="max-height: 100px;" />
                                </div>
                                <div class="mt-3">
                                        <div class="text-dark"><?= htmlspecialchars($invoice_data['invoice_from']); ?>
                                        </div>
                                </div>
                        </div>
                        <div class="col-md-6 text-end pt-5 pe-md-5 text-dark">
                                <div class="display-5"><?= htmlspecialchars($invoice_data['company_name']); ?></div>
                                <div class="fs-3 text-secondary">
                                        #<?= htmlspecialchars($invoice_data['invoice_number']); ?></div>
                        </div>
                </div>
                <div class="row mt-3 px-1">
                        <div class="col-md-8 px-md-5">
                                <div class="row">
                                        <div class="col-md-6">
                                                <div class="mt-3">
                                                        <div class="fs-6 text-secondary">Bill To</div>
                                                        <div class="text-dark">
                                                                <?= htmlspecialchars($invoice_data['bill_to']); ?>
                                                        </div>
                                                </div>
                                        </div>
                                        <div class="col-md-6">
                                                <div class="mt-3">
                                                        <div class="fs-6 text-secondary">Ship To</div>
                                                        <div class="text-dark">
                                                                <?= htmlspecialchars($invoice_data['ship_to']); ?>
                                                        </div>
                                                </div>
                                        </div>
                                </div>
                        </div>
                        <div class="col-md-4 px-md-5 mt-3 mt-md-0">
                                <div class="row mt-3">
                                        <div class="col-auto fs-6 text-secondary">Date</div>
                                        <div class="col text-end">
                                                <?= htmlspecialchars($invoice_data['invoice_date']); ?>
                                        </div>
                                </div>
                                <div class="row mt-3">
                                        <div class="col-auto fs-6 text-secondary">Payment Terms</div>
                                        <div class="col text-end">
                                                <?= htmlspecialchars($invoice_data['payment_terms']); ?>
                                        </div>
                                </div>
                                <div class="row mt-3">
                                        <div class="col-auto fs-6 text-secondary">Due Date</div>
                                        <div class="col text-end"><?= htmlspecialchars($invoice_data['due_date']); ?>
                                        </div>
                                </div>
                                <div class="row mt-3">
                                        <div class="col-auto fs-6 text-secondary">PO Number</div>
                                        <div class="col text-end"><?= htmlspecialchars($invoice_data['po_number']); ?>
                                        </div>
                                </div>
                        </div>
                </div>
                <div class="table-responsive mx-5 mt-5">
                        <table class="table table-borderless border-top table-thead-bordered">
                                <thead class="thead-light">
                                        <tr>
                                                <th class="ps-md-7">Item</th>
                                                <th class="text-end">Quantity</th>
                                                <th class="text-end">Rate</th>
                                                <th class="text-end pe-md-7">Amount</th>
                                        </tr>
                                </thead>
                                <tbody>
                                        <?php foreach ($invoice_data['items'] as $item): ?>
                                                <tr>
                                                        <td class="ps-md-7">
                                                                <div><?= htmlspecialchars($item['item_name']); ?></div>
                                                        </td>
                                                        <td class="text-end"><?= htmlspecialchars($item['item_quantity']); ?>
                                                        </td>
                                                        <td class="text-end">
                                                                $<?= htmlspecialchars(number_format($item['item_amount'], 2)); ?>
                                                        </td>
                                                        <td class="text-end pe-md-7">
                                                                $<?= htmlspecialchars(number_format($item['item_total'], 2)); ?>
                                                        </td>
                                                </tr>
                                        <?php endforeach; ?>
                                </tbody>
                                <tfoot>
                                        <tr>
                                                <td colspan="2"></td>
                                                <td class="text-end ps-3 border-top">Subtotal</td>
                                                <td class="text-end border-top pe-md-7">
                                                        $<?= htmlspecialchars(number_format($invoice_data['subtotal'], 2)); ?>
                                                </td>
                                        </tr>
                                        <tr>
                                                <td colspan="2"></td>
                                                <td class="text-end ps-3">Discount</td>
                                                <td class="text-end pe-md-7">
                                                        $<?= htmlspecialchars(number_format($invoice_data['discount'], 2)); ?>
                                                </td>
                                        </tr>
                                        <tr>
                                                <td colspan="2"></td>
                                                <td class="text-end ps-3">Tax</td>
                                                <td class="text-end pe-md-7">
                                                        $<?= htmlspecialchars(number_format($invoice_data['tax_charge'], 2)); ?>
                                                </td>
                                        </tr>
                                        <tr>
                                                <td colspan="2"></td>
                                                <td class="text-end ps-3">Shipping</td>
                                                <td class="text-end pe-md-7">
                                                        $<?= htmlspecialchars(number_format($invoice_data['shipping_charge'], 2)); ?>
                                                </td>
                                        </tr>
                                        <tr>
                                                <td colspan="2"></td>
                                                <td class="text-end ps-3 border-top fw-bold">Total</td>
                                                <td class="text-end border-top fw-bold pe-md-7">
                                                        $<?= htmlspecialchars(number_format($invoice_data['total_amount'], 2)); ?>
                                                </td>
                                        </tr>
                                        <tr>
                                                <td colspan="2"></td>
                                                <td class="text-end ps-3">Amount Paid</td>
                                                <td class="text-end pe-md-7">
                                                        $<?= htmlspecialchars(number_format($invoice_data['paid_amount'], 2)); ?>
                                                </td>
                                        </tr>
                                        <tr>
                                                <td colspan="2"></td>
                                                <td class="text-end ps-3 fw-bold">Balance Due</td>
                                                <td class="text-end pe-md-7 fw-bold">
                                                        $<?= htmlspecialchars(number_format($invoice_data['remainig_amount'], 2)); ?>
                                                </td>
                                        </tr>
                                </tfoot>
                        </table>
                </div>
                <div class="mt-3 px-5 px-md-8">
                        <div class="fs-6 text-secondary">Notes</div>
                        <div><?php echo $invoice_data['notes']; ?></div>
                </div>
                <div class="my-5 px-5 px-md-8">
                        <div class="fs-6 text-secondary">Terms</div>
                        <div><?php echo $invoice_data['terms']; ?></div>
                </div>
        </div>
</div>



<?php include_once "../../includes/footer.php"; ?>