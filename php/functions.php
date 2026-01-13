<?php
function login($userMail, $password)
{
global $conn;
$stmt = $conn->prepare("SELECT user_id, username, email, password, rol FROM users WHERE email = ? OR username = ?");
$stmt->execute([$userMail, $userMail]);
$user = $stmt->fetch(PDO::FETCH_ASSOC);
print_r($user);
}



?>