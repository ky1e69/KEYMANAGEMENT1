<!DOCTYPE html>
<html>
<head>
    <title>Registered Students</title>
    <link rel="stylesheet" href="registers.css">
</head>
<body>
    <div class="registers">
    <h1>Registered Users</h1>
    <button onclick="window.location.href='admindashboard.php'">DASHBOARD</button> 
    <table>
    <thead>
        <tr>
            <th>name</th>
            <th>Id number</th>
            <th>Section</th>
            <th>Email</th>
            
            
        </tr>
    </thead>
    <tbody>

        <?php

          $conn = mysqli_connect("localhost", "root", "", "login_register");
            if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }

        $sql = "SELECT name, idnum, section, email, password FROM users";
        $result = $conn->query($sql);
        if (mysqli_num_rows($result) > 0) {
            while ($row = mysqli_fetch_assoc($result)) {
                echo "<tr>
                </td>
                        <td>{$row['name']}</td>
                        <td>{$row['idnum']}</td>
                        <td>{$row['section']}</td>
                        <td>{$row['email']}</td>
                       
    
                        ";
                echo "</td>
                      </tr>";
            }
        } else {
            echo "<tr><td colspan='6'>No records found.</td></tr>";
        }

        $conn->close();
        ?>
    </tbody>
    </table>
<div>

</body>
</html>