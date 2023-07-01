<?php
// Database connection
$host = "localhost";
$username = "root";
$password = "";
$database = "form_submit";

$conn = mysqli_connect($host, $username, $password, $database);
if (!$conn) {
  die("Connection failed: " . mysqli_connect_error());
}

$email = $_GET["email"];

// Fetch health report file path based on email ID
$sql = "SELECT health_report_path FROM users WHERE email = '$email'";
$result = mysqli_query($conn, $sql);

if (mysqli_num_rows($result) > 0) {
  $row = mysqli_fetch_assoc($result);
  $filePath = $row["health_report_path"];

  // Download the health report file
  header("Content-Type: application/pdf");
  header("Content-Disposition: attachment; filename='" . basename($filePath) . "'");
  readfile($filePath);
} else {
  echo "Health report not found.";
}

mysqli_close($conn);
?>
