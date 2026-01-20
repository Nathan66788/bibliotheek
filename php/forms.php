<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['userMail'])) { //check of het de form is van login
        $value1 = $_POST['userMail'];
        $value2 = $_POST['password'];
        loginCheck($value1, $value2);
    } 
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['newUsername'])) { //check of het de form is van registration
        if (validateUsername($_POST['newUsername']) == true) { //check of naam mag
            $value1 = $_POST['newUsername'];
            $value2 = $_POST['newEmail'];
            $value3 = $_POST['newPassword'];
            $value4 = $_POST['confirmNewPassword'];
            registerCheck($value1, $value2, $value3, $value4);
        } else {
            global $errormessage;
            global $passwordError;
            $errormessage = "Ongeldige naam je naam mag maar 3-24 letters zijn en geen speciale tekens hebben";
        }
    }
}


if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['titel'])) {
        $value1 = $_POST["titel"];
        $value2 = $_POST["auteur"];
        $value3 = $_POST["genre"];
        $value4 = $_POST["new_genre"];
        $value5 = $_POST["imglink"];
        $value6 = $_POST["beschrijving"];
        $value7  = $_POST['leeftijdsgroep'];
        $value8  = $_POST['aantal_paginas'];
        $value9  = $_POST['verdieping'];
        $value10 = $_POST['kast'];
        newBook($value1, $value2, $value3, $value4, $value5,$value6,$value7,$value8,$value9,$value10);
        header("Location: ../paginas/admin.php?success=1");
        exit;
    }
}
?>