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
  <title>Digital Mind</title>
  <link rel="shortcut icon" type="image/x-icon" href="../images/favicon.ico" />
  <link rel="stylesheet" href="../../css/estilos.css" />
  <link rel="stylesheet" href="../../css/menu.css" />
  <link rel="stylesheet" href="../../css/tabla.css" />
  <link rel="stylesheet" href="../../css/formularios.css" />
  <script type="text/javascript" src="../../js/jquery-2.1.4.js"></script>
  <script type="text/javascript" src="../../js/configuracion.js"></script>
</head>
    <body>
  <header>
    <img src="../../images/logoDigitalMind.png" alt="Página Principal" title="Página Principal" />
  </header>
    <nav>
    <ul>
      <li><a href="../../Home" alt="Inicio" title="Inicio"><img src="../../images/home.png"/></a></li>
      <a href="./"><li><img src="../../images/volver.png" /><b>Atras</b></li></a><li></li><li></li><li><spam style="color:#fff;"><?php echo $_SESSION["usuario"]; ?></spam></li>
      <li><a href="../../salir.php" alt="Cerrar Sesion" title="Cerrar Sesion"><img src="../../images/lock.png"/></a></li>
    </ul>
  </nav>
  <h1 style="text-align:center;">Busqueda de inventario</h1>
  <section id="contenido">
    <section id="principal">
    <form action="buscar.php">
    <label>Buscar :</label>
    <input name="buscar" type="text" list="lista" value="<?php echo $_GET["buscar"] ?>"  title="Ingresa descripcion para buscar">
    <button class="buscar">.</button>
    </form>
<?php  
include ("../../conexion.php");
  $b=$_GET["buscar"];

  $sql="SELECT I.id_inventario,nom_proveedor,nombre,modelo,O.nombre_tipo,M.nombre_marca,I.no_serie,no_factura,nombre_estado,nombre_status,nombre_ubicacion,
        T.fecha,T.id_operacion,Y.id_tipo_transaccion,Y.nombre_tipo_transaccion,I.id_producto,T.id_transaccion FROM inventario I 
        INNER JOIN proveedores P on I.id_proveedor=P.id_proveedor 
        INNER JOIN productos D on I.id_producto=D.id_producto 
        INNER JOIN nombres N on D.id_nombre=N.id_nombre
        INNER JOIN marca_productos M on D.id_marca=M.id_marca
        INNER JOIN tipos O on D.id_tipo=O.id_tipo
        INNER JOIN estados E ON I.id_estado=E.id_estado 
        INNER JOIN status S on I.id_status=S.id_status 
        INNER JOIN transacciones T on I.id_inventario=T.id_operacion
        INNER JOIN ubicaciones U on I.id_ubicacion=U.id_ubicacion 
        INNER JOIN tipo_transaccion Y on T.id_tipo_transaccion=Y.id_tipo_transaccion 
        WHERE I.id_status=4 and T.id_tipo_transaccion=1 and T.id_operacion=I.id_inventario and N.nombre LIKE '%".$b."%'";    
  $result=mysql_query($sql);
  $conta=mysql_num_rows($result);
  if($conta==0 || $b ==""){
      echo "<br><br><img src='../../images/nohay.jpg' style='border-radius:10px;-moz-border-radius:10px;' />";
  }else{
?>
<table class="datos">
        <tr>
          <th>ID</th>
          <th>PROVEEDOR</th>
          <th>PRODUCTO</th>
          <th>TIPO</th>
          <th>MARCA</th>
          <th>NO_SERIE</th>
          <th>FACTURA / COMPRA</th>
          <th>ESTADO</th>
          <th>STATUS</th>
          <th>UBICACIÓN</th>
          <th></th>
          <th></th>
          <th></th>
          <th></th>
        </tr>
<?php
  while($fila=mysql_fetch_array($result)){
?>
<tr>
  <td><?php echo "I0",$fila[0],""; ?></td>
  <td><?php echo $fila["nom_proveedor"] ?></td>
  <td><?php echo "",$fila["nombre"],"-",$fila["modelo"]; ?></td>
  <td><?php echo $fila["nombre_tipo"] ?></td>
  <td><?php echo $fila["nombre_marca"] ?></td>
  <td align="center"><?php echo $fila["no_serie"] ?></td>
  <td align="center"><?php echo $fila["no_factura"] ?></td>
  <td><?php echo $fila["nombre_estado"] ?></td>
  <td><?php echo $fila["nombre_status"] ?></td>
  <td align="center"><?php echo $fila["nombre_ubicacion"] ?></td>
  <td><a href="detalle.php?id_inv=<?php echo $fila["id_inventario"]; ?>"><img src="../../images/detalle.png"></a></td>
  <td><a href="editar.php?id_inv=<?php echo $fila["id_inventario"]; ?>"><img src="../../images/editar.png"></a></td>
  <td><a href="clonar.php?id_inv=<?php echo $fila["id_inventario"]; ?>"><img width="20" height="20" src="../../images/copy2.png" alt="Clonar"></a></td>
  <td style="background:#fff;"><a href="eliminar.php?id_inv=<?php echo $fila["id_inventario"]; ?>&id_tra=<?php echo $fila["id_transaccion"]; ?>&id_pro=<?php echo $fila["id_producto"] ?>"><img src="../../images/eliminar.png"></a></td>
</tr>
<?php
  }
}
?>
<body>
</html>
