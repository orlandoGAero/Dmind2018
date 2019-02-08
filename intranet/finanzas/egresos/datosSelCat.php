<?php 
	include_once('../../class/classProductosEg.php');
    $productos = new Productos(); 
 ?>
<select name="categoria" style="line-height: 0px;" id="selcategoria">
    <option value="0">Elige</option>		
    <?php 
    $categorias = $productos->getCategorias();
        foreach($categorias as $categoria) :
    ?>
            <option value='<?=$categoria['id_categoria']?>'><?=$categoria['nombre_categoria']?></option>
    
    <?php endforeach; ?>
</select>