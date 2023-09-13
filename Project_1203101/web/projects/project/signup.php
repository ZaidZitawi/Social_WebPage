<?php
include("post.php");
// Define variables and set to empty values
$username = $email = $password = $confirmPassword = "";
$errors = array();

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Sanitize input
    $username = sanitizeInput($_POST["username"]);
    $email = sanitizeInput($_POST["email"]);
    $password = sanitizeInput($_POST["password"]);
    $confirmPassword = sanitizeInput($_POST["confirmpass"]);

    // Validate username
    if (empty($username)) {
        $errors["username"] = "Username is required";
    } else {
        // Check if username already exists
        $query = "SELECT * FROM users WHERE user = :username";
        $stmt = $conn->prepare($query);
        $stmt->bindParam(':username', $username);
        $stmt->execute();
        if ($stmt->rowCount() > 0) {
            $errors["username"] = "Username already exists";
        }
    }

    // Validate email
    if (empty($email)) {
        $errors["email"] = "Email is required";
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errors["email"] = "Invalid email format";
    }

    // Validate password
    if (empty($password)) {
        $errors["password"] = "Password is required";
    } elseif (strlen($password) < 8) {
        $errors["password"] = "Password should be at least 8 characters long";
    }

    // Validate confirm password
    if (empty($confirmPassword)) {
        $errors["confirmPassword"] = "Confirm password is required";
    } elseif ($password !== $confirmPassword) {
        $errors["confirmPassword"] = "Passwords do not match";
    }

    // If there are no errors, perform further actions (e.g., store user data in database)
    if (empty($errors)) {
        $sql = "INSERT INTO users (email, user, password) VALUES (:email, :username, :password)";
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(':email', $email);
        $stmt->bindParam(':username', $username);
        $stmt->bindParam(':password', $password);
        if ($stmt->execute()) {
            header("Location: log.php?massage=Registration successful.");
            echo "Registration successful. You can now log in.";
            exit();
        } else {
            echo "Error inserting record: " . $stmt->errorInfo()[2];
        }
    }
}

// Function to sanitize user input
function sanitizeInput($data)
{
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <title>Signup Page</title>
    <link rel="stylesheet" href="style2.css">
</head>

<body>
    <div class="signup-container">
        <p class="title2">Create Account</p>
        <form class="form" method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
            <div class="input-group">
                <label for="username">Username</label>
                <input type="text" name="username" id="username" value="<?php echo $username; ?>" required>
                <span class="error"><?php echo isset($errors["username"]) ? $errors["username"] : ""; ?></span><br>
            </div>
            <div class="input-group">
                <label for="email">Email</label>
                <input type="email" name="email" id="email" value="<?php echo $email; ?>" required>
                <span class="error"><?php echo isset($errors["email"]) ? $errors["email"] : ""; ?></span><br>
            </div>
            <div class="input-group">
                <label for="password">Password</label>
                <input type="password" name="password" id="password" required pattern="^(?=.*\d).{8,}$" title="Password must be at least 8 digits long and contain at least one character">
                <span class="error"><?php echo isset($errors["password"]) ? $errors["password"] : ""; ?></span><br>
                <br><br>
            </div>
            <div class="input-group">
                <label for="confirmpass">Confirm Password</label>
                <input type="password" name="confirmpass" id="confirmpass" required>
                <span class="error"><?php echo isset($errors["confirmPassword"]) ? $errors["confirmPassword"] : ""; ?></span><br>
            </div><br>
            <button class="sign">Sign up</button>
        </form>
        <p class="signup">Have an account?
            <a rel="login-page" href="log.php">
                Login</a>
        </p>
    </div>
</body>

</html>

<?php
// Close the database connection
$conn = null;
?>