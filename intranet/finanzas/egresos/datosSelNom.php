<?php 
	include_once('../../class/classProductosEg.php');
    $productos = new Productos(); 
 ?>
<select name="id_nombre" style="line-height: 0px;" id="selnombre">
    <option value="0">Elige</option>		
    <?php
            $nombres = $productos->getNombres();
            foreach($nombres as $nombre) :
    ?>
            <option value='<?=$nombre['id_nombre']?>'><?=$nombre['nombre']?></option>		
    <?php endforeach;?>
</select>