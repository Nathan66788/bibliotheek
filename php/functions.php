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
    ) {
        loginSucess($user["user_id"], $user["username"]);
    } else {
        echo "not matching";
    }
}

function loginSucess($id, $username)
{
    global $conn;
    $_SESSION["id"] = $id;
    $_SESSION["username"] = $username;
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
            echo "geen user dus maak account";
        } else {
            print_r($user);
            echo "er is user geen account maken pls";
        }

        createAccount($username, $email, $password);
    } else {
        echo "password no same you bum";
    }
}
function createAccount($username, $email, $password)
{

}
?>