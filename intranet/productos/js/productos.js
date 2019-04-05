export class Productos {
	constructor() {
		// this.criterio = new FormData()
	}

	async abrirNuevoP() {
		const resp = await fetch('registrar_producto.php');
		const data = await resp.text();
		return data;
	}

	async guardarProductos(form) {
		const formData = new FormData(form);

		const resp = await fetch('guardar_producto.php', {
			method: 'POST',
			body: formData	
		});
		const data = await resp.text();
		return data;
	}

	async mostrarTodaTabla() {
		const resp = await fetch('lista_productos.php',{
			method: 'POST'
		});
		
		const data = await resp.text();
		return data;
	}

	async buscarProductos(form) {
		
		const formData = new FormData(form);

		const resp = await fetch('buscar.php', {
			method: 'POST',
			body: formData	
		});

		const data = await resp.text();
		return data;
	}

	mostrarDataTb() {
		const tabla = $('#products').DataTable( {
	        // configuracion del lenguaje
	    	language: {
	            // url: 'https://cdn.datatables.net/plug-ins/1.10.19/i18n/Spanish.json'
	            "sProcessing":     "Procesando...",
				"sLengthMenu":     "Mostrar _MENU_ registros",
				"sZeroRecords":    "No se encontraron resultados",
				"sEmptyTable":     "Ningún dato disponible en esta tabla",
				"sInfo":           "Mostrando registros del _START_ al _END_ de un total de _TOTAL_ registros",
				"sInfoEmpty":      "Mostrando registros del 0 al 0 de un total de 0 registros",
				"sInfoFiltered":   "(filtrado de un total de _MAX_ registros)",
				"sInfoPostFix":    "",
				"sSearch":         "Buscar:",
				"sUrl":            "",
				"sInfoThousands":  ",",
				"sLoadingRecords": "Cargando...",
				"oPaginate": {
					"sFirst":    "Primero",
					"sLast":     "Último",
					"sNext":     "Siguiente",
					"sPrevious": "Anterior"
				},
				"oAria": {
					"sSortAscending":  ": Activar para ordenar la columna de manera ascendente",
					"sSortDescending": ": Activar para ordenar la columna de manera descendente"
				}
	        },
	    	// desabilitar orden en las columnas con la clase nosort
	    	columnDefs: [ {
		      targets: 'nosort',
		      orderable: false
		    } ],
		    // Damos formato a la paginación(números).
		    "sPaginationType": "full_numbers",
		    // Ordenar de forma ascendente la columna de la posición 1.
		    aaSorting: [[0,"asc"]],
		    /* Configura el menú que se utiliza para seleccionar 
		        	el número de filas en una sola página. */
		        aLengthMenu: [[25, 50, 100], [25, 50, 100]],
		     // Muestra el número de filas en una sola página.
		    iDisplayLength: 25,
		    // Cambiar de posición los elementos(paginado,buscar,etc.)
			"sDom": '<"top"lp>rt<"bottom"i><"clear">'
    	});

	    // configurar inputs
		$('#products tfoot th.search_txt').each( function () {
	        const title = $(this).text();
	        $(this).html( `<input type="text" placeholder="${title}" />` );
	    } );

	    // aplicar la busqueda
	    tabla.columns().every( function() {
	    	const that = this;

	    	$('input', this.footer() ).on('keyup change', function() {
	    		if (that.search() !== this.value) {
	    			that
	    				.search( this.value )
	    				.draw();
	    		}
	    	} )
	    } );

	    $('#products tfoot').each(function () {
	    	// console.log($(this))
			$(this).insertBefore($(this).siblings('tbody'));
		}); 
	}

	async cambiarMon(btn) {
		const formData = new FormData();
		if (btn.id === 'precioDolares') {
			formData.append('moneda', 'dolarAm');
		} else if (btn.id === 'precioPesos') {
			formData.append('moneda', 'pesoMx');
		}

		const resp = await fetch('lista_productos_precio.php',{
			method: 'POST',
			body: formData
		});

		const data = await resp.text();
		return data;
	}

	fadeOut(el){
	  el.style.opacity = 1;

	  (function fade() {
	    if ((el.style.opacity -= .1) < 0) {
	      el.style.display = "none";
	    } else {
	      requestAnimationFrame(fade);
	    }
	  })();
	}

	fadeIn(el, display){
	  el.style.opacity = 0;
	  el.style.display = display || "block";

	  (function fade() {
	    var val = parseFloat(el.style.opacity);
	    if (!((val += .1) > 1)) {
	      el.style.opacity = val;
	      requestAnimationFrame(fade);
	    }
	 })();
};

}