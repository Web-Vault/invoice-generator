
<style>
        aside {
                position: fixed;
                height: 100vh;
                width: 20%;
                background-color: #2c3e50;
                color: white;
                display: flex;
                flex-direction: column;
                justify-content: space-between;
                padding: 20px;
        }

        .nav ul {
                list-style: none;
        }

        .nav ul li {
                /* width: 14vw !important; */
                margin: 15px 0;
                padding: 10px;
                cursor: pointer;
                background-color: #34495e;
                text-align: center;
                border-radius: 5px;
                transition: all 0.3s ease;
        }

        .nav ul li:hover {
                background-color: #1abc9c;
        }

        .nav ul .active {
                background-color: #1abc9c;
        }

        .logout {
                background-color: #e74c3c;
                color: white;
                border: none;
                padding: 10px 20px;
                border-radius: 5px;
                cursor: pointer;
                width: 100%;
                font-size: 16px;
                transition: all 0.3s ease;
                text-align: center;
        }

        .logout:hover {
                background-color: #c0392b;
                transform: scale(1.05);
        }

        .bottom ul {
                list-style: none;
                padding: 0;
                margin: 0;
                text-align: center;
        }
</style>

<div class="nav">
        <ul>
                <a href="/admin/index.php" style="color: white; text-decoration: none;">
                        <!-- <img src="../../assets/invoice_img.png" alt="Invoice_Generator_Logo" width="230" style="margin: 25px 0;"> -->
                </a>
                <a href="/admin/index.php" style="color: white; text-decoration: none;">
                        <li> Dashboard </li>
                </a>
                <a href="/admin/users.php" style="color: white; text-decoration: none;">
                        <li> Users </li>
                </a>
                <a href="/admin/invoice.php" style="color: white; text-decoration: none;">
                        <li> Invoices </li>
                </a>
        </ul>
</div>
<div class="bottom">
        <ul>
                <li> <a href="logout.php"> <button class="logout" style="color: white; text-decoration: none;"> Logout </button>
                        </a></li>
        </ul>
</div>