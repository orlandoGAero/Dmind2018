<?php 
	if(isset($_REQUEST['idE'])) {
		$idEg = $_REQUEST['idE'];
	}
 ?>
<div id="resultOri"></div>
<form action="" id="form_or" method="POST" target="_self">
	<h2 class="formarriba">Nuevo Origen</h2>
	<center>
		<div class="camps"><br>
			<label>Origen :</label><br>
			<?php if(isset($_REQUEST['idE'])): ?>
			<input type="hidden" name="txt_idEg" value="<?=$idEg?>" readonly>
			<?php else: ?>
			<input type="hidden" name="txt_idEg" value="registrarOri" readonly>
			<?php endif; ?>
			<input type="text" name="nom_ori" required/><br><br>
		</div>
	</center>
	
	<center>
		<div style="background:#16555B;" class="formabajo"><br>
			<input type="button" name="btn_or" id="btn_or" value="Registrar" class="btn primary" onclick="agregarOri()"/>
			<input type="reset" value="Limpiar" id="btn_limpiar" class="btn" />
		</div>
	</center>
</form>
