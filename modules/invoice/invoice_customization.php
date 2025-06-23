<?php include_once "../../includes/header.php"; ?>

<div class="container py-5">
        <style>
        :root {
                --primary-color: #1a56db;
                --secondary-color: #4b5563;
                --background-color: #ffffff;
                --border-color: #e5e7eb;
                --text-color: #111827;
                --hover-color: #1e40af;
                --accent-color: #3b82f6;
        }

        :root[data-theme="dark"] {
                --primary-color: #60a5fa;
                --secondary-color: #9ca3af;
                --background-color: #1f2937;
                --border-color: #374151;
                --text-color: #f9fafb;
                --hover-color: #3b82f6;
                --accent-color: #60a5fa;
        }

        .invoice-form {
                max-width: 800px;
                margin: 0 auto;
                background: var(--background-color);
                border-radius: 12px;
                box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1), 0 2px 4px -1px rgba(0, 0, 0, 0.06);
                padding: 2rem;
        }

        .form-header {
                text-align: center;
                margin-bottom: 2rem;
                padding-bottom: 1rem;
                border-bottom: 2px solid var(--border-color);
        }

        .form-header h3 {
                font-size: 1.5rem;
                font-weight: 600;
                color: var(--text-color);
                margin: 0;
        }

        .fields-grid {
                display: grid;
                grid-template-columns: repeat(auto-fill, minmax(300px, 1fr));
                gap: 1rem;
        }

        .field-item {
                background: var(--background-color);
                border: 1px solid var(--border-color);
                border-radius: 8px;
                padding: 0.75rem;
                transition: all 0.2s ease;
        }

        .field-item:hover {
                transform: translateY(-2px);
                box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1);
        }

        .field-checkbox {
                display: flex;
                align-items: center;
                gap: 0.75rem;
        }

        .field-checkbox input[type="checkbox"] {
                width: 1.25rem;
                height: 1.25rem;
                border-radius: 4px;
                border: 2px solid var(--border-color);
                cursor: pointer;
        }

        .field-checkbox label {
                font-size: 0.95rem;
                color: var(--text-color);
                margin: 0;
                cursor: pointer;
        }

        .form-actions {
                margin-top: 2rem;
                text-align: right;
                padding-top: 1rem;
                border-top: 2px solid var(--border-color);
        }

        .btn-submit {
                background: var(--primary-color);
                color: white;
                border: none;
                padding: 0.75rem 2rem;
                border-radius: 6px;
                font-weight: 500;
                transition: background 0.2s ease;
        }

        .btn-submit:hover {
                background: var(--hover-color);
        }
        </style>

        <form action="release.php" method="post" name="visibility" class="invoice-form">
                <div class="form-header">
                        <h3>Customize Invoice Fields</h3>
                </div>

                <div class="fields-grid">
                        <div class="field-item">
                                <div class="field-checkbox">
                                        <input type="checkbox" name="field['invoice_number']" id="invoice_number" checked>
                                        <label for="invoice_number">Show All Fields</label>
                                </div>
                        </div>

                        <div class="field-item">
                                <div class="field-checkbox">
                                        <input type="checkbox" name="field['invoice_logo']" id="invoice_logo">
                                        <label for="invoice_logo">Company Logo</label>
                                </div>
                        </div>

                        <div class="field-item">
                                <div class="field-checkbox">
                                        <input type="checkbox" name="field['invoice_date']" id="issue_Date">
                                        <label for="issue_Date">Issue Date</label>
                                </div>
                        </div>

                        <div class="field-item">
                                <div class="field-checkbox">
                                        <input type="checkbox" name="field['due_date']" id="due_date">
                                        <label for="due_date">Due Date</label>
                                </div>
                        </div>

                        <div class="field-item">
                                <div class="field-checkbox">
                                        <input type="checkbox" name="field['po_number']" id="po_number">
                                        <label for="po_number">Purchase Order Number</label>
                                </div>
                        </div>

                        <div class="field-item">
                                <div class="field-checkbox">
                                        <input type="checkbox" name="field['notes']" id="notes">
                                        <label for="notes">Notes</label>
                                </div>
                        </div>

                        <div class="field-item">
                                <div class="field-checkbox">
                                        <input type="checkbox" name="field['terms']" id="terms">
                                        <label for="terms">Terms & Conditions</label>
                                </div>
                        </div>

                        <div class="field-item">
                                <div class="field-checkbox">
                                        <input type="checkbox" name="field['discount']" id="discount">
                                        <label for="discount">Discount</label>
                                </div>
                        </div>

                        <div class="field-item">
                                <div class="field-checkbox">
                                        <input type="checkbox" name="field['tax_charge']" id="tax_charge">
                                        <label for="tax_charge">Tax Charges</label>
                                </div>
                        </div>

                        <div class="field-item">
                                <div class="field-checkbox">
                                        <input type="checkbox" name="field['paid_amount']" id="paid_amount">
                                        <label for="paid_amount">Amount Paid</label>
                                </div>
                        </div>

                        <div class="field-item">
                                <div class="field-checkbox">
                                        <input type="checkbox" name="field['remaining_amount']" id="remaining_amount">
                                        <label for="remaining_amount">Balance Due</label>
                                </div>
                        </div>

                        <div class="field-item">
                                <div class="field-checkbox">
                                        <input type="checkbox" name="field['currency']" id="currency">
                                        <label for="currency">Currency (Default: INR)</label>
                                </div>
                        </div>
                </div>

                <div class="form-actions">
                        <button type="submit" name="submit" class="btn-submit">
                                Save Changes
                        </button>
                </div>
        </form>
</div>

<?php include_once "../../includes/footer.php"; ?>