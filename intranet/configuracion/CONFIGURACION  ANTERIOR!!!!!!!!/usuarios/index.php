<?php include ('../head.php'); ?>
<body>
<?php include ('../nav.php'); ?>
	<section id="contenido">
		<section id="principal">
		<h1 title="Nuevo Usuario">Nuevo Usuario</h1>
		<b class="nuevos">Nueva</b>
			<table class="datos-bd">
				<tr>
					<th>ID</th>
					<th>USUARIO</th>
					<th>EMAIL</th>
					<th>Tipo</th>
					<th></th>
					<th></th>			
				</tr>
<?php //este se utiliza para llenar el combo de categorias
  include ('../../Conexion.php');
  $query = "select * from usuarios order by id_usuario asc";
  $result=mysql_query($query);
  while($fila=mysql_fetch_array($result))
  {
  	echo "<tr>";
     echo '<td>'.$fila["id_usuario"].'</td><td>'.$fila["usuario"].'</td>';
     echo '<td>'.$fila["email"].'</td><td>'.$fila["tipo"].'</td>';
     echo '<td><a href="editar.php?id_usuario='.$fila["id_usuario"].'">';
     echo '<img src="../../images/editar.png" /></a>';
     echo '<td><a href="eliminar.php?id_usuario='.$fila["id_usuario"].'">';
     echo '<img src="../../images/eliminar.png" /></a></td>';
     echo "</tr>";
  }
?>
			</table>
		</section>
	</section>
<div class="todasacciones">

</div>
<b class="cerrar">Cerrar</b>

</body>
</html>