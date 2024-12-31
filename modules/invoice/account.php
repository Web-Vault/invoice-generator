<?php

include_once "../../includes/header.php";
require_once "../app/user.php";

$user = new user();

?>

<style>
        .fff,
        header {
                background-color: #fff !important;
        }
</style>

<div class="border my-4 mx-4 p-4 rounded-3 fff">
        <p class="fw-bold text-center fs-4">My Account</p>
        <p class="fw-normal text-secondary text-center" style="font-size: 17px;">Manage your user account, including
                your contact and sign in information.
        </p>

        <div class="acc-email">
                <div class="text-dark em-heading px-3">Email</div>
                <div class="fw-bold em m-3 text-secondary" style="font-size: 15px;"><?php echo $_SESSION['email']; ?>
                </div>
        </div>

        <?php

        $uid = $_SESSION['user_id'];
        $sql = "SELECT `firstname`, `lastname` FROM `users` WHERE `id` = $uid";
        $res = $db->query($sql);

        if ($res->num_rows > 0) {
                $row = $res->fetch_assoc();
        }


        ?>

        <section class="profile mx-3 my-5">
                <form action="" name="change_name" id="update_name" method="post">
                        <p class="fs-4 fw-bold pb-2 border-bottom">
                                Change Profile.
                        </p>

                        <div class="profile-content">
                                <article class="info">
                                        <div class="row g-1">
                                                <div class="col-12 col-md-6">
                                                        First Name
                                                        <input type="text" name="fname"
                                                                value="<?php echo htmlspecialchars($row['firstname']); ?>"
                                                                class="form-control input-field my-1 text-start border rounded-1 d-block">
                                                </div>
                                                <div class="col-12 col-md-6">
                                                        Last Name
                                                        <input type="text" name="lname"
                                                                value="<?php echo htmlspecialchars($row['lastname']); ?>"
                                                                class="form-control input-field my-1 text-start border rounded-1 d-block">
                                                </div>
                                        </div>
                                </article>
                        </div>

                        <div class="button-compartment my-4 py-1">
                                <button type="submit" name="change_name" class="btn btn-lg px-4 btn-success">
                                        Save</button>
                        </div>
                </form>


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



        </section>

        <section class="profile mx-3 my-5">
                <form action="" name="update_em_pw" id="update_em_pw" method="post">
                        <p class="fs-4 fw-bold pb-2 border-bottom">
                                Change Email Address or Password.
                        </p>

                        <div class="email-content">
                                <article class="info">
                                        <div class="row g-1">
                                                <div class="col-6">
                                                        New Email
                                                        <input class="form-control input-field my-1 text-start border rounded-1 d-block"
                                                                type="email" name="email" id="">
                                                </div>
                                                <div class="col-6">
                                                        Confirm Email
                                                        <input class="form-control input-field my-1 text-start border rounded-1 d-block"
                                                                type="email" name="cnf_email" id="">
                                                </div>
                                        </div>
                                </article>
                        </div>

                        <div class="password-content my-4">
                                <article class="info">
                                        <div class="row g-1">
                                                <div class="col-6">
                                                        New Password
                                                        <input class="form-control input-field my-1 text-start border rounded-1 d-block"
                                                                type="password" name="password" id="">
                                                </div>
                                                <div class="col-6">
                                                        Confirm Password
                                                        <input class="form-control input-field my-1 text-start border rounded-1 d-block"
                                                                type="password" name="cnf_password" id="">
                                                </div>
                                        </div>
                                </article>
                        </div>

                        <div class="button-compartment my-4 py-1">
                                <button type="submit" name="update_em_pw" class="btn btn-lg px-4 btn-success">
                                        Save</button>
                        </div>
                </form>

        </section>

        <div class="card mt-5 mb-3 mx-3">
                <div class="card-header bg-danger text-white py-3 fs-5">Danger Zone</div>
                <div class="card-body">
                        <a href="../auth/delete_acc.php" class="btn btn-danger btn-sm p-2 px-3">Close Account</a>
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