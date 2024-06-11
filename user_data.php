<?php
session_start();

$host = 'localhost';
$db = 'fwtube';
$user = 'root';
$pass = '';
$charset = 'utf8mb4';

if (!isset($_SESSION["email"])) {
  // redirect to the login page
  header("Location: login.php");
  exit;
}

$email = $_SESSION["email"];

// connect to the database
$conn = new mysqli($host, $user, $pass, $db);

// Check connection
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}

// query the database for the user's data
$sql = "SELECT * FROM fwtube WHERE email = '$email'";
$result = $conn->query($sql);

if ($result) {
  if ($result->num_rows > 0) {
    // output data of each row
    $row = $result->fetch_assoc();
    echo json_encode($row);
  } else {
    echo "0 results";
  }
} else {
  // Query error
  echo "Error executing query: " . $conn->error;
}

$conn->close();
?>
