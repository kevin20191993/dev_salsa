<?php
//sign-up.php: public , contains a form to register (user name , email , password) and a link to sign-in.php.
include "conexion.php";

$conexion = new conexion();
if (isset($_POST["username"])&&isset($_POST["email"])&&isset($_POST["password"])) {
    $user = $_POST["username"];
    $email = $_POST["email"];
    $pass = $_POST["password"];
    $datos = array();
    $datos['username'] = $user;
    $datos['email'] = $email;
    $datos['password'] = $pass;
    $mensaje = $conexion->insert_inicia($datos, 'users');
    
    if ($mensaje == 'Usuario registrado correctamente') {
        session_start();
        if (!isset($_SESSION['flash_message'])) {
            $_SESSION['flash_message'] = $mensaje;
        }
        header("Location: sign-in.php");
        exit();
    } else {
        echo $conexion->insert_inicia($datos, 'users');
    }
}
?>
<h1><a href="sign-in.php"> Sign in</a></h1>

<h1>Registrate</h1>
<form action="sign-up.php" method="POST">
    <label>Username:</label>
    <input type="text" name="username" required="true">
    <label>Email:</label>
    <input type="email" name="email" required="true">
    <label>Password:</label>
    <input type="password" name="password" required="true">
    <button type="submit" value="Save">Registrarse</button>

</form>
