<?php
include 'db.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $shoe_name = trim($_POST['shoe_name'] ?? '');
    $size = filter_input(INPUT_POST, 'size', FILTER_VALIDATE_INT);
    $price = filter_input(INPUT_POST, 'price', FILTER_VALIDATE_FLOAT);
    $quantity = filter_input(INPUT_POST, 'quantity', FILTER_VALIDATE_INT);

    if (
        $shoe_name === '' ||
        $size === false || $size === null || $size <= 0 ||
        $price === false || $price === null || $price < 0 ||
        $quantity === false || $quantity === null || $quantity < 0
    ) {
        die("Please enter valid shoe details.");
    }

    $stmt = mysqli_prepare(
        $conn,
        "INSERT INTO shoes (shoe_name, size, price, quantity)
         VALUES (?, ?, ?, ?)"
    );

    mysqli_stmt_bind_param(
        $stmt,
        "sidi",
        $shoe_name,
        $size,
        $price,
        $quantity
    );

    if (mysqli_stmt_execute($stmt)) {
        echo "Shoe added successfully!";
    } else {
        echo "Unable to add shoe.";
    }

    mysqli_stmt_close($stmt);
}
?>
