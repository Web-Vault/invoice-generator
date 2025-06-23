<?php

include_once "../../includes/header.php";

require_once "../app/invoice.php";

if (isset($_SERVER['REQUEST_METHOD']) == 'POST' && isset($_POST['invoice'])) {


    $new_invoice = new Invoice();
    $new_invoice->add_items();

    //     echo "<pre>";
// print_r($_POST);
// echo "</pre>";
// echo $_FILES['invoice_logo']['name'];

}

?>

<main class="container-fluid py-5">
    <style>
        :root {
            --primary-color: #1a56db;
            --secondary-color: #4b5563;
            --background-color: #f9fafb;
            --border-color: #e5e7eb;
            --text-color: #111827;
            --hover-color: #1e40af;
            --accent-color: #3b82f6;
            --white: #ffffff;
            --light-gray: #f3f4f6;
            --success: #00c853;
            --shadow: 0 1px 3px rgba(0, 0, 0, 0.1);
            --border-radius: 0.5rem;
        }

        :root[data-theme="dark"] {
            --primary-color: #60a5fa;
            --secondary-color: #9ca3af;
            --background-color: #111827;
            --border-color: #374151;
            --text-color: #f9fafb;
            --hover-color: #3b82f6;
            --accent-color: #60a5fa;
            --white: #1f2937;
            --light-gray: #374151;
            --success: #059669;
            --shadow: 0 1px 3px rgba(0, 0, 0, 0.3);
        }

        .invoice-form {
            background-color: var(--white);
            border-radius: var(--border-radius);
            box-shadow: var(--shadow);
            margin-bottom: 2.5rem;
            position: relative;
        }

        .form-header {
            padding: 2rem;
            border-bottom: 1px solid var(--light-gray);
            border-radius: var(--border-radius) var(--border-radius) 0 0;
            color: var(--text-color);
        }

        .form-content {
            padding: 2.5rem;
        }

        .form-control {
            border: 1.5px solid var(--border-color);
            border-radius: var(--border-radius);
            padding: 0.75rem 1rem;
            transition: all 0.3s ease;
            font-size: 0.95rem;
            background-color: var(--white);
            color: var(--text-color);
        }

        .form-control:focus {
            box-shadow: 0 0 0 3px rgba(96, 165, 250, 0.2);
            border-color: var(--accent-color);
        }

        .form-label {
            font-weight: 600;
            color: var(--text-color);
            margin-bottom: 0.75rem;
            font-size: 0.9rem;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }

        .btn {
            border-radius: var(--border-radius);
            transition: all 0.3s ease;
            text-transform: uppercase;
        }

        .btn-success {
            background-color: var(--success);
            border: none;
            box-shadow: 0 4px 12px rgba(5, 150, 105, 0.2);
        }

        .btn-success:hover {
            background-color: var(--success);
            transform: translateY(-2px);
            box-shadow: 0 6px 16px rgba(5, 150, 105, 0.3);
        }

        .invoice-table {
            border-collapse: separate;
            border-spacing: 0;
            width: 100%;
            margin: 2rem 0;
            background: var(--white);
            border-radius: var(--border-radius);
            overflow: hidden;
            box-shadow: var(--shadow);
        }

        .invoice-table th {
            color: var(--text-color);
            border-bottom: 1px solid var(--border-color);
            font-weight: 600;
            padding: 1.25rem;
            font-size: 0.9rem;
            text-transform: uppercase;
            letter-spacing: 1px;
        }

        .invoice-table td {
            padding: 1.25rem;
            border-bottom: 1px solid var(--border-color);
            vertical-align: middle;
            color: var(--text-color);
        }

        .summary-card {
            background: var(--white);
            border-radius: var(--border-radius);
            padding: 2rem;
            color: var(--text-color);
        }

        .summary-item {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 1rem 0;
            border-bottom: 1px solid var(--border-color);
        }

        .summary-item:last-child {
            border-bottom: none;
        }

        .currency-select {
            min-width: 200px;
            border-radius: var(--border-radius);
            padding: 0.75rem;
            border: 1.5px solid var(--border-color);
            font-weight: 500;
            background-color: var(--white);
            color: var(--text-color);
        }

        .image-preview {
            max-width: 200px;
            margin-top: 1rem;
            border-radius: var(--border-radius);
            box-shadow: var(--shadow);
        }

        .input-group-text {
            background-color: var(--light-gray);
            border: 1.5px solid var(--border-color);
            border-radius: var(--border-radius);
            padding: 0.75rem 1rem;
            color: var(--text-color);
        }

        .card {
            background-color: var(--white);
            color: var(--text-color);
        }


        /* Image Preview and Remove Button */
        @media screen and (max-width: 768px) {
            .image-preview {
                max-width: 120px;
                margin-top: 0.75rem;
            }

            .remove-image {
                font-size: 0.875rem;
                padding: 0.25rem 0.5rem;
                margin-top: 0.5rem;
            }
        }

        @media screen and (max-width: 480px) {
            .image-preview {
                max-width: 100px;
                margin-top: 0.5rem;
            }

            .remove-image {
                font-size: 0.75rem;
                padding: 0.2rem 0.4rem;
                margin-top: 0.4rem;
            }

            .img-preview-div {
                gap: 0.5rem;
                flex-direction: column;
                align-items: flex-start;
            }
        }

        @media screen and (max-width: 320px) {
            .image-preview {
                max-width: 80px;
                margin-top: 0.4rem;
            }

            .remove-image {
                font-size: 0.7rem;
                padding: 0.15rem 0.3rem;
                margin-top: 0.3rem;
            }

            .img-preview-div {
                gap: 0.3rem;
            }
        }

        /* Mobile Devices - Small Screens */
        @media screen and (max-width: 576px) {
            .form-content {
                padding: 1rem;
            }

            .form-header {
                padding: 1rem;
            }

            .invoice-table {
                display: block;
                overflow-x: auto;
                font-size: 0.85rem;
            }

            .invoice-table th,
            .invoice-table td {
                padding: 0.75rem;
                min-width: 150px !important;
                /* border: 1px solid #000; */
            }

            .currency-select {
                width: 100%;
                min-width: unset;
            }

            .summary-card {
                padding: 1rem;
            }

            .summary-item {
                flex-direction: row;
                align-items: center;
                justify-content: space-between;
                gap: 0.5rem;
            }

            .btn {
                width: 100%;
                margin: 0.5rem 0;
            }

            .image-preview {
                max-width: 150px;
            }
        }

        /* Tablet Devices - Medium Screens */
        @media screen and (min-width: 577px) and (max-width: 768px) {
            .form-content {
                padding: 1.5rem;
            }

            .invoice-table {
                display: block;
                overflow-x: auto;
            }

            .invoice-table th,
            .invoice-table td {
                padding: 0.75rem;
                min-width: 150px !important;
                /* border: 1px solid #000; */
            }

            .currency-select {
                width: 100%;
            }

            .summary-item {
                padding: 0.75rem 0;
                flex-direction: row;
                align-items: center;
                justify-content: space-between;
                gap: 5px;
            }

            .summary-item .input-group {
                width: 60% !important;
            }

            .btn {
                padding: 0.5rem 1rem;
            }
        }

        @media screen and (min-width: 768px) and (max-width: 1024px) {

            .invoice-table th,
            .invoice-table td {
                padding: 0.75rem;
                min-width: 100px !important;
                /* border: 1px solid #000; */
            }
        }

        /* Print Styles */
        @media print {
            .invoice-form {
                box-shadow: none;
                border: none;
            }

            .btn {
                display: none;
            }

            .form-header {
                -webkit-print-color-adjust: exact;
                print-color-adjust: exact;
            }
        }

        .border_invoice {
            border: 1px solid #000;
        }
    </style>

    <!--  -->

    <?php


    // echo $_SESSION['email'];
    if (isset($_SESSION['user_id'])) {
        $sql = "SELECT `invoice_number` FROM `invoice` ORDER BY `invoice_number` DESC LIMIT 1";
        $res = $db->query($sql);

        if ($res && $res->num_rows > 0) {
            $row = $res->fetch_assoc();
            // print_r($row)
        }
    } else {
        $row['invoice_number'] = 0;
    }

    if (isset($_SESSION['user_id'])) {

        $uid = $_SESSION['user_id'];
        $fetch_visibility = "SELECT * FROM `visibility` WHERE `user_id` = $uid";

        $res = $db->query($fetch_visibility);

        if ($res) {
            $row_visibility = $res->fetch_assoc();


            $fields = explode(",", $row_visibility['field_visibility']);
            // print_r($fields);
    
        }


    } else {
        // echo "no login!";
        $fields = [];
    }

    ?>

    <!--  -->

    <div class="row justify-content-center">
        <div class="col-lg-11">
            <div class="invoice-form">

                <div class="form-content">



                    <?php
                    // if(isset($_POST['invoice'])) {
                    //     echo "<div class='alert alert-info'>";
                    //     echo "<h4>Form Data Submitted:</h4>";
                    
                    //     // Handle file upload
                    //     if(isset($_FILES['invoice_logo'])) {
                    //         $file = $_FILES['invoice_logo'];
                    //         echo "<p><strong>Uploaded Logo:</strong><br>";
                    //         echo "File name: " . $file['name'] . "<br>";
                    //         echo "File type: " . $file['type'] . "<br>";
                    //         echo "File size: " . ($file['size'] / 1024) . " KB</p>";
                    //     }
                    
                    //     // Print other form data
                    //     echo "<p><strong>Company Details:</strong><br>";
                    //     echo "Company Name: " . $_POST['company_name'] . "<br>";
                    //     echo "Business Info: " . $_POST['from_address'] . "<br>";
                    //     echo "Client Info: " . $_POST['bill_to'] . "</p>";
                    
                    //     echo "<p><strong>Invoice Details:</strong><br>";
                    //     echo "Invoice Number: " . $_POST['invoice_number'] . "<br>";
                    //     if(isset($_POST['date'])) echo "Date: " . $_POST['date'] . "<br>";
                    //     if(isset($_POST['due_date'])) echo "Due Date: " . $_POST['due_date'] . "<br>";
                    //     if(isset($_POST['po_number'])) echo "PO Number: " . $_POST['po_number'] . "<br>";
                    //     if(isset($_POST['currency'])) echo "Currency: " . $_POST['currency'] . "</p>";
                    
                    //     echo "<p><strong>Line Items:</strong><br>";
                    //     if(isset($_POST['items'])) {
                    //         for($i = 0; $i < count($_POST['items']); $i++) {
                    //             echo "Item " . ($i+1) . ": " . $_POST['items'][$i] . " - ";
                    //             echo "Qty: " . $_POST['quantities'][$i] . " x ";
                    //             echo "Rate: " . $_POST['rates'][$i] . "<br>";
                    //         }
                    //     }
                    
                    //     echo "<p><strong>Additional Info:</strong><br>";
                    //     if(isset($_POST['notes'])) echo "Notes: " . $_POST['notes'] . "<br>";
                    //     if(isset($_POST['terms'])) echo "Terms: " . $_POST['terms'] . "<br>";
                    //     if(isset($_POST['discount'])) echo "Discount: " . $_POST['discount'] . "<br>";
                    //     if(isset($_POST['tax'])) echo "Tax: " . $_POST['tax'] . "%<br>";
                    //     if(isset($_POST['amount_paid'])) echo "Amount Paid: " . $_POST['amount_paid'] . "</p>";
                    
                    //     echo "</div>";
                    // }
                    ?>




                    <form action="" method="post" enctype="multipart/form-data" id="invoiceForm">
                        <div class="form-header">
                            <div class="d-flex justify-content-between align-items-center mb-5">
                                <h1 class="h3 mb-0">Create New Invoice</h1>
                                <button type="submit" id="submitBtn" name="invoice" class="py-2 px-3 btn btn-primary">
                                    Generate
                                </button>
                            </div>
                            <div class="row g-4 mb-5">
                                <div class="col-md-6 ">
                                    <div class="card shadow-sm p-4 h-100 border">
                                        <div class="mb-4">
                                            <div class="col-sm-12 mb-2">
                                                <label class="form-label">Company Name</label>
                                                <input type="text" name="company_name" class="form-control"
                                                    onchange="validateUsername(this)" required>
                                                <span id="username-error" class="text-danger"></span>
                                            </div>
                                            <label class="form-label">Business Information</label>
                                            <textarea name="from_address" class="form-control" rows="4"
                                                placeholder="Your Business Details"
                                                onchange="validateAddress(this)"></textarea>
                                                <span id="address-error" class="text-danger"></span>
                                        </div>
                                        <div>
                                            <label class="form-label">Client Information</label>
                                            <textarea name="bill_to" class="form-control" rows="4"
                                                placeholder="Client Details"
                                                onchange="validateCAddress(this)"></textarea>
                                                <span id="caddress-error" class="text-danger"></span>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="card shadow-sm p-4 h-100 border">
                                        <div class="row g-4">
                                            <?php
                                            if (!in_array("invoice_logo", $fields)) {
                                                ?>
                                                <div class="mb-3 d-block">
                                                    <label for="invoice_logo" class="form-label">Invoice Logo</label>
                                                    <input type="file" name="invoice_logo" class="form-control d-block"
                                                        id="logoInput" accept=".png"
                                                        onchange="previewImage(this); validateImageSize(this);">
                                                    <span id="img-size-error-message" class="text-danger"></span>
                                                    <span class="text-secondary">Image size should be between 500KB to 5MB</span>
                                                    <div class="d-flex align-items-center img-preview-div">
                                                        <img id="imagePreview" class="image-preview d-none">
                                                        <button type="button" id="removeButton"
                                                            class="btn btn-sm btn-danger m-auto mx-4 mt-2 d-none"
                                                            onclick="removeImage()">×</button>
                                                    </div>
                                                </div>
                                            <?php } ?>
                                            <div class="col-sm-6">
                                                <label class="form-label">Invoice Number</label>
                                                <input type="text" name="invoice_number" class="form-control"
                                                    value="<?php echo $row['invoice_number'] + 1; ?>" readonly>
                                            </div>
                                            <?php
                                            if (!in_array("invoice_date", $fields)) { ?>
                                                <div class="col-sm-6">
                                                    <label class="form-label">Date</label>
                                                    <input type="date" name="date" class="form-control" required>
                                                </div>
                                            <?php } ?>
                                            <?php
                                            if (!in_array("due_date", $fields)) { ?>
                                                <div class="col-sm-6">
                                                    <label class="form-label">Due Date</label>
                                                    <input type="date" name="due_date" class="form-control" required>
                                                </div>
                                            <?php } ?>
                                            <?php
                                            if (!in_array("po_number", $fields)) { ?>
                                                <div class="col-sm-6 d-none">
                                                    <label class="form-label">PO Number</label>
                                                    <input type="text" name="po_number" class="form-control">
                                                </div>
                                            <?php } ?>
                                            <?php
                                            if (!in_array("currency", $fields)) { ?>
                                                <div class="col-12">
                                                    <label class="form-label">Currency</label>
                                                    <select name="currency" class="form-select currency-select"
                                                        onchange="updateCurrency()">
                                                        <option value="INR" selected>Indian Rupee (₹)</option>
                                                        <option value="USD">US Dollar ($)</option>
                                                        <option value="EUR">Euro (€)</option>
                                                        <option value="GBP">British Pound (£)</option>
                                                    </select>
                                                </div>
                                            <?php } ?>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="card shadow-sm p-4 mb-5">
                                <div class="table-responsive">
                                    <table class="invoice-table">
                                        <thead>
                                            <tr>
                                                <th style="width: 40%">Item Description</th>
                                                <th class="text-center">Quantity</th>
                                                <th class="text-center">Rate</th>
                                                <th class="text-end">Amount</th>
                                                <th width="50"></th>
                                            </tr>
                                        </thead>
                                        <tbody id="line-items">
                                            <tr class="line-item">
                                                <td>
                                                    <input type="text" name="items[]" class="form-control"
                                                        placeholder="Item name or description"
                                                        onchange="validateItem(this)" required>
                                                    <span id="item-error" class="text-danger"></span>
                                                </td>
                                                <td>
                                                    <input type="number" name="quantities[]"
                                                        class="form-control text-end quantity" value="1" min="1"
                                                        title="Min value should be greater then 0"
                                                        onchange="calculateLineTotal(this)" required>
                                                </td>
                                                <td>
                                                    <div class="input-group">
                                                        <span class="input-group-text currency-symbol">₹</span>
                                                        <input type="number" name="rates[]"
                                                            class="form-control text-end rate" value="0.00" min="1"
                                                            title="Min value should be greater then 0"
                                                            onchange="calculateLineTotal(this)" required>
                                                    </div>
                                                </td>
                                                <td class="text-end">
                                                    <span class="currency-symbol">₹</span>
                                                    <span class="line-total">0.00</span>
                                                </td>
                                                <td class="text-center">
                                                    <button type="button"
                                                        class="btn btn-sm btn-outline-danger remove-line"
                                                        onclick="removeLine(this)">×</button>
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>

                                    <button type="button" class="btn btn-outline-secondary" onclick="addLine()">
                                        + Add Line Item
                                    </button>
                                </div>
                            </div>

                            <div class="row g-4">
                                <div class="col-md-6">
                                    <div class="card shadow-sm p-4 border">
                                        <?php
                                        if (!in_array("notes", $fields)) { ?>
                                            <div class="mb-4">
                                                <label class="form-label">Notes</label>
                                                <textarea name="notes" class="form-control" rows="4"
                                                    placeholder="Additional notes to client"></textarea>
                                            </div>
                                        <?php } ?>
                                        <?php
                                        if (!in_array("terms", $fields)) { ?>
                                            <div>
                                                <label class="form-label">Terms & Conditions</label>
                                                <textarea name="terms" class="form-control" rows="4"
                                                    placeholder="Terms and conditions"></textarea>
                                            </div>
                                        <?php } ?>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="summary-card border">
                                        <div class="summary-item">
                                            <span>Subtotal</span>
                                            <span class="subtotal"><span class="currency-symbol">₹</span>0.00</span>
                                        </div>

                                        <?php
                                        if (!in_array("discount", $fields)) { ?>
                                            <div class="summary-item">
                                                <span>Discount</span>
                                                <div class="input-group" style="width: 200px">
                                                    <input type="number" name="discount" class="form-control text-end"
                                                        onchange="calculateTotal()" value="0">
                                                    <span class="input-group-text currency-symbol">₹</span>
                                                </div>
                                            </div>
                                        <?php } ?>

                                        <?php
                                        if (!in_array("tax_charge", $fields)) { ?>
                                            <div class="summary-item">
                                                <span>Tax</span>
                                                <div class="input-group" style="width: 200px">
                                                    <input type="number" name="tax" class="form-control text-end"
                                                        onchange="calculateTotal()" value="1">
                                                    <span class="input-group-text">%</span>
                                                </div>
                                            </div>
                                        <?php } ?>

                                        <div class="summary-item">
                                            <strong>Total</strong>
                                            <strong class="total"><span class="currency-symbol">₹</span>0.00</strong>
                                        </div>

                                        <?php
                                        if (!in_array("paid_amount", $fields)) { ?>
                                            <div class="summary-item">
                                                <span>Amount Paid</span>
                                                <div class="input-group" style="width: 200px">
                                                    <input type="number" name="amount_paid" class="form-control text-end"
                                                        onchange="calculateBalanceDue()">
                                                    <span class="input-group-text currency-symbol">₹</span>
                                                </div>
                                            </div>

                                            <div class="summary-item">
                                                <strong>Balance Due</strong>
                                                <strong class="balance-due"><span
                                                        class="currency-symbol">₹</span>0.00</strong>
                                            </div>
                                        <?php } ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script>
        const fileInput = document.getElementById('logoInput');
        const preview = document.getElementById('imagePreview');
        const removeButton = document.getElementById('removeButton');

        // Image preview functionality
        function previewImage(input) {
            const preview = document.getElementById('imagePreview');
            if (input.files && input.files[0]) {
                const reader = new FileReader();
                reader.onload = function (e) {
                    preview.src = e.target.result;
                    preview.classList.remove('d-none');
                }
                removeButton.classList.remove('d-none');
                removeButton.classList.add('d-block');
                reader.readAsDataURL(input.files[0]);
            }
        }

        function validateImageSize(input) {
            let file = input.files[0];
            let errorMessage = document.getElementById("img-size-error-message");

            if (file) {
                let fileSize = file.size; // File size in bytes
                let minSize = 500 * 1024; // 500KB
                let maxSize = 5 * 1024 * 1024; // 5MB

                if (fileSize < minSize) {
                    errorMessage.textContent = "File is too small! Minimum size is 100KB.";
                    errorMessage.style.display = "block";
                    input.value = ""; // Clear file input
                    document.getElementById('submitBtn').disabled = true;
                } else if (fileSize > maxSize) {
                    errorMessage.textContent = "File is too large! Maximum size is 5MB.";
                    errorMessage.style.display = "block";
                    input.value = ""; // Clear file input
                } else {
                    errorMessage.style.display = "none"; // Hide error if valid
                    document.getElementById('submitBtn').disabled = false;
                }
            }
        }

        function removeImage() {


            fileInput.value = '';
            let errorMessage = document.getElementById("img-size-error-message");

            preview.src = '';
            preview.classList.add('d-none');
            preview.classList.remove('d-block');
            removeButton.classList.add('d-none');
            document.getElementById('submitBtn').disabled = false;
            errorMessage.textContent = "";
        }

        // Add new line item
        function addLine() {
            const lineItems = document.getElementById('line-items');
            const newLine = document.querySelector('.line-item').cloneNode(true);

            // Clear input values
            newLine.querySelectorAll('input').forEach(input => {
                if (input.type === 'number') {
                    input.value = input.name.includes('quantities') ? '1' : '0.00';
                } else {
                    input.value = '';
                }
            });

            newLine.querySelector('.line-total').textContent = '0.00';
            lineItems.appendChild(newLine);
            calculateTotal();
        }

        // Remove line item
        function removeLine(button) {
            if (document.querySelectorAll('.line-item').length > 1) {
                button.closest('.line-item').remove();
                calculateTotal();
            }
        }

        // Calculate line total
        function calculateLineTotal(input) {
            const row = input.closest('.line-item');
            const quantity = parseFloat(row.querySelector('.quantity').value) || 0;
            const rate = parseFloat(row.querySelector('.rate').value) || 0;
            const total = quantity * rate;
            row.querySelector('.line-total').textContent = total.toFixed(2);
            calculateTotal();
        }

        // Calculate total
        function calculateTotal() {
            let subtotal = 0;

            // Calculate subtotal from all '.line-total' elements
            document.querySelectorAll('.line-total').forEach(total => {
                subtotal += parseFloat(total.textContent) || 0;
            });

            // Fetch discount and tax values, defaulting to 0 and 1 respectively if not found
            const discountInput = document.querySelector('input[name="discount"]');
            const taxInput = document.querySelector('input[name="tax"]');

            const discount = discountInput && discountInput.value ? parseFloat(discountInput.value) : 0.0;
            const tax = taxInput && taxInput.value ? parseFloat(taxInput.value) : 0.0;

            // Ensure tax is treated as a percentage (default is 0 if input is missing)
            const taxAmount = (subtotal - discount) * (tax / 100);
            const total = subtotal - discount + taxAmount;

            // Update the subtotal and total in the DOM
            document.querySelector('.subtotal').textContent = `${subtotal.toFixed(2)}`;
            document.querySelector('.total').textContent = `${total.toFixed(2)}`;

            // Call additional function to update balance due
            calculateBalanceDue();
        }


        // Calculate balance due
        function calculateBalanceDue() {
            const total = parseFloat(document.querySelector('.total').textContent.replace('₹', '')) || 0;
            const amountPaid = parseFloat(document.querySelector('input[name="amount_paid"]').value) || 0;
            const balanceDue = total - amountPaid;

            document.querySelector('.balance-due').textContent = `${balanceDue.toFixed(2)}`;
        }

        // Update currency symbols
        function updateCurrency() {
            const select = document.querySelector('.currency-select');
            const symbol = select.options[select.selectedIndex].text.match(/\((.*?)\)/)[1];
            document.querySelectorAll('.currency-symbol').forEach(span => {
                span.textContent = symbol;
            });
        }


        //  field validation

        function validateUsername(input) {
            let pattern = /^(?=.*[A-Za-z])[A-Za-z0-9]+$/; // At least one letter, only letters & numbers
            let errorMessage = document.getElementById("username-error");

            if (!pattern.test(input.value)) {
                errorMessage.textContent = "Must contain at least one letter and only letters & numbers.";
                errorMessage.style.color = "red"; // Show error
                input.value = ""; // Clear input
            } else {
                errorMessage.textContent = ""; // Hide error if valid
            }
        }

        function validateItem(input) {
            let pattern = /^(?=.*[A-Za-z])[A-Za-z0-9 ]+$/; // Must contain at least one letter, allow letters, numbers, and spaces
            let errorMessage = document.getElementById("item-error");

            if (!pattern.test(input.value)) {
                errorMessage.textContent = "Item name must contain at least one letter and only letters, numbers, and spaces.";
                errorMessage.style.color = "red";
                input.value = ""; // Clear input field
            } else {
                errorMessage.textContent = ""; // Hide error if valid
            }
        }

        function validateAddress(textarea) {
            let pattern = /^(?=.*[A-Za-z])[A-Za-z0-9 .,\/#&-]{5,}$/;
            let errorMessage = document.getElementById("address-error");

            if (!pattern.test(textarea.value)) {
                errorMessage.textContent = "Address must contain at least one letter, be at least 5 characters long, and use only allowed symbols (.,-/#&).";
                errorMessage.style.color = "red";
                textarea.value = ""; // Clear input field
            } else {
                errorMessage.textContent = ""; // Hide error if valid
            }
        }

        function validateCAddress(textarea) {
            let pattern = /^(?=.*[A-Za-z])[A-Za-z0-9 .,\/#&-]{5,}$/;
            let errorMessage = document.getElementById("caddress-error");

            if (!pattern.test(textarea.value)) {
                errorMessage.textContent = "Address must contain at least one letter, be at least 5 characters long, and use only allowed symbols (.,-/#&).";
                errorMessage.style.color = "red";
                textarea.value = ""; // Clear input field
            } else {
                errorMessage.textContent = ""; // Hide error if valid
            }
        }
    </script>

    <script src="../../assets/js/invoice.js"></script>
</main>

<?php include_once "../../includes/footer.php"; ?>