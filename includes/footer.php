<footer class="footer px-3 pb-5">
        <div class="row w-100">

                <div class="col-sm-12 col-md-4 my-2 <?php if (isset($_SESSION['email']))
                        echo "d-none"; ?>">
                        <ul class="list-group footer-ul">
                                <li style="background: none;"
                                        class="list-group-item fs-6 text-dark py-1 fw-bold border-0">USE INVOICE
                                        GENERATOR</li>
                                <li class="list-group-item fs-6 footer-li border-0">Invoice Template</li>
                                <li class="list-group-item fs-6 footer-li border-0">Credit Note Template</li>
                                <li class="list-group-item fs-6 footer-li border-0">Quote Template</li>
                                <li class="list-group-item fs-6 footer-li border-0">Purchase Order Template</li>
                        </ul>
                </div>


                <div class="col-12 col-md-4 <?php if (isset($_SESSION['email']))
                        echo "col-md-8"; ?> my-2">
                        <ul class="list-group footer-ul">
                                <li style="background: none;"
                                        class="list-group-item fs-6 text-dark py-1 fw-bold border-0">RESOURCES</li>
                                <li class="list-group-item fs-6 footer-li border-0"> <a href="#"
                                                class="footer_a text-dark text-decoration-none">Invoice Guide</a></li>
                                <li class="list-group-item fs-6 footer-li border-0"> <a href="help.php"
                                                class="footer_a text-dark text-decoration-none">Help</a></li>

                                <?php

                                if (!isset($_SESSION['email'])) {
                                        ?>
                                        <li class="list-group-item fs-6 footer-li border-0"> <a href="../auth/login.php"
                                                        class="footer_a text-dark text-decoration-none">Sign In</a></li>
                                        <li class="list-group-item fs-6 footer-li border-0"> <a href="../auth/signup.php"
                                                        class="footer_a text-dark text-decoration-none">Sign Up</a></li>
                                        <?php
                                }

                                ?>
                                <li class="list-group-item fs-6 footer-li border-0"> <a href="#"
                                                class="footer_a text-dark text-decoration-none">Release Notes</a></li>

                                <li class="list-group-item fs-6 footer-li border-0"> <a href="#"
                                                class="footer_a text-dark text-decoration-none">Developer API</a></li>
                        </ul>
                </div>

                <div class="col-sm-12 col-md-4 text-center text-md-start my-2">
                        <p class="text-secondary cc-text">&copy; 2012-2024 Invoice-Generator.com</p>
                        <span class="sm-icons me-2"><i class="fa-brands fa-square-facebook"></i></span>
                        <span class="sm-icons me-2"><i class="fa-brands fa-square-x-twitter"></i></span>
                        <span class="sm-icons me-2"><i class="fa-brands fa-youtube"></i></span>
                        <span class="sm-icons me-2"><i class="fa-brands fa-linkedin"></i></span>
                        <span class="sm-icons me-2"><i class="fa-brands fa-github"></i></span>
                        <div class="ft-links">
                                <a href="" class="text-secondary text-decoration-none d-block">Terms of Service</a>
                                <a href="" class="text-secondary text-decoration-none d-block">Privacy Policy</a>
                        </div>
                </div>
        </div>
</footer>