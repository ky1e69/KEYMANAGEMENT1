<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname_login_register = "login_register";
$dbname_key_records = "key_records";

// Function to establish a database connection
function connectToDatabase($dbname) {
    global $servername, $username, $password;

    // Create connection
    $conn = new mysqli($servername, $username, $password, $dbname);

    // Check connection
    if ($conn->connect_error) {
        throw new Exception("Connection to database $dbname failed: " . $conn->connect_error);
    }

    return $conn;
}

try {
    // Create connection for login_register
    $conn_login_register = connectToDatabase($dbname_login_register);

    // Create connection for key_records
    $conn_key_records = connectToDatabase($dbname_key_records);
} catch (Exception $e) {
    // Handle connection errors gracefully
    die("Error: " . $e->getMessage());
}
?>