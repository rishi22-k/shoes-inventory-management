<?php
include 'db.php';

$message = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $name = trim($_POST['name'] ?? '');
    $email = trim($_POST['email'] ?? '');
    $msg = trim($_POST['message'] ?? '');

    if (
        $name === '' ||
        strlen($name) > 100 ||
        !filter_var($email, FILTER_VALIDATE_EMAIL) ||
        strlen($email) > 254 ||
        $msg === '' ||
        strlen($msg) > 2000
    ) {
        $message = "Please enter valid details.";
    } else {

        $stmt = mysqli_prepare(
            $conn,
            "INSERT INTO contacts (name, email, message)
             VALUES (?, ?, ?)"
        );

        if ($stmt) {
            mysqli_stmt_bind_param(
                $stmt,
                "sss",
                $name,
                $email,
                $msg
            );

            if (mysqli_stmt_execute($stmt)) {
                $message = "Message sent successfully!";
            } else {
                $message = "Unable to send message. Please try again.";
            }

            mysqli_stmt_close($stmt);
        } else {
            $message = "Unable to process your request.";
        }
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

    <p><?php echo htmlspecialchars($message, ENT_QUOTES, 'UTF-8'); ?></p>

    <form method="POST" action="contact.php">
        <label>Name:</label><br>
        <input type="text" name="name" maxlength="100" required><br><br>

        <label>Email:</label><br>
        <input type="email" name="email" maxlength="254" required><br><br>

        <label>Message:</label><br>
        <textarea name="message" maxlength="2000" required></textarea><br><br>

        <button type="submit">Send Message</button>
    </form>

    <p><a href="index.php">Back to Home</a></p>
</body>
</html>
