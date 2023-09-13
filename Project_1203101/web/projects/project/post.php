<?php
$db_server = "localhost";
$db_user = "c152zaid";
$db_pass = "web1203101";
$db_name = "c152project";
$conn="";

try {
    $conn = new PDO("mysql:host=$db_server;dbname=$db_name", $db_user, $db_pass);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    echo "Connection failed: " . $e->getMessage() . "<br>";
}

?>

