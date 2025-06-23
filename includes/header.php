<?php session_start(); ?>
<?php require_once "../../modules/app/connect.php"; ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Invoice Generator | Professional Invoicing Solution</title>

    <!-- CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.1/css/all.min.css">
    
    <!-- JavaScript -->
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js"></script>

    <link rel="shortcut icon" href="../../assets/173745502034560481.png" type="image/x-icon">

    <style>
        :root {
            --primary-color: #1a56db;
            --secondary-color: #4b5563;
            --background-color: #f9fafb;
            --border-color: #e5e7eb;
            --text-color: #111827;
            --hover-color: #1e40af;
            --accent-color: #3b82f6;
        }

        :root[data-theme="dark"] {
            --primary-color: #60a5fa;
            --secondary-color: #9ca3af;
            --background-color: #111827;
            --border-color: #374151;
            --text-color: #fff;
            --hover-color: #3b82f6;
            --accent-color: #60a5fa;
        }

        body {
            background-color: var(--background-color);
            font-family: 'Inter', -apple-system, BlinkMacSystemFont, sans-serif;
            color: var(--text-color);
            line-height: 1.6;
            transition: background-color 0.3s ease;
        }

        .header {
            background: var(--background-color);
            box-shadow: 0 1px 2px 0 rgb(0 0 0 / 0.05);
            position: sticky;
            top: 0;
            z-index: 1000;
            border-bottom: 1px solid var(--border-color);
            transition: background-color 0.3s ease;
        }

        .navbar {
            padding: 0.75rem 0;
            /* max-width: 1280px; */
            margin: 0 auto;
        }

        .navbar-brand {
            padding: 0;
            margin-right: 3rem;
        }

        .navbar-brand img {
            height: 36px;
            width: auto;
        }

        .nav-link {
            color: var(--secondary-color);
            font-weight: 500;
            padding: 0.75rem 1rem;
            transition: all 0.2s ease;
            border-radius: 0.375rem;
            margin: 0 0.25rem;
        }

        .nav-link:hover {
            color: var(--primary-color);
            background-color: var(--background-color);
        }

        .nav-link.active {
            color: var(--primary-color);
            background-color: rgba(59, 130, 246, 0.1);
        }

        .btn {
            padding: 0.625rem 1.25rem;
            font-weight: 500;
            border-radius: 0.5rem;
            transition: all 0.2s ease;
        }

        .btn-primary {
            background-color: var(--primary-color);
            border: none;
            box-shadow: 0 1px 2px 0 rgba(0, 0, 0, 0.05);
        }

        .btn-primary:hover {
            background-color: var(--hover-color);
            transform: translateY(-1px);
        }

        .btn-outline-secondary {
            border-color: var(--border-color);
            color: var(--secondary-color);
        }

        .btn-outline-secondary:hover {
            background-color: var(--background-color);
            border-color: var(--border-color);
            color: var(--text-color);
        }

        .user-profile {
            display: flex;
            align-items: center;
            gap: 0.75rem;
            padding: 0.5rem 1rem;
            border-radius: 0.5rem;
            border: 1px solid var(--border-color);
            transition: all 0.2s ease;
            background: var(--background-color);
            color: var(--text-color);
        }

        .user-profile:hover {
            background-color: var(--background-color);
            border-color: var(--accent-color);
        }

        .icon-button {
            width: 2.5rem;
            height: 2.5rem;
            display: flex;
            align-items: center;
            justify-content: center;
            border-radius: 0.5rem;
            color: var(--secondary-color);
            background: var(--background-color);
            border: 1px solid var(--border-color);
            transition: all 0.2s ease;
        }

        .icon-button:hover {
            background-color: var(--background-color);
            color: var(--primary-color);
            border-color: var(--accent-color);
        }

        .popover {
            box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1), 0 2px 4px -2px rgba(0, 0, 0, 0.05);
            border: 1px solid var(--border-color);
            border-radius: 0.75rem;
            background-color: var(--background-color);
            color: var(--text-color);
        }

        .dropdown-menu {
            padding: 0.5rem;
            border-radius: 0.75rem;
            border: 1px solid var(--border-color);
            box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1);
            background-color: var(--background-color);
            color: var(--text-color);
        }
    </style>
</head>

<body>
    <header class="header">
        <nav class="navbar navbar-expand-lg">
            <div class="container-fluid">
                <a href="../invoice/create.php" class="navbar-brand d-flex align-items-center gap-2">
                    <img src="../../assets/173745502034560481.png" alt="Invoice Generator" class="img-fluid">
                    <span class="fw-semibold" style="font-size: 1.5rem; color: var(--text-color);">Invoice Edge</span>
                </a>

                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarContent">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarContent">
                    <ul class="navbar-nav me-auto">
                        <?php if (isset($_SESSION['email'])): ?>
                            <li class="nav-item">
                                <a href="invoices.php" class="nav-link <?php echo basename($_SERVER['PHP_SELF']) == 'invoices.php' ? 'active' : ''; ?>">
                                    <i class="fa-regular fa-file-lines me-2"></i>My Invoices
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="settings.php" class="nav-link <?php echo basename($_SERVER['PHP_SELF']) == 'settings.php' ? 'active' : ''; ?>">
                                    <i class="fa-regular fa-gear me-2"></i>Settings
                                </a>
                            </li>
                        <?php else: ?>
                            <li class="nav-item">
                                <a href="../invoice/help.php" class="nav-link <?php echo basename($_SERVER['PHP_SELF']) == 'help.php' ? 'active' : ''; ?>">
                                    <i class="fa-regular fa-circle-question me-2"></i>Help
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="../invoice/history.php" class="nav-link <?php echo basename($_SERVER['PHP_SELF']) == 'history.php' ? 'active' : ''; ?>">
                                    <i class="fa-regular fa-clock me-2"></i>History
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="#" class="nav-link">
                                    <i class="fa-regular fa-book me-2"></i>Invoicing Guide
                                </a>
                            </li>
                        <?php endif; ?>
                    </ul>

                    <div class="d-flex align-items-center gap-3">
                       
                        <button class="icon-button" id="themeToggle" title="Toggle Theme">
                            <i class="fa-solid fa-sun" id="themeIcon"></i>
                        </button>

                        <?php if (isset($_SESSION['email'])): ?>
                            <?php
                                require_once "../../modules/app/connect.php";
                                $connect = new connect();
                                $db = $connect->connect_db();
                                $em = $_SESSION['email'];
                                $sql = "SELECT `firstname`,`lastname` FROM `users` WHERE `email` = '$em'";
                                $res = $db->query($sql);
                                $row = $res->fetch_assoc();
                            ?>
                            <div class="user-profile" id="toggle">
                                <span class="fw-medium"><?php echo $row['firstname'] . " " . $row['lastname']; ?></span>
                                <i class="fa-solid fa-angle-down text-secondary"></i>
                            </div>
                        <?php else: ?>
                            <a href="../../modules/auth/login.php" class="btn btn-outline-secondary">Sign In</a>
                            <a href="../../modules/auth/signup.php" class="btn btn-primary">Sign Up</a>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </nav>
    </header>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Theme toggle functionality
            const themeToggle = document.getElementById('themeToggle');
            const themeIcon = document.getElementById('themeIcon');
            
            // Check for saved theme preference
            const currentTheme = localStorage.getItem('theme') || 'light';
            document.documentElement.setAttribute('data-theme', currentTheme);
            updateThemeIcon(currentTheme);

            themeToggle.addEventListener('click', () => {
                const currentTheme = document.documentElement.getAttribute('data-theme');
                const newTheme = currentTheme === 'light' ? 'dark' : 'light';
                
                document.documentElement.setAttribute('data-theme', newTheme);
                localStorage.setItem('theme', newTheme);
                updateThemeIcon(newTheme);
            });

            function updateThemeIcon(theme) {
                if (theme === 'dark') {
                    themeIcon.classList.remove('fa-sun');
                    themeIcon.classList.add('fa-moon');
                } else {
                    themeIcon.classList.remove('fa-moon');
                    themeIcon.classList.add('fa-sun');
                }
            }

            // User profile popover
            if (document.getElementById('toggle')) {
                const toggleElement = document.getElementById('toggle');
                const popover = new bootstrap.Popover(toggleElement, {
                    content: `
                        <div class="p-3">
                            <a href="account.php"><div class="border-bottom pb-2 mb-2">
                                <div class="fw-medium text-dark"><?php echo $row['firstname'] . " " . $row['lastname']; ?></div>
                                <div class="text-secondary small"><?php echo $_SESSION['email']; ?></div>
                            </div></a>
                            <a href="../auth/logout.php" class="d-flex align-items-center gap-2 text-danger text-decoration-none">
                                <i class="fa-solid fa-right-from-bracket"></i>
                                <span>Logout</span>
                            </a>
                        </div>
                    `,
                    html: true,
                    placement: 'bottom',
                    trigger: 'click',
                    customClass: 'shadow-lg',
                    container: 'body',
                    offset: [0, 10],
                    popperConfig: {
                        modifiers: [{
                            name: 'preventOverflow',
                            options: {
                                boundary: document.body
                            }
                        }]
                    }
                });
            }
        });
    </script>
</body>
</html>