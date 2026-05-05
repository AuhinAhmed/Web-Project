<?php

require_once 'db.php';

$conn = connect_db();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
  $name = $_POST['name'];
  $email = $_POST['email'];

  // Sanitize input (VERY IMPORTANT!)
  $name = mysqli_real_escape_string($conn, $name); // Deprecated, but shown for basic example
  $email = mysqli_real_escape_string($conn, $email); // Deprecated, use prepared statements

  // Use prepared statements (STRONGLY RECOMMENDED for security)
  $stmt = $conn->prepare("INSERT INTO your_table (name, email) VALUES (?, ?)");
  $stmt->bind_param("ss", $name, $email); // "ss" indicates two strings

  if ($stmt->execute()) {
    echo "New record created successfully";
  } else {
    echo "Error: " . $stmt->error;
  }

  $stmt->close();

}

$conn->close();

?>