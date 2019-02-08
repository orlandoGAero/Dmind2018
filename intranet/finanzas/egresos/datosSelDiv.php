<?php 
	include_once('../../class/classProductosEg.php');
    $productos = new Productos(); 
 ?>
<select name="id_division" style="line-height: 0px;" id="seldivision">
    <option value="0">Elige</option>		
    <?php
            $divisiones = $productos->getDivisiones();
            foreach($divisiones as $division) :
    ?>
            <option value='<?=$division['id_division']?>'><?=$division['nombre_division']?></option>		
    <?php endforeach;?>
</select>