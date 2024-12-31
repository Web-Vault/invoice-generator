<?php

include_once "../../includes/header.php";

require_once "../app/invoice.php";

if (isset($_SERVER['REQUEST_METHOD']) == 'POST' && isset($_POST['invoice'])) {
        $new_invoice = new Invoice();
        $new_invoice->add_items();
}

?>

<main class="mb-5 px-3">

        <style>

                body {
                        background-color: #fff !important;
                }

                textarea {
                        resize: none !important;
                        width: 97% !important;
                }

                input[type="text"]:focus,
                textarea:focus {
                        border: none !important;
                }
        </style>

        <div class="container-fluid learn-more-banner w-100 my-3 pb-4 border-bottom">
                <div class="row">
                        <div class="col-lg-8 col-md-10 col-sm-12 px-3">
                                <h1 class="fs-2 fw-semibold text">Free Invoice Template</h1>
                                <h2 class="fs-5 fw-bold text">Make beautiful Invoices with one click!</h2>
                                <p class="text-secondary text">
                                        Welcome to the original Invoice Generator, trusted by millions of people.
                                        Invoice Generator lets you instantly make Invoices with our attractive invoice
                                        template straight from your web browser. The Invoices you make can be sent and
                                        paid online or downloaded as a PDF.
                                </p>
                                <p class="text-secondary text">
                                        Did we also mention that Invoice Generator lets you generate an unlimited number
                                        of Invoices?
                                </p>
                                <div>
                                        <a href="#" class="btn btn-success px-4 py-2">OK, got it!</a>
                                </div>
                        </div>
                </div>
        </div>

        <?php

        $sql = "SELECT `invoice_number` FROM `invoice` ORDER BY `invoice_number` DESC LIMIT 1";
        $res = $db->query($sql);

        if ($res && $res->num_rows > 0) {
                $row = $res->fetch_assoc();
                // print_r($row);
        
        } else {
                echo "No records found.";
        }


        ?>

        <div class="container-fluid mx-2 mt-4">
                <form action="" method="post" name="invoice" enctype="multipart/form-data">
                        <div class="row d-flex justify-content-around py-3">
                                <div class="col-12 col-md-10 learn-more-banner py-2 row">
                                        <div class="row">
                                                <div class="col-12 col-md-9 d-flex align-items-center mb-3 mb-md-0">
                                                        <input type="file" id="fileInput" name="invoice_logo"
                                                                class="d-none">
                                                        <label for="fileInput" class="upload-box">
                                                                <span class="text-secondary fs-5">+ Add Your Logo</span>
                                                        </label>
                                                </div>
                                                <div class="col-12 col-md-3 d-flex flex-column align-items-end">
                                                        <input type="text" name="company_name"
                                                                class="form-control input-field my-1 text-end border-0 rounded-1 fs-2 w-100 py-2 d-block m-0"
                                                                value="INVOICE">
                                                        <input type="text" name="invoice_number"
                                                                class="form-control input-field my-1 text-end border rounded-1 w-auto fs-6 py-1 d-block m-0"
                                                                value="<?php echo $row['invoice_number'] + 1; ?>"
                                                                readonly>
                                                </div>
                                        </div>
                                        <div class="row mt-5">
                                                <div class="col-12 col-md-7">
                                                        <div class="col-12 col-md-8">
                                                                <textarea rows="3" name="invoice_from"
                                                                        class="form-control input-field my-1 text-start border rounded-1 w-100 d-block m-0"
                                                                        style="height: 65px;"
                                                                        placeholder="Who is this from?"></textarea>
                                                        </div>
                                                        <div class="row g-1">
                                                                <div class="col-12 col-md-6 ">
                                                                        <span class="text"> Bill To </span>
                                                                        <textarea rows="3" name="bill_to"
                                                                                class="form-control input-field my-1 text-start border rounded-1 d-block"
                                                                                style="height: 65px;"
                                                                                placeholder="Who is this to?"></textarea>
                                                                </div>
                                                                <div class="col-12 col-md-6">
                                                                        <span class="text"> Ship To </span>
                                                                        <textarea rows="3" name="ship_to"
                                                                                class="form-control input-field my-1 text-start border rounded-1 d-block"
                                                                                style="height: 65px;"
                                                                                placeholder="(Optional)"></textarea>
                                                                </div>
                                                        </div>
                                                </div>

                                                <div class="col-12 col-md-5 row">
                                                        <div
                                                                class="text col-md-7 d-flex justify-content-start justify-content-md-end align-items-center mb-2 mb-md-0">
                                                                Date
                                                        </div>
                                                        <div class="col-md-5 mb-2 mb-md-0">
                                                                <input type="date" name="invoice_date"
                                                                        class="form-control input-field my-1 text-end border rounded-1 w-100 py-1 d-block m-0"
                                                                        value="">
                                                        </div>
                                                        <div
                                                                class="text col-md-7 d-flex justify-content-start justify-content-md-end align-items-center mb-2 mb-md-0">
                                                                Payment Terms</div>
                                                        <div class="col-md-5 mb-2 mb-md-0">
                                                                <input type="text" name="payment_terms"
                                                                        class="form-control input-field my-1 text-end border rounded-1 w-100 py-1 d-block m-0"
                                                                        value="">
                                                        </div>
                                                        <div
                                                                class="text col-md-7 d-flex justify-content-start justify-content-md-end align-items-center mb-2 mb-md-0">
                                                                Due Date</div>
                                                        <div class="col-md-5 mb-2 mb-md-0">
                                                                <input type="date" name="due_date"
                                                                        class="form-control input-field my-1 text-end border rounded-1 w-100 py-1 d-block m-0"
                                                                        value="">
                                                        </div>
                                                        <div
                                                                class="text col-md-7 d-flex justify-content-start justify-content-md-end align-items-center mb-2 mb-md-0">
                                                                PO Number</div>
                                                        <div class="col-md-5 mb-2 mb-md-0">
                                                                <input type="text" name="po_number"
                                                                        class="form-control input-field my-1 text-end border rounded-1 w-100 py-1 d-block m-0"
                                                                        value="">
                                                        </div>
                                                </div>
                                        </div>

                                        <div class="row my-3">
                                                <table class="table border-0 rounded-1">
                                                        <thead class="table-dark rounded-top">
                                                                <tr>
                                                                        <th class="border-0 px-2"
                                                                                style="border-top-left-radius: 10px; border-bottom-left-radius: 10px;">
                                                                                Item</th>
                                                                        <th class="border-0 text-center px-1">
                                                                                Quantity</th>
                                                                        <th class="border-0 text-center px-1">
                                                                                Rate</th>
                                                                        <th class="border-0 text-center px-1"
                                                                                style="border-top-right-radius: 10px; border-bottom-right-radius: 10px;">
                                                                                Amount</th>
                                                                </tr>
                                                        </thead>
                                                        <tbody class="border-0" id="Rows">
                                                                <tr class="border-0">
                                                                        <td class="border-0 align-middle">
                                                                                <input type="text" name="item_name[]"
                                                                                        id="item"
                                                                                        class="item border rounded-1 form-control input-field w-100"
                                                                                        placeholder="Description of Item / Service..">
                                                                        </td>
                                                                        <td class="border-0 align-middle">
                                                                                <input type="number"
                                                                                        name="item_quantity[]" id="qty"
                                                                                        class="qty text-end form-control border rounded-1 input-field w-100"
                                                                                        value="1">
                                                                        </td>
                                                                        <td class="border-0 align-middle">
                                                                                <div
                                                                                        class="input-group border rounded-1">
                                                                                        <span
                                                                                                class="input-group-text border-0 bg-light currency_sign">₹</span>
                                                                                        <input type="number"
                                                                                                name="item_amount[]"
                                                                                                id="rate"
                                                                                                class="rate border-0 text-end form-control input-field"
                                                                                                value="0">
                                                                                </div>
                                                                        </td>
                                                                        <td class="border-0 text-center align-middle">
                                                                                <span id="item_total"
                                                                                        class="item-total"> <span
                                                                                                class="currency_sign">₹</span>
                                                                                        0.00</span>
                                                                        </td>
                                                                </tr>
                                                        </tbody>
                                                        <tr class="border-0">
                                                                <td class="border-0" colspan="4">
                                                                        <button type="button" id="add-row"
                                                                                class="btn btn-outline-success d-inline-flex align-items-center justify-content-center fs-6"
                                                                                onclick="addRow()">
                                                                                <i class="fa-solid fa-plus"></i>
                                                                                <span class="mx-1">Line Item</span>
                                                                        </button>
                                                                </td>
                                                        </tr>
                                                </table>

                                                <script>
                                                        document.addEventListener('input', function (event) {
                                                                if (event.target.matches('.qty') || event.target.matches('.rate')) {
                                                                        const row = event.target.closest('tr');
                                                                        const qty = row.querySelector('.qty').value || 0;
                                                                        const rate = row.querySelector('.rate').value || 0;
                                                                        const total = (qty * rate).toFixed(2);
                                                                        row.querySelector('.item-total').textContent = `$${total}`;
                                                                }

                                                        });
                                                </script>

                                                <div class="row border p-1">
                                                        <div class="col-12 col-sm-6">
                                                                <div class="mb-3">
                                                                        <input type="text" name="notes" id="notes"
                                                                                class="text form-control border-0 fw-semibold text-secondary bg-transparent"
                                                                                value="Notes" readonly>
                                                                        <textarea name="notes_info" id="notes-info"
                                                                                class="form-control border-1 rounded-1"
                                                                                style="font-size: 13px;"
                                                                                placeholder="Notes - Any relevant information not already covered"
                                                                                rows="3"></textarea>
                                                                </div>
                                                                <div>
                                                                        <input type="text" name="terms" id="terms"
                                                                                class="text form-control border-0 fw-semibold text-secondary bg-transparent"
                                                                                value="Terms" readonly>
                                                                        <textarea name="terms_info" id="terms-info"
                                                                                class="form-control border-1 rounded-1"
                                                                                style="font-size: 13px;"
                                                                                placeholder="Terms and conditions - late fees, payment methods, delivery schedule"
                                                                                rows="3"></textarea>
                                                                </div>
                                                        </div>
                                                        <div class="col-12 col-sm-6">
                                                                <div class="row mb-2 align-items-center">
                                                                        <div class="col-8">
                                                                                <input type="text" name="subtotal"
                                                                                        id="subtotal"
                                                                                        class="text form-control text-end border-0 bg-transparent text-secondary fw-semibold "
                                                                                        value="Subtotal" readonly>
                                                                        </div>
                                                                        <div class="col-4 text-end py-2" id="subtotal">
                                                                                <span class="currency_sign"
                                                                                        id="currency_sign">₹</span>0.00
                                                                        </div>
                                                                </div>

                                                                <div class="m-0 p-0 options">
                                                                        <div class="row mb-2 align-items-center"
                                                                                id="div1">
                                                                                <div class="col-8">
                                                                                        <input type="text"
                                                                                                name="Discount"
                                                                                                id="discount"
                                                                                                class="text form-control text-end border-0 bg-transparent text-secondary fw-semibold"
                                                                                                value="Discount"
                                                                                                readonly>
                                                                                </div>
                                                                                <div class="col-4 ps-0">
                                                                                        <div
                                                                                                class="input-group border rounded">
                                                                                                <input type="text"
                                                                                                        name="discount"
                                                                                                        id="discount-val"
                                                                                                        class="form-control text-end border-0"
                                                                                                        value="0"
                                                                                                        onblur="updateAmounts()">
                                                                                                <span class="input-group-text bg-light border-0 currency_sign"
                                                                                                        id="currency_sign">₹</span>
                                                                                        </div>
                                                                                </div>
                                                                        </div>
                                                                        <div class="row mb-2 align-items-center"
                                                                                id="div2">
                                                                                <div class="col-8">
                                                                                        <input type="text" name="tax"
                                                                                                id="tax"
                                                                                                class="text form-control text-end border-0 bg-transparent text-secondary fw-semibold"
                                                                                                value="Tax" readonly>
                                                                                </div>
                                                                                <div class="col-4 ps-0">
                                                                                        <div
                                                                                                class="input-group border rounded">
                                                                                                <input type="text"
                                                                                                        name="tax_charge"
                                                                                                        id="tax-val"
                                                                                                        class="form-control text-end border-0"
                                                                                                        value="0"
                                                                                                        onblur="updateAmounts()">
                                                                                                <span class="input-group-text bg-light border-0 currency_sign"
                                                                                                        id="currency_sign">₹</span>
                                                                                        </div>
                                                                                </div>
                                                                        </div>
                                                                        <div class="row mb-2 align-items-center"
                                                                                id="div3">
                                                                                <div class="col-8">
                                                                                        <input type="text"
                                                                                                name="Shipping"
                                                                                                id="shipping"
                                                                                                class="text form-control text-end border-0 bg-transparent text-secondary fw-semibold"
                                                                                                value="Shipping"
                                                                                                readonly>
                                                                                </div>
                                                                                <div class="col-4 ps-0">
                                                                                        <div
                                                                                                class="input-group border rounded">
                                                                                                <input type="text"
                                                                                                        name="shipping_charge"
                                                                                                        id="ship-val"
                                                                                                        class="form-control text-end border-0"
                                                                                                        value="0"
                                                                                                        onblur="updateAmounts()">
                                                                                                <span class="input-group-text bg-light border-0 currency_sign"
                                                                                                        id="currency_sign">₹</span>
                                                                                        </div>
                                                                                </div>
                                                                        </div>
                                                                </div>
                                                                <div class="add-options text-end my-3 mx-2">
                                                                        <span class="text text-success fw-bold fs-6 px-2 discount"
                                                                                id="toggleDiv1">
                                                                                <i class="fa-solid fa-minus"></i>
                                                                                Discount
                                                                        </span>
                                                                        <span class="text text-success fw-bold fs-6 px-2 tax"
                                                                                id="toggleDiv2">
                                                                                <i class="fa-solid fa-minus"></i> Tax
                                                                        </span>
                                                                        <span class="text text-success fw-bold fs-6 px-2 shipping"
                                                                                id="toggleDiv3">
                                                                                <i class="fa-solid fa-minus"></i>
                                                                                Shipping
                                                                        </span>
                                                                </div>
                                                                <div class="row mb-2 align-items-center">
                                                                        <div class="col-8">
                                                                                <input type="text" name="Total"
                                                                                        class="text form-control text-end border-0 bg-transparent text-secondary fw-semibold"
                                                                                        value="Total" readonly>
                                                                        </div>
                                                                        <div id="Total"
                                                                                class="col-4 ps-0 text-end py-2"><span
                                                                                        class="currency_sign">
                                                                                        ₹</span>0.00
                                                                        </div>
                                                                </div>
                                                                <div class="row mb-2 align-items-center">
                                                                        <div class="col-8">
                                                                                <input type="text" name="paid" id="paid"
                                                                                        class="text form-control text-end border-0 bg-transparent text-secondary fw-semibold"
                                                                                        value="Amount paid" readonly>
                                                                        </div>
                                                                        <div class="col-4 ps-0">
                                                                                <div class="input-group border rounded">
                                                                                        <span class="input-group-text bg-light border-0 currency_sign"
                                                                                                id="currency_sign">₹</span>
                                                                                        <input type="text"
                                                                                                name="paid_amount"
                                                                                                class="form-control text-end border-0"
                                                                                                value="0"
                                                                                                onblur="updateAmounts()">
                                                                                </div>
                                                                        </div>
                                                                </div>
                                                                <div class="row mb-2 align-items-center">
                                                                        <div class="col-8">
                                                                                <input type="text" name="B-due"
                                                                                        id="B-due"
                                                                                        class="text form-control text-end border-0 bg-transparent text-secondary fw-semibold"
                                                                                        value="Balance Due" readonly>
                                                                        </div>
                                                                        <div id="B-due"
                                                                                class="col-4 ps-0 text-end py-2"><span
                                                                                        class="currency_sign">
                                                                                        ₹</span>0.00
                                                                        </div>
                                                                </div>
                                                        </div>

                                                        <script>
                                                                function updateAmounts() {

                                                                        const subtotal = parseFloat(document.getElementById('subtotal').textContent.replace('$', '') || 0);
                                                                        const discount = parseFloat(document.getElementById('discount-val').value || 0);
                                                                        const tax = parseFloat(document.getElementById('tax-val').value || 0);
                                                                        const shipping = parseFloat(document.getElementById('ship-val').value || 0);
                                                                        const paid = parseFloat(document.querySelector('input[name="paid_amount"]').value || 0);

                                                                        const total = subtotal - discount + tax + shipping;

                                                                        const balanceDue = total - paid;

                                                                        document.getElementById('Total').innerHTML = `${total.toFixed(2)}`;
                                                                        document.getElementById('B-due').innerHTML = `${balanceDue.toFixed(2)}`;
                                                                }

                                                        </script>

                                                </div>
                                        </div>
                                </div>

                                <div class="col-lg-2 col-md-6 col-sm-12 d-block mt-2">
                                        <button type="submit" name="invoice"
                                                class="btn btn-lg btn-success my-3 w-100">Create Invoice</button>
                                        <div class="container-fluid border-top my-3 m-3 w-auto">
                                                <div class="col mt-3">
                                                        <h6 class="text"><small>Currency</small></h6>
                                                        <select class="text form-select" name="currency" id="currencySelect"
                                                                onchange="change_currency()"
                                                                aria-label="Currency select">
                                                                <option value="INR" selected>INR</option>
                                                                <option value="EUR">EUR</option>
                                                                <option value="GBP">GBP</option>
                                                                <option value="USD">USD</option>
                                                                <option value="AUD">AUD</option>
                                                                <option value="CAD">CAD</option>
                                                                <option value="JPY">JPY</option>
                                                                <option value="CNY">CNY</option>
                                                                <option value="CHF">CHF</option>
                                                                <option value="SGD">SGD</option>
                                                                <option value="NZD">NZD</option>
                                                                <option value="HKD">HKD</option>
                                                                <option value="SEK">SEK</option>
                                                                <option value="NOK">NOK</option>
                                                                <option value="KRW">KRW</option>
                                                                <option value="ZAR">ZAR</option>
                                                                <option value="BRL">BRL</option>
                                                                <option value="MXN">MXN</option>
                                                                <option value="RUB">RUB</option>
                                                                <option value="MYR">MYR</option>
                                                                <option value="IDR">IDR</option>

                                                        </select>
                                                </div>
                                        </div>
                                        <!-- <p class="text-success fw-bold text-center w-100 mx-auto"
                                                style="cursor: pointer;">Save Defaut</p> -->

                                        <script>
                                                // Object mapping currency codes to their symbols
                                                const currencyMap = {
                                                        "INR": "₹",
                                                        "EUR": "€",
                                                        "GBP": "£",
                                                        "USD": "$",
                                                        "AUD": "A$",
                                                        "CAD": "C$",
                                                        "JPY": "¥",
                                                        "CNY": "¥",
                                                        "CHF": "CHF",
                                                        "SGD": "S$",
                                                        "NZD": "NZ$",
                                                        "HKD": "HK$",
                                                        "SEK": "kr",
                                                        "NOK": "kr",
                                                        "KRW": "₩",
                                                        "ZAR": "R",
                                                        "BRL": "R$",
                                                        "MXN": "$",
                                                        "RUB": "₽",
                                                        "MYR": "RM",
                                                        "IDR": "Rp"
                                                };

                                                function change_currency() {
                                                        const selectedCurrency = document.getElementById("currencySelect").value;
                                                        const currencySymbol = currencyMap[selectedCurrency];

                                                        const currencySigns = document.querySelectorAll(".currency_sign");

                                                        currencySigns.forEach(span => {
                                                                span.textContent = currencySymbol;
                                                        });
                                                }
                                        </script>

                                </div>
                        </div>
                </form>
        </div>

        <script>
                $(document).ready(function () {
                        $('#toggleDiv1').click(function () {
                                $('#div1').toggle();
                                $('#discount-val').val(0);
                                if ($('#div1').is(':visible')) {
                                        $(this).html('<i class="fa-solid fa-minus"></i> Discount');
                                } else {
                                        $(this).html('<i class="fa-solid fa-plus"></i> Discount');
                                }
                        });

                        $('#toggleDiv2').click(function () {
                                $('#div2').toggle();
                                $('#tax-val').val(0);
                                if ($('#div2').is(':visible')) {
                                        $(this).html('<i class="fa-solid fa-minus"></i> Tax');
                                } else {
                                        $(this).html('<i class="fa-solid fa-plus"></i> Tax');
                                }
                        });

                        $('#toggleDiv3').click(function () {
                                $('#div3').toggle();
                                $('#ship-val').val(0);

                                if ($('#div3').is(':visible')) {
                                        $(this).html('<i class="fa-solid fa-minus"></i> Shipping');
                                } else {
                                        $(this).html('<i class="fa-solid fa-plus"></i> Shipping');
                                }
                        });
                });
        </script>

        <script>
                document.getElementById('invoice-table').addEventListener('input', function (event) {
                        if (event.target.matches('.qty') || event.target.matches('.rate')) {
                                const row = event.target.closest('tr');
                                const qty = parseFloat(row.querySelector('.qty').value) || 0;
                                const rate = parseFloat(row.querySelector('.rate').value) || 0;
                                const total = (qty * rate).toFixed(2);
                                row.querySelector('.item-total').textContent = `<span class="currency_sign">₹</span>${total}`;
                        }
                });

                document.getElementById('add-row').addEventListener('click', function () {
                        const table = document.getElementById('invoice-table');
                        const newRow = `
                        <tr class="border-0">
                                                                        <td class="border-0 align-middle">
                                                                                <input type="text" name="item_name[]"
                                                                                        id="item"
                                                                                        class="item border rounded-1 form-control input-field w-100"
                                                                                        placeholder="Description of Item / Service..">
                                                                        </td>
                                                                        <td class="border-0 align-middle">
                                                                                <input type="number"
                                                                                        name="item_quantity[]" id="qty"
                                                                                        class="qty text-end form-control border rounded-1 input-field w-100"
                                                                                        value="1">
                                                                        </td>
                                                                        <td class="border-0 align-middle">
                                                                                <div
                                                                                        class="input-group border rounded-1">
                                                                                        <span
                                                                                                class="input-group-text border-0 bg-light currency_sign">₹</span>
                                                                                        <input type="number"
                                                                                                name="item_amount[]"
                                                                                                id="rate"
                                                                                                class="rate border-0 text-end form-control input-field"
                                                                                                value="0">
                                                                                </div>
                                                                        </td>
                                                                        <td class="border-0 text-center align-middle">
                                                                                <span id="item_total"
                                                                                        class="item-total"> <span class="currency_sign">₹</span> 0.00</span>
                                                                        </td>
                                                                </tr>`;

                        table.insertAdjacentHTML('beforeend', newRow);
                });
        </script>

        <script src="../../assets/dynamic.js"></script>
</main>

<?php include_once "../../includes/footer.php"; ?>