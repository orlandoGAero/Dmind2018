<?php include ('../head.php'); ?>
<body>
<?php include ('../nav.php'); ?>

	<section id="contenido">
		<section id="principal">
						<h1>Subcategoría</h1>
						<b class="nuevos">Nueva</b>
						<table class="datos-bd">
							<tr>
								<th>ID</th>
								<th>NOMBRE</th>
								<th></th>
							</tr>
<?php //este se utiliza para llenar el combo de categorias
include ('../../Conexion.php');
$query="SELECT * FROM subcategorias";
$result=mysql_query($query);
while($fila=mysql_fetch_array($result))
  {
  	echo "<tr>";
     echo '<td>'.$fila["id_subcategoria"].'</td><td>'.$fila["nombre_subcategoria"].'</td>';
     echo '<td><a href="editar.php?id_subcategoria='.$fila["id_subcategoria"].'"><img src="../../images/editar.png" /></a>';
     echo '<a href="eliminar.php?id_subcategoria='.$fila["id_subcategoria"].'"><img src="../../images/delete.png" /></a></td>';
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