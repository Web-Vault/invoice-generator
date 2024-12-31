<?php include_once "../../includes/header.php"; ?>

<style>
        .fff,
        header {
                background-color: #fff !important;
        }

        section {
                margin-bottom: 10px;
        }

        section.payments {
                padding-bottom: 40px;
                margin: 40px 0;
        }

        table,
        th,
        td {
                font-size: 13px;
        }
</style>

<div class="border my-4 mx-4 p-4 rounded-3 fff">
        <p class="fw-bold text-center fs-4">Settings</p>
        <p class="fw-normal text-secondary text-center" style="font-size: 17px;">Manage your settings here, including
                how you want
                to get paid.
        </p>

        <?php
        require_once "../app/connect.php";

        $conn = new connect();
        $db = $conn->connect_db();


        $sql = "SELECT `invoice_number` FROM `invoice` ORDER BY `invoice_number` DESC LIMIT 1";
        $res = $db->query($sql);

        if ($res && $res->num_rows > 0) {
                $row = $res->fetch_assoc();
                // print_r($row);
        
        } else {
                echo "No records found.";
        }
        ?>

        <section class="settings">
                <p class="fw-bold fs-4 text-dark mb-1">Invoicing Settings</p>
                <p class="text-secondary fs-6" style="font-size: 12px;">Next invoice number : <span class="tw-bold">
                                <?php echo $row['invoice_number'] + 1; ?> </span></p>
        </section>

        <section class="payments border-bottom">
                <p class="fw-bold fs-4 text-dark mb-1">Payment Settings</p>
                <span class="badge badge-danger border bg-danger text-light my-2" style="font-size: 10px;"><i
                                class="fa-solid fa-bullseye text-light mx-1 my-1"></i>Action Required</span>
                <p class="text-secondary fs-6" style="font-size: 12px;">You need to finish setting up your Stripe
                        account in order to process payments.</p>

                <button class="btn btn-md btn-success">Accept Payments</button>
        </section>

        <section class="api">
                <div class="usage">
                        <p class="fw-bold fs-4 text-dark mb-1">API Usage</p>
                        <p class="fw-bold fs-5 text-dark mb-1">This Month</p>
                        <p class="text-secondary fs-6" style="font-size: 12px;">Invoices Generated :
                                <span class="tw-bold">0</span>
                        </p>
                </div>

                <div class="keys">
                        <p class="fw-bold fs-4 text-dark mb-1">API Keys</p>

                        <table class="table my-3">
                                <tr class="table-secondary">
                                        <th class="border-0 fw-semibold text-secondary">API KEYS</th>
                                        <th class="border-0 fw-semibold text-secondary" colspan="2">CREATED</th>
                                </tr>

                                <tr>
                                        <td class="border-0 text-danger">sk_cKgr3QX1Wb2TJfBWhqDYLI4ELmL26PPN</td>
                                        <td class="border-0">Dec 18, 2024</td>
                                        <td class="border-0"><i class="fa-solid fa-trash"></i></td>
                                </tr>
                        </table>
                </div>
        </section>
</div>



<?php include_once "../../includes/footer.php"; ?>