<?php 
	include_once 'classProveedores.php';
	$fnProv = new Proveedores();
 ?>
<select name="sltCatP">
	<option value="">Elige</option>
	<?php foreach ($fnProv -> categoriasProveedor() as $categoriaP) : ?>
		<option value="<?=$categoriaP['id_cat_prov']?>"><?=$categoriaP['nombre_cat_prov']?></option>
	<?php endforeach; ?>
</select>