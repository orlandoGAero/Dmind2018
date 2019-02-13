<?php 
	if(isset($_REQUEST['idE'])) {
		$idEg = $_REQUEST['idE'];
	}
 ?>
<div id="resultCon"></div>
<form action="" id="form_con" method="POST" target="_self">
	<h2 class="formarriba">Nuevo Concepto</h2>
	<center>
		<div class="camps"><br>
			<label>Concepto :</label><br>
			<?php if(isset($_REQUEST['idE'])): ?>
			<input type="hidden" name="txt_idEg" value="<?=$idEg?>" readonly>
			<?php else: ?>
			<input type="hidden" name="txt_idEg" value="registrarC" readonly>
			<?php endif; ?>
			<input type="text" name="nom_con" required/><br><br>
		</div>
	</center>
	
	<center>
		<div style="background:#16555B;" class="formabajo"><br>
			<input type="button" name="btn_co" id="btn_co" value="Registrar" class="btn primary" onclick="agregarCon()" />
			<input type="reset" value="Limpiar" id="btn_limpiar" class="btn" />
		</div>
	</center>
</form>