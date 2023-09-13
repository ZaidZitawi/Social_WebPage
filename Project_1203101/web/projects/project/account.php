<?php
session_start();
include("post.php");
include("header.php");

// Check if the user is logged in
if (!isset($_SESSION['username'])) {
    echo "User not logged in.";
    exit();
}

// Retrieve the user details from the database
$username = $_SESSION['username'];

// Prepare the SQL query
$sql = "SELECT * FROM users WHERE email = :username";

try {
    // Prepare the statement
    $stmt = $conn->prepare($sql);

    // Bind the parameter
    $stmt->bindParam(':username', $username);

    // Execute the query
    $stmt->execute();

    // Fetch the result
    $result = $stmt->fetch(PDO::FETCH_ASSOC);

    // Check if a matching record is found
    if ($result) {
        $userid = $result['id'];
        $username = $result['user'];
        $email = $result['email'];
        $reg_date = $result['reg_date'];

        
        echo "<ul>";
        echo "<li><strong>User ID:</strong> " . $userid . "</li>";
        echo "<li><strong>Username:</strong> " . $username . "</li>";
        echo "<li><strong>Email:</strong> " . $email . "</li>";
        echo "<li><strong>Registration Date:</strong> " . $reg_date . "</li>";
        echo "</ul>";
    } else {
        echo "User not found.";
    }
} catch (PDOException $e) {
    echo "Error: " . $e->getMessage();
}

// Close the database connection
$conn = null;
?>




<?php
include("footer.html");
?>

