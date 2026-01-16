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
            $errormessage = "Ongeldige naam je naam mag maar 3-24 letters zijn en geen speciale karakters hebben";
        }
    }
}


?>