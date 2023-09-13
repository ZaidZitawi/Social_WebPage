<!DOCTYPE html>
<html lang="en">

<head>
    <title>Footer Example</title>
    <Style>
        .footer {
            background-color: #f5f5f5;
            padding: 20px;
            text-align: center;
        }

        .container {
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .logo img {
            width: 50px;
            /* Adjust the size as needed */
        }

        .contact-info {
            text-align: left;
        }

        .contact-info p {
            margin: 5px 0;
        }

        .copywrite {
            margin-top: 10px;
            color: #888;
        }
    </Style>
</head>

<body>
    <footer class="footer">
        <div class="container">
            <div class="logo">
                <img src="images\letter-w.png" alt="Logo">
            </div>
            <div class="contact-info">
                <p>Address: 123 Main Street, City, Country</p>
                <p>Email: info@webbrotech.com</p>
                <p>Phone: +1 123-456-7890</p>
                <p><a href="contact.html">Contact Us</a></p>
            </div>
        </div>
        <div class="copywrite">
            <p>&copy; 2023 WebBroTech. All rights reserved.</p>
        </div>
    </footer>
</body>

</html>