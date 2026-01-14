<?php

$errormessage = "";
$passwordError = "";
function loginCheck($userMail, $password)
{
    global $conn;
    $stmt = $conn->prepare("SELECT user_id, username, email, password, rol FROM users WHERE email = ? OR username = ?");
    $stmt->execute([$userMail, $userMail]);
    $user = $stmt->fetch(PDO::FETCH_ASSOC);
    if ($user === false) {
        global $errormessage;
        $errormessage = "Account bestaat niet";
    } else {
        if (
            ($userMail == $user["email"] || $userMail == $user["username"])
            && password_verify($password, $user["password"])
        ) {
            loginSucess($user["user_id"], $user["username"]);
        } else {
            global $errormessage;
            $errormessage = "Login is niet gelukt voer opnieuw je mail/wachtwoord";
        }
    }
}

function loginSucess($id, $username)
{
    global $conn;
    $_SESSION["id"] = $id;
    $_SESSION["username"] = $username;
    $_SESSION["loggedIn"] = true;
    header("Location: ../paginas/index.php");
}
function validateUsername($username)
{
    return preg_match('/^[a-zA-Z0-9_]{3,24}$/', $username);
}
function registerCheck($username, $email, $password, $password2)
{
    if ($username && $email && ($password == $password2)) {
        global $conn;
        $stmt = $conn->prepare('SELECT user_id, username, email FROM users WHERE username = ? OR email = ? ');
        $stmt->execute([$username, $email]);
        $user = $stmt->fetch(PDO::FETCH_ASSOC);
        if ($user === false) {
            createAccount($username, $email, $password);
        } else {
            global $errormessage;
            $errormessage = "Naam/Email is al in gebruik";
        }
    } else {
        global $passwordError;
        $passwordError = "Wachtwoorden zijn niet hetzelfde";
        echo $passwordError;
    }
}
function createAccount($username, $email, $password)
{
    $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
    global $conn;
    $stmt = $conn->prepare("INSERT INTO users (username, email, password) VALUES (?,?,?)");
    $stmt->execute([$username, $email, $hashedPassword]);
    loginCheck($email, $password);
}
?>