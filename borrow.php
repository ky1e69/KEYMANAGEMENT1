<!DOCTYPE html>
<html>
<head>
    <title>Borrow Key</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" type="image/x-icon" href="/Images/CTU Logo.png">
    <link rel="stylesheet" href="borrow.css">
</head>
<body>

<div class="borrow">
  
<?php
require_once "database.php";
date_default_timezone_set('Australia/West');

// Check if the borrow form is submitted
if (isset($_POST["borrow"])) {
    // Retrieve form data
    $username = $_POST["username"];
    $borrower_id = $_POST["idnum"];
    $section = $_POST["section"];
    $key_name = $_POST["key"];
    $borrow_date = date('Y-m-d H:i:s');

    // Check if any field is empty
    if (empty($username) || empty($borrower_id) || empty($section) || empty($key_name)) {
        echo "<script>alert('Please fill in all fields!');</script>";
    } else {
        // Check if the user is registered
        $query = "SELECT * FROM users WHERE idnum = ?";
        $stmt = mysqli_stmt_init($conn_login_register);
        if (mysqli_stmt_prepare($stmt, $query)) {
            mysqli_stmt_bind_param($stmt, "s", $borrower_id);
            mysqli_stmt_execute($stmt);
            $result = mysqli_stmt_get_result($stmt);
            if (mysqli_num_rows($result) == 0) {
                echo "<script>alert('You are not registered!');</script>";
            } else {
                // Check if the user has already borrowed a key
                $query = "SELECT * FROM users WHERE borrower_id = ? AND return_date IS NULL";
                $stmt = mysqli_stmt_init($conn_key_records);
                if (mysqli_stmt_prepare($stmt, $query)) {
                    mysqli_stmt_bind_param($stmt, "s", $borrower_id);
                    mysqli_stmt_execute($stmt);
                    $result = mysqli_stmt_get_result($stmt);
                    if (mysqli_num_rows($result) > 0) {
                        echo "<script>alert('You have already borrowed a key!');</script>";
                    } else {
                        // Check if the key is already being borrowed
                        $query = "SELECT * FROM users WHERE key_name = ? AND return_date IS NULL";
                        $stmt = mysqli_stmt_init($conn_key_records);
                        if (mysqli_stmt_prepare($stmt, $query)) {
                            mysqli_stmt_bind_param($stmt, "s", $key_name);
                            mysqli_stmt_execute($stmt);
                            $result = mysqli_stmt_get_result($stmt);
                            if (mysqli_num_rows($result) > 0) {
                                echo "<script>alert('The key is already being borrowed!');</script>";
                            } else {
                                // Insert the new borrowing record
                                $sql = "INSERT INTO users (username, borrower_id, borrower_section, key_name, borrow_date) VALUES (?, ?, ?, ?, ?)";
                                $stmt = mysqli_stmt_init($conn_key_records);
                                if (mysqli_stmt_prepare($stmt, $sql)) {
                                    mysqli_stmt_bind_param($stmt, "sssss", $username, $borrower_id, $section, $key_name, $borrow_date);
                                    if (mysqli_stmt_execute($stmt)) {
                                        echo "<script>alert('Key borrowed successfully!');</script>";
                                    } else {
                                        echo "Error: " . mysqli_stmt_error($stmt);
                                    }
                                } else {
                                    echo "Error: " . mysqli_error($conn_key_records);
                                }
                            }
                        } else {
                            echo "Error: " . mysqli_error($conn_key_records);
                        }
                    }
                } else {
                    echo "Error: " . mysqli_error($conn_key_records);
                }
            }
        } else {
            echo "Error: " . mysqli_error($conn_login_register);
        }
    }
}
?>
    <h1>Borrow Key</h1>
    <form action="borrow.php" method="post">
    <input type="text" placeholder="Name" name="username" required>
        <input type="number" name="idnum" placeholder="ID No." required>
        <select id="section" name="section" required>
            <option value="">Select Section</option>
            <option value="BSCpE 1">BSCpE 1</option>
            <option value="BSCpE 2-Day">BSCpE 2-Day</option>
            <option value="BSCpE 2A-Night">BSCpE 2A-Night</option>
            <option value="BSCpE 2B-Night">BSCpE 2B-Night</option>
            <option value="BSCpE 3-Day">BSCpE 3-Day</option>
            <option value="BSCpE 3-Night">BSCpE 3-Night</option>
            <option value="BSCpE 4-Day">BSCpE 4-Day</option>
            <option value="BSCpE 4-Night">BSCpE 4-Night</option>
            <option value="BSME 1">BSME 1</option>
            <option value="BSME 2-Day">BSME 2-Day</option>
            <option value="BSME 2-Night">BSME 2-Night</option>
            <option value="BSME 3">BSME 3</option>
            <option value="BSME 4">BSME 4</option>
            <option value="BSIE 1">BSIE 1</option>
            <option value="BSIE 2A-Day">BSIE 2A-Day</option>
            <option value="BSIE 2B-Day">BSIE 2B-Day</option>  
            <option value="BSIE 2A-Night">BSIE 2A-Night</option>
            <option value="BSIE 2B-Night">BSIE 2B-Night</option>
            <option value="BSIE 3A-Day">BSIE 3A-Day</option>
            <option value="BSIE 3B-Day">BSIE 3B-Day</option>
            <option value="BSIE 3A-Night">BSIE 3A-Night</option>
            <option value="BSIE 3B-Night">BSIE 3B-Night</option>
            <option value="BSIE 4-Day">BSIE 4-Day</option>
            <option value="BSIE 4-Night">BSIE 4-Night</option>
            <option value="BSCE 1">BSCE 1</option>
            <option value="BSCE 2-Day">BSCE 2-Day</option>
            <option value="BSCE 2A-Night">BSCE 2A-Night</option>
            <option value="BSCE 2B-Night">BSCE 2B-Night</option>
            <option value="BSCE 3-Day">BSCE 3-Day</option>
            <option value="BSCE 3A-Night">BSCE 3A-Night</option>
            <option value="BSCE 3B-Night">BSCE 3B-Night</option>
            <option value="BSCE 4">BSCE 4</option>
            <option value="BSEE 1">BSEE 1</option>
            <option value="BSEE 2-Day">BSEE 2-Day</option>
            <option value="BSEE 2-Night">BSEE 2-Night</option>
            <option value="BSEE 3-Day">BSEE 3-Day</option>
            <option value="BSEE 3-Night">BSEE 3-Night</option>
            <option value="BSEE 4">BSEE 4</option>
        </select>
        <select id="key" name="key" required>
            <option value="">Choose Key</option>
            <option value="EN-CME 101">EN-CME 101</option>
            <option value="EN-CME 102">EN-CME 102</option>
            <option value="Electro Lab">Electro Lab</option>
            <option value="Comlab-1">Comlab-1</option>
            <option value="Comlab-2">Comlab-2</option>
            <option value="CE Lab">CE Lab</option>
            <option value="EE Lab">EE Lab</option>
            <option value="EN-CME 308">EN-CME 308</option>
            <option value="EN-CME 307">EN-CME 307</option>
            <option value="EN-CME 302">EN-CME 302</option>
            <option value="EN-CME 301">EN-CME 301</option>
            <option value="IE Lab">IE Lab</option>
            <option value="ME Lab">ME Lab</option>
            <option value="Innovation Hall">Innovation Hall</option>
        </select>
        <button type="submit" name="borrow">Borrow</button>
    </form>
    <button class="back-button" onclick="window.location.href='homepage.php'">Back to Homepage</button>
</div>

</body>
</html>
