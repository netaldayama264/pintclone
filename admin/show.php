<?php include 'dbconn.php'; ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Show Data</title>
    <link rel="stylesheet" href="styles2.css">
</head>
<body>
    <h1>Data Table</h1>
    <table border="1">
        <tr>
            <th>ID</th>
            <th>Name</th>
            <th>Email</th>
            <th>Birt_Date</th>
            <th>Password</th>
            <th>Action</th>
        </tr>
        <?php
        $sql = "SELECT * FROM signin1";
        $result = $conn->query($sql);

        while ($row = $result->fetch_assoc()) {
            echo "<tr>
                <td>{$row['ID']}</td>
                <td>{$row['Name']}</td>
                <td>{$row['Email']}</td>
                <td>{$row['Birth_Date']}</td>
                <td>{$row['Password']}</td>
                <td>
                    <a href='fetch.php?id={$row['ID']}'>View</a>
                    <a href='update.php?id={$row['ID']}'>Update</a>
                    <a href='delete.php?id={$row['ID']}'>Delete</a>
                </td>
            </tr>";
        }
        ?>
    </table>
</body>
</html>
