
<?php
include 'db.php';

$message = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = mysqli_real_escape_string($conn, $_POST['name']);
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $msg = mysqli_real_escape_string($conn, $_POST['message']);

    $sql = "INSERT INTO contacts (name, email, message)
            VALUES ('$name', '$email', '$msg')";

    if (mysqli_query($conn, $sql)) {
        $message = "Message sent successfully!";
    } else {
        $message = "Error saving message. Please try again.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Contact Us</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <h1>Contact Us</h1>

    <p><?php echo htmlspecialchars($message); ?></p>

    <form method="POST" action="contact.php">
        <label>Name:</label><br>
        <input type="text" name="name" required><br><br>

        <label>Email:</label><br>
        <input type="email" name="email" required><br><br>

        <label>Message:</label><br>
        <textarea name="message" required></textarea><br><br>

        <button type="submit">Send Message</button>
    </form>

    <p><a href="index.php">Back to Home</a></p>
</body>
</html>
