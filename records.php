<!DOCTYPE html>
<html>
<head>
    <title>Key Records</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" type="image/x-icon" href="/Images/CTU Logo.png">
    <link rel="stylesheet" href="records.css">
</head>
<body>

<div class="records">
    <h1>Key Records</h1>
    <button onclick="window.location.href='homepage.php'">Homepage</button>
    <table>
        <thead>
            <tr>
            <th>Name</th>
                <th>ID No.</th>
                <th>Section</th>
                <th>Key Name</th>
                <th>Borrowed At</th>
                <th>Returned At</th>
            </tr>
        </thead>
        <tbody>
            <?php
            require_once "database.php";

            // Handle return key action
            if (isset($_POST['']) && isset($_POST['borrower_id'])) {
                $borrower_id = $_POST['borrower_id'];
                $return_date = date('Y-m-d H:i:s');

                $update_sql = "UPDATE users SET return_date='$return_date' WHERE borrower_id='$borrower_id' AND return_date IS NULL";
                mysqli_query($conn_key_records, $update_sql);
            }

            // Fetch records
            $sql = "SELECT username, borrower_id, borrower_section, key_name, borrow_date, return_date
                    FROM users
                    ORDER BY borrow_date DESC";

            $result = mysqli_query($conn_key_records, $sql);

            if (mysqli_num_rows($result) > 0) {
                while ($row = mysqli_fetch_assoc($result)) {
                    echo "<tr>
                    <td>{$row['username']}</td>
                            <td>{$row['borrower_id']}</td>
                            <td>{$row['borrower_section']}</td>
                            <td>{$row['key_name']}</td>
                            <td>{$row['borrow_date']}</td>
                            <td>{$row['return_date']}</td>
                            ";
                    if (is_null($row['return_date'])) {
                        echo "<form method='POST' action=''>
                                <input type='hidden' name='borrower_id' value='{$row['borrower_id']}'>
                              </form>";
                    }
                    echo "</td>
                          </tr>";
                }
            } else {
                echo "<tr><td colspan='6'>No records found.</td></tr>";
            }

            mysqli_close($conn_key_records);
            ?>
        </tbody>
    </table>
</div>

</body>
</html>