<?php
	require ('classInventario.php');
	$funInv = new Inventario();

	$egresos = $funInv->getEgInvIncomp();
	
?>

<div id="divFacturas">
    <h1>Egresos (Facturas incompletas)</h1>
    <div class="botones">
        <button type="button" id="facSinCap" class="btnSinCap">Facturas Por Capturar</button>
        <button type="button" id="facIn" class="btnInc">Facturas Incompletas</button>
        <button type="button" id="facCap" class="btnCap">Facturas Capturadas</button>
    </div>

    <?php if($funInv->getEgInvIncomp()): ?>
        <div id="status_inv">
            <table cellspacing="0" cellpadding="2" class="display" id="egre">
                <thead>	
                    <tr>
                        <th>Fecha</th>
                        <th>RFC Emisor</th>
                        <th>Razón Social Emisor</th>
                        <th>Serie</th>
                        <th>No.Folio</th>
                        <th>Ver</th>
                    </tr>
                </thead>
                <tbody>
                    <?php 
                        foreach ($egresos as $row):
                        $id_eg = $row['idegresos'];
                        $rfcE = $row['rfc_emisor'];
                        $nomProv = $funInv->getNombreProv($rfcE);
                    ?>
                        <tr>
                            <td><?=$row['fecha']?></td>
                            <td><?=$row['rfc_emisor']?></td>
                            <td><?=$row['razon_social_emisor']?></td>
                            <td><?=$row['serie']?></td>
                            <td><?=$row['no_folio']?></td>
                            <td>
                                <form>
                                    <input type="hidden" name="txt_ideg" id="eg" value="<?=$id_eg?>">
                                    <input type="hidden" name="txt_serie" value="<?=$row['serie']?>">
                                    <input type="hidden" name="txt_folio" value="<?=$row['no_folio']?>">
                                    <input type="hidden" name="txt_nomprov" value="<?=$nomProv['nom_proveedor']?>">
                                    <input type="hidden" name="txt_idprov" value="<?=$nomProv['id_proveedor']?>">
                                    <button class="cargar-conceptos centrar">
                                        <img src="../../images/open-eye.png"/>
                                    </button>
                                </form>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
                <tfoot style="display:table-header-group;">
                        <tr>
                            <th class="search">Fecha</th>
                            <th class="search2">RFC</th>
                            <th class="search2">Razón Social</th>
                            <th></th>
                            <th></th>
                            <th></th>
                        </tr>
                </tfoot>
            </table>
            <div id="contenido" class="modal-c"></div>
        </div>
    <?php else:?>
        <div class="vacio">
            <center>(No existen Facturas Incompletas)</center>
        </div>
    <?php endif; ?>
</div>


<script type="text/javascript">
	$(document).ready(function(){
		
		// DataTable
		jQuery('#egre').dataTable({ 
	        // Damos formato a la paginación(números).
	        "sPaginationType": "full_numbers",
	        // Desactiva el filtrado de datos.
	        // bFilter: false,
	        // Ordenar de forma ascendente la columna de la posición 1.
	        aaSorting: [[0,"asc"]],
	        // Muestra el número de filas en una sola página.
	        iDisplayLength: 5,
	        /* Configura el menú que se utiliza para seleccionar 
	        	el número de filas en una sola página. */
	        aLengthMenu: [[5, 10, 20], [5, 10, 20]],
	        // Desactivar la ordenación de una columna.
	        aoColumnDefs:[{
	        	bSortable: false,
	        	// Posición de la columna.
	        	aTargets: [5],
	        }],
			// Cambiar de posición los elementos(paginado,buscar,etc.)
			"sDom" : '<"top"lp>rt<"bottom"i><"clear">'
	    })

	    .columnFilter({
	    	aoColumns: [
	    		{type:"date_range"},
	    		{type:"text"},
                {type:"text"},
	    		null,
	    		null,
	    		null
	    	]
	    });
        
        $(".cargar-conceptos").click(function(e){
			e.preventDefault();
			$.ajax({
				url: 'ver_conceptos.php',
				data: {
					id_egreso: e.currentTarget.form[0].value,
					serie: e.currentTarget.form[1].value,
					folio: e.currentTarget.form[2].value,
					nom_prov: e.currentTarget.form[3].value,
					id_prov: e.currentTarget.form[4].value
				},
				success: function(res) {
					let listaConceptos = $("#contenido");
					listaConceptos.append(res);

                    let divError = document.getElementsByClassName('error').length;
                    
                    if (divError !== 0) {
                        let errorConcepto = $("#errorContenido");
                        errorConcepto.append(`<div id='noConcepto'>${res}</div>`);
                        errorConcepto.show();

                        setTimeout(function(){
                           $("#noConcepto").remove();
                            $.get('tb_fac_incompletas.php', function(dochtml) {
                                $('#divTabla').html(dochtml);
                            });
                        },3000);

                    } else {
					   listaConceptos.show();
                    }

					$("#cerrar-contenido").click(function(){
						listaConceptos.hide();
                        $.get('tb_fac_incompletas.php', function(dochtml) {
                            $('#divTabla').html(dochtml)
                        });
					});
				}
			})
		});

        $("#facIn").click(function(){
            
            $.ajax({
                url : "tb_fac_incompletas.php",
                method : "post"
            })
            .done(function(html){
                $("#divFacturas").html(html)
            });
        });
        
        $("#facSinCap").click(function(){
            
            $.ajax({
                url : "tabla_eg.php",
                method : "post"
            })
            .done(function(html){
                $("#divFacturas").html(html)
            });
        });
        
        $("#facCap").click(function(){
            
            $.ajax({
                url : "tb_fac_capturadas.php",
                method : "post"
            })
            .done(function(html){
                $("#divFacturas").html(html)
            });
        });
    });
</script>