<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['userMail'])) {
        $value1 = $_POST['userMail'];
        $value2 = $_POST['password'];
        loginCheck($value1, $value2);
    } else {
        $error = 'Invalid info';
    }
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['newUsername'])) {
        if(validateUsername($_POST['newUsername']) == true)
        {
        $value1 = $_POST['newUsername'];
        $value2 = $_POST['newEmail'];
        $value3 = $_POST['newPassword'];
        $value4 = $_POST['confirmNewPassword'];
        registerCheck($value1, $value2, $value3, $value4);
        } else {echo "use a normal username";}
    } else {
        $error = 'Invalid info';
    }
    echo "test";
}


?>