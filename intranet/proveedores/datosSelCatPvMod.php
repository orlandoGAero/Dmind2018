<?php 
	include_once 'classProveedores.php';
	$fnProv = new Proveedores();

	if (isset($_REQUEST['idPv'])) {
		$idProve = $_REQUEST['idPv'];
		$datosProv = $fnProv -> datosProveedorEditar($idProve);
	}
 ?>
<select name="sltCatP" >
	<?php if ($datosProv['nombre_cat_prov'] != "") : ?>
		<option value="<?=$datosProv['id_cat_prov']?>"><?=$datosProv['nombre_cat_prov']?></option>
		<?php foreach ($fnProv -> categoriasProveedorDiff($datosProv['id_cat_prov']) as $categoriaP) : ?>
			<option value="<?=$categoriaP['id_cat_prov']?>"><?=$categoriaP['nombre_cat_prov']?></option>
		<?php endforeach; ?>
	<?php else : ?>
		<option value="">Elige</option>
		<?php foreach ($fnProv -> categoriasProveedor() as $categoriaP) : ?>
			<option value="<?=$categoriaP['id_cat_prov']?>"><?=$categoriaP['nombre_cat_prov']?></option>
		<?php endforeach; ?>
	<?php endif; ?>
</select>