<?php include ('../head.php'); ?>
<body>
<?php include ('../nav.php'); ?>
	<section id="contenido">
		<section id="principal">
						<h1>Direcciones</h1>
						<b class="nuevos">Nueva</b>
						<table class="datos-bd">
							<tr>
								<th>ID</th>
								<th>Calle</th>
								<th>Num_Ext</th>
								<th>Num_Int</th>
								<th>Colonia</th>
								<th>Localidad</th>
								<th>Referencia</th>
								<th>Municipio</th>
								<th>Estado</th>
								<th>Pais</th>
								<th>C.P.</th>
								<th>Sucursal</th>
								<th>GPS Ubicacion</th>
								<th></th>
								<th></th>
							</tr>
<?php //este se utiliza para llenar el combo de categorias
  include ('../../Conexion.php');
  $query="select * from direcciones";
  $result=mysql_query($query);
  while($fila=mysql_fetch_array($result)){
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
     echo '<td>'.$fila["gps_ubicacion"].'</td>';
     echo '<td><a href="editar.php?id_direccion='.$fila[0].'"><img src="../../images/editar.png" /></a></td>';
     echo '<td><a href="eliminar.php?id_direccion='.$fila[0].'"><img src="../../images/delete.png" /></a></td>';
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