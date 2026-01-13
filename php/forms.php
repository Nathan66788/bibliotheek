<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $value1 = $_POST['userMail'];
    $value2 = $_POST['password'];
login($value1, $value2);
}
?>