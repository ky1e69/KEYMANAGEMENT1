<?php
// Database connection
$servername = "localhost";
$username = "root";
$password = "";
$dbname_key_borrowing = "key_borrowing";
$dbname_key_records = "key_records";

function connectToDatabase($dbname) {
    global $servername, $username, $password;

    $conn = new mysqli($servername, $username, $password, $dbname);

    if ($conn->connect_error) {
        die("Connection to database $dbname failed: " . $conn->connect_error);
    }

    return $conn;
}

$conn_to_borrow_keys = connectToDatabase($dbname_key_borrowing);
$conn_key_records = connectToDatabase($dbname_key_records);

// Get the selected key from the form
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['selectedKey'])) {
    $selectedKey = $conn_to_borrow_keys->real_escape_string($_POST['selectedKey']);
    
    // Check if the key is available
    $sqlCheck = "SELECT * FROM avail_keys WHERE key_name = '$selectedKey' AND is_borrowed = 0";
    $resultCheck = $conn_to_borrow_keys->query($sqlCheck);

    if ($resultCheck->num_rows > 0) {
        // Update avail_keys table to set is_borrowed to 1
        $sqlUpdate = "UPDATE avail_keys SET is_borrowed = 1 WHERE key_name = '$selectedKey'";
        $conn_to_borrow_keys->query($sqlUpdate);

        // Insert a record into key_records
        $borrowDate = date("Y-m-d H:i:s");
        $sql = "INSERT INTO users (key_name, borrow_date) VALUES ('$selectedKey', '$borrowDate')";
        $stmt = mysqli_stmt_init($conn_key_records);

        // Success message
        echo "<script>alert('You have borrowed a key successfully!'); window.location.href='your_keys_page.php';</script>";
    } else {
        // Error: Key is not available
        echo "<script>alert('The key is not available for borrowing.'); window.location.href='your_keys_page.php';</script>";
    }
} else {
    echo "No key selected.";
}

// Close database connections
$conn_to_borrow_keys->close();
$conn_key_records->close();
?>