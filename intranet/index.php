<?php
session_start();

$valido=true;
      if(isset($_POST['entrar'])){
         //datos de acceso xampp digital mind
         // $host="localhost";
         // $usuario="desarrollo";
         // $contra="entraradmin";
         // $db="digitalm";

        // datos acceso local xampp borrar
        $host="localhost";
         $usuario="root";
         $contra="";
         $db="dmind";
        
        
         //establecer la conexion
        echo "<div class='oculto'>";
        $testconec= mysql_connect($host,$usuario,$contra) or die ("No se puede conectar");
        mysql_select_db($db) or die ("No se encuentra la base de datos especificada");
        echo " </div>";
        
        echo $testconec;
        
         $usuario=$_POST['usuario'];
         $contrasena=$_POST['contrasena'];
         $consulta="SELECT id_usuario, usuario,contrasena FROM usuarios where usuario='$usuario' AND contrasena='$contrasena'";
         $result=mysql_query($consulta) or die (mysql_error());
         $filasn= mysql_num_rows($result);
         if ($filasn<=0 || isset($_GET['nologin']) ){
               $valido=false;
         }else{
        $rowsresult=mysql_fetch_array($result);          
        $_SESSION['idusuario']= $rowsresult['id_usuario'];
             $valido=true;
             //guardamos en sesion el nombre del usuario 
             $_SESSION["usuario"]=$usuario;
             header("location:home/");
         }               
      }
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="utf-8" />
    <title>Iniciar Sesion</title>
    <link rel="shortcut icon" type="Imagenes/x-icon" href="images/favicon.ico" />
    <link rel="stylesheet" href="css/Login.css" />
    <script src="js/jquery-2.1.4.js" type="text/javascript"></script>
    <script type="text/javascript">
    $(document).ready(function(){
      $("#grande").css("display","block");
      $(".us").click(function(event){
           event.preventDefault();
            $(".errors").hide(1500);
      });
      $(".pass").click(function(event){
           event.preventDefault();
            $(".errors").hide(1500);
      });
      });
    </script>
</head>

<body>
<div id="grande">
<aside  id="contenido">
<form action="./" method="post">
    <img src="images/logoDigitalMind.png" />
    <div class="campos">
    <label>Usuario :</label><br>
        <input name="usuario" type="text" class="us" value="<?php if(isset($_POST['entrar'])){ echo $_POST["usuario"]; } ?>"/><br><br>
            <label>Contraseña :</label><br>
        <input name="contrasena" class="pass" type="password" value="<?php if(isset($_POST['entrar'])){ echo $_POST["contrasena"]; } ?>" /><br><br>
    </div><br>
        <input name="entrar" type="submit" class="secion" value="Iniciar secion" >
    <?php 
     if ($valido==false) {
            echo '<div class="errors">Usuario y/o Contraseña Esta Mal</div>';
     }?><br>
</form>
<br>
</aside>
</div>
</body>
</html>

