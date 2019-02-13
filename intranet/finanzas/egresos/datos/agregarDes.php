<?php 
	if(isset($_REQUEST['idE'])) {
		$idEg = $_REQUEST['idE'];
	}
 ?>
<div id="resultDes"></div>
<form action="" id="form_des" method="POST" target="_self" >
	<h2 class="formarriba">Nuevo Destino</h2>
	<center>
		<div class="camps"><br>
			<label>Destino :</label><br>
			<?php if(isset($_REQUEST['idE'])): ?>
			<input type="hidden" name="txt_idEg" value="<?=$idEg?>" readonly>
			<?php else: ?>
			<input type="hidden" name="txt_idEg" value="registrarDes" readonly>
			<?php endif; ?>
			<input type="text" name="nom_des" required/><br><br>
		</div>
	</center>
	
	<center>
		<div style="background:#16555B;" class="formabajo"><br>
			<input type="button" name="btn_des" id="btn_des" value="Registrar" class="btn primary" onclick="agregarDes()" />
			<input type="reset" value="Limpiar" id="btn_limpiar" class="btn" />
		</div>
	</center>
</form>
