<?php
function loginCheck($userMail, $password)
{
global $conn;
$stmt = $conn->prepare("SELECT user_id, username, email, password, rol FROM users WHERE email = ? OR username = ?");
$stmt->execute([$userMail, $userMail]);
$user = $stmt->fetch(PDO::FETCH_ASSOC);
if (
    ($userMail == $user["email"] || $userMail == $user["username"])
    && $password == $user["password"]
){
   echo "matching password and usermail";
} else {
    echo "not matching";
}
}

function login(){}



?>