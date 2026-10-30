<?php
$conn=mysqli_connect(
  "localhost"
  "YOUR_USERNAME"
  "YOUR_PASSWORD"
  "YPUR_DATABASE"
  );
if(!$conn){
  die("Database connection failed");
}
?>
