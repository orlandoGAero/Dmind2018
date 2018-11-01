$(document).ready(function(){
  $(".nuevopro").click(function(){
    $("#pro").css("display","block");
    $("#todo").css("display","block");
    setTimeout(function() {
    $(".cargand").css("display","none");
    }, 500);
    setTimeout(function() {
    $("#formagregar").slideDown("low");
    $(".cerrar").css("display","block");
  }, 1000);
  });

  $(".cerrar").click(function(){
    $("#todo").css("display","none");
    $("#pro").css("display","none");
    $(".cerrar").css("display","none");
  });

    $("#cancela").click(function(event){
    $("#opac").hide("low");
  });

  $("form").mouseout(function(){
  var cant = $("#cantidad").val();
  var pre = $("#precio").val();
  var imp= $("#cantidad").val() * $("#precio").val();
  $("#importe").val(""+imp);
    var dats = $("#ivaedit").val();
    $("#iva").val(dats);
  if($("#subtotal").val()==0){
  $("#subtotal").val(""+imp);
  }
  var subt = $("#subtotal").val();
  var iva = $("#iva").val();
  var resiva = iva*0.01;
  var cast = subt*resiva;
  var tot = parseFloat(cast)+parseFloat(subt);
    $("#total").val(tot);
  });
  //mouseout
//para la seleccion del product se despliegan las opciones del producto encadenados segu su seleccion
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
      data:{id_nombre: id_nombre,id_division: div,id_subcategoria: subcat},
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

    $("#cliente").change(function(){
    if($("#cliente").val()>0){
    $.ajax({
      url:"datoscliente.php",
      type: "POST",
      data:"id_cliente="+$("#cliente").val(),
      success: function(resp){
        $("#camposclie").html(resp);
        $("#cliepost").val($("#cliente").val());
      }
    })
    }      
    });
    $("#modelos").change(function(){
    $.ajax({
      url:"precio.php",
      type: "POST",
      data:"infopre="+$("#modelos").val(),
      success: function(prec){
        $("#precu").html(prec);
        $("#precio").val($("#precu").val());
        
      }
    })
    });
});