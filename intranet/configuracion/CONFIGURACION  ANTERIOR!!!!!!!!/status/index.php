<?php include ('../head.php'); ?>
<body>
<?php include ('../nav.php'); ?>
	<section id="contenido">
		<section id="principal">
						<h1>Status</h1>
						<b class="nuevos">Nuevo</b>
						<table class="datos-bd">
							<tr>
								<th>ID</th>
								<th>NOMBRE</th>
								<th></th>
							</tr>
<?php //este se utiliza para ver los status
include ('../../Conexion.php');
$query="SELECT * FROM status_inventario";
$result=mysql_query($query);
while($fila=mysql_fetch_array($result))
  {
  	echo "<tr>";
     echo '<td>'.$fila["id_status"].'</td><td>'.$fila["nombre_status"].'</td>';
     echo '<td><a href="editar.php?id_status='.$fila["id_status"].'"><img src="../../images/editar.png" /></a>';
     echo '<a href="eliminar.php?id_status='.$fila["id_status"].'"><img src="../../images/delete.png" /></a></td>';
     echo "</tr>";
  }
?>
						</table>

		</section>
	</section>
<div class="todasacciones"></div>
<b class="cerrar">Cerrar</b>
</body>
</html>