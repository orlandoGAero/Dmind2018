<?php 
	if(isset($_REQUEST['idPv'])) {
		$idPv = $_REQUEST['idPv'];
		print $idPv;
	}
 ?>
<div id="resultCpv"></div>
<form action="" id="form_catProv" method="POST" target="_self">
	<h2 class="formarriba">Nueva Categoría Proveedor</h2>
	<center>
		<div class="camps"><br>
			<label>Nombre Categoría:</label><br>
			<?php if(isset($_REQUEST['idPv'])): ?>
			<input type="hidden" name="txt_idPv" value="<?=$idPv?>" readonly>
			<?php else: ?>
			<input type="hidden" name="txt_idPv" value="registrarCPv" readonly>
			<?php endif; ?>
			<input type="text" name="txtNameCatProv" required/><br><br>
		</div>
	</center>
	<center>
		<div style="background:#16555B;" class="formabajo"><br>
			<input type="button" value="Registrar" class="btn primary" onclick="guardarCatPv()"/>
			<input type="reset" value="Limpiar" id="btn_limpiar" class="btn" />
		</div>
	</center>
</form>