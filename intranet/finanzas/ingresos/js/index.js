let $ = jQuery.noConflict();

const mensajes = $('#mensajes');

// abrir modal
$('.cargarVarios').on('click', () => {
	
	$('#modalVariosXml').css({
		'display': 'block', 
		'border-radius': '0',
		'width': '800px',
		'height': '600px',
		'padding': '0',
		'overflow': 'hidden'
	});

	$('#fondoIn').css({'display': 'block'});

	$.ajax({
		url: 'cargar_varios.php',
		dataType: 'html'
	})

	.done((res) => {
		$('#contenidoVariosXml').html(res);

		$('#formuXML').css({
			'width': '800px',
			'top': '0'
		});

		$('.contenido-cargar-v').css({
			'box-sizing': 'border-box',
			'width': '800px',
			'height': '480px',
			'min-height': '0',
			'overflow-y': 'auto'
		});

		// enviar datos de formulario de archivos
		$("#formuXML").submit((e) => {
			$('#cargar').html('<div id="imagenCargar"><img src="../../images/cargando.gif"/></div>');
			e.preventDefault();

			const formFiles = document.getElementById("formuXML");
			const datosForm = new FormData(formFiles);

			$.ajax({
				url: "obtener_varios_xml.php",
				type: "post",
				dataType: "html",
				data: datosForm,
				cache: false,
				contentType: false,
				processData: false
			})

			.done((result) => {
				$("#imagenCargar").remove();
				$(".datosXML").html(result);

				$('.botones-cargar').css({
					'width': '800px'
				});

				// Remueve los mensajes en pantalla.
				setTimeout(function(){
					$('.error').fadeOut(1000);
				},5000);

				setTimeout(function(){
					$('.caption').fadeOut(1000);
				},5000);

				setTimeout(function(){
					$('.success').fadeOut(1000);
				},5000);

				// La información extraida de la data de un DIV con id = datosIngresos.
				let ingresos = $("#datosIngresos").data('ingresos');
				const btnNameGuardarV = $('#btnGuardarInV').attr('name');
				// console.log(ingresos);

				$('#btnGuardarInV').click((e) => {
					$('#guardarVa').html('<div id="imagenGuardar"><img src="../../images/loader_blue.gif"/></div>');
		        	e.preventDefault();

		        	$.ajax({
		        		url: 'guardar_varios_ingresos.php',
		        		type: 'post',
		        		dataType: 'html',
		        		data: {ingresos, btnNameGuardarV}
		        	})
		        	.done((res) => {
		        		$("#imagenGuardar").remove();
						$("#registrarEg").html(res);
						
						const bandera = $('#banderaReg').data('bandera');
						const mensajeOk = $('.success');
						
						if (bandera == 0) {
							setTimeout(() => {
								$('#fondoIn').css({'display': 'none'});
								$('#modalVariosXml').css({'display': 'none'});
							}, 1000);

							if (mensajeOk) {
								mensajes.html(mensajeOk);
								setTimeout(() => {
									mensajes.fadeOut(1000);
								}, 5000);
							}
						}
						// mostrar tabla de ingresos
						mostrarTbIn();
		        	})
		        	.fail((e) => {
		        		console.log("error", e);
		        	})
				});

				// boton cancelar
				$('#btnCancelarIn').click(() => {
					var msjConfirm = confirm('¿Esta seguro de cancelar el registro?');
					if (msjConfirm == true) {
						$('#fondoIn').css({'display': 'none'});
						$('#modalVariosXml').css({'display': 'none'});
					}
				});
			});
		});
	})

	.fail(() => {
		console.log("error");
	})
});

// boton mostrar todo
$('#mostrarTodoI').click(() => {
	$('#cargando-res').html(`<center id='img-car'><img src='../../images/esperando.gif'/></center>`);
	
	$.ajax({
		url: 'listar_ingresos.php',
		dataType: 'html'
	})
	.done((res) => {
		$('#lista_ingresos').html(res);
		mostrarDataTb();
		$('.deleteIngreso').on('click', eliminarIngreso);
	})
	.fail(function() {
		console.log("no existe archivo");
	})
});

// cerrar modal y fondo
$('#fondoIn').click(() => {
	$('#fondoIn').css({'display': 'none'});
	$('#modalVariosXml').css({'display': 'none'});
});

// funcion para cambiar numero de archivos
function cambiar() {
    let pdrs = `${document.getElementById('file-upload').files.length} archivos agregados`;
    document.getElementById('info').innerHTML = pdrs;
}

// botón para buscar ingresos
$('#formBuscar').submit((e) => {
	const datosForm = $('#formBuscar').serialize();
	$("#cargando-res").html("<center><img src='../../images/esperando.gif' /></center>");
	e.preventDefault();
	$.ajax({
		url: 'busqueda_filtrada.php',
		type: 'POST',
		dataType: 'html',
		data: datosForm
	})
	.done((res) => {
		$('#lista_ingresos').html(res);
		mostrarDataTb();
		$('.deleteIngreso').on('click', eliminarIngreso);
	})
	.fail(function() {
		console.log("error");
	})	
});

// mostrar datatable
function mostrarDataTb() {
	// DataTable
		$('#ingresos').dataTable({ 
	        // Damos formato a la paginación(números).
	        "sPaginationType": "full_numbers",
	        // Desactiva el filtrado de datos.
	        // bFilter: false,
	        // Ordenar de forma ascendente la columna de la posición 1.
	        aaSorting: [[0,"desc"]],
	        // Muestra el número de filas en una sola página.
	        iDisplayLength: 25,
	        /* Configura el menú que se utiliza para seleccionar 
	        	el número de filas en una sola página. */
	        aLengthMenu: [[25, 50, 100], [25, 50, 100]],
	        // Desactivar la ordenación de una columna.
	        aoColumnDefs:[{
	        	bSortable: false,
	        	// Posición de la columna.
	        	aTargets: [14],
	        }],
			// Cambiar de posición los elementos(paginado,buscar,etc.)
			"sDom" : '<"top"lp>rt<"bottom"i><"clear">'
	    })

	    .columnFilter({
	    	aoColumns: [
	    		{type:"date_range"},
	    		null,
	    		{type:"text"},
	    		null,
	    		null,
	    		null,
	    		null,
	    		{type:"text"},
	    		{type:"text"},
	    		{type:"date_range"},
	    		{type:"number"},
	    		{type:"text"},
	    		{type:"text"},
	    		{type:"text"},
	    		null
	    	]
	    });
}

// mostrar tabla de Ingresos
function mostrarTbIn() {
	$.ajax({
		url: 'listar_ingresos.php',
		type: 'GET',
		dataType: 'html'
	})
	.done((res) => {
		$('#lista_ingresos').html(res);
		mostrarDataTb();
		$('.deleteIngreso').on('click', eliminarIngreso);
	})
	.fail(function() {
		console.log("error");
	})
}

// eliminar un ingreso
function eliminarIngreso() {
	if (confirm('¿Desea eliminar el registro?')) {
		formDelI = this.form;
		$('#lista_ingresos').load('eliminar_ingresos.php',$(formDelI).serialize());
	}
}

// modificar despues
$('.ingresosAdd').fancybox({
	'scrolling':'auto',
	'autoSize':false,
	'transitionIn':'none',
	'transitionOut':'none',
	'width':700,
	'height':600,
	'type':'ajax'
});
