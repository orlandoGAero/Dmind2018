<?php
    require ('classInventario.php');
    $funInv = new Inventario();
    
    $idegreso = $_REQUEST['id_egreso'];
    $serie = $_REQUEST['serie'];
    $folio = $_REQUEST['folio'];
    $nomprov = $_REQUEST['nom_prov'];
    $idprov = $_REQUEST['id_prov'];

    //$conceptos = $funInv->getConceptosEg($idegreso);
    
    $prodConceptos = $funInv->getProductosEg($idegreso);
    // print_r($prodConceptos);
    
    if($prodConceptos != null) :
?>

<form>              
    <input type="hidden" name="txt_serie" value="<?=$serie?>" readonly>
    <input type="hidden" name="txt_idEgreso" value="<?=$idegreso?>" readonly>
    <input type="hidden" name="txt_folio" value="<?=$folio?>" readonly>
    <input type="hidden" name="txt_idprov" value="<?=$idprov?>" readonly>
    <input type="hidden" name="txt_nomprov" value="<?=$nomprov?>" readonly>

    <div class="tabla">
        <div class="tittle">
            Conceptos por Capturar
        </div>
        <div class="cabeceras">
            <div class="columna">Descripción</div>
            <div class="columna">Modelo</div>
            <div class="columna">Cantidad</div>
            <div class="columna">¿Tiene Número de Serie?</div>
            <div class="columna">Agregar</div>
        </div>
        
        <?php 
            $i = 0;
            foreach ($prodConceptos as $concepto):
                $i += 1; 
                $modelo = $concepto['modelo'];
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
                <div class="columna"><?=$concepto['descripcion']?></div>
                <div class="columna"><?=$concepto['modelo']?></div>
                <div class="columna"><?=$concepto['cantidad_concepto_e']?></div>
                <div class="columna" >
                    Si <input style="margin-left: 0;margin-top: auto; width: auto" 
                            type="radio" name="serie[<?=$i?>]" value="Si"><br>
                    No <input style="margin-left: 0;margin-top: auto; width: auto" 
                            type="radio" name="serie[<?=$i?>]" value="No">
                </div>
                <div class="columna">
                    <input type="hidden" name="txt_idConcepto[<?=$i?>]" value="<?=$concepto['id_egresos_conceptos']?>" readonly>
                    <input type="hidden" name="txt_categoria[<?=$i?>]" value="<?=$categoria?>" readonly>
                    <input type="hidden" name="txt_idcat[<?=$i?>]" value="<?=$idcat?>" readonly>
                    <input type="hidden" name="txt_subcategoria[<?=$i?>]" value="<?=$subcategoria?>" readonly>
                    <input type="hidden" name="txt_idsubcat[<?=$i?>]" value="<?=$idsubcat?>" readonly>
                    <input type="hidden" name="txt_division[<?=$i?>]" value="<?=$division?>" readonly>
                    <input type="hidden" name="txt_iddiv[<?=$i?>]" value="<?=$iddiv?>" readonly>
                    <input type="hidden" name="txt_nombre[<?=$i?>]" value="<?=$nombre?>" readonly>
                    <input type="hidden" name="txt_idnom[<?=$i?>]" value="<?=$idnom?>" readonly>
                    <input type="hidden" name="txt_tipo[<?=$i?>]" value="<?=$tipo?>" readonly>
                    <input type="hidden" name="txt_idtip[<?=$i?>]" value="<?=$idtip?>" readonly>
                    <input type="hidden" name="txt_cantidad[<?=$i?>]" value="<?=$concepto['cantidad_concepto_e']?>" readonly>
                    <input type="hidden" name="txt_marca[<?=$i?>]" value="<?=$marca?>" readonly>
                    <input type="hidden" name="txt_idmar[<?=$i?>]" value="<?=$idmar?>" readonly>
                    <input type="hidden" name="txt_idpro[<?=$i?>]" value="<?=$idpro?>" readonly>
                    <input type="hidden" name="txt_modelo[<?=$i?>]" value="<?=$concepto['modelo']?>" readonly>
                    <input style="margin-left: 0;margin-top: auto; width: auto" 
                            type="checkbox" name="agregar[<?=$i?>]">
                </div>
            </div>
        <?php endforeach; ?>
        
        <label for="cerrar-modal" id="cerrar-contenido" class="cerrar-modal" title="cerrar">X</label>
        <div style="display:table-cell;width:auto"></div>
        <div style="display:table-cell;width:auto"></div>
        <div style="display:table-cell;width:auto"></div>
        <div class="columna">
            <button type ="submit" class="btn-form">
                <img src="../../images/add2.png" alt="Obtener Datos" title="Obtener Datos">
            </button>
        </div>
    </div>
</form>
<script>
    $('.btn-form').bind('click',function(add){
			add.preventDefault();

            if(!$("input[type='checkbox']").is(':checked')) {
                alert('Favor de seleccionar al menos un producto');
            } else if(!$("input[type='radio']").is(':checked')){
                alert('Favor de seleccionar si el producto tiene numero de serie');
            } else {
			formCargar = this.form;
			$('#cargar').load('cargar_val.php',$(formCargar).serialize());
			$('#divTabla').hide();
			$('#fade').hide();
			$("#contenido").hide();
            }
            return false;
		});
</script>
<?php else:?>
   <div id="errorC" class='error'><h3 style="z-index: 1002;">No has agregado los conceptos de esta factura a productos</h3></div>
<?php endif;?>
