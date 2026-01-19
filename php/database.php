<?php
$servername = 'localhost';      // Database host
$dbname = 'bibliotheek_db'; // Database name
$username = 'root'; // Database username

try {
  $conn = new PDO("mysql:host=$servername;dbname=bibliotheek_db", $username); //connect database
  $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
  echo "Connection failed: " . $e->getMessage();
}
$stmt = $conn->prepare("SELECT * FROM users");
$stmt->execute();
$users = $stmt->fetchAll(PDO::FETCH_ASSOC);
$stmt = $conn->prepare("SELECT * FROM boeken");
$stmt->execute();
$boeken = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>