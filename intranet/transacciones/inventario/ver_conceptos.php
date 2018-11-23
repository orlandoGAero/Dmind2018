<?php
    require ('classInventario.php');
    $funInv = new Inventario();
    
    $idegreso = $_REQUEST['id_egreso'];
    $serie = $_REQUEST['serie'];
    $folio = $_REQUEST['folio'];

    $conceptos = $funInv->getConceptosEg($idegreso);

?>
<div class="tabla">
    <div class="tittle">
        Conceptos
    </div>
    <div class="cabeceras">
        <div class="columna">Descripción</div>
        <div class="columna">Modelo</div>
        <div class="columna">Cantidad</div>
        <div class="columna">Agregar</div>
    </div>
    <?php 
        foreach ($conceptos as $concepto): 
        $modelo = $concepto['modelo_concepto_e'];
        $datos = $funInv->getDatosProd($modelo);
        foreach ($datos as $dato) {

            $idpro = $dato['id_producto'];
            $categoria = $dato['nombre_categoria'];
            $idcat = $dato['id_categoria'];
            $subcategoria = $dato['nombre_subcategoria'];
            $idsubcat = $dato['id_subcategoria'];
            $division = $dato['nombre_division'];
            $iddiv = $dato['id_division'];
            $nombre = $dato['nombre'];
            $idnom = $dato['id_nombre'];
            $tipo = $dato['nombre_tipo'];
            $idtip = $dato['id_tipo'];
            $marca = $dato['nombre_marca'];
            $idmar = $dato['id_marca'];
        }
    ?>
        <div class="fila">
            <div class="columna"><?=$concepto['descripcion_concepto_e']?></div>
            <div class="columna"><?=$concepto['modelo_concepto_e']?></div>
            <div class="columna"><?=$concepto['cantidad_concepto_e']?></div>
            <div class="columna">
                <form>
                    <button type ="submit" class="btn-form">
                        <input type="hidden" name="txt_serie" value="<?=$serie?>">
                        <input type="hidden" name="txt_folio" value="<?=$folio?>">
                        <input type="hidden" name="txt_categoria" value="<?=$categoria?>">
                        <input type="hidden" name="txt_idcat" value="<?=$idcat?>">
                        <input type="hidden" name="txt_subcategoria" value="<?=$subcategoria?>">
                        <input type="hidden" name="txt_idsubcat" value="<?=$idsubcat?>">
                        <input type="hidden" name="txt_division" value="<?=$division?>">
                        <input type="hidden" name="txt_iddiv" value="<?=$iddiv?>">
                        <input type="hidden" name="txt_nombre" value="<?=$nombre?>">
                        <input type="hidden" name="txt_idnom" value="<?=$idnom?>">
                        <input type="hidden" name="txt_tipo" value="<?=$tipo?>">
                        <input type="hidden" name="txt_idtip" value="<?=$idtip?>">
                        <input type="hidden" name="txt_marca" value="<?=$marca?>">
                        <input type="hidden" name="txt_idmar" value="<?=$idmar?>">
                        <input type="hidden" name="txt_idpro" value="<?=$idpro?>">
						<input type="hidden" name="txt_modelo" value="<?=$concepto['modelo_concepto_e']?>">
						<input type="hidden" name="txt_cantidad" value="<?=$concepto['cantidad_concepto_e']?>">
                        <img src="../../images/add2.png" alt="Obtener Datos" title="Obtener Datos">
                    </button>
                </form>
            </div>
        </div>
    <?php endforeach; ?>
    <label for="cerrar-modal" id="cerrar-contenido" class="cerrar-modal">X</label>
</div>
<script>
    $('.btn-form').bind('click',function(add){
			add.preventDefault();
			formCargar = this.form;
			$('#cargar').load('cargar_val.php',$(formCargar).serialize());
			$('#divTabla').hide();
			$('#fade').hide();
			$("#contenido").hide();
			return false;
		});
</script>
