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
?>

<!DOCTYPE html>
<html lang="es">
<head>
	<meta charset="utf-8" />
	<title>Registrar Ventas</title>
	<link rel="shortcut icon" type="image/x-icon" href="../../images/favicon.ico">
	<link rel="stylesheet" type="text/css" href="../../css/menu.css" >
    <link rel="stylesheet" type="text/css" href="../../css/formularios.css" />
    <link rel=stylesheet href="../../css/scroll.css" type="text/css">
    <link rel=stylesheet href="../../css/formatocotizacion.css" type="text/css">
  	<!-- jQuery -->
    <script type="text/javascript" src="../../js/jquery-1.7.1.min.js" ></script>
    <!-- Filtrado de Productos -->
    <script type="text/javascript" src="../../js/filtrar_listas_prod_inv.js"></script>
    <!-- FUNCIÓN para Actualizar los valores de la lista de Números de Serie -->
    <script type="text/javascript" src="../../js/actualiza_numero_serie.js"></script>
    <!-- Funciones de Registrar Venta -->
    <script type="text/javascript" src="../../js/registrar_ventas.js"></script>
	<script type="text/javascript" src="../../libs/encrypt_decrypt_base_64.js"></script>
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
    	Nueva Venta
    </h1>

    <center>
    	<aside id="izquierdo">
    		<h3>AGREGAR PRODUCTO</h3>
    		<form action="" method="POST" class="ventasform" id="formAddProd" target="_self">
    			<ul>
    				<li>
    					<?php $idVenta = $funcVentas -> numeroVenta() ?>
    					<input type="hidden" name="txtNumVenta1" value="<?=$idVenta?>" readonly>
    				</li>
					<li>
						<label> Categoría:</label>
						<?php $Categorias = $funcVentas -> obtenerCategorias() ?>
	    				<select id="categoria" required>
	    					<option value="" selected>Elige</option>
							<?php foreach($Categorias as $categoria) :?>
	    						<option value="<?=$categoria['id_categoria']?>"><?=$categoria['nombre_categoria']?></option>
	    					<?php endforeach; ?>
	    				</select>
					</li>
					<li>
						<label> Subcategoria:</label>
						<select id="subcategoria" required>
							<option value="">Elige</option>
						</select>
					</li>
					<li>
						<label>División:</label>
					    <select id="divisiones" required>
					      <option value="">Elige</option>
					    </select>
					</li>
					<li>
						<label>Nombre:</label>
						<select id="nombres" name="nombre" required>
							<option value="">Elige</option>
						</select>
					</li>
					<li>
						<label>Tipo:</label>
						<select id="tipos" required>
							<option value="">Elige</option>
						</select>
					</li>
					<li>
						<label>Marca:</label>
					  	<select id="marcas" name="marca" required>
					  		<option value="">Elige</option>
					  	</select>
					</li>

					<li>
						<label>Modelo:</label>
					  	<select id="modelos" name="sltModeloProd" required>
					  		<option value="">Elige</option>
					  	</select>
					</li>
					<li>
						<label>No. Serie:</label>
						<select id="series" name="sltNumSerie" required>
							<option value="">Elige</option>
						</select>
					</li>
					<li>
						<div id="precio">
							<label>Precio: </label>
							<input type="text" name="txtPrice" readonly>
						</div>
					</li>
					<li>
						<label>Nota o Descripción:</label>
					</li>
					<li>
						<textarea name="txtNotaDescrip" id="descripcion" cols="90" rows="4" style="resize:none;"></textarea>
					</li>
					<li>
						<center>
							<button type="submit" class="btn primary" id="addProduct" disabled>Agregar</button>
							<button type="button" class="btnReset btn">Limpiar</button>
						</center>
					</li>
    			</ul>
    		</form>
    	</aside>

    	<article>
    		<img class="icono" src="../Imagenes/banner.png" >
    		<div id="datosCot">
				Nota de Venta <br/>
				VENTA <?=$idVenta?><br />
				<?php 
					date_default_timezone_set('America/Mexico_City');
					$fecha = date('d/m/Y');
				?>
				Fecha: <?=$fecha?>
				<?php $imprimirFecha = date('d/m/Y H:i:s'); ?>
				<input type="hidden" id="fechaVenta" value="<?=$imprimirFecha?>" readonly />
    		</div>

    		<form action="" method="POST" id="formDatosGuardarVenta">
    			<div id="statusRegistrarVenta">
    				<input type="hidden" name="txtNumVenta2" id="numVenta" value="<?=$idVenta?>" readonly>
    				<?php $StatusVentas = $funcVentas -> obtenerStatusVenta() ?>
	    			<select name="sltStatusV" id="statusV" required>
	    				<?php if($StatusVentas) :?>
		    				<?php foreach($StatusVentas as $status_V) :?>
		    					<option value="<?=$status_V['id_status_venta']?>"><?=$status_V['nombre_status_venta']?></option>
		    				<?php endforeach; ?>
		    			<?php else :?>
		    				<option value="0">Sin Status</option>
		    			<?php endif; ?>
	    			</select>
    			</div>

    			<table>
    				<tr>
						<td>
				    		<div class="datosclie">
				    			<h3>EN ATENCIÓN A</h3>
					    		<ul>
					    			<li>
					    				Cliente: 
					    				<?php $Clientes = $funcVentas -> obtenerClientes() ?>
					    				<select name="sltCliente" id="nombreCliente">
					    					<option selected value="0">Selecciona el cliente</option>
					    					<?php foreach($Clientes as $nombreCliente) :?>
					    						<option value="<?=$nombreCliente['id_cliente']?>"><?=$nombreCliente['nombre_cliente']?></option>
					    					<?php endforeach; ?>
					    				</select>
					    			</li>
					    			<div id="datosCliente">
						    			<li>RFC:</li>
						    			<li>Dirección:</li>
						    			<li>Colonia:</li>
						    			<li>Localidad:</li>
						    			<li>Municipio:</li>
						    			<li>Estado:</li>
						    			<li>C.P./País:</li>
						    		</div>
					    		</ul>
				    		</div>
				    	</td>
				    	
						<td>
							<div class="datoscotizador">
							    <h3>VENTA DE</h3>
							    <ul>
								    <li>EMANUEL ESPEJEL RODRIGUEZ</li>
								    <br />
								    <li>RFC:<b>EERE780924Q89</b></li>
								    <li>Dirección:<b>Manuel Villa Verde 1 40B</b></li>
								    <li>Colonia:<b>Carlos Hank González</b></li>
								    <li>Localidad:<b>Toluca</b></li>
								    <li>Municipio:<b>Toluca</b></li>
								    <li>Estado:<b>México</b></li>
								    <li>C.P./Pais:<b>50026/México</b></li>
								</ul>
							</div>
						</td>
				    </tr>
				</table>
				<section>
					<div id="tablaProductos">
						<?php include 'tabla_venta_detalle.php' ?>
					</div>
					<br>
					<table id="masDatosVenta">
						<tr>
							<td>
								<?php $TiposVenta = $funcVentas -> obtenerTiposVenta() ?>
								<label>Tipo de Venta:</label>
								<select name="sltTipoVenta" id="tipoV" required>
									<?php if($TiposVenta) :?>
										<?php foreach($TiposVenta as $tipo_V) :?>
											<option value="<?=$tipo_V['id_tipo_venta']?>"><?=$tipo_V['nom_tipo_venta']?></option>
										<?php endforeach; ?>
									<?php else :?>
										<option value="0">Sin Tipos de Venta</option>
									<?php endif; ?>
								</select>
							</td>
							<td class="ancho15Px"></td>
							<td>
								<?php $FormasPago = $funcVentas -> obtenerFormasPago() ?>
								<label>Forma de Pago:</label>
								<select name="sltFormaPago" id="formaPagoV" required>
									<?php if($FormasPago) :?>
										<?php foreach($FormasPago as $forma_Pago) :?>
											<option value="<?=$forma_Pago['id_tipo_pago']?>"><?=$forma_Pago['nom_tipo_pago']?></option>
										<?php endforeach; ?>
									<?php else :?>
										<option value="0">Sin Formas de Pago</option>
									<?php endif; ?>
								</select>
							</td>
						</tr>
					</table>
				</section>
	    	</form>
    	</article>
    	<aside id="derecho">
    		<h3>OPERACIONES</h3>
    		<form action="" method="POST">
    			<input type="hidden" name="txtNumVenta3" value="<?=$idVenta?>" readonly>
				<button type="button" class="btnImprimirVenta" id="btnImprimir" disabled>
					<img src="../../images/pdf-32.png" class="imgImprimir" />
					Imprimir
				</button>
				<!-- </a> -->
				<!-- Botón quitar productos -->
	    		<button type="button" id="borrtodo" class="btnQuitarProd" disabled>Quitar Productos</button>
	    		<!-- Botón vender y salir -->
				<button type="button" class="btn primary" id="btnVender" disabled >Vender y Salir</button>
				<!-- Botón Cancelar -->
				<button type="button" class="btnCancelar" id="btn-cancelar">Cancelar</button>
				<!-- Botones de Cambiar Moneda -->
				<div id="pesos">
					<button type="button" class="btn primary" id="pesosM" disabled >Venta en Pesos</button>
				</div>
				<div id="dolares">
					<button type="button" class="btn primary" id="dolaresA" disabled >Venta en Dolares</button>
				</div>
			</form>
    	</aside>
    </center>

    <div id="guardarVenta" style="color:#fff;"></div>
</body>
</html>