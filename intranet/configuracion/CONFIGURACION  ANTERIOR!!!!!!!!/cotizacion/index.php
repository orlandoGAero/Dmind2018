<?php include ('../head.php'); ?>
<body>
<?php include ('../nav.php'); ?>
<center>
	<section>
		<h1>Registros Cotizaciones</h1>
<div class="scrollbar" id="barra">
<table border="1" cellspacing="0" cellpadding="2" class="datos">
<th>Folio </th>
<th>Fecha de captura</th>
<th>Cliente de la cotización</th>
<th></th>

<?php 
include ('../../Conexion.php');
$query="SELECT nombre_cliente, C.fecha, C.id_cotizacion,estado FROM cotizacion C 
		inner join clientes on clientes.id_cliente=C.id_cliente ORDER BY C.id_cotizacion ASC";
$result=mysql_query($query);
while($fila=mysql_fetch_array($result))
{
?>
<tr>
    <td align="center">
    COT<?php echo $fila[2] ?>
    </td>
    <td align="center">
    <?php echo $fila[1] ?>
    </td>
    <td><?php echo $fila[0] ?></td>
    <td>
    <a href="../../transacciones/Cotizacion/vistacot.php?id_cotizacion=<?php echo $fila[2]; ?>">
    <img src="../../images/detalle.png"/></a>
<?php 
if($fila[3]==1){
?>
   <a style="text-decoration:none;" href="desactivar.php?id_cot=<?php echo $fila[2]; ?>">
   <img src="../../images/inactivo.png"  width="20" height="20">
   quitar</a>
<?php
}else{
?>
    <a style="text-decoration:none;" href="activar.php?id_cot=<?php echo $fila[2]; ?>">
    <img src="../../images/activo.png"  width="20" height="20">
    activar</a>
<?php
}

?>

    </td>
</tr>
<?php
}
 ?>
</table>
 <div class="contbarra"></div>
 </div>