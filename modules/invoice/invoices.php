<?php
include_once "../../includes/header.php";
require_once "../app/invoice.php";

$invoice = new Invoice();

$invoice_list = $invoice->history();

if ($invoice_list) {
        // echo "<pre>";
        // print_r($invoice_list);
        // echo "</pre>";
} else {
        echo $invoice_list;
}

?>


<style>
        .fff,
        header {
                background-color: #fff !important;
        }
</style>


<div class="border my-4 mx-4 p-4 rounded-3 fff">

        <div class="header-part d-flex justify-content-between border-bottom pb-2">
                <p class="fw-bold fs-4">My Invoices</p>
                <button class="btn btn-md px-4 btn-success"><a href="create.php"
                                class="text-white text-decoration-none"> New Invoice </a></button>
        </div>
        <div class="invoices">
                <!-- <p class="text-secondary fw-bold p-3">No Invoices</p> -->

                <table class="table my-5">
                        <tr class="table-secondary">
                                <th class="fs-6 fw-normal text-secondary">CUSTOMER</th>
                                <th class="fs-6 fw-normal text-secondary">REFERENCE</th>
                                <th class="fs-6 fw-normal text-secondary">DATE</th>
                                <th class="fs-6 fw-normal text-secondary">DUE DATE</th>
                                <th class="fs-6 fw-normal text-secondary">TOTAL</th>
                                <th class="fs-6 fw-normal text-secondary"></th>
                                <th class="fs-6 fw-normal text-secondary"></th>
                        </tr>


                        <!-- dynammic row display. -->

                        <?php

                        if (!empty($invoice_list)) {
                                foreach ($invoice_list as $invoice_list_id => $invoice_data) {
                                        ?>
                                        <tr>
                                                <td class="align-middle"><?php echo $invoice_data['bill_to']; ?></td>
                                                <td class="align-middle">invoice #<?php echo $invoice_data['invoice_number']; ?></td>
                                                <td class="align-middle"><?php echo $invoice_data['invoice_date']; ?></td>
                                                <td class="align-middle"><?php echo $invoice_data['due_date']; ?></td>
                                                <td class="align-middle"><?php echo $invoice_data['remainig_amount'] ?></td>
                                                <td><button class="btn btn-md btn-secondary"> <a class="text-decoration-none text-white"
                                                                        href="temp.php?invoice_id=<?php echo $invoice_data['invoice_id']; ?>">
                                                                        View </a></button></td>
                                                <td> <a class="text-decoration-none text-secondary align-middle"
                                                                href="delete_invoice.php?invoice_id=<?php echo $invoice_data['invoice_id']; ?>">
                                                                Delete </a> </td>
                                        </tr>
                                        <?php
                                }
                        }


                        ?>
                </table>
        </div>

</div>

<?php include_once "../../includes/footer.php"; ?>