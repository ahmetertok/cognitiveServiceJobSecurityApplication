<?php
header("Access-Control-Allow-Origin: *");
// Update the database connection details
$host = 'coopmysqltest.mysql.database.azure.com';
$db   = 'coop4494';
$user = 'cop4494user';
$pass = '3c74?R5m';

try {
  // Connect to the database
  $dbh = new PDO("mysql:host=$host;dbname=$db;charset=utf8", $user, $pass);
  $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

  // Set the timezone to Turkish time
  date_default_timezone_set('Europe/Istanbul');

  // Retrieve POST data
  $registry_code = $_POST['registry_code'];
  $helmet_taking = isset($_POST['helmet_taking']) ? 1 : 0; // 1 if helmet is taken, 0 otherwise
  $timestamp = date('Y-m-d H:i:s'); // Timestamp in Turkish timezone

  // Prepare SQL query
  $sql = "INSERT INTO user_records (registry_code, helmet_taking, timestamp) VALUES (:registry_code, :helmet_taking, :timestamp)";

  // Prepare and bind the data to the query
  $stmt = $dbh->prepare($sql);
  $stmt->bindParam(':registry_code', $registry_code, PDO::PARAM_STR);
  $stmt->bindParam(':helmet_taking', $helmet_taking, PDO::PARAM_INT);
  $stmt->bindParam(':timestamp', $timestamp, PDO::PARAM_STR);

  // Execute the query
  $stmt->execute();

  echo "Data successfully saved.";
} catch (PDOException $e) {
  echo "Error: " . $e->getMessage();
}
?>