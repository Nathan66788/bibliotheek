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
    return ("false");
    echo"successfull function call";
}
function registerCheck($username, $email, $password, $password2){

}

?>