<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $value1 = $_POST['userMail'];
    $value2 = $_POST['password'];
loginCheck($value1, $value2);
}
?>