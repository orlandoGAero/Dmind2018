	<link rel=stylesheet href="../../css/formatocotizacion.css" type="text/css">
<!-- jQuery -->
	<!-- <script src="../../js/jquery-1.7.1.min.js"></script> -->
<?php
	require('../../conexion.php');
	require('funciones_ventas.php');

	$funcVentas = new funciones_ventas();
	$idp_ve = $_REQUEST['id_p'];
	// print_r($_REQUEST);
	$idp_vent = explode(',', $idp_ve);
?>
<div style="background-color: white; width: 610px; height: auto;">
	<form action="" id="fdel" method="POST">
		<section style="padding:1px; width: auto;">
			<table cellpadding="0" cellspacing="0" style="margin: 5px;">
			<tr>
				<th>Código Producto</th>
				<th>No. Serie</th>
				<th>Producto</th>
				<th>Eliminar Todos<input type="checkbox" onclick="marcar(this)" onchange="habilitar();" /></th>
			</tr>
			<?php
			foreach($idp_vent as $id_ven) :
				$dat_p = $funcVentas -> obtenerProsingle($id_ven);
				foreach ($dat_p as $arr_del) : ?>
				<tr>
					<td><?=$arr_del['id_vap_tmp']?></td>
					<td><?=$arr_del['no_serie']?></td>
					<td><?=$arr_del['nombre']?>-<?=$arr_del['modelo']?> / <?=$arr_del['nombre_marca']?></td>
					<td><input type="checkbox" name="casilla[]" value="<?=$arr_del['id_vap_tmp']?>"  onchange="habilitar();"/></td>
				</tr>
				<?php endforeach;
			endforeach;?>
			</table>
		</section>
		<div><input type="submit" class="btn-del" id="btndel" disabled="disabled" value="Eliminar"></div>
	</form>
	<div id="div"></div>
</div>
<script type="text/javascript">

	$('#fdel').submit(function(borrar){
		borrar.preventDefault();
		if (confirm('¿Deseas eliminar el registro/los registros?')){
			$('#div').load('borrar_producto.php?' + $('#fdel').serialize());
			// Llamando otra Función.
        	actualizaNumSeries();
		}
	})

	function marcar(source)
	{
		checkboxes=document.getElementsByTagName('input'); //obtenemos todos los controles del tipo Input
		 //recorremos todos los controles
		for (i=0;i<checkboxes.length;i++){ 
			//solo si es un checkbox entramos
			if (checkboxes[i].type == 'checkbox'){
				checkboxes[i].checked=source.checked; //si es un checkbox le damos el valor del checkbox que lo llamó (Seleccionar Todos)
			}
		}
	}

	function habilitar(){
	    document.forms['fdel'].btndel.disabled = true;
	    for (i=0;i<document.forms['fdel'].elements.length;i++){
	        if(document.forms['fdel'].elements[i].type == "checkbox"){
	            if(document.forms['fdel'].elements[i].checked == 1 ){
	                document.forms['fdel'].btndel.disabled = false;
	                i=document.forms['fdel'].elements.length+10;
	            }
	        }
	    }
	}
</script>
