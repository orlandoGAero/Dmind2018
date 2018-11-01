	$(document).ready(function(){
		
		//para cerrar la ventana emergente 
		$(".cerrar").click(function(){
		$(".cerrar").css("display","none");
		$(".todasacciones").css("display","none");
		});
		
		//aparecce con esta accion la ventana emergente
		$(".nuevos").click(function(){
		$(".todasacciones").load("agregar.php");
		$(".todasacciones").slideDown("low");	
		$(".cerrar").css("display","block");
		});

		//acciones del menu principal
		$("#basic").css("display","block");
		$("#basicas").click(function(){
			$("#basic").css("display","block");
			$("#contact").css("display","none");
			$("#product").css("display","none");
			$("#invent").css("display","none");
			$("#prov").css("display","none");
			$("#trans").css("display","none");
			$("#client").css("display","none");
      $("#finan").css("display","none");
      $("#egre").css("display","none");
		});
		
		$("#clientes").click(function(){
			$("#client").css("display","block");
			$("#contact").css("display","none");
			$("#basic").css("display","none");
			$("#product").css("display","none");
			$("#invent").css("display","none");
			$("#prov").css("display","none");
			$("#trans").css("display","none");
      $("#finan").css("display","none");
      $("#egre").css("display","none");
		});
		$("#contactos").click(function(){
			$("#contact").css("display","block");
			$("#basic").css("display","none");
			$("#product").css("display","none");
			$("#invent").css("display","none");
			$("#prov").css("display","none");
			$("#trans").css("display","none");
			$("#client").css("display","none");
      $("#finan").css("display","none");
      $("#egre").css("display","none");
		});
		$("#productos").click(function(){
			$("#product").css("display","block");
			$("#basic").css("display","none");
			$("#contact").css("display","none");
			$("#invent").css("display","none");
			$("#prov").css("display","none");
			$("#trans").css("display","none");
			$("#client").css("display","none");
      $("#finan").css("display","none");
      $("#egre").css("display","none");
		});
		$("#inventario").click(function(){
			$("#invent").css("display","block");
			$("#basic").css("display","none");
			$("#product").css("display","none");
			$("#contact").css("display","none");
			$("#prov").css("display","none");
			$("#trans").css("display","none");
			$("#client").css("display","none");
      $("#finan").css("display","none");
      $("#egre").css("display","none");
		});
		$("#proveedores").click(function(){
			$("#prov").css("display","block");
			$("#basic").css("display","none");
			$("#product").css("display","none");
			$("#invent").css("display","none");
			$("#contact").css("display","none");
			$("#trans").css("display","none");
			$("#client").css("display","none");
      $("#finan").css("display","none");
      $("#egre").css("display","none");
		});
		$("#transacciones").click(function(){
			$("#trans").css("display","block");
			$("#basic").css("display","none");
			$("#product").css("display","none");
			$("#invent").css("display","none");
			$("#prov").css("display","none");
			$("#contact").css("display","none");
			$("#client").css("display","none");
      $("#finan").css("display","none");
      $("#egre").css("display","none");
		});
    $("#finanzas").click(function(){
      $("#finan").css("display","block");
      $("#basic").css("display","none");
      $("#product").css("display","none");
      $("#invent").css("display","none");
      $("#prov").css("display","none");
      $("#contact").css("display","none");
      $("#trans").css("display","none");
      $("#client").css("display","none");
      $("#egre").css("display","none");
    });
    $("#egresos").click(function(){
      $("#egre").css("display","block");
      $("#basic").css("display","none");
      $("#product").css("display","none");
      $("#invent").css("display","none");
      $("#prov").css("display","none");
      $("#contact").css("display","none");
      $("#trans").css("display","none");
      $("#client").css("display","none");
      $("#finan").css("display","none");
    });

//para la seleccion del product se despliegan las opciones del producto encadenados segun su seleccion
    $("#categoria").change(function(){
    $.ajax({
      url:"subcategoria.php",
      type: "POST",
      data:"id_categoria="+$("#categoria").val(),
      success: function(opciones){
        $("#subcategoria").html(opciones);
      }
    })
    });
//////////////////////////////////////////////////    
    $("#subcategoria").change(function(){
    var cat = $("#categoria").val();
    var subcat = $("#subcategoria").val();
    $.ajax({
      url:"nombres.php",
      type: "POST",
      data:{id_categoria: cat,id_subcat: subcat},
      success: function(opciones){
        $("#nombres").html(opciones);
      }
    })
    var subcat = $("#subcategoria").val();
    var cat= $("#categoria").val();
    $.ajax({
      url:"divisiones.php",
      type: "POST",
      data:{id_subcategoria: subcat, id_categoria: cat},
      success: function(divis){
        $("#divisiones").html(divis);
      }
    })
    });
/////////////////////////////////////////////////
    $("#divisiones").change(function(){
    var subcat = $("#subcategoria").val();
    var cat= $("#categoria").val();
    var id_division= $("#divisiones").val();
    $.ajax({
      url:"nombresdiv.php",
      type: "POST",
      data:{id_categoria: cat,id_subcategoria: subcat,id_division: id_division},
      success: function(opciones){
        $("#nombres").html(opciones);
      }
    })
    });
/////////////////////////////////////////////////
    $("#nombres").change(function(){
    var subcat = $("#subcategoria").val();
    var div = $("#divisiones").val();
    var id_nombre = $("#nombres").val();
    var id_tipo = $("#tipos").val();
    $.ajax({
      url:"tipos.php",
      type: "POST",
      data:{id_nombre: id_nombre,id_subcategoria: subcat,id_division: div},
      success: function(opciones){
        $("#tipos").html(opciones);
      }
    })
    $.ajax({
      url:"marcas.php",
      type: "POST",
      data:{id_nombre: id_nombre,id_division: div,id_tipo: id_tipo},
      success: function(opciones){

        $("#marcas").html(opciones);
      }
    })
    });
//////////////////////////////////////////////
    $("#tipos").change(function(){
    var id_nombre = $("#nombres").val();
    var id_tipo = $("#tipos").val();
    var div = $("#divisiones").val();
    var subcat = $("#subcategoria").val();
    var cat = $("#categoria").val();
    $.ajax({
      url:"marcatipo.php",
      type: "POST",
      data:{id_nombre: id_nombre,id_tipo: id_tipo,id_division: div,id_subcategoria: subcat},
      success: function(opciones){
        $("#marcas").html(opciones);
      }
    })
    });
//////////////////////////////////////////////
    $("#marcas").change(function(){
   	var id_nombre = $("#nombres").val();
   	var id_tipo = $("#tipos").val();
   	var id_marca = $("#marcas").val();
    var cat = $("#categoria").val();
    var subcat = $("#subcategoria").val();
    var div = $("#divisiones").val();
   	$.ajax({
      url:"modelo.php",
      type: "POST",
      data:{id_nombre: id_nombre,id_tipo: id_tipo,id_marca: id_marca},
      success: function(opciones){
        $("#modelos").html(opciones);
      }
    })
    });
//////////////////////////////////////////////

   //  $("#modelos").change(function(){
   //  var modelo = $("#modelos").val();
   //  var id_marca = $("#marcas").val();
   //  var id_tipo = $("#tipos").val();
   //  var id_nombre = $("#nombres").val();
   //  $.ajax({
   //    url:"noserie.php",
   //    type: "POST",
   //    data:{id_producto: modelo,id_marca: id_marca,id_tipo: id_tipo, id_nombre: id_nombre},
   //    success: function(opciones){
   //      $("#noserie").html(opciones);
   //    }
   //  })
   //  });

   //  $("#noserie").change(function(){
   //  var id_producto = $("#modelos").val();
   //  var id_nombre = $("#nombres").val();
   //  var no_serie = $("#noserie").val();
   //  var id_tipo = $("#tipos").val();
   //  var id_venta = $("#venta").val();
   //  $.ajax({
   //    url:"existencias.php",
   //    type: "POST",
   //    data:{id_producto: id_producto,id_nombre: id_nombre,no_serie: no_serie},
   //    success: function(opciones){
   //      setTimeout(function() {
   //      $("#existencias").css("display","block");
   //      }, 100);
   //      $("#existencias").html(opciones);
   //      setTimeout(function() {
   //      //$("#existencias").css("display","none");
   //      }, 3700);
   //    }
   //  })
   //  $.ajax({
   //    url:"precio.php",
   //    type: "POST",
   //    data:{id_producto: id_producto,id_venta: id_venta},
   //    success: function(prec){
   //      $("#precu").html(prec);
   //      $("#precio").val($("#precu").val());
        
   //    }
   //  })
   //  });

	  // $("form").mouseout(function(){
	  // var cant = $("#cantidad").val();
	  // var pre = $("#precio").val();
	  // var imp= $("#cantidad").val() * $("#precio").val();
	  // $("#importe").val(""+imp);
	  //   var dats = $("#ivaedit").val();
	  //   $("#iva").val(dats);
	  // if($("#subtotal").val()==0){
	  // $("#subtotal").val(""+imp);
	  // }
	  // var subt = $("#subtotal").val();
	  // var iva = $("#iva").val();
	  // var resiva = iva*0.01;
	  // var cast = subt*resiva;
	  // var tot = parseFloat(cast)+parseFloat(subt);
	  //   $("#total").val(tot);
	  // });
   //  $("#cliente").change(function(){
   //  if($("#cliente").val()>0){
   //  $.ajax({
   //    url:"datoscliente.php",
   //    type: "POST",
   //    data:"id_cliente="+$("#cliente").val(),
   //    success: function(resp){
   //      $("#camposclie").html(resp);
   //      $("#cliepost").val($("#cliente").val());
   //    }
   //  })
   //  }      
   //  });
   //  $("#estadoventa").change(function(){
   //  if($("#estadoventa").val()>0){
   //  $.ajax({
   //    url:"estado.php",
   //    type: "POST",
   //    data:"id_status="+$("#estadoventa").val(),
   //    success: function(resp){
   //      //$("#camposclie").html(resp);
   //      //alert("Cambiado"+resp);
   //    }
   //  })
   //  }      
   //  });

    $(".web").val("https://");
	});