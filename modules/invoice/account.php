<?php

include_once "../../includes/header.php";
require_once "../app/user.php";

$user = new user();
?>

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
                --sidebar-bg: #fff;
                --main-content-bg: #fff;
                --danger-zone-bg: #fff1f0;
                --danger-zone-border: #ffccc7;
                --profile-image-bg: #e9ecef;
                --profile-icon: #6c757d;
                --nav-link-color: #495057;
                --nav-link-active-bg: #e9ecef;
                --nav-link-active-color: #212529;
                --section-border: #e9ecef;
                --form-label-color: #495057;
                --form-control-border: #dee2e6;
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
                --sidebar-bg: #1f2937;
                --main-content-bg: #1f2937;
                --danger-zone-bg: #2d1c1c;
                --danger-zone-border: #4c2c2c;
                --profile-image-bg: #374151;
                --profile-icon: #9ca3af;
                --nav-link-color: #d1d5db;
                --nav-link-active-bg: #374151;
                --nav-link-active-color: #f9fafb;
                --section-border: #374151;
                --form-label-color: #d1d5db;
                --form-control-border: #4b5563;
        }

        header.header {
                z-index: 9999 !important;
        }

        .account-wrapper {
                min-height: 100vh;
                background-color: var(--background-color);
                padding: 3rem 0;
        }

        .account-container {
                margin: 0 auto;
                padding: 0 1.5rem;
        }

        .account-grid {
                display: grid;
                grid-template-columns: 300px 1fr;
                gap: 2rem;
        }

        .sidebar {
                background: var(--sidebar-bg);
                border-radius: 12px;
                box-shadow: var(--shadow);
                padding: 2rem;
                height: fit-content;
        }

        .sidebar-profile {
                text-align: center;
                padding-bottom: 2rem;
                border-bottom: 1px solid var(--section-border);
                margin-bottom: 2rem;
        }

        .profile-image {
                width: 100px;
                height: 100px;
                border-radius: 50%;
                background: var(--profile-image-bg);
                margin: 0 auto 1rem;
                display: flex;
                align-items: center;
                justify-content: center;
        }

        .profile-image i {
                font-size: 2.5rem;
                color: var(--profile-icon);
        }

        .nav-pills .nav-link {
                color: var(--nav-link-color);
                padding: 0.75rem 1rem;
                border-radius: 8px;
                transition: all 0.2s;
        }

        .nav-pills .nav-link.active {
                background-color: var(--nav-link-active-bg);
                color: var(--nav-link-active-color);
        }

        .main-content {
                background: var(--main-content-bg);
                border-radius: 12px;
                box-shadow: var(--shadow);
                padding: 2rem;
        }

        .section-header {
                display: flex;
                justify-content: space-between;
                align-items: center;
                margin-bottom: 2rem;
                padding-bottom: 1rem;
                border-bottom: 1px solid var(--section-border);
        }

        .section-title {
                font-size: 1.5rem;
                font-weight: 600;
                color: var(--text-color);
                margin: 0;
        }

        .form-section {
                background: var(--main-content-bg);
                border-radius: 8px;
                padding: 2rem;
                margin-bottom: 2rem;
        }

        .form-section:last-child {
                margin-bottom: 0;
        }

        .form-group {
                margin-bottom: 1.5rem;
        }

        .form-label {
                font-weight: 500;
                margin-bottom: 0.5rem;
                color: var(--form-label-color);
        }

        .form-control {
                border: 1px solid var(--form-control-border);
                padding: 0.75rem;
                border-radius: 6px;
                transition: border-color 0.2s;
                background-color: var(--white);
                color: var(--text-color);
        }

        .form-control:focus {
                border-color: var(--accent-color);
                box-shadow: 0 0 0 0.2rem rgba(96, 165, 250, 0.25);
        }

        .btn-primary {
                background: var(--primary-color);
                border: none;
                padding: 0.75rem 2rem;
                font-weight: 500;
                border-radius: 6px;
                transition: all 0.2s;
        }

        .btn-primary:hover {
                background: var(--hover-color);
                transform: translateY(-1px);
        }

        .danger-zone {
                background: var(--danger-zone-bg);
                border: 1px solid var(--danger-zone-border);
                border-radius: 8px;
                margin-top: 3rem;
        }

        .danger-zone .header {
                padding: 1rem 1.5rem;
                border-bottom: 1px solid var(--danger-zone-border);
        }

        .danger-zone .content {
                padding: 1.5rem;
        }

        .btn-danger {
                background: #dc3545;
                border: none;
                padding: 0.75rem 2rem;
                font-weight: 500;
                border-radius: 6px;
                transition: all 0.2s;
        }

        .btn-danger:hover {
                background: #c82333;
        }

        /* Mobile Devices - Small Screens */
        @media screen and (max-width: 576px) {
                .account-wrapper {
                        padding: 1rem 0;
                }

                .account-grid {
                        grid-template-columns: 1fr;
                        gap: 1rem;
                }

                .sidebar {
                        padding: 1rem;
                }

                .profile-image {
                        width: 80px;
                        height: 80px;
                }

                .profile-image i {
                        font-size: 2rem;
                }

                .main-content {
                        padding: 1rem;
                }

                .section-header {
                        flex-direction: column;
                        align-items: flex-start;
                        gap: 1rem;
                }

                .form-section {
                        padding: 1rem;
                }

                .btn-primary, .btn-danger {
                        width: 100%;
                        padding: 0.5rem 1rem;
                }
        }

        /* Tablet Devices - Medium Screens */
        @media screen and (min-width: 577px) and (max-width: 768px) {
                .account-grid {
                        grid-template-columns: 1fr;
                        gap: 1.5rem;
                }

                .sidebar {
                        padding: 1.5rem;
                        background-color: var(--sidebar-bg);
                        border-radius: var(--border-radius);
                        box-shadow: var(--shadow);
                        display: flex;
                        flex-direction: row-reverse;
                        justify-content: space-between;
                }

                .sidebar-profile {
                        display: flex;
                        flex-direction: column;
                        align-items: center;
                        gap: 1rem;
                        padding-bottom: 1rem;
                        border-bottom: none;
                        margin-bottom: 1rem;
                }

                .profile-image i {
                        font-size: 1.5rem;
                }

                .profile-image {
                        width: 65px;
                        height: 65px;
                        margin-bottom: 0;
                }

                .nav-pills {
                        display: flex;
                        flex-direction: row;
                        flex-wrap: wrap;
                        gap: 0.5rem;
                        width: 50% !important;
                }
                
                .nav-pills .nav-link {
                        flex: 1;
                        min-width: 150px;
                        text-align: center;
                        display: flex;
                        justify-content: center;
                        align-items: center;
                        padding: 0.75rem 1rem;
                        /* background-color: var(--nav-link-active-bg); */
                        color: var(--nav-link-color);
                        border-radius: var(--border-radius);
                }

                .nav-pills .nav-link.active {
                        background-color: var(--primary-color);
                        color: var(--white);
                }

                .main-content {
                        padding: 1.5rem;
                        background-color: var(--main-content-bg);
                        border-radius: var(--border-radius);
                        box-shadow: var(--shadow);
                }
        }

        /* Larger Tablets and Small Laptops */
        @media screen and (min-width: 769px) and (max-width: 1024px) {
                .account-grid {
                        grid-template-columns: 250px 1fr;
                        gap: 1.5rem;
                }

                .sidebar {
                        padding: 1.5rem;
                }
        }
</style>

<div class="account-wrapper">
        <div class="account-container">
                <div class="account-grid">
                        <div class="sidebar">
                                <div class="sidebar-profile">
                                        <div class="profile-image">
                                                <i class="fas fa-user"></i>
                                        </div>
                                        <h5 class="mb-1">
                                                <?php echo htmlspecialchars($row['firstname'] . ' ' . $row['lastname']); ?>
                                        </h5>
                                        <p class="mb-0"><?php echo $_SESSION['email']; ?></p>
                                </div>

                                <div class="nav flex-column nav-pills">
                                        <a class="nav-link active mb-2" href="#profile">Profile Information</a>
                                        <a class="nav-link mb-2" href="#security">Security Settings</a>
                                        <a class="nav-link mb-2" href="#preferences">Preferences</a>
                                </div>
                        </div>
                        
                        <div class="main-content">
                                <div class="section-header">
                                        <h2 class="section-title">Account Settings</h2>
                                </div>

                                <?php
                                $uid = $_SESSION['user_id'];
                                $sql = "SELECT `firstname`, `lastname` FROM `users` WHERE `id` = $uid";
                                $res = $db->query($sql);

                                if ($res->num_rows > 0) {
                                        $row = $res->fetch_assoc();
                                }
                                ?>

                                <div class="form-section" id="profile">
                                        <form action="" name="change_name" id="update_name" method="post">
                                                <h3 class="mb-4">Profile Information</h3>

                                                <div class="row g-4">
                                                        <div class="col-md-6">
                                                                <div class="form-group">
                                                                        <label class="form-label">First Name</label>
                                                                        <input type="text" name="fname"
                                                                                value="<?php echo htmlspecialchars($row['firstname']); ?>"
                                                                                class="form-control">
                                                                </div>
                                                        </div>
                                                        <div class="col-md-6">
                                                                <div class="form-group">
                                                                        <label class="form-label">Last Name</label>
                                                                        <input type="text" name="lname"
                                                                                value="<?php echo htmlspecialchars($row['lastname']); ?>"
                                                                                class="form-control">
                                                                </div>
                                                        </div>
                                                </div>

                                                <div class="mt-4">
                                                        <button type="submit" name="change_name"
                                                                class="btn btn-primary">Save Changes</button>
                                                </div>
                                        </form>
                                </div>

                                <?php
                                if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['change_name'])) {
                                        $fname = trim($_POST['fname']);
                                        $lname = trim($_POST['lname']);

                                        if (!empty($fname) && !empty($lname)) {
                                                $user->update_name($fname, $lname);
                                        } else {
                                                echo "<script>alert('Both fields are required');</script>";
                                        }
                                }
                                ?>

                                <div class="form-section" id="security">
                                        <form action="" name="update_em_pw" id="update_em_pw" method="post">
                                                <h3 class="mb-4">Security Settings</h3>

                                                <div class="row g-4 mb-4">
                                                        <div class="col-md-6">
                                                                <div class="form-group">
                                                                        <label class="form-label">New Email</label>
                                                                        <input type="email" name="email"
                                                                                class="form-control">
                                                                </div>
                                                        </div>
                                                        <div class="col-md-6">
                                                                <div class="form-group">
                                                                        <label class="form-label">Confirm Email</label>
                                                                        <input type="email" name="cnf_email"
                                                                                class="form-control">
                                                                </div>
                                                        </div>
                                                </div>

                                                <div class="row g-4">
                                                        <div class="col-md-6">
                                                                <div class="form-group">
                                                                        <label class="form-label">New Password</label>
                                                                        <input type="password" name="password"
                                                                                class="form-control">
                                                                </div>
                                                        </div>
                                                        <div class="col-md-6">
                                                                <div class="form-group">
                                                                        <label class="form-label">Confirm
                                                                                Password</label>
                                                                        <input type="password" name="cnf_password"
                                                                                class="form-control">
                                                                </div>
                                                        </div>
                                                </div>

                                                <div class="mt-4">
                                                        <button type="submit" name="update_em_pw"
                                                                class="btn btn-primary">Update Security</button>
                                                </div>
                                        </form>
                                </div>

                                <div class="danger-zone">
                                        <div class="header">
                                                <h4 class="mb-0 text-danger">Danger Zone</h4>
                                        </div>
                                        <div class="content">
                                                <p class="mb-4">Once you delete your account, there is no
                                                        going back. Please be certain.</p>
                                                <a href="../auth/delete_acc.php" class="btn btn-danger">Delete
                                                        Account</a>
                                        </div>
                                </div>
                        </div>
                </div>
        </div>
</div>

<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['update_em_pw'])) {
        $new_email = $_POST['email'];
        $cnf_email = $_POST['cnf_email'];
        $new_password = $_POST['password'];
        $cnf_password = $_POST['cnf_password'];

        if ($new_email !== "" && $new_email !== $cnf_email) {
                echo "<script>alert('Emails do not match');</script>";
        } elseif ($new_password !== "" && $new_password !== $cnf_password) {
                echo "<script>alert('Passwords do not match');</script>";
        } elseif ($new_email === "" && $new_password === "") {
                echo "<script>alert('Please enter either email or password to update');</script>";
        } else {
                $user->update_profile($new_email, $new_password);
        }
}
?>

<?php include_once "../../includes/footer.php"; ?>