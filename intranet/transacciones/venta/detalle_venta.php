<?php
	session_start();
	// Manejamos en sesión el nombre del usuario que se ha logeado
	if(!isset($_SESSION["usuario"])){
		header("location:../");  
	}
	$_SESSION["usuario"];
	// Termina inicio de sesión

	require('../../conexion.php');
    require('funciones_ventas.php');

    $funcVentas = new funciones_ventas();

    require_once("../../libs/encrypt_decrypt_strings_urls.php");
    $id_ve = decrypt(htmlspecialchars($_GET["venta"]),"intranetdmventas");

	$datosv = $funcVentas -> obtdventa($id_ve);
?>
<!DOCTYPE html>
<html lang="es">
<head>
	<meta charset="utf-8" />
	<title>Detalle Ventas</title>
	<link rel="shortcut icon" type="image/x-icon" href="../../images/favicon.ico">
	<link rel="stylesheet" type="text/css" href="../../css/menu.css" >
    <link rel=stylesheet href="../../css/formatocotizacion.css" type="text/css">
</head>
<body>
	<header>
        <img src="../../images/logoDigitalMind.png" alt="Página Principal" title="Página Principal" />
    </header>
    <nav>
        <ul>
            <li><a href="../../Home" alt="Inicio" title="Inicio"><img src="../../images/home.png"/></a></li>
            <li></li>
            <li></li>
            <li></li>
            <li><spam style="color:#fff;"><?php echo $_SESSION["usuario"]; ?></spam></li>
            <li><a href="../../salir.php" alt="Cerrar Sesion" title="Cerrar Sesion"><img src="../../images/lock.png"/></a></li>
        </ul>
    </nav>

    <h1 style="text-align:center; color:rgba(0,191,255,.9);">
    	<a href="index.php">
            <img class="atras" src="../../images/atras.png" title="Regresar">
        </a>Detalle Venta
    </h1>

    <center>
    	<article>
    		<img class="icono" src="../Imagenes/banner.png" >
    		<div id="datosCot">
				Nota de Venta <br/>
				VENTA <?=$datosv['id_venta']?><br />
				<?php 
					$fecha = date_format(date_create($datosv['fecha_hora']),'d/m/Y H:i:s');
				?>
				Fecha: <?=$fecha?>
    		</div>
    		<div class="divstatus">
    			<b><?=$datosv['nombre_status_venta']?></b>
    		</div>
			
			<table>
				<tr>
					<td>
			    		<div class="datosclie">
			    		<?php
			    			$datcl = $funcVentas -> datosCliente($datosv['id_cliente']);
			    		?>
			    			<h3>EN ATENCIÓN A</h3>
				    		<ul>
				    			<li>
				    				Cliente: 
				    				<b><?=$datosv['nombre_cliente']?></b>
				    			</li>
				    			<br />
				    			<div id="datosCliente">
					    			<li>RFC: <b><?=$datcl['rfc']?></b></li>
					    			<li>Dirección: 
					    				<b>
					    					<?=$datcl['calle'];?> 
					    					<?=$datcl['num_ext'];?>
					    					<?=$datcl['num_int'];?>
					    				</b>
					    			</li>
					    			<li>Colonia: <b><?=$datcl['colonia']?></b></li>
					    			<li>Localidad: <b><?=$datcl['localidad']?></b></li>
					    			<li>Municipio: <b><?=$datcl['municipio']?></b></li>
					    			<li>Estado: <b><?=$datcl['estado']?></b></li>
					    			<li>C.P./País: <b><?=$datcl['cod_postal']?>/<?=$datcl['pais']?></b></li>
					    		</div>
				    		</ul>
			    		</div>
	    			</td>

	    			<td>
						<div class="datoscotizador">
						    <h3>VENTA DE</h3>
						    <ul>
							    <li>Vendedor: <b><?=$datosv['nom_vend']?></b></li>
							    <br />
							    <li>RFC: <b>EERE780924Q89</b></li>
							    <li>Dirección: <b>Manuel Villa Verde 1 40B</b></li>
							    <li>Colonia: <b>Carlos Hank González</b></li>
							    <li>Localidad: <b>Toluca</b></li>
							    <li>Municipio: <b>Toluca</b></li>
							    <li>Estado: <b>México</b></li>
							    <li>C.P./Pais: <b>50026/México</b></li>
							</ul>
						</div>
					</td>
	    		</tr>
			</table>
			<section>
				<div id="tablaProductos">
					<?php $moneda = $datosv['id_moneda']; ?>
					<?php $datosdetv = $funcVentas -> obtdetventa($id_ve) ?>
					<table cellpadding="0" cellspacing="0">
					  <tr>
					    <th>CANTIDAD</th>
					    <th>DESCRIPCIÓN</th>
					    <th>PRECIO UNITARIO</th>
					    <th>IMPORTE</th>
					  </tr>
					  <?php foreach($datosdetv as $datdetve) :?>
						  <tr>
							<td><?=$datdetve['cantp']?></td>
							<td style="text-align:left;">
								<b><?=$datdetve['nombre']?></b>
								<?=$datdetve['nombre_marca']?>
								<?=$datdetve['modelo']?>
								<?=$datdetve['descripcion']."."?>
								<b><?="<br>".$datdetve['noserie']."<br>"?></b>
								<?php $notaProducto = explode('[br]', $datdetve['notaProd']) ?>
								<?php foreach($notaProducto as $notaProd) :?>
									<?php if($notaProd != NULL) :?>
										<?=$notaProd."<br>"?>
									<?php endif ?>
								<?php endforeach ?>
							</td>
							<td><b>$</b><?=number_format($datdetve['precio_unitario'],2,'.',',')?></td>
							<?php $import = $datdetve['precio_unitario']*$datdetve['cantp'] ?>
							<td><b>$</b><?=number_format($import,2,'.',',')?></td>
						  </tr>
					   <?php endforeach; ?>
					</table>
					<table cellspacing="-1" id="operaciones">
				        <tr>
				            <td class="izqOperac">
				            	<!-- Obtiene el NOMBRE de la MONEDA PREDETERMINADA del TIPO de CAMBIO. -->
				                <?php $DatosNomMoneda = $funcVentas -> monedaPredeterminada(); ?>
				                <?php $nomMoneda = $DatosNomMoneda['nombre_moneda'] ?>
				                <!-- Obtiene el VALOR según la  MONEDA PREDETERMINADA -->
				                <?php $valorTipoCambio = $funcVentas -> obtenerValorTipoCambio($nomMoneda); ?>
				                Tipo de cambio: <b>$</b><?=$valorTipoCambio?> <b>USD</b>&nbsp;
				                Tipo de venta: <b><?=$datosv['nom_tipo_venta']?></b>&nbsp;
				                Forma de pago: <b><?=$datosv['nom_tipo_pago']?></b>
				            </td>
				            <td class="azulOperac">SUBTOTAL:</td>
				            <td class="costos">
				                <!-- Subtotal -->
				                <b>$</b><?=number_format($datosv['subtotal'],2,'.',',')?>
				            </td>
				        </tr>
				        <tr>
				            <td class="izqOperac">
				            	<?php if($moneda == 1) :?>
				                    Moneda: <b>USD</b>
				                <?php elseif($moneda == 2) :?>                    
				                    Moneda: <b>MXN</b>
				                <?php endif; ?>
				            </td>
				            <td class="azulOperac">
				            	<?php $nombreImpuesto = $funcVentas -> obtenerNombreImpuesto($datosv['id_impuesto']); ?>
				            	<?=$nombreImpuesto['nombre_impuesto']?>:<br />
				            </td>
				            <td class="costos ">
				            	<!-- IMPUESTO -->
				                <?=$datosv['iva']?>%
				            </td>
				        </tr>
				        <tr>
				            <td class="izqOperac"></td>
				            <td class="azulOperac radiusBottomIzq">TOTAL:</td>
				            <td class="costos radiusBottomDer">
				            	<!-- Total -->
				                <b>$</b><?=number_format($datosv['total'],2,'.',',')?>
				            </td>
				        </tr>
				    </table>
				</div>
			</section>
		</article>
	</center>
	<br />
</body>
</html>