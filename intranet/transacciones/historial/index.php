<?php  include ("../../configuracion/head.php");?>
<body>
    <header>
        <img src="../../images/logoDigitalMind.png" alt="Página Principal" title="Página Principal" />
    </header>
        <nav>
        <ul>
            <li><a href="../../Home" alt="Inicio" title="Inicio"><img src="../../images/home.png"/></a></li>
            <a href="../"><li><img src="../../images/volver.png" /><b>Atras</b></li></a><li></li><li></li><li><spam style="color:#fff;"><?php echo $_SESSION["usuario"]; ?></spam></li>
            <li><a href="../../salir.php" alt="Cerrar Sesion" title="Cerrar Sesion"><img src="../../images/lock.png"/></a></li>
        </ul>
    </nav>

	<h1 style="text-align:center;">Historial de productos</h1>

	<section id="contenido">
		<section id="principal">
		<form action="buscar.php">
		<label>Buscar :</label>
		<input name="buscar" type="text" list="lista"  title="Ingresa descripcion para buscar">
		<button class="buscar">.</button>
		</form>
	<div id="resultado"></div>
	<div class="scrollbar" id="barra">
		<table class="datos" id="allregistros">
				<tr>
					<th>CATEGORIA</th>
					<th>SUBCATEGORIA</th>
					<th>NOMBRE</th>
					<th>MODELO</th>
					<th>NO. SERIE</th>
					<th>MARCA</th>
					<th>PRECIO</th>
					<th></th>
					<th></th>
				</tr>
<?php
include("../../conexion.php");
    $query = "SELECT distinct P.id_producto, C.nombre_categoria, S.nombre_subcategoria,
    				nombre,no_serie, M.nombre_marca, P.modelo, P.precio from inventario I
					  inner join productos P on I.id_producto=P.id_producto
    				inner join categorias C on P.id_categoria=C.id_categoria 
    				inner join subcategorias S on P.id_subcategoria=S.id_subcategoria 
    				inner join marca_productos M on P.id_marca=M.id_marca 
            inner join nombres N on P.id_nombre=N.id_nombre
            where id_status>0 ORDER BY P.modelo asc";
$result=mysql_query($query);
while($fila=mysql_fetch_array($result)){
       echo "<tr>";
       echo '<td align="center">'.$fila["nombre_categoria"].'</td>';
       echo '<td align="center">'.$fila["nombre_subcategoria"].'</td>';
       echo '<td align="center">'.$fila["nombre"].'</td>';
       echo '<td align="center">'.$fila["modelo"].'</td>';
       echo '<td align="center">'.$fila["no_serie"].'</td>';
       echo '<td align="center">'.$fila["nombre_marca"].'</td>';
       echo '<td align="center">'.$fila["precio"].'</td>';
       echo '<td><a href="ventas.php?id_pro='.$fila[0].'&no_serie='.$fila["no_serie"].'"><img src="../../images/ventas.png" title="Ventas"></a></td>';
       echo '<td><a href="inventario.php?id_pro='.$fila['id_producto'].'&no_serie='.$fila["no_serie"].'" class="edita"><img src="../../images/inventario.png" title="inventario"></a></td>';
       echo "</tr>";
    }
?>
				
			</table>
 <div class="contbarra"></div>
 </div>
		</section>
	</section>

<div class="todasacciones">
<img src="../images/loadingAnimation.gif" class="cargand">

</div>
<b class="cerrar">Cerrar</b>
</body>
</html>
