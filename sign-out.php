<?php
//Cierra sesión y redirecciona a index.php

session_start();
unset($_SESSION['id']);
unset($_SESSION['username']);
unset($_SESSION['email']);
session_destroy();

header("Location: index.php");
        exit();
?>