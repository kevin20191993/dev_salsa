<?php
/*user.php: available only when signed in, else redirect to signin.php. Shows the user name and
email, and a link to change-password.php, and a link to sign-out.php.*/

include "conexion.php";
session_start();
if(!isset($_SESSION["email"])) 
{ 
   header("Location: sign-in.php");
    exit;
}

if(isset($_POST["pass_new"])){
    $conexion = new conexion();
    $respuesta=$conexion->actualiza_pass($_SESSION["id"], $_POST["pass_new"],'users');
     if($respuesta){
         echo "Contraseña cambiada exitosamente";
         $_SESSION["password"]=$_POST["pass_new"];
         unset($_SESSION['flash_actualiza']);
     }else{
         echo "Error al cambiar la contraseña";
     }
    
}
        ?>

<script>
   function valida_logout(){
    
       if (confirm("Seguro que desea cerrar sesión?")){
           //formulario.form.submit();
           window.location.href = "sign-out.php";
       }
            
   }
</script>

    <button type="submit" value="Cerrar Sesión"  onclick="valida_logout()">Salir</button>
<?php
        echo "<h1> SESION INICIADA DE: ".$_SESSION['username']."</h1>";
        echo "<h2> Email: ".$_SESSION['email']."</h1>";?>
    <form action="change-password.php" method="POST">
        <button type="submit" value="Cambiar">Cambiar contraseña</button>    
    </form>
     
        
