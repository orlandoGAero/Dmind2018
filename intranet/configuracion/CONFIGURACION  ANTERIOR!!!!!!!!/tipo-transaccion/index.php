<?php include ('../head.php'); ?>
<body>
<?php include ('../nav.php'); ?>

	<section id="contenido">
		<section id="principal">
						<h1>Tipo transacción</h1>
						<b class="nuevos">Nuevo</b>
						<table class="datos-bd">
							<tr>
								<th>ID</th>
								<th>NOMBRE TRANSACCIÓN</th>
								<th></th>
							</tr>
<?php
  include ('../../Conexion.php');
  $query = "select * from tipo_transaccion";
  $result=mysql_query($query);
  while($fila=mysql_fetch_array($result))
  {
  	echo "<tr>";
     echo '<td>'.$fila["id_tipo_transaccion"].'</td><td>'.$fila["nombre_tipo_transaccion"].'</td>';
     echo '<td><a href="editar.php?id_tipo='.$fila["id_tipo_transaccion"].'"><img src="../../images/editar.png" /></a>';
     echo '<a href="eliminar.php?id_tipo='.$fila["id_tipo_transaccion"].'"><img src="../../images/delete.png" /></a></td>';
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