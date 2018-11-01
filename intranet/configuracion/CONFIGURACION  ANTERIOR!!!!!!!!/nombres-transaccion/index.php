<?php include ('../head.php'); ?>
<body>
<?php include ('../nav.php'); ?>
	<section id="contenido">
		<section id="principal">
						<h1>Nombres</h1>
            <b class="nuevos">Nuevo</b>
						<table class="datos-bd">
							<tr>
								<th>ID</th>
								<th>NOMBRE</th>
								<th></th>
							</tr>
<?php //este se utiliza para llenar el combo de categorias
include ('../../Conexion.php');
$query="SELECT * FROM nombres";
$result=mysql_query($query);
while($row=mysql_fetch_array($result))
  {
  ?>
  	<tr>
     <td>
     <?php echo $row[0]; ?>
     </td>
     <td>
     <?php echo $row[1]; ?>
     </td>
     <td>
     <a href="editar.php?id_nombre=<?php echo $row[0]; ?>">
     <img src="../../images/editar.png" /></a>
     <a href="eliminar.php?id_nombre=<?php echo $row[0]; ?>"><img src="../../images/delete.png" /></a></td>
     </tr>
<?php
  }
?>
			        	</table>

		</section>
	</section>
<div class="todasacciones"></div>
<b class="cerrar">Cerrar</b>
</body>
</html>