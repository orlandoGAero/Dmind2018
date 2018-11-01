<?php include ('../head.php'); ?>
<body>
<?php include ('../nav.php'); ?>

	<section id="contenido">
		<section id="principal">
						<h1>Proveedor</h1>
						<b class="nuevos">Nuevo</b><br>
<table class="datos" style="position:absolute;left:10px;">
							<tr>
							<th>ID</th>
							<th>NOMBRE</th>
							<th>FECHA<b style="color:transparent">-</b>ALTA</th>
							<th>TELEFONO</th>
							<th>RAZON SOCIAL</th>
							<th>RFC</th>
							<th>TIPO</th>
							<th align="center">EMAIL</th>
							<th>PAIS</th>
							<th>ESTADO</th>
							<th>MUNICIPIO</th>
							<th>LOCALIDAD</th>
							<th>C.P</th>
							<th>COLONIA</th>
							<th>CALLE</th>
							<th>NO_EXT</th>
							<th>NO_INT</th>
							<th></th>
							<th></th>
							</tr>
<?php //este se utiliza para llenar el combo de categorias
  include ('../../Conexion.php');
  $query = "SELECT P.id_proveedor,P.nom_proveedor,P.fecha_alta,P.telefono,F.razon_social,F.rfc,F.tipo_razon_social,
  			F.email,pais,estado,municipio,localidad,cod_postal,colonia,calle,num_ext,num_int,P.id_bancarios,P.id_direccion,F.id_direccion,P.id_datfiscal from proveedores P 
  			inner join datos_fiscales F on P.id_datfiscal=F.id_datfiscal
  			inner join direcciones on P.id_direccion=direcciones.id_direccion";
$result=mysql_query($query);
while($fila=mysql_fetch_array($result))
  {
  	echo "<tr>";
	echo '<td>'.$fila[0].'</td>';
	echo '<td>'.$fila[1].'</td>';
	echo '<td>'.$fila[2].'</td>';
	echo '<td>'.$fila[3].'</td>';
	echo '<td>'.$fila[4].'</td>';
	echo '<td>'.$fila[5].'</td>';
	echo '<td>'.$fila[6].'</td>';
	echo '<td>'.$fila[7].'</td>';
	echo '<td>'.$fila[8].'</td>';
	echo '<td>'.$fila[9].'</td>';
	echo '<td>'.$fila[10].'</td>';
	echo '<td>'.$fila[11].'</td>';
	echo '<td>'.$fila[12].'</td>';
	echo '<td>'.$fila[13].'</td>';
	echo '<td>'.$fila[14].'</td>';
	echo '<td>'.$fila[15].'</td>';
	echo '<td>'.$fila[16].'</td>';
    echo '<td><a href="editar.php?id_prov='.$fila["id_proveedor"].'"><img src="../../images/editar.png" /></a>';
?>
<td><a href="eliminar.php?id_prov=<?php echo $fila["id_proveedor"]; ?>&id_dirp=<?php echo $fila[10]; ?>&id_dirf=<?php echo $fila[11]; ?>&id_datfis=<?php echo $fila["id_datfiscal"] ?>&dat_banc=<?php echo $fila["id_bancarios"] ?>"><img src="../../images/eliminar.png" alt=""></a></td>

<?php
    echo "</tr>";
  }
?>
						</table>

		</section>
	</section>
<div class="todasacciones" style="overflow-y: scroll;"></div>
<b class="cerrar">Cerrar</b>
</body>
</html>