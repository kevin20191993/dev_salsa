<?php 
//sign-in.php: public , on success redirects to user.php.
include "conexion.php";

session_start();
if(isset($_SESSION['flash_message'])) {
    echo $_SESSION['flash_message'];
    unset($_SESSION['flash_message']);
}

if (isset($_POST["username"])&&isset($_POST["password"])) {
    $conexion = new conexion();
    $datos = array();
    $datos['username'] = $_POST["username"];
    //$datos['email'] = $email;
    $datos['password'] = $_POST["password"];
    if($datos_inicio=$conexion->inicia_sesion($datos, 'users')){
        $_SESSION['id'] = $datos_inicio["id"];
        $_SESSION['username'] = $datos_inicio["username"];
        $_SESSION['email'] = $datos_inicio["email"];
        header("Location: user.php");
        exit();
    }else {
        echo "Usuario o contraseña incorrectos";
    }
}

?>
<h1>INICIA SESIÓN</h1>
<form action="sign-in.php" method="POST">
    <label>Username:</label>
    <input type="text" name="username" required="true">
    <label>Password:</label>
    <input type="password" name="password" required="true">
    <button type="submit" value="Save">Ingresar</button>

</form>
