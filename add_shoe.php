
<?php
include 'db.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $shoe_name = $_POST['shoe_name'];
    $size = $_POST['size'];
    $price = $_POST['price'];
    $quantity = $_POST['quantity'];

    $sql = "INSERT INTO shoes (shoe_name, size, price, quantity)
            VALUES ('$shoe_name', '$size', '$price', '$quantity')";

    if (mysqli_query($conn, $sql)) {
        echo "Shoe added successfully!";
    } else {
        echo "Error: " . mysqli_error($conn);
    }
}
?>
