<?php
include 'db.php';

$search = trim($_GET['search'] ?? '');
$error = '';

if (strlen($search) > 100) {
    $search = substr($search, 0, 100);
}

$stmt = mysqli_prepare(
    $conn,
    "SELECT id, shoe_name, size, price, quantity
     FROM shoes
     WHERE shoe_name LIKE ?"
);

if ($stmt) {
    $searchTerm = "%" . $search . "%";
    mysqli_stmt_bind_param($stmt, "s", $searchTerm);

    if (mysqli_stmt_execute($stmt)) {
        $result = mysqli_stmt_get_result($stmt);
    } else {
        $result = false;
        $error = "Unable to load inventory.";
    }
} else {
    $result = false;
    $error = "Unable to load inventory.";
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Shoe Inventory</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>

    <h1>Shoe Inventory</h1>

    <form method="GET" action="view_shoes.php">
        <input
            type="text"
            name="search"
            maxlength="100"
            placeholder="Search shoe name..."
            value="<?php echo htmlspecialchars($search, ENT_QUOTES, 'UTF-8'); ?>"
        >
        <button type="submit">Search</button>
    </form>

    <?php if ($error !== '') { ?>
        <p><?php echo htmlspecialchars($error, ENT_QUOTES, 'UTF-8'); ?></p>
    <?php } ?>

    <table border="1" cellpadding="10">
        <tr>
            <th>ID</th>
            <th>Shoe Name</th>
            <th>Size</th>
            <th>Price</th>
            <th>Quantity</th>
        </tr>

        <?php if ($result && mysqli_num_rows($result) > 0) { ?>
            <?php while ($row = mysqli_fetch_assoc($result)) { ?>
                <tr>
                    <td><?php echo (int)$row['id']; ?></td>
                    <td><?php echo htmlspecialchars($row['shoe_name'], ENT_QUOTES, 'UTF-8'); ?></td>
                    <td><?php echo (int)$row['size']; ?></td>
                    <td>₹<?php echo number_format((float)$row['price'], 2); ?></td>
                    <td><?php echo (int)$row['quantity']; ?></td>
                </tr>
            <?php } ?>
        <?php } ?>
    </table>

    <?php
    if (isset($stmt) && $stmt) {
        mysqli_stmt_close($stmt);
    }
    ?>

    <p><a href="index.php">Back to Home</a></p>

</body>
</html>
