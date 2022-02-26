<?php
//available only when signed in, else redirect to signin.php.


session_start();
if(!isset($_SESSION["email"])) 
{ 
   header("Location: sign-in.php");
    exit;
}else{
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
            $_SESSION['passsword'] = $datos_inicio["passsword"];
            $_SESSION['flash_actualiza']='ACTUALIZA';
            header("Location: user.php");
            exit();
        }else {
            echo "Usuario o contraseña incorrectos";
        }
    }
    
    
    ?>
    <script>
    function valida_contras(){
        var form=document.getElementById('form');
        var old_p=document.getElementById('old').value;
        var new_p=document.getElementById('new').value;
        if(old_p===new_p){
            alert('la nueva contraseña debe ser diferente');
        }else{
            form.submit();
        }
        
    }
    </script>
    <h1>CAMBIAR CONTRASEÑA</h1>
     <form action="user.php" id="form" method="POST">
         <label>Ingrese la contraseña antigua</label>
         <input id="old" type="password" name="pass_old">             
         
         <label>Ingrese la nueva contraseña</label>
         <input id="new" type="password" name="pass_new">
         
         <button type="button" onclick="valida_contras()" value="enviar">Enviar</button>
    </form>
<?php }

?>