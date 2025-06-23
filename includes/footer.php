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
            --footer-border: #e2e8f0;

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
            --footer-border: #374151;
        }

        .footer {
                padding: 2rem 1.5rem;
                background-color: var(--footer-bg);
                border-top: 1px solid var(--footer-border);
        }


        .footer-section {
                margin-bottom: 2rem;
        }

        .footer-heading {
                color: var(--footer-text-primary);
                font-size: 1rem;
                font-weight: 600;
                margin-bottom: 1.25rem;
                text-transform: uppercase;
                letter-spacing: 0.05em;
        }

        .footer-list {
                list-style: none;
                padding: 0;
                margin: 0;
        }

        .footer-item {
                margin-bottom: 0.75rem;
        }

        .footer-link {
                color: var(--footer-text-secondary);
                text-decoration: none;
                transition: color 0.2s ease;
                font-size: 0.9375rem;
                display: inline-block;
        }

        .footer-link:hover {
                color: var(--footer-link-hover);
        }

        .social-links {
                display: flex;
                gap: 1rem;
                margin-bottom: 1.5rem;
        }

        .social-icon {
                color: var(--footer-text-secondary);
                font-size: 1.5rem;
                transition: color 0.2s ease;
        }

        .social-icon:hover {
                color: var(--footer-link-hover);
        }

        .footer-bottom {
                margin-top: 1rem;
                display: flex;
                flex-direction: column;
                gap: 0.75rem;
        }

        .footer-bottom-links {
                display: flex;
                gap: 1.5rem;
        }

        .copyright {
                color: var(--footer-text-secondary);
                font-size: 0.875rem;
        }

        @media (max-width: 768px) {
                .footer-bottom {
                        text-align: center;
                }

                .footer-bottom-links {
                        justify-content: center;
                }

                .social-links {
                        justify-content: center;
                }
        }
</style>

<footer class="footer">
        <div class="container">
                <div class="row">
                        <!-- Products Section -->
                        <div
                                class="col-12 col-md-4 footer-section <?php if (isset($_SESSION['email']))
                                        echo 'd-none'; ?>">
                                <h3 class="footer-heading">Invoice Tools</h3>
                                <ul class="footer-list">
                                        <li class="footer-item">
                                                <a href="#" class="footer-link">Invoice Template</a>
                                        </li>
                                        <li class="footer-item">
                                                <a href="#" class="footer-link">Credit Note Template</a>
                                        </li>
                                        <li class="footer-item">
                                                <a href="#" class="footer-link">Quote Template</a>
                                        </li>
                                        <li class="footer-item">
                                                <a href="#" class="footer-link">Purchase Order Template</a>
                                        </li>
                                </ul>
                        </div>

                        <!-- Resources Section -->
                        <div
                                class="col-12 <?php echo isset($_SESSION['email']) ? 'col-md-8' : 'col-md-4'; ?> footer-section">
                                <h3 class="footer-heading">Resources</h3>
                                <ul class="footer-list">
                                        <li class="footer-item">
                                                <a href="#" class="footer-link">Invoice Guide</a>
                                        </li>
                                        <li class="footer-item">
                                                <a href="help.php" class="footer-link">Help Center</a>
                                        </li>
                                        <?php if (!isset($_SESSION['email'])): ?>
                                                <li class="footer-item">
                                                        <a href="../auth/login.php" class="footer-link">Sign In</a>
                                                </li>
                                                <li class="footer-item">
                                                        <a href="../auth/signup.php" class="footer-link">Sign Up</a>
                                                </li>
                                        <?php endif; ?>
                                        <li class="footer-item">
                                                <a href="#" class="footer-link">Release Notes</a>
                                        </li>
                                        <li class="footer-item">
                                                <a href="#" class="footer-link">Developer API</a>
                                        </li>
                                </ul>
                        </div>

                        <!-- Company & Social Section -->
                        <div class="col-12 col-md-4 footer-section">
                                <div class="social-links">
                                        <a href="#" class="social-icon" aria-label="Facebook">
                                                <i class="fa-brands fa-facebook"></i>
                                        </a>
                                        <a href="#" class="social-icon" aria-label="Twitter">
                                                <i class="fa-brands fa-x-twitter"></i>
                                        </a>
                                        <a href="#" class="social-icon" aria-label="YouTube">
                                                <i class="fa-brands fa-youtube"></i>
                                        </a>
                                        <a href="#" class="social-icon" aria-label="LinkedIn">
                                                <i class="fa-brands fa-linkedin"></i>
                                        </a>
                                        <a href="#" class="social-icon" aria-label="GitHub">
                                                <i class="fa-brands fa-github"></i>
                                        </a>
                                </div>

                                <div class="footer-bottom">
                                        <div class="footer-bottom-links">
                                                <a href="#" class="footer-link">Terms of Service</a>
                                                <a href="#" class="footer-link">Privacy Policy</a>
                                        </div>
                                        <p class="copyright">&copy; 2012-<?php echo date('Y'); ?>
                                                Invoice-Generator.test. All rights reserved.</p>
                                </div>
                        </div>
                </div>
        </div>
</footer>