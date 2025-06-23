<?php
session_start();
// echo $_SESSION['admin']; 

require_once "../modules/app/connect.php";

$conn = new connect();
$db = $conn->connect_db();
?>

<!DOCTYPE html>
<html lang="en">

<head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Admin Dashboard</title>

        <!-- <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
                integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH"
                crossorigin="anonymous">
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
                integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
                crossorigin="anonymous"></script> -->

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
                        gap: 20px;
                        margin-bottom: 20px;
                }

                .counter-section {
                        flex: 1;
                        padding: 20px;
                        background-color: white;
                        border-radius: 10px;
                        box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
                        text-align: center;
                }

                .counter-section span {
                        font-size: 18px;
                        color: #2c3e50;
                }

                .counter-section .number {
                        font-weight: bold;
                        color: #1abc9c;
                }

                .recent-orders {
                        margin-top: 20px;
                        background-color: white;
                        padding: 20px;
                        border-radius: 10px;
                        box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
                }

                .recent-orders table {
                        width: 100%;
                        border-collapse: collapse;
                        /* margin-top: 30px; */
                }

                .recent-orders table th,
                .recent-orders table td {
                        /* background-color: #fff; */
                        padding: 10px;
                        /* border: 1px solid #ddd; */
                        text-align: center;
                }

                .recent-orders table th {
                        background-color: #34495e;
                        color: white;
                        border-radius: 10px 10px 0 0;
                }

                .quick-actions {
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


                .quick-actions button {
                        padding: 10px 20px;
                        background-color: #1abc9c;
                        color: white;
                        border: none;
                        border-radius: 5px;
                        cursor: pointer;
                        font-size: 16px;
                }

                .quick-actions button:hover {
                        background-color: #16a085;
                }


                .btn {
                        padding: 8px 15px;
                        color: white;
                        border: none;
                        border-radius: 5px;
                        cursor: pointer;
                        font-size: 14px;
                }

                .edit-btn {
                        background-color: #f39c12;
                }

                .edit-btn:hover {
                        background-color: #e67e22;
                }

                .delete-btn {
                        background-color: #e74c3c;
                }

                .delete-btn:hover {
                        background-color: #c0392b;
                }
        </style>
</head>

<body>


        <section class="main-content">
                <div class="top-header">
                        <div class="counter-section">
                                <span>Total Users: <span class="number"><?php
                                $sql = "SELECT COUNT(*) as count FROM users";
                                $result = $db->query($sql);
                                $row = $result->fetch_assoc();
                                echo $row['count'];
                                ?></span></span>
                        </div>
                        <div class="counter-section">
                                <span>Total Invoices: <span class="number"><?php
                                $sql = "SELECT COUNT(*) as count FROM invoice";
                                $result = $db->query($sql);
                                $row = $result->fetch_assoc();
                                echo $row['count'];
                                ?></span></span>
                        </div>
                </div>

                <div class="quick-actions">
                        <h2>Recent Orders</h2>
                        <span>
                                <a href="create_invoice.php" style="text-decoration: none; color: white;"><button>New
                                                Invoice</button></a>
                                <a href="users.php" style="text-decoration: none; color: white;"><button>Manage
                                                Users</button></a>
                        </span>
                </div>

                <div class="recent-orders">
                        <table>
                                <thead>
                                        <tr>
                                                <th>Invoice ID</th>
                                                <th>Sender</th>
                                                <th>Amount</th>
                                                <th>Due date</th>
                                                <th>Action</th>
                                        </tr>
                                </thead>
                                <tbody>
                                        <?php
                                        $sql = "SELECT invoice_id, company_name, total_amount, due_date 
                                               FROM invoice 
                                               ORDER BY invoice_id DESC 
                                               LIMIT 5";
                                        if (!$result = $db->query($sql)) {
                                                echo "Error: " . $db->error;
                                        }

                                        if ($result->num_rows > 0) {
                                                while ($row = $result->fetch_assoc()) {
                                                        ?>
                                                        <tr>
                                                                <td><?php echo $row['invoice_id']; ?></td>
                                                                <td><?php echo $row['company_name']; ?></td>
                                                                <td><?php echo $row['total_amount']; ?></td>
                                                                <td><?php echo date('d/m/Y', strtotime($row['due_date'])); ?></td>
                                                                <td>
                                                                        <a href="temp.php?invoice_id=<?php echo $row['invoice_id']; ?>"
                                                                                style="text-decoration: none; color: white;">
                                                                                <button class="btn edit-btn">view</button></a>
                                                                </td>
                                                        </tr>
                                                        <?php
                                                }
                                        } else {
                                                ?>
                                                <tr>
                                                        <td colspan="5" style="text-align: center;">No invoices found</td>
                                                </tr>
                                                <?php
                                        }
                                        ?>
                                </tbody>
                        </table>
                </div>
        </section>
        <aside>
                <?php include_once "includes/aside.php"; ?>
        </aside>
</body>

</html>