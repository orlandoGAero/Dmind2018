<?php 
	if(isset($_REQUEST['idE'])) {
		$idEg = $_REQUEST['idE'];
	}
 ?>
<div id="resultCla"></div>
<form action="" id="form_cla" method="POST" target="_self">
	<h2 class="formarriba">Nueva Clasificación</h2>
	<center>
		<div class="camps"><br>
			<label>Clasificación :</label><br>
			<?php if(isset($_REQUEST['idE'])): ?>
			<input type="hidden" name="txt_idEg" value="<?=$idEg?>" readonly>
			<?php else: ?>
			<input type="hidden" name="txt_idEg" value="registrarCla" readonly>
			<?php endif; ?>
			<input type="text" name="nom_cl" required/><br><br>
		</div>
	</center>
	
	<center>
		<div style="background:#16555B;" class="formabajo"><br>
			<input type="button" name="btn_cl" id="btn_cl" value="Registrar" class="btn primary" onclick="agregarCla()"/>
			<input type="reset" value="Limpiar" id="btn_limpiar" class="btn" />
		</div>
	</center>
</form>