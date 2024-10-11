<?php
session_start(); // Inicia a sessão


$_SESSION = [];


session_destroy();


header("Location: index.php"); 
exit();
?>
