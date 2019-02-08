<?php 
	include_once('../../class/classProductosEg.php');
    $productos = new Productos(); 
 ?>
 <select name="id_marca" style="line-height: 0px;" id="selmarca">
    <option value="0">Elige</option>		
    <?php
            $marcas = $productos->getMarcas();
            foreach($marcas as $marca) :
    ?>
            <option value='<?=$marca['id_marca']?>'><?=$marca['nombre_marca']?></option>		
    <?php endforeach;?>		
</select>