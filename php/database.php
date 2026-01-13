<?php
$servername = 'localhost';      // Database host
$dbname = 'bibliotheek_db'; // Database name
$username = 'root'; // Database username

try {
  $conn = new PDO("mysql:host=$servername;dbname=bibliotheek_db", $username);
  $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
echo"connected";
} catch(PDOException $e) { 
echo "Connection failed: " . $e->getMessage();
}
$stmt = $conn->prepare("SELECT * FROM users");
$stmt->execute();
$users = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>
