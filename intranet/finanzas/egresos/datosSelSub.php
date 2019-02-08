<?php 
	include_once('../../class/classProductosEg.php');
    $productos = new Productos(); 
 ?>
<select name="id_subcategoria" style="line-height: 0px;" id="selsubcategoria">
    <option value="0">Elige</option>		
    <?php
        $subcategorias = $productos->getSubCategorias();
        foreach($subcategorias as $subcategoria) :
    ?>
            <option value='<?=$subcategoria['id_subcategoria']?>'><?=$subcategoria['nombre_subcategoria']?></option>
    <?php endforeach; ?>
</select>