<?php
$user_id = $_REQUEST['user_id'];

require_once "../modules/app/connect.php";
require_once "../modules/app/user.php";

$user = new user();
$user_info = $user->fetch_one($user_id);


?>

<!DOCTYPE html>
<html lang="en">

<head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Edit</title>

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


                .edit-profile-container {
                        /* width: 90%; */
                        background-color: white;
                        padding: 20px;
                        margin: auto;
                        border-radius: 10px;
                        box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);

                }

                .top-header h2 {
                        color: #2c3e50;
                }

                .top-header {
                        display: flex;
                        justify-content: left;
                        align-items: center;
                        gap: 20px;
                        margin-bottom: 20px;
                        background-color: #ffffff;
                        padding: 15px;
                        border-radius: 10px;
                        box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
                }

                .form-group {
                        margin-bottom: 20px;
                }

                .form-group label {
                        display: block;
                        margin-bottom: 8px;
                        color: #2c3e50;
                        font-weight: bold;
                }

                .form-group input {
                        width: 100%;
                        padding: 10px;
                        border: 1px solid #ddd;
                        border-radius: 5px;
                        font-size: 16px;
                        box-shadow: inset 0 1px 3px rgba(0, 0, 0, 0.1);
                }

                .form-group span.current-value {
                        display: block;
                        margin-top: 5px;
                        font-size: 14px;
                        color: #7f8c8d;
                }

                .form-row {
                        display: flex;
                        gap: 20px;
                }

                .form-row .form-group {
                        flex: 1;
                }

                .form-actions {
                        display: flex;
                        justify-content: space-between;
                        margin-top: 20px;
                }

                .form-actions button {
                        padding: 10px 20px;
                        border: none;
                        border-radius: 5px;
                        cursor: pointer;
                        font-size: 16px;
                }

                .btn-save {
                        background-color: #1abc9c;
                        color: white;
                }

                .btn-save:hover {
                        background-color: #16a085;
                }

                .btn-cancel {
                        background-color: crimson;
                        color: white;
                }

                .btn-cancel:hover {
                        background-color: darkred;
                }
        </style>

</head>

<body>
        <aside>
                <?php include_once "includes/aside.php"; ?>
        </aside>

        <section class="main-content">
                <div class="top-header">
                        <h2>Edit User Profile</h2>
                </div>
                <!-- <?php print_r($user_info); ?> -->
                <div class="edit-profile-container">
                        <form action="update_user.php" id="editProfileForm" method="POST"
                                onsubmit="validateForm(event)">
                                <div class="form-row">
                                        <div class="form-group">
                                                <input type="hidden" name="user_id" value="<?php echo $user_info['id']; ?>">
                                                <label for="first_name">First Name</label>
                                                <input type="text" id="first_name" name="first_name"
                                                        value="<?php echo $user_info['firstname']; ?>">
                                                <span class="current-value">Current:
                                                        <?php echo $user_info['firstname']; ?></span>
                                        </div>
                                        <div class="form-group">
                                                <label for="last_name">Last Name</label>
                                                <input type="text" id="last_name" name="last_name"
                                                        value="<?php echo $user_info['lastname']; ?>">
                                                <span class="current-value">Current:
                                                        <?php echo $user_info['lastname']; ?></span>
                                        </div>
                                </div>

                                <div class="form-group">
                                        <label for="email">Email</label>
                                        <input type="email" id="email" name="email"
                                                value="<?php echo $user_info['email']; ?>">
                                        <span class="current-value">Current: <?php echo $user_info['email']; ?></span>
                                </div>

                                <div class="form-row">
                                        <div class="form-group">
                                                <label for="password">Password</label>
                                                <input type="password" id="password" name="password"
                                                        placeholder="Enter new password">
                                                <span class="current-value">Current: Hidden for security</span>
                                        </div>
                                        <div class="form-group">
                                                <label for="password">Confirm Password</label>
                                                <input type="password" id="re-password" name="re-password"
                                                        placeholder="Re-type password">
                                                <!-- <span class="current-value">Current: Hidden for security</span> -->
                                        </div>
                                </div>

                                <div class="form-actions">
                                        <button type="submit" class="btn-save">Save Changes</button>
                                        <a href="users.php"><button type="reset" class="btn-cancel">Cancel</button></a>
                                </div>
                        </form>
                </div>
        </section>

        <script>
                function validateForm(event) {
                        event.preventDefault();
                        console.log("validateForm executed");

                        var firstName = document.getElementById('first_name').value;
                        var lastName = document.getElementById('last_name').value;
                        var email = document.getElementById('email').value;
                        var password = document.getElementById('password').value;
                        var confirmPassword = document.getElementById('re-password').value;

                        let valid = true;

                        const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;

                        if (firstName === '') {
                                alert("First Name is required.");
                                valid = false;
                        }
                        if (lastName === '') {
                                alert("Last Name is required.");
                                valid = false;
                        }
                        if (!emailRegex.test(email)) {
                                alert("Please enter a valid email address.");
                                valid = false;
                        }
        
                        if (valid) {
                                console.log("Form is valid. Submitting...");
                                document.getElementById('editProfileForm').submit();
                        }
                }
        </script>
</body>

</html>