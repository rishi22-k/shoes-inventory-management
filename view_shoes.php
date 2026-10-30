
<?php
include 'db.php';

$search = $_GET['search'] ?? '';
$search = mysqli_real_escape_string($conn, $search);
$sql = "SELECT * FROM shoes WHERE shoe_name LIKE '%$search%'";
$result = mysqli_query($conn, $sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Shoe Inventory</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <h1>Shoe Inventory</h1>
    <form method="GET" action="view_shoes.php">
    <input type="text" name="search" placeholder="Search shoe name..." value="<?php echo htmlspecialchars($_GET['search'] ?? ''); ?>">
    <button type="submit">Search</button>
</form>

    <table border="1" cellpadding="10">
        <tr>
            <th>ID</th>
            <th>Shoe Name</th>
            <th>Size</th>
            <th>Price</th>
            <th>Quantity</th>
        </tr>

        <?php while ($row = mysqli_fetch_assoc($result)) { ?>
        <tr>
            <td><?php echo $row['id']; ?></td>
            <td><?php echo htmlspecialchars($row['shoe_name']); ?></td>
            <td><?php echo $row['size']; ?></td>
            <td>₹<?php echo $row['price']; ?></td>
            <td><?php echo $row['quantity']; ?></td>
        </tr>
        <?php } ?>
    </table>

    <p><a href="index.php">Back to Home</a></p>
</body>
</html>
