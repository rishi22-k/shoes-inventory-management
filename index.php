
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Shoes Inventory Management</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>

    <h1>Shoes Inventory Management System</h1>
    <p>Manage your shoe stock easily!</p>

    <div class="menu">
        <a href="#add-shoes">Add Shoes</a>
        <a href="view_shoes.php">View Inventory</a>
        <a href="contact.php">Contact Us</a>
    </div>

    
<section id="add-shoes">
    <h2>Add Shoes</h2>

    <form action="add_shoe.php" method="POST">
        <label>Shoe Name:</label>
        <input type="text" name="shoe_name" placeholder="Enter shoe name" required>

        <label>Size:</label>
        <input type="number" name="size" placeholder="Enter shoe size" required>

        <label>Price (₹):</label>
        <input type="number" name="price" placeholder="Enter price" required>

        <label>Quantity:</label>
        <input type="number" name="quantity" placeholder="Enter quantity" required>

        <button type="submit">Add Shoe</button>
    </form>
</section>


    <section id="inventory">
        <h2>View Inventory</h2>
        <p>Your shoe stock will appear here.</p>
    </section>

    <section id="contact">
        <h2>Contact Us</h2>
        <p>Contact us for any questions.</p>
    </section>

</body>
</html>
s