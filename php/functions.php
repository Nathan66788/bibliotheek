<?php

$errormessage = "";
$passwordError = "";
function loginCheck($userMail, $password) //Check of login kan of niet
{
    global $conn; //check of account in database staat
    $stmt = $conn->prepare("SELECT user_id, username, email, password, rol FROM users WHERE email = ? OR username = ?");
    $stmt->execute([$userMail, $userMail]);
    $user = $stmt->fetch(PDO::FETCH_ASSOC);
    if ($user === false) { //geen user geen log in
        global $errormessage;
        $errormessage = "Account bestaat niet";
    } else { // wel user wel login
        if ( //als username/username bij de wachtwoord hoort dan log in
            ($userMail == $user["email"] || $userMail == $user["username"])
            && password_verify($password, $user["password"])
        ) {
            loginSucess($user["user_id"], $user["username"]); //logincheck is klaar
        } else {
            global $errormessage;
            $errormessage = "Login is niet gelukt voer opnieuw je mail/wachtwoord";
        }
    }
}

function loginSucess($id, $username)//log in account
{
    global $conn;
    $_SESSION["id"] = $id;
    $_SESSION["username"] = $username;
    $_SESSION["loggedIn"] = true;
    header("Location: ../paginas/index.php");
}
function validateUsername($username)
{
    return preg_match('/^[a-zA-Z0-9_]{3,24}$/', $username); //check of naam goed is of niet (3-24 letters a-z 0-9 geen symbolen)
}

function validatePassword($password){
    return preg_match('/^.{8,}$/', $password);
}
function registerCheck($username, $email, $password, $password2)
{

    if (validatePassword($password)){
        if ($username && $email && ($password == $password2)) { //check of username mail en wachtwoord er is en check ook of wachtwoord gelijk is
            global $conn;
            $stmt = $conn->prepare('SELECT user_id, username, email FROM users WHERE username = ? OR email = ? '); //check of user bestaat
            $stmt->execute([$username, $email]);
            $user = $stmt->fetch(PDO::FETCH_ASSOC);
            if ($user === false) { //als geen user gepakt is dan maak account
                createAccount($username, $email, $password);
            } else {
                global $errormessage;
                $errormessage = "Naam/Email is al in gebruik";
            }
        } else {
            global $passwordError;
            $passwordError = "Wachtwoorden zijn niet hetzelfde";
        }
    } else {
        global $passwordError;
        $passwordError = "Wachtwoord is te kort";
    }
}

function createAccount($username, $email, $password) //maak de account
{
    $hashedPassword = password_hash($password, PASSWORD_DEFAULT); //hash wachtwoord
    global $conn;
    $stmt = $conn->prepare("INSERT INTO users (username, email, password) VALUES (?,?,?)"); //nieuwe user wordt in database gezet
    $stmt->execute([$username, $email, $hashedPassword]);
    loginCheck($email, $password);
}


function newBook($titel, $auteur, $genre, $new_genre, $imglink, $beschrijving,$leeftijdsgroep,$aantalpaginas,$verdieping,$kast) {
    global $conn;
    $stmt = $conn->prepare("INSERT INTO boeken (titel, auteur, genre, imglink, beschrijving,leeftijdsgroep,aantalpaginas,verdieping,kast) VALUES (?, ?, ?, ? ,? ,? ,? ,? ,?)");
    if ($genre != "nieuw"){
    $stmt->execute([$titel, $auteur, $genre, $imglink, $beschrijving, $leeftijdsgroep, $aantalpaginas, $verdieping, $kast]);
    } else {
    $stmt->execute([$titel, $auteur, $new_genre, $imglink, $beschrijving,$leeftijdsgroep,$aantalpaginas,$verdieping,$kast]);
    }
}
?>