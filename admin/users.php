<?php
require_once "../modules/app/connect.php";
require_once "../modules/app/user.php";

$conn = new connect();
$db = $conn->connect_db();

?>


<!DOCTYPE html>
<html lang="en">

<head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Manage Users</title>
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

                <div class="top-header">
                        <h2>Manage Users</h2>
                        <a href="add_user.php"><button class="add-user-btn">Add New User</button></a>
                </div>

                <div class="user-list">
                        <table>
                                <thead>
                                        <tr>
                                                <th>User ID</th>
                                                <th>Name</th>
                                                <th>Email</th>
                                                <th>Invoice Count</th>
                                                <th>Actions</th>
                                        </tr>
                                </thead>
                                <tbody>
                                        <?php
                                        $users = new user();
                                        $all_user = $users->fetch_all();

                                        if ($all_user) {
                                                while ($row = $all_user->fetch_assoc()) {

                                                        $invoice_count = $users->fetch_user_invoice($row['id']);

                                                        ?>
                                                        <tr>
                                                                <td><?php echo $row['id']; ?></td>
                                                                <td><?php echo $row['firstname'] . " " . $row['lastname']; ?></td>
                                                                <td><?php echo $row['email']; ?></td>
                                                                <td><a href="user_invoice.php?user_id=<?php echo $row['id']; ?>"><button class="btn"><?php echo $invoice_count; ?></button></a></td>
                                                                <td>
                                                                        <a href="edit-user.php?user_id=<?php echo $row['id']; ?>"><button class="btn edit-btn">Edit</button></a>
                                                                        <a href="../modules/auth/delete_acc.php?user_id=<?php echo $row['id']; ?>"><button class="btn delete-btn">Delete</button></a>
                                                                </td>
                                                        </tr>
                                                        <?php
                                                }
                                        }

                                        ?>
                                </tbody>
                        </table>
                </div>
        </section>
</body>

</html>