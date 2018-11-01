<?php include ('../../Conexion.php'); ?>
<center>
<h2 class="pro" style="margin-top:-100px;box-shadow:0px -1px 1px;width:600px;background:#16555B; color:white;border-top-right-radius:10px;border-top-left-radius:10px;">NUEVO PRODUCTO</h2>
	<form action='guardarproducto.php' class="pro" style="display:none;">
<article style="width:560px;background:#fff; text-align:justify;padding:20px; text-align:center;"><br>
	<label>Categoria</label>
	<select name="id_categoria">
	<option value="0">Elige</option>		
<?php 
$query = "select * from categorias";
$result=mysql_query($query);
while($fila=mysql_fetch_array($result)){
	echo "<option value='",$fila[0],"'>",$fila[1],"</opion>";
}
 ?>
	</select>

	<label>Subcategoria</label>
	<select name="id_subcategoria" id="">
	<option value="0">Elige</option>		
<?php
  $query = "select id_subcategoria, nombre_subcategoria from subcategorias";
$result=mysql_query($query);
	while($fila=mysql_fetch_array($result)){
	echo "<option value='",$fila[0],"'>",$fila[1],"</opion>";
  }
?>
	</select><br><br>

	<label>División:</label>
	<select name="id_division" id="">
	<option value="0">Elige</option>		
<?php
  $query = "select id_division, nombre_division from division";
$result=mysql_query($query);
while($fila=mysql_fetch_array($result)){
	echo "<option value='",$fila[0],"'>",$fila[1],"</opion>";
  }
?>		
	</select>
<label>Nombre :</label>
<select name="id_nombre" id="">
<option value="0">Elige</option>		
<?php
  $query = "select id_nombre, nombre from nombres";
	$result=mysql_query($query);
	while($fila=mysql_fetch_array($result)){
	echo "<option value='",$fila[0],"'>",$fila[1],"</opion>";
  }
?>	
</select>
<br><br>
	<label>Tipo:</label>

	<select name="id_tipo" id="">
	<option value="0">Elige</option>		
<?php
  $query = "select id_tipo, nombre_tipo from tipos";
$result=mysql_query($query);
while($fila=mysql_fetch_array($result)){
	echo "<option value='",$fila[0],"'>",$fila[1],"</opion>";
  }
?>		
	</select>

	<label>Marca :</label>
	<select name="id_marca" id="">
	<option value="0">Elige</option>		
<?php
  $query = "select DISTINCT id_marca, nombre_marca from marcas";
$result=mysql_query($query);
	while($fila=mysql_fetch_array($result)){
	echo "<option value='",$fila[0],"'>",$fila[1],"</opion>";
  }
?>	
	</select><br><br>
	<label>Modelo :</label>
	<input type="text" name="modelo"><br><br>
	<label> Precio :</label>
	<input type="text" name="precio"><br><br>
	<label>Unidad de medida:</label><br>

<select name="id_unidad" id="">
<option value="0">Elige</option>		
<?php
  $query = "select DISTINCT id_unidad, nombre_unidad from unidades";
  $result=mysql_query($query);
	while($fila=mysql_fetch_array($result)){
	echo "<option value='",$fila[0],"'>",$fila[1],"</opion>";
  }
?>
</select><br><br>
	<label>Descripcion del producto</label><br>
	<input type="text" name="descripcion"><br><br>
</article>
<article style="width:590px;background:#16555B;border-bottom-right-radius:10px;border-bottom-left-radius:10px;padding:5px;">
	<button class="btn">Guardar producto</button>
</article>

	</form>
</center>