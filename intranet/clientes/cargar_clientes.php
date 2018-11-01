<?php
	require 'class_clientes.php';
	$fnclientes = new clientes;
	set_time_limit(300);
	$datosClientes = $fnclientes -> cargarClientes();
	// Insertando Datos del Cliente.
	foreach ($datosClientes as $cliente) {
		// Id de Dirección de Cliente.
		$idDireccionCl = $fnclientes -> incrementoDireccionCliente();
		// Id de Datos Fiscales Cliente.
		$idDatFisc = $fnclientes -> incrementoDatosFiscalesCliente();
		$fnclientes -> registrarClientes($idDireccionCl,$cliente['d_calle'],$cliente['d_noExterior'],$cliente['d_noInterior'],$cliente['d_colonia'],$cliente['d_localidad'],$cliente['d_referencia'],$cliente['d_municipio'],$cliente['d_estado'],$cliente['d_pais'],$cliente['d_codigoPostal'],
		$idDatFisc,$cliente['razonSocial'],$cliente['rfc'],$cliente['tipoRazonSocial'],
		$cliente['nombre']);
	}

	if(isset($fnclientes -> msjOk)) echo"<div class='success2'><h3>".$fnclientes -> msjOk."</h3></div>";
?>
<div id="tbClientes"><?php require 'lista_clientes.php' ?></div>
<script type="text/javascript">
	setTimeout(function() {
        $('.success2').fadeOut(3000);
    },3500);
</script>