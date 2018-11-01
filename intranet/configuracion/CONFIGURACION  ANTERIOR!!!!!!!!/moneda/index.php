<?php include ('../head.php'); ?>
<body>
<?php include ('../nav.php'); ?>
	<section id="contenido">
		<section id="principal">
						<h1>Monedas</h1>
						<b class="nuevos">Nuevo</b>
						<table class="datos-bd">
							<tr>
								<th>ID</th>
								<th>NOMBRE</th>
								<th>VALOR</th>
								<th></th>
							</tr>
<?php //este se utiliza para llenar el combo de categorias
include ('../../Conexion.php');
$query="SELECT * FROM moneda order by id_moneda asc";
$result=mysql_query($query);
while($fila=mysql_fetch_array($result))
  {
  	echo "<tr>";
     echo '<td>'.$fila["id_moneda"].'</td><td>'.$fila["nombre_moneda"].'</td><td>'.$fila["valor"].'</td>';
     echo '<td><a href="editar.php?id_moneda='.$fila["id_moneda"].'">';
     echo '<img src="../../images/editar.png" /></a>';
     echo '<a href="eliminar.php?id_moneda='.$fila["id_moneda"].'">';
     echo '<img src="../../images/delete.png" /></a></td>';
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