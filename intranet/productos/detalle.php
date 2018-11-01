<?php
  session_start();
  //manejamos en sesion el nombre del usuario que se ha logeado
  if (!isset($_SESSION["usuario"])){
      header("location:../");  
  }
  $_SESSION["usuario"];
  //termina inicio de sesion
?>
<!DOCTYPE html>
<html lang="es">
<head>
	<meta charset="utf-8" />
  <meta charset="utf-8" />
  <title>Digital Mind</title>
  <link rel="shortcut icon" type="image/x-icon" href="../images/favicon.ico" />
	<link rel="stylesheet" href="../css/estilos.css" />
	<link rel="stylesheet" href="../css/menu.css" />
	<link rel="stylesheet" href="../css/tabla.css" />
  <link rel="stylesheet" href="../css/formularios.css" />
	<script type="text/javascript" src="../js/jquery-2.1.4.js"></script>
<style>
	td{
		padding: 3px;
	}
</style>
</head>

<body>
  <?php
    include ("../menu.php");
    include ('../Conexion.php');
    require_once("../libs/encrypt_decrypt_strings_urls.php");

    if(isset($_GET["productdetail"]))
      $id_pro = decrypt($_GET["productdetail"],"productosDM");
  ?>
  <?php if(isset($id_pro) && $id_pro != "") :?>
    <form action='editar.php' id='formeditar' style="color:#000;display:block;margin-top:0;">
    	<h4>Datos del Producto</h4>
      <center>
        <table style="text-align:justify;">
          <?php //este se utiliza para llenar los campos editables
            $query = "SELECT 
                        P.id_producto,
                        C.nombre_categoria,
                        S.nombre_subcategoria,
                        D.nombre_division,
                        N.nombre 
                      FROM
                        productos P 
                        INNER JOIN categorias C 
                          ON P.id_categoria = C.id_categoria 
                        INNER JOIN subcategorias S 
                          ON P.id_subcategoria = S.id_subcategoria 
                        INNER JOIN division D
                          ON P.id_division = D.id_division
                        INNER JOIN nombres N 
                          ON P.id_nombre = N.id_nombre 
                      WHERE P.id_producto = ".$id_pro;
            $result=mysql_query($query);
          ?>
          <?php while($fila=mysql_fetch_array($result)) :?>
            <tr>
              <td><b>Categoría:</b></td>
              <td><?=$fila[1]?></td>
            </tr>
            <tr>
              <td><b>Subcategoría:</b></td>
              <td><?=$fila[2]?></td>
            </tr>
            <tr>
              <td><b>División:</b></td>
              <td><?=$fila[3]?></td>
            </tr>
            <tr>
              <td><b>Nombre :</b></td>
              <td><?=$fila[4]?></td>
            </tr>
          <?php endwhile; ?>
          <?php 
            $sql="SELECT nombre_tipo FROM productos P
          	       INNER JOIN tipos N on P.id_tipo=N.id_tipo where id_producto=$id_pro";
            $result=mysql_query($sql);
          ?>
          <?php while($fila=mysql_fetch_array($result)) :?>
            <tr>
              <td><b>Tipo:</b></td>
              <td><?=$fila[0]?></td>
            </tr>
          <?php endwhile; ?>
          <?php 
            $sql="SELECT distinct nombre_marca FROM productos P
          	       INNER JOIN marca_productos M on P.id_marca=M.id_marca where id_producto=$id_pro";
            $result=mysql_query($sql);
          ?>
          <?php while($fila=mysql_fetch_array($result)) :?>
            <tr>
              <td><b>Marca :</b></td>
              <td><?=$fila[0]?></td>
            </tr>
          <?php endwhile; ?>
          <?php 
            $sql="SELECT modelo,precio,exit_inventario,id_moneda FROM productos where id_producto=$id_pro";
            $result=mysql_query($sql);
          ?>
          <?php while($fila=mysql_fetch_array($result)) :?>
            <tr>
              <td><b>Modelo :</b></td>
              <td><?php echo $fila[0] ?></td>
            </tr>
            <tr>
              <td> <b>Precio :</b></td>
              <td>
                <?php if($fila[3] == 1) :?>
                  <!-- Dolares Americanos -->
                  <b>US$</b><?=number_format($fila[1],2,'.',',')?>
                <?php elseif($fila[3] == 2) :?>
                  <!-- Pesos Mexicanos -->
                  <b>$</b><?=number_format($fila[1],2,'.',',')?>
                <?php endif; ?>
              </td>
            </tr>
            <!-- Existencia -->
            <?php $exist=$fila[2]; ?>
          <?php endwhile; ?>
          <?php 
            $sql="SELECT nombre_unidad FROM productos P 
          	       INNER JOIN unidades U on P.id_unidad=U.id_unidad where id_producto=$id_pro";
            $result=mysql_query($sql);
          ?>
          <?php while($fila=mysql_fetch_array($result)) :?>
            <tr>
              <td><b>Unidad de Medida:</b></td>
              <td><?php echo $fila[0] ?></td>
            </tr>
          <?php endwhile; ?>
          <tr>
            <td><b>Cantidad en inventario:</b></td>
            <td><?php echo $exist ?></td>
          </tr>
        </table>
        <a href="./" class="btn primary">Salir</a>
      </center>
    </form>
  <?php endif; ?>
  <br>
  <br>
  <br>
</body>
</html>