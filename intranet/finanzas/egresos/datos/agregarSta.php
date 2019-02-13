<?php 
	if(isset($_REQUEST['idE'])) {
		$idEg = $_REQUEST['idE'];
	}
 ?>
<div id="resultSta"></div>
<form action="" id="form_st" method="POST" target="_self">
	<h2 class="formarriba">Nuevo Status</h2>
	<center>
		<div class="camps"><br>
			<label>Status :</label><br>
			<?php if(isset($_REQUEST['idE'])): ?>
			<input type="hidden" name="txt_idEg" value="<?=$idEg?>" readonly>
			<?php else: ?>
			<input type="hidden" name="txt_idEg" value="registrarSta" readonly>
			<?php endif; ?>
			<input type="text" name="nom_status" required/><br><br>
		</div>
	</center>
	
	<center>
		<div style="background:#16555B;" class="formabajo"><br>
			<input type="button" name="btn_s" id="btn_s" value="Registrar" class="btn primary" onclick="agregarSta()" />
			<input type="reset" value="Limpiar" id="btn_limpiar" class="btn" />
		</div>
	</center>
</form>
