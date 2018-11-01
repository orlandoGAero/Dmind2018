var $ = jQuery.noConflict();
$(document).ready(function($) {
	// Cambio de Moneda
	var txtTipoMoneda = $("#moneda").val();
	// Habilitar botón de Cambiar Venta a Pesos si se encuentra en Dolares.
	if (txtTipoMoneda == 1) {
		$("#pesos").show();
		$("#dolares").hide();
	}
	// Habilitar botón de Cambiar Venta a Dólares si se encuentra en Pesos.
	if(txtTipoMoneda == 2) {
		$("#dolares").show();
		$("#pesos").hide();
	}
	// Script que cambia venta a Pesos Mexicanos
	$("#pesosM").on("click" ,function() {
		$("#moneda").val(2);
		if($("#moneda").val() == 2){
			// Oculta botón de Cambiar Venta a Pesos
			$("#pesos").hide();
			// Muestra botón de Cambiar Venta a Dolares.
			$("#dolares").show();

			var mandarImpuesto = $("#impuesto").val();
			formBotonesOper = this.form;
			$("#tablaProductos").load('cambiar_a_pesos.php?impuesto='+mandarImpuesto+'&',$(formBotonesOper).serialize());
		}
	});
	// Script que cambia venta a Dólares
	$("#dolaresA").on("click" ,function() {
		$("#moneda").val(1);
		if($("#moneda").val() == 1){
			// Oculta botón de Cambiar Venta a Dolares
			$("#dolares").hide();
			// Muestra botón de Cambiar Venta a Pesos.
			$("#pesos").show();

			var mandarImpuesto = $("#impuesto").val();
			formBotonesOper = this.form;
			$("#tablaProductos").load('cambiar_a_dolares.php?impuesto='+mandarImpuesto+'&',$(formBotonesOper).serialize());
		}
	});
	// Agregar Producto a la Venta.
	$("#formAddProd").on("submit", function(ap) {
		// Agrega los Productos
		ap.preventDefault();
		var mandarImpuesto = $("#impuesto").val();
		$("#tablaProductos").load('agregar_productos.php?impuesto='+mandarImpuesto+'&'+$("#formAddProd").serialize());
		if($("#nombreCliente").val() != 0){
			$("#btnVender").removeAttr('disabled');
			$("#btnImprimir").removeAttr('disabled');
		}
		// Llamando otra Función.
		actualizaNumSeries();
	});
	//Limpiar valores de Agregar Producto
	$(".btnReset").on("click", function() {
		$("#izquierdo").load('reset_add_product.php');
	});
	// Quitar todos los Productos
	$(".btnQuitarProd").on("click",function() {
		if(confirm('¿Quitar Productos?')){
			// Elimina todos los productos.
			formBotonesQ = this.form;
			$("#tablaProductos").load('quitar_productos.php',$(formBotonesQ).serialize());
			$("#borrtodo").attr('disabled','disabled');
			$("#btnVender").attr('disabled','disabled');
			$("#btnImprimir").attr('disabled','disabled');
			$("#pesosM").attr('disabled','disabled');
			$("#dolaresA").attr('disabled','disabled');
			// Llamando otra Función.
			actualizaNumSeries();
		}
	});
	// Cancelar venta
	$("#btn-cancelar").click(function() {
		var cancelar = confirm('¿Desea cancelar la venta?');
		if (cancelar) {
			formBotones = this.form;
			$("#tablaProductos").load('cancelar_venta.php',$(formBotones).serialize());
		}
	});
	// Imprimir Venta
	$("#btnImprimir").click(function() {
		// Se utilizó una funcion para encriptar los datos enviados.
		var claveVenta = Base64.encode($("#numVenta").val());
		var fechaHoraVenta = Base64.encode($("#fechaVenta").val());
		var statusVenta = Base64.encode($("#statusV").val());
		var cliente = Base64.encode($("#nombreCliente").val());
		var tipoVenta = Base64.encode($("#tipoV").val());
		var formaPago = Base64.encode($("#formaPagoV").val());
		var tipoMoneda = Base64.encode($("#moneda").val());
		var impuesto = Base64.encode($("#impuesto").val());
		var tipoImpuesto = Base64.encode($("#NomImpuesto").val());
		var imprimir = 'pdf_venta.php?vent='+claveVenta+'&dt='+fechaHoraVenta+'&st='+statusVenta+'&tv='+tipoVenta+'&fp='+formaPago+'&cl='+cliente+'&m='+tipoMoneda+'&i='+impuesto+'&ti='+tipoImpuesto;

		window.open(imprimir,'_blank');
	});
	// Guardar Venta
	$("#btnVender").click(function() {
		$("#guardarVenta").load('guardar_venta.php?'+$("#formDatosGuardarVenta").serialize());
	});
});