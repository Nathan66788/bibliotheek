<?php
session_start(); //verwijder alle sessions
session_unset();
session_destroy();
header("Location: ../paginas/index.php"); //terug naar page
exit;
?>