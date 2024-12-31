<?php session_start(); ?>
<?php require_once "../../modules/app/connect.php"; ?>

<!DOCTYPE html>
<html lang="en">

<head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Invoice Generator</title>

        <!-- Bootstrap -->
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
                integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH"
                crossorigin="anonymous">
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
                integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
                crossorigin="anonymous"></script>

        <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js"
                integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r"
                crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js"
                integrity="sha384-0pUGZvbkm6XF6gxjEnlmuGrJXVbNuzT9qBBavbLwCsOGabYfZo0T0to5eqruptLy"
                crossorigin="anonymous"></script>

        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>


        <!-- Bootstrap Bundle with Popper -->
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"></script>


        <!-- FontAwsome -->
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.1/css/all.min.css"
                integrity="sha512-5Hs3dF2AEPkpNAR7UiOHba+lRSJNeM2ECkwxUIxC1Q/FLycGTbNapWXB4tP889k5T5Ju8fs4b1P5z/iB4nMfSQ=="
                crossorigin="anonymous" referrerpolicy="no-referrer" />

        <!-- JQuery -->
        <script src="https://code.jquery.com/jquery-3.7.1.js"
                integrity="sha256-eKhayi8LEQwp4NKxN+CfCh+3qOVUtJn3QNZ0TciWLP4=" crossorigin="anonymous"></script>


        <style>
                /* DARK */

                /* header,
                .learn-more-banner {
                        background-color: #fff;
                } */

                body {
                        background-color: #f9f9f9;
                        font-family: "Inter", sans-serif !important;
                }

                .nav-item>a:hover {
                        color: green !important;
                }

                /* main content styles */

                .col,
                .row {
                        margin: 0;
                        padding: 0;
                }

                input[type="file"] {
                        display: none;
                }

                .upload-box {
                        display: flex;
                        margin: auto 0 !important;
                        align-items: center;
                        justify-content: center;
                        width: 230px;
                        height: 120px;
                        border: 1px solid #bbb;
                        border-radius: 5px;
                        background-color: #eee;
                        cursor: pointer;
                        transition: all 0.3s ease;
                }

                .upload-box:hover {
                        background-color: #ddd;
                        border-color: #555;
                }

                .input-field {
                        padding: 8px !important;
                        justify-content: flex-start;
                        background: none;
                        font-size: 12px;
                }



                .add-options>span {
                        cursor: pointer;
                }



                /* footer styles */
                .footer {
                        padding-top: 50px;
                        border-top: 1px solid #aaa;
                }

                .footer>ul>th {
                        background: none !important;
                        /* background: none !important; */
                }

                .footer-li {
                        background: none !important;
                        color: #212529;
                        padding: 3px;
                        margin: auto 15px;
                        transition: color all 0.3s;
                }

                .fs-6 {
                        font-size: 15px !important;
                }

                .footer-li:hover .footer_a {
                        color: #198754 !important;
                }

                .cc-text {
                        font-size: 13px;
                }

                .sm-icons {
                        font-size: 30px;
                        padding: 0 5px;
                        cursor: pointer;
                }

                .ft-links {
                        margin-top: 8px;
                }

                .ft-links>a:hover {
                        color: #198754 !important;
                }

                .hvr:hover {
                        cursor: pointer;
                }
        </style>

</head>

<body>
        <header class="header px-3" style="box-shadow: 0 4px 15px rgba(0, 0, 0, 0.2);">
                <nav class="navbar navbar-expand-lg">
                        <div class="container-fluid">
                                <a href="../invoice/create.php" class="navbar-brand">
                                        <img src="../../includes/invoice_svg.svg" alt="logo" height="28" class="img">
                                </a>

                                <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                                        data-bs-target="#navbarContent" aria-controls="navbarContent"
                                        aria-expanded="false" aria-label="Toggle navigation">
                                        <span class="navbar-toggler-icon"></span>
                                </button>

                                <div class="collapse navbar-collapse" id="navbarContent">
                                        <ul class="navbar-nav me-auto mb-2 mb-lg-0">

                                                <?php

                                                if (isset($_SESSION['email'])) {
                                                        ?>
                                                        <li class="nav-item mx-2" style="font-size: 15px;">
                                                                <a href="invoices.php" class="nav-link text-secondary">My
                                                                        Invoices</a>
                                                        </li>
                                                        <li class="nav-item mx-2" style="font-size: 15px;">
                                                                <a href="settings.php"
                                                                        class="nav-link text-secondary">Settings</a>
                                                        </li>
                                                        <!-- <a href="#" class="btn btn-success text-white"> <i
                                                                        class="fa-regular fa-star"></i> Upgrade</a> -->
                                                        <?php
                                                } else {
                                                        ?>
                                                        <li class="nav-item mx-3" style="font-size: 15px;">
                                                                <a href="../invoice/help.php"
                                                                        class="nav-link text-secondary">Help</a>
                                                        </li>
                                                        <li class="nav-item mx-2" style="font-size: 15px;">
                                                                <a href="../invoice/history.php"
                                                                        class="nav-link text-secondary">History</a>
                                                        </li>
                                                        <li class="nav-item mx-2" style="font-size: 15px;">
                                                                <a href="#" class="nav-link text-secondary">Invoicing Guide</a>
                                                        </li>
                                                        <?php
                                                }

                                                ?>



                                        </ul>

                                        <div class="d-flex align-items-center">
                                                <i class="fa-solid fa-language mx-3 text-secondary"></i>
                                                <i class="fa-solid fa-sun mx-3 text-secondary"></i>



                                                <?php

                                                if (isset($_SESSION['email'])) {
                                                        ?>
                                                        <div class="profile mx-2 px-2 my-1">
                                                                <div id="toggle" class="text-secondary"
                                                                        style="cursor: pointer;">
                                                                        <?php
                                                                        require_once "../app/connect.php";

                                                                        $connect = new connect();
                                                                        $db = $connect->connect_db();

                                                                        $em = $_SESSION['email'];
                                                                        $sql = "SELECT `firstname`,`lastname` FROM `users` WHERE `email` = '$em'";
                                                                        $res = $db->query($sql);

                                                                        $row = $res->fetch_assoc();

                                                                        echo $row['firstname'] . " " . $row['lastname'];
                                                                        ?>

                                                                        <span class="mx-1 fw-light text-secondary">
                                                                                <i class="fa-solid fa-angle-down"></i>
                                                                        </span>
                                                                </div>

                                                                <script>
                                                                        document.addEventListener('DOMContentLoaded', function () {
                                                                                const popover = new bootstrap.Popover(document.getElementById('toggle'), {
                                                                                        content: '<div class="row d-flex fs-6 border-bottom pb-3"><a class="text-dark text-decoration-none" href="../invoice/account.php"><div clas="col-7 border"><span class="fw-bold d-block" style="fontsize: 20px;"><?php echo $row['firstname'] . " " . $row['lastname']; ?></span><span class="fw-normal text-secondary"><?php echo $_SESSION['email']; ?></span></div></a></div><div class="row d-flex align-items-center justify-content-center border-bottom py-2"><span class="fw-bold text-center m-auto" style="fontsize: 20px;"><a href="../auth/logout.php" class="text-danger fs-5 text-decoration-none">Logout</a></span></div>',
                                                                                        // content: '<div class="">',
                                                                                        html: true,
                                                                                        placement: 'right',
                                                                                        trigger: 'click'
                                                                                });
                                                                        });
                                                                </script>
                                                                
                                                        </div>
                                                        <?php
                                                } else {
                                                        ?>
                                                        <a href="../../modules/auth/login.php" class="btn me-2">Sign In</a>
                                                        <a href="../../modules/auth/signup.php"
                                                                class="btn btn-success text-white">Sign Up</a>
                                                        <?php
                                                }
                                                ?>

                                        </div>
                                </div>
                        </div>
                </nav>
        </header>

        <script src="../assets/dynamic.js"></script>

</body>

</html>