<?php include_once "../../includes/header.php"; ?>

<style>
        .fff,
        header {
                background-color: #fff !important;
        }
</style>

<div class="border my-4 mx-4 p-4 rounded-3 fff">
        <p class="fw-bold fs-4">History</p>
        <p class="fw-normal text-secondary" style="font-size: 18px;">We automatically save invoices that you created
                recently to your device. This is useful when you need to quickly make an edit to an invoice.
        </p>

        <div class="container-fluid d-flex justify-content-between row py-2 pb-3">
                <div class="search col-6 ">
                        <div class="input-group border rounded">
                                <span class="input-group-text bg-white border-0"><i
                                                class="fa-solid fa-magnifying-glass"></i></span>
                                <input type="text" class="form-control text-start border-0"
                                        placeholder="Search Inoices">
                        </div>
                </div>
                <div class="buttons col-6 d-flex justify-content-end">
                        <!-- <button class="btn btn-md btn-outline-secondary py-2 mx-3"><i
                                        class="fa-solid fa-download"></i>Export</button> -->
                        <button class="btn btn-md btn-success py-2 my-3"><a href="create.php"
                                        class="text-white text-decoration-none"> New Invoice </a></button>

                </div>

                <?php

                if (!isset($_SESSION['email'])) {
                        ?>
                        <p class="fw-bold p-2 fs-6">
                                <a href="../auth/login.php">Log In</a> or <a href="../auth/signup.php">Sign Up</a> to track your
                                created invoices.
                        </p>
                <?php
                } else {
                        ?>
                        <script>
                                window.location.href = "invoices.php";
                        </script>
                        <?php
                }
                ?>



                <!-- <div class="disc">
                        <p style="font-size: 14px;" class="text-danger my-2"><i
                                        class="fa-solid fa-triangle-exclamation"></i> These invoices are stored on your
                                device only. Clearing your browser's history will erase these invoices. We recommend
                                hanging on to a copy of each invoice you generate.

                        </p>
                        <button class="btn btn-sm btn-danger text-white">Erase Everything</button>
                </div> -->
        </div>
</div>

<?php include_once "../../includes/footer.php"; ?>