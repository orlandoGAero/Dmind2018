<?php 
	include_once('../../class/classProductosEg.php');
    $productos = new Productos(); 
 ?>
<select name="id_tipo" style="line-height: 0px;" id="seltipo">
    <option value="0">Elige</option>		
    <?php
            $tipos = $productos->getTipos();
            foreach($tipos as $tipo) :
    ?>
            <option value='<?=$tipo['id_tipo']?>'><?=$tipo['nombre_tipo']?></option>		
    <?php endforeach;?>		
</select>