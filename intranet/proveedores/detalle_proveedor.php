<?php
	session_start();
	// Manejamos en sesión el nombre del usuario que se ha logeado.
	if (!isset($_SESSION["usuario"])){
	    header("location:../");  
	}
	$_SESSION["usuario"];
	// Termina inicio de sesión.
?>
<!DOCTYPE html>
<html lang="es">
	<head>
		<meta charset="utf-8" />
		<title>Digital Mind</title>
		<link rel="shortcut icon" type="image/x-icon" href="../images/favicon.ico" />
		<link rel="stylesheet" href="../css/estilos.css" />
		<link rel="stylesheet" href="../css/tabla.css" />
		<link rel="stylesheet" href="../css/menu.css" />
		<link rel="stylesheet" href="../css/formularios.css" />
		<link rel="stylesheet" href="../css/proveedor.css" />
	</head>
	<body>
		<?php include ("../menu.php"); ?>
		<div id="titulo">
			<h1>
				<a href="index.php"><img class="atras" src="../images/atras.png" alt="Atras"></a> Detalle Proveedor
			</h1>
		</div>
		<?php
			// Clase Proveedores.
			include 'classProveedores.php';
			$fnProv = new Proveedores();
		?>
		<?php if (isset($_GET['proveedor'])) : ?>
			<?php $idProveedor = $_GET['proveedor']; ?>
			<?php if ($idProveedor != "") : ?>
				<?php $detProveedor = $fnProv -> detalleProveedor($idProveedor); ?>
				<!-- Proveedor -->
				<section>
					<table class="detalle">
						<!-- Datos Generales -->
						<tr><td colspan="2"><span class="azul"><b>Datos Generales</b></span></td></tr>
						<tr><th>Id</th><td><?=$detProveedor['id_proveedor']?></td></tr>
						<tr><th>Categoría</th><td><?=$detProveedor['nombre_cat_prov']?></td></tr>
						<tr><th>Nombre</th><td><?=$detProveedor['nom_proveedor']?></td></tr>
						<tr><th>Teléfono</th><td><?=$detProveedor['tel_proveedor']?></td></tr>
						<tr><th>Correo Electrónico</th><td><?=$detProveedor['email_proveedor']?></td></tr>
						<tr><th>Dirección Web</th><td><?=$detProveedor['url_proveedor']?></td></tr>
						<tr>
							<th>Fecha de Registro</th>
							<td>
								<?php $fechaReg = date_format(date_create($detProveedor['fecha_registro']), 'd-m-Y H:i:s'); ?>
								<?=$fechaReg?>
							</td>
						</tr>
						<!-- Datos Fiscales -->
						<tr><td colspan="2"><span class="azul"><b>Datos Fiscales</b></span></td></tr>
						<tr><th>Razón Social</th><td><?=$detProveedor['razon_social_prov']?></td></tr>
						<tr><th>RFC</th><td><?=$detProveedor['rfc_prov']?></td></tr>
						<tr><th>Tipo Razón Social</th><td><?=$detProveedor['tipo_razon_social_prov']?></td></tr>
						<!-- Datos Bancarios -->
						<tr><td colspan="2"><span class="azul"><b>Datos Bancarios</b></span></td></tr>
						<tr><th>Banco</th><td><?=$detProveedor['nombre_banco_p']?></td></tr>
						<tr><th>Sucursal</th><td><?=$detProveedor['sucursal_banco_p']?></td></tr>
						<tr><th>Titular</th><td><?=$detProveedor['titular_cuenta_p']?></td></tr>
						<tr><th>No. Cuenta</th><td><?=$detProveedor['num_cbancaria_p']?></td></tr>
						<tr><th>Clabe Interbancaria</th><td><?=$detProveedor['clabe_interbancaria_p']?></td></tr>
						<tr><th>Tipo de Cuenta</th><td><?=$detProveedor['tipo_cuenta_p']?></td></tr>
						<!-- Direcciones -->
						<?php $datosDireccionProveedor = $fnProv -> direccionesProveedor($idProveedor); ?>
						<?php foreach($datosDireccionProveedor as $dirProve) : ?>
							<?php if ($dirProve != NULL) : ?>
								<tr><td colspan="2"><span class="azul"><b>Dirección <?=$dirProve['tipo_direccion']?></b></span></td></tr>
								<tr>
									<th>Calle/No.Ext/No.Int</th>
									<td><?=$dirProve['calle_p']?>&nbsp;<?=$dirProve['num_ext_p']?>&nbsp;<?=$dirProve['num_int_p']?></td>
								</tr>
								<tr><th>Colonia</th><td><?=$dirProve['colonia_p']?></td></tr>
								<tr><th>Localidad</th><td><?=$dirProve['localidad_p']?></td></tr>
								<tr><th>Municipio</th><td><?=$dirProve['municipio_p']?></td></tr>
								<tr><th>Estado</th><td><?=$dirProve['estado_p']?></td></tr>
								<tr><th>País</th><td><?=$dirProve['pais_p']?></td></tr>
								<tr><th>Código Postal</th><td><?=$dirProve['cod_postal_p']?></td></tr>
								<tr><th>Referencia</th><td><?=$dirProve['referencia_direccion']?></td></tr>
							<?php endif; ?>
						<?php endforeach; ?>
						<tr><th>&nbsp;</th><td><a class="btn primary" href="./">Salir</a></td></tr>
					</table>
				</section>
				<!-- Contactos Proveedor -->
				<div id="contactos-proveedor">
					<h3>Contactos</h3>
					<?php if ($contactosProv = $fnProv -> contactosProveedor($idProveedor)) : ?>
						<table class="datos lista-contactos">
							<tr>
								<th>Nombre</th>
								<th>Área</th>
								<th>Teléfono Oficina</th>
							</tr>
							<?php foreach ($contactosProv as $contacto) : ?>
								<tr>
									<td><?=$contacto['nombre']?></td>
									<td><?=$contacto['nombre_areacontacto']?></td>
									<td><?=$contacto['tel_oficina']?></td>
								</tr>
							<?php endforeach; ?>
						</table>
					<?php else : ?>
						<p class="sin-contactos">Sin contactos</p>
					<?php endif; ?>
				</div>
			<?php endif; ?>
		<?php endif; ?>
	</body>
</html>