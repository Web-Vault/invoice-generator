<?php
require_once "../modules/app/connect.php";
require_once "../modules/app/invoice.php";

$conn = new connect();
$db = $conn->connect_db();

?>



<!DOCTYPE html>
<html lang="en">

<head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Manage Invoices</title>
        <style>
                * {
                        margin: 0;
                        padding: 0;
                        box-sizing: border-box;
                        font-family: "Inter", sans-serif !important;
                }

                body {
                        display: flex;
                        height: 100vh;
                        background-color: #f4f4f4;
                }

                section.main-content {
                        margin-left: 20%;
                        width: 80%;
                        padding: 20px;
                }

                .top-header {
                        display: flex;
                        justify-content: space-between;
                        align-items: center;
                        gap: 20px;
                        margin-bottom: 20px;
                        background-color: #ffffff;
                        padding: 15px;
                        border-radius: 10px;
                        box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
                }

                .top-header h2 {
                        color: #2c3e50;
                }

                .add-user-btn {
                        background-color: #1abc9c;
                        color: white;
                        padding: 10px 20px;
                        border: none;
                        border-radius: 5px;
                        cursor: pointer;
                        font-size: 16px;
                }

                .add-user-btn:hover {
                        background-color: #16a085;
                }

                .user-list {
                        margin-top: 20px;
                        background-color: white;
                        padding: 20px;
                        border-radius: 10px;
                        box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
                }

                .user-list table {
                        width: 100%;
                        border-collapse: collapse;
                }

                .user-list table th,
                .user-list table td {
                        padding: 12px;
                        /* border: 1px solid #ddd; */
                        text-align: center;
                }

                .user-list table th {
                        background-color: #2c3e50;
                        color: #fff;
                        border-radius: 10px 10px 0 0;
                }

                .user-list table td {
                        color: #7f8c8d;
                }

                .text-wrap {
                        text-overflow: ellipsis;
                        white-space: nowrap;
                        overflow: hidden;
                        max-width: 150px;
                        text-align: left;
                }

                .user-list .btn {
                        padding: 8px 15px;
                        background-color: #1abc9c;
                        color: white;
                        border: none;
                        border-radius: 5px;
                        cursor: pointer;
                        font-size: 14px;
                }

                .user-list .btn:hover {
                        background-color: #16a085;
                }

                .user-list .edit-btn {
                        background-color: #f39c12;
                }

                .user-list .edit-btn:hover {
                        background-color: #e67e22;
                }

                .user-list .delete-btn {
                        background-color: #e74c3c;
                }

                .user-list .delete-btn:hover {
                        background-color: #c0392b;
                }
        </style>
</head>

<body>
        <aside>
                <?php include_once "includes/aside.php"; ?>
        </aside>

        <section class="main-content">

                <!-- Top Header -->
                <div class="top-header">
                        <h2>Manage Invoices</h2>
                        <button class="add-user-btn">Issue New Invoice</button>
                </div>

                <div class="user-list">
                        <table>
                                <thead>
                                        <tr>
                                                <th>Invoice ID</th>
                                                <th>Date</th>
                                                <!-- <th>Sender</th> -->
                                                <th>Receiver</th>
                                                <th>Amount</th>
                                                <th>Due Date</th>
                                                <th>Actions</th>
                                        </tr>
                                </thead>
                                <tbody>

                                        <?php
                                        $user_id = $_REQUEST['user_id'];
                                        $sql = "SELECT * FROM `invoice` WHERE `user_id` = $user_id";
                                        $db = $conn->connect_db();
                                        $all_invoices = $db->query($sql);
                                        // echo "<pre>";
                                        // print_r($all_invoices);
                                        
                                        foreach ($all_invoices as $invoice) {
                                                ?>
                                                <tr>
                                                        <td><?php echo $invoice['invoice_id'] ?></td>
                                                        <td><?php echo $invoice['invoice_date'] ?></td>
                                                        <td class="text-wrap" title="<?php echo $invoice['invoice_from'] ?>"><?php echo $invoice['invoice_from'] ?></td>
                                                        <td><?php echo $invoice['remainig_amount'] ?></td>
                                                        <td><?php echo $invoice['due_date'] ?></td>
                                                        <td>
                                                                <a
                                                                        href="../modules/invoice/temp.php?invoice_id=<?php echo $invoice['invoice_id'] ?>"><button
                                                                                class="btn edit-btn">View</button></a>
                                                                <a
                                                                        href="delete_invoice.php?invoice_id=<?php echo $invoice['invoice_id'] ?>"><button
                                                                                class="btn delete-btn">Delete</button></a>
                                                        </td>
                                                </tr>
                                                <?php
                                                
                                        }
                                        ?>


                                        <!-- More invoices can be added here -->
                                </tbody>
                        </table>
                </div>
        </section>
</body>

</html>