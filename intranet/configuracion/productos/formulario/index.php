<?php
    require ('classFormularioProd.php');
    $fnFormProd = new FormularioProd();
?>
<?php include ('../../head.php'); ?>
<body>
	<?php include ('../../nav.php'); ?>
    <div id="menuopcion"><?php include('../../menu_individual.php') ?></div>
    <h1 style="text-align:center; color:rgba(0,191,255,.9);">
    	<a href="../../">
			<img class="atras" src="../../../images/atras.png" title="Regresar">
		</a>Formulario Productos
    </h1>
    <section id="info">
        <span>Configurar los registros obligatorios del módulo de productos. Solo se podrán modificar aquellos registros que no afecten el funcionamiento del sistema.</span>
    </section>
    <center>
    	<section id="transparente">
    		<center>
                <?php $configFormP = $fnFormProd -> obtenerConfiguracionFormP() ?>
    			<form method="POST" id="confProd">
                    <ul>
                        <li>
                            <label>Categoría</label>
                            <?php if($configFormP['categoria'] == 1) :?>
                                <input type="checkbox" name="cbxCat" checked disabled />
                            <?php else :?>
                                <input type="checkbox" name="cbxCat" disabled />
                            <?php endif; ?>
                        </li>
                        <li>
                            <label>Subcategoría</label>
                            <?php if($configFormP['subcategoria'] == 1) :?>
                                <input type="checkbox" name="cbxSubcat" checked disabled />
                            <?php else :?>
                                <input type="checkbox" name="cbxSubcat" disabled />
                            <?php endif; ?>
                        </li>
                        <li>
                            <label>División</label>
                            <?php if($configFormP['division'] == 1) :?>
                                <input type="checkbox" name="cbxDiv" checked disabled />
                            <?php else :?>
                                <input type="checkbox" name="cbxDiv" disabled />
                            <?php endif; ?>
                        </li>
                        <li>
                            <label>Nombre</label>
                            <?php if($configFormP['nombre'] == 1) :?>
                                <input type="checkbox" name="cbxNom" checked disabled />
                            <?php else :?>
                                <input type="checkbox" name="cbxNom" disabled />
                            <?php endif; ?>
                        </li>
                        <li>
                            <label>Tipo</label>
                            <?php if($configFormP['tipo'] == 1) :?>
                                <input type="checkbox" name="cbxTip" checked disabled />
                            <?php else :?>
                                <input type="checkbox" name="cbxTip" disabled />
                            <?php endif; ?>
                        </li>
                        <li>
                            <label>Marca</label>
                            <?php if($configFormP['marca'] == 1) :?>
                                <input type="checkbox" name="cbxMar" checked disabled />
                            <?php else :?>
                                <input type="checkbox" name="cbxMar" disabled />
                            <?php endif; ?>
                        </li>
                        <li>
                            <label>Modelo</label>
                            <?php if($configFormP['modelo'] == 1) :?>
                                <input type="checkbox" name="cbxMod" checked />
                            <?php else :?>
                                <input type="checkbox" name="cbxMod" />
                            <?php endif; ?>
                        </li>
                        <li>
                            <label>Precio</label>
                            <?php if($configFormP['precio'] == 1) :?>
                                <input type="checkbox" name="cbxPre" checked/>
                            <?php else :?>
                                <input type="checkbox" name="cbxPre" />
                            <?php endif; ?>
                        </li>
                        <li>
                            <label>Moneda</label>
                            <?php if($configFormP['moneda'] == 1) :?>
                                <input type="checkbox" name="cbxMon" checked disabled />
                            <?php else :?>
                                <input type="checkbox" name="cbxMon" disabled />
                            <?php endif; ?>
                        </li>
                        <li>
                            <label>Unidad de Medida</label>
                            <?php if($configFormP['unidad_medida'] == 1) :?>
                                <input type="checkbox" name="cbxUniMed" checked disabled />
                            <?php else :?>
                                <input type="checkbox" name="cbxUniMed" disabled />
                            <?php endif; ?>
                        </li>
                        <li>
                            <label>Descripción</label>
                            <?php if($configFormP['descripcion'] == 1) :?>
                                <input type="checkbox" name="cbxDescrip" checked />
                            <?php else :?>
                                <input type="checkbox" name="cbxDescrip" />
                            <?php endif; ?>
                        </li>
                        <li><input type="submit" name="btnGuardar" value="Guardar" class="btn primary btnConfigFP"></li>
                    </ul>
                </form>
                <div id="result"></div>
    		</center>
    	</section>
    </center>
</body>
</html>
<script type="text/javascript">
    $(document).ready(function() {
        $('#confProd').submit(function(prod) {
            prod.preventDefault();
            $.ajax({
                url: 'guardar_config_form_prod.php',
                type: 'POST',
                data: $(this).serialize(),
                success: function(data){
                    $('#result').html(data);
                }
            })
            return false;
        });
    });
</script>