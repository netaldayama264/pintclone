<?php
include 'dbconn.php';
// Get the user ID from URL
$ID = intval($_GET['ID']);

// Fetch user data
$sql = "SELECT * FROM signin1 WHERE ID = $ID";
$result = $conn->query($sql);
$user = $result->fetch_assoc();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Details</title>
    <link rel="stylesheet" href="styles2.css">
</head>
<body>
    <div class="container">
        <h1 style="color:blue">Data </h1>
        <p><strong>ID:</strong> <?php echo $user['ID']; ?></p>
        <p><strong>Name:</strong> <?php echo $user['Name']; ?></p>
        <p><strong>Email:</strong> <?php echo $user['Email']; ?></p>
        <p><strong>Birth_Date:</strong> <?php echo $user['Birth_Date']; ?></p>
        <p><strong>Paswword:</strong> <?php echo $user['Password']; ?></p>
        
        <a href="fetch.php">Back to Records</a>
    </div>
</body>
</html>

<?php
$conn->close();
?>
