<!DOCTYPE html>
<html>
<head>
  <title>Return Key</title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="icon" type="image/x-icon" href="/Images/CTU Logo.png">
 <link rel="stylesheet" href="borrow.css">
</head>
<body>

<div class="borrow">
<?php
require_once "database.php";
date_default_timezone_set('Australia/West');

// Check if the return form is submitted
if (isset($_POST["return"])) {
    // Retrieve form data
    $borrower_id = $_POST["idnum"];
    $key_name = $_POST["key"];
    $return_date = date('Y-m-d H:i:s');

    // Check if any field is empty
    if (empty($borrower_id) || empty($key_name)) {
        echo "<script>alert('Please fill in all fields!');</script>";
    } else {
        // Update the return date of the borrowed key
        $query = "UPDATE users SET return_date = ? WHERE borrower_id = ? AND key_name = ? AND return_date IS NULL";
        $stmt = mysqli_stmt_init($conn_key_records);
        if (mysqli_stmt_prepare($stmt, $query)) {
            mysqli_stmt_bind_param($stmt, "sss", $return_date, $borrower_id, $key_name);
            if (mysqli_stmt_execute($stmt)) {
                if (mysqli_stmt_affected_rows($stmt) > 0) {
                    echo "<script>alert('Key returned successfully!');</script>";
                } else {
                    echo "<script>alert('No matching borrow record found or key already returned!');</script>";
                }
            } else {
                echo "Error: " . mysqli_stmt_error($stmt);
            }
        } else {
            echo "Error: " . mysqli_error($conn_key_records);
        }
    }
}
?>
  <h1>Return Key</h1>
  <form action="return.php" method="post">
  <input type="text" placeholder="Name" name="username" required>
    <input type="number" name="idnum" placeholder="ID No." required> 
    <select id="section" name="section" required>
      <option value="section">Select Section</option>
      <!-- Add other options here -->
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
      <option value="BSIE 2B-Nght">BSIE 2B-Nght</option>
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
      <option value="key">Choose Key</option>
      <!-- Add other options here -->
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
    <button type="submit" name="return">Return</button>
    </form>
    <button class="back-button" onclick="window.location.href='homepage.php'">Back to Homepage</button>
</div>

</body>
</html>