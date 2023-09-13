<?php
include("post.php");
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <title>Header</title>
    <style>
        body {
            margin: 0;
            padding: 0;
        }

        .container {
            max-width: 960px;
            margin: 0 auto;
            padding: 20px;
        }

        .header {
            background-color: rgba(17, 24, 39, 1);
            color: #fff;
        }

        .logo {
            margin: 0;
            padding: 0;
            font-size: 24px;
        }

        .navigation {
            display: flex;
            justify-content: flex-end;
        }

        .menu {
            list-style-type: none;
            margin: 0;
            padding: 0;

        }

        .menu li {
            display: inline-block;
            margin-right: 20px;
            transition-duration: 0.4s;
        }

        .menu li a {
            display: block;
            padding: 10px 15px;
            text-decoration: none;
            color: #ffffff;
            transition-duration: 0.4s;
        }

        .menu li a:hover {
            background-color: rgba(167, 139, 250);
        }

        .logo {
            display: flex;
            align-items: center;
        }

        .logo img {
            width: 50px;
            /* Adjust the width as needed */
            height: auto;
            margin-right: 10px;
            /* Adjust the spacing between the logo and company name */
        }

        .company-name {
            margin: 0;
            font-size: 24px;
            color: #fff;
        }
    </style>
</head>

<body>
    <header class="header">
        <div class="container">
            <div class="logo">
                <img src="images\letter-w.png" alt="Logo">
                <h1 class="company-name">WebBroTech</h1>
            </div>
            <nav class="navigation">
                <ul class="menu">
                    <li><a href="dashboard.php">Home </a></li>
                    <li><a href="account.php">Account</a></li>
                    <li><a href="about.php">About Us</a></li>
                    <li><a href="log.php?destroy=true">Log out</a></li>

                    <?php
                    if (!$conn) {
                        die("Connection failed: " . mysqli_connect_error());
                    }
                    $db_name = "x";
                    $conn->exec("USE $db_name");

                    $sql = "SELECT user FROM users WHERE email = :username AND password = :password";
                    $stmt = $conn->prepare($sql);
                    $stmt->bindParam(':username', $_SESSION['username']);
                    $stmt->bindParam(':password', $_SESSION['password']);
                    $stmt->execute();
                    $result = $stmt->fetch(PDO::FETCH_ASSOC);
                    if ($result) {
                        $user = $result['user'];
                        echo "Hi " . $user;
                    }
                    

                    ?>
                </ul>
            </nav>
        </div>
    </header>
</body><br><br><br>

</html>