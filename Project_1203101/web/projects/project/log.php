<?php
session_start();
include("post.php");


// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get the submitted username and password
    $username = $_POST["username"];
    $password = $_POST["password"];

    // Check the connection
    if (!$conn) {
        die("Connection failed: " . mysqli_connect_error());
    }

    $db_name = "c152project";
    $conn->exec("USE $db_name");


    // Prepare the SQL query
    $sql = "SELECT * FROM users WHERE email = :username AND password = :password";
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(':username', $username);
    $stmt->bindParam(':password', $password);
    $stmt->execute();
    $result = $stmt->fetch(PDO::FETCH_ASSOC);

    // Check if a matching record is found
    if ($result) {
        // Valid username and password, set the user as logged-in using sessions
        $_SESSION["username"] = $username;
        $_SESSION["password"] = $password;
        // Redirect the user to the home page
        header("Location: dashboard.php");
        exit();
    } else {
        // Invalid username or password
        $error = "Invalid username or password";
    }
}



?>
<!DOCTYPE html>
<html lang="en">

<head>
    <title>Login Page</title>
    <link rel="stylesheet" href="style2.css">
</head>

<body>
    
    <div class="login-container">
        <p class="title1">Welcome to WebBroTech</p>
        <p class="title2">Login</p>
        <?php if (isset($error)) { ?>
            <p class="error"><?php echo $error; ?></p>
        <?php } ?>
        <form class="form" method="post">
            <div class="input-group">
                <label for="username">Email</label>
                <input type="text" name="username" id="username">
            </div>
            <div class="input-group">
                <label for="password">Password</label>
                <input type="password" name="password" id="password">
                <br><br>
            </div>
            <button class="sign">Login</button>
        </form>
        <p class="signup">Don't have an account?
            <a rel="Sign-up-page" href="signup.php" class="">Sign up</a>
        </p>
    </div>
</body>

</html>

<?php
if (isset($_GET['destroy']) && $_GET['destroy'] === 'true') {
    //if someone loged out, then the session should 
    //be destroyed and the user must log in again 
    session_destroy();
}
?>