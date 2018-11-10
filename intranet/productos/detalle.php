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
    require "classProductos.php";
    $productos = new Productos();

    require_once("../libs/encrypt_decrypt_strings_urls.php");

    if(isset($_GET["productdetail"]))
      $id_pro = decrypt($_GET["productdetail"],"productosDM");
  ?>
  <?php if(isset($id_pro) && $id_pro != "") :?>
    <form action='editar.php' id='formeditar' style="color:#000;display:block;margin-top:0;">
    	<h4>Datos del Producto</h4>
      <center>
        <table style="text-align:justify;">
          <?php 
            $detalleProducto = $productos->getProductoDet($id_pro);
          ?>
            <tr>
              <td><b>Categoría:</b></td>
              <td><?=$detalleProducto['nombre_categoria']?></td>
            </tr>
            <tr>
              <td><b>Subcategoría:</b></td>
              <td><?=$detalleProducto['nombre_subcategoria']?></td>
            </tr>
            <tr>
              <td><b>División:</b></td>
              <td><?=$detalleProducto['nombre_division']?></td>
            </tr>
            <tr>
              <td><b>Nombre:</b></td>
              <td><?=$detalleProducto['nombre']?></td>
            </tr>
            <tr>
              <td><b>Tipo:</b></td>
              <td><?=$detalleProducto['nombre_tipo']?></td>
            </tr>
            <tr>
              <td><b>Marca :</b></td>
              <td><?=$detalleProducto['nombre_marca']?></td>
            </tr>
            <tr>
              <td><b>Modelo :</b></td>
              <td><?= $detalleProducto['modelo'] ?></td>
            </tr>
            <tr>
              <td> <b>Precio :</b></td>
              <td>
                <?php if($detalleProducto['id_moneda'] == 1) :?>
                  <!-- Dolares Americanos -->
                  <b>US$</b><?=number_format($detalleProducto['precio'],2,'.',',')?>
                <?php elseif($detalleProducto['id_moneda'] == 2) :?>
                  <!-- Pesos Mexicanos -->
                  <b>$</b><?=number_format($detalleProducto['precio'],2,'.',',')?>
                <?php endif; ?>
              </td>
            </tr>
            <tr>
              <td><b>Unidad de Medida:</b></td>
              <td><?=$detalleProducto['nombre_unidad'] ?></td>
            </tr>
          <tr>
            <td><b>Cantidad en inventario:</b></td>
            <td>
              <?=$detalleProducto['exit_inventario']; ?>
            </td>
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