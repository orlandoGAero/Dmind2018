$(document).ready(function(){
    $(".btn").click(function(){
        var nom = $(".nombre").val();
        //en contactos valida los numeros telefonicos

//        var tel = $(".telefono").val();
        var cat = $(".categoria").val();
//        var web = $(".web").val();
 //       url = /^(ht|f)tps?:\/\/\w+([\.\-\w]+)?\.([a-z]{2,6})?([\.\-\w\/_]+)$/i;
        var raz = $(".raz").val();
      	var rfc = $(".rfc").val();
        var ema = $(".email").val();
        var tel = $(".telefono").val();
      	email = /^[a-zA-Z0-9\._-]+@[a-zA-Z0-9-]{2,}[.][a-zA-Z]{2,4}$/;
//	//para la validacion de direccion fiscal
      if (nom == "") {
      	  $(".nombre").focus();
          $("#alerta1").fadeIn();
          return false;
      }else{
      	$("#alerta1").fadeOut();
      if (tel == "" || isNaN(tel)) {
      	  $(".telefono").focus();
          $("#alerta2").fadeIn();
          return false;
      }else{
      	$("#alerta2").fadeOut();
      }
		 if (cat==0) {
		     	$(".categoria").focus();
		          $("#alerta3").fadeIn();
		          return false;
		}else{
			$("#alerta3").fadeOut();
		}
      }

//para velidar los datos fiscales
      if (raz == "") {
          $("#alerta5").fadeIn();
          return false;
      }else{
      	$("#alerta5").fadeOut();
	      if (rfc == "") {
	      	$(".rfc").focus();
	          $("#alerta6").fadeIn();
	          return false;
	      }else{
	      	$("#alerta6").fadeOut();
	      }
      }
	if(email.test($(".email").val().trim())){
			$("#alerta77").fadeOut();
	}else{
			$("#alerta77").fadeIn();
			$(".email").focus();
	}






//		var fpais = $(".fpais").val();
//		var fest = $(".festado").val();
//		var fmun = $(".fmunicipio").val();
//		var floc = $(".flocalidad").val();
//		var fcol = $(".fcolonia").val();
//		var fcod = $(".fcod_postal").val();
//		var fcall = $(".fcalle").val();
//		var fnum_e = $(".fnum_ext").val();
//		var fnum_i = $(".fnum_int").val();
//		var fref = $(".freferencia").val();
//		var ban = $(".banco").val();
//		var sucur = $(".sucursal").val();
//		var titu = $(".titular").val();
//		var no_cu = $(".no_cuenta").val();
//		var clav = $(".clave_int").val();
////		var tipo_cu = $(".tipo_cuenta").val();
//
//
//		var pais = $(".pais").val();
//		var est = $(".estado").val();
//		var mun = $(".municipio").val();
//		var loc = $(".localidad").val();
//		var col = $(".colonia").val();
//		var cod = $(".cod_postal").val();
//		var call = $(".calle").val();
//		var suc1 = $(".sucursal1").val();
//		var num_e = $(".num_ext").val();
//		var num_i = $(".num_int").val();
//		var ref = $(".referencia").val();
//
//para la validacion de datos bancarios
//      if (ban == "") {
//      	$(".banco").focus();
//          $("#alertab1").fadeIn();
//          return false;
//      }else{
  //    	$("#alertab1").fadeOut();
//	      if (sucur == "") {
//	      	$(".sucursal").focus();
//	          $("#alertab2").fadeIn();
//	          return false;
	//      }else{
//	      	$("#alertab2").fadeOut();
//		      if (titu == "") {
//		      	$(".titular").focus();
//		          $("#alertab3").fadeIn();
	//	          return false;
//		      }else{
//		      	$("#alertab3").fadeOut();
//			      if (no_cu == "" || isNaN(no_cu)) {
//			      	$(".no_cuenta").focus();
	//		          $("#alertab4").fadeIn();
//			          return false;
//			      }else{
//			      	$("#alertab4").fadeOut();
//				      if (clav == "" || isNaN(clav)) {
	//			      	$(".clave_int").focus();
//				          $("#alertab5").fadeIn();
//				          return false;
//				      }else{
//				      	$("#alertab5").fadeOut();
	//				      if (tipo_cu == "") {
//					      	$(".tipo_cuenta").focus();
//					          $("#alertab6").fadeIn();
//					          return false;
//					      }else{
	//				      	$("#alertab6").fadeOut();
//					      }
//				      }
//	//		      }
////		      }
//	      }
  //    }
//
//     if (tel == "" || isNaN(tel)) {
//  		$(".telefono").focus();
//    		$("#alerta2").fadeIn();
//       		return false;
//     }else{
// 		$("#alerta2").fadeOut();
//     }
  //  if (web == "") {
  //    	$(".web").focus();
//	        $("#alerta4").fadeIn();
  //        return false;
  //  }else{
  //    	$("#alerta4").fadeOut();
  //    	$(".raz").focus();
    //}
				      	
//	if(url.test($(".web").val().trim())){
//	    $("#alerta44").fadeOut();		
//	}else{
//		$("#alerta44").fadeIn();
//	}

//para validar los datos fiscales
		
  //    if (fpais == "") {
  //        $("#alertp").fadeIn();
  //        return false;
  //    }else{
//      	$("#alertp").fadeOut();
	//      if (fest == "") {
	//      	$(".festado").focus();
	//          $("#falertaestado").fadeIn();
	//          return false;
//	      }else{
	  //    	$("#falertaestado").fadeOut();
	//	      if (fmun == "") {
	//	      	$(".fmunicipio").focus();
	//	          $("#falertamunicipio").fadeIn();
//		          return false;
		//      }else{
	//	      	$("#falertamunicipio").fadeOut();
	//		      if (floc == "") {
	//		      	$(".flocalidad").focus();
//			          $("#falertalocalidad").fadeIn();
		//	          return false;
	//		      }else{
	//		      	$("#falertalocalidad").fadeOut();
	//			      if (fcod == "" || isNaN(fcod)) {
//				      	$(".fcod_postal").focus();
		//		          $("#falertacod_postal").fadeIn();
	//			          return false;
	//			      }else{
	//			      	$("#falertacod_postal").fadeOut();
//					      if (fcol == "") {
		//			      	$(".fcolonia").focus();
	//				          $("#falertacolonia").fadeIn();
	//				          return false;
	//				      }else{
//					      	$("#falertacolonia").fadeOut();
		//				      if (fcol == "") {
	//					      	$(".fcolonia").focus();
	//					          $("#falertacolonia").fadeIn();
	//					          return false;
//						      }else{
		//				      	$("#falertacolonia").fadeOut();
	//						      if (fcall == "") {
	//						      	$(".fcalle").focus();
	//						          $("#falertacalle").fadeIn();
//							          return false;
		//					      }else{
	//						      	$("#falertacalle").fadeOut();
	//							      if (fnum_e == "" || isNaN(fnum_e)) {
	//							      	$(".fnum_ext").focus();
//								          $("#falertanum_ext").fadeIn();
		//						          return false;
	//							      }else{
	//							      	$("#falertanum_ext").fadeOut();
	//								      if (fnum_i == "" || isNaN(fnum_i)){
//									      	$(".fnum_int").focus();
		//							          $("#falertanum_int").fadeIn();
	//								          return false;
	//								      }else{
	//								      	$("#falertanum_int").fadeOut();
//										      if (fref == "") {
		//								      	$(".freferencia").focus();
	//									          $("#falertaref").fadeIn();
	//									          return false;
	//									      }else{
//										      	$("#falertaref").fadeOut();
		//								      }
	//								      }
	//							      }
	//						      }
//						      }
		//			      }
	//			      }
	//	//	      }
	////	      }
//	  //    }
      //}
//

      //para validar la informacion bancaria


      //para la validacion de direccion fisica

  //    if (pais == "") {
  //    	$(".pais").focus();
  //        $("#alertp1").fadeIn();
  //        return false;
  //    }else{
  //    	$("#alertp1").fadeOut();
//	      if (est == "") {
//	      	$(".estado").focus();
	//          $("#alertaestado").fadeIn();
	//          return false;
	//      }else{
	//      	$("#alertaestado").fadeOut();
	//	      if (mun == "") {
	//	      	$(".municipio").focus();
//		          $("#alertamunicipio").fadeIn();
//		          return false;
	//	      }else{
	//	      	$("#alertamunicipio").fadeOut();
	//		      if (loc == "") {
	//		      	$(".localidad").focus();
	//		          $("#alertalocalidad").fadeIn();
	//		          return false;
//			      }else{
//			      	$("#alertalocalidad").fadeOut();
	//			      if (cod == "" || isNaN(cod)) {
	//			      	$(".cod_postal").focus();
	//			          $("#alertacod_postal").fadeIn();
	//			          return false;
	//			      }else{
	//			      	$("#alertacod_postal").fadeOut();
//					      if (col == "") {
//					      	$(".colonia").focus();
	//				          $("#alertacolonia").fadeIn();
	//				          return false;
	//				      }else{
	//				      	$("#alertacolonia").fadeOut();
	//				      	if (suc1 == "") {
	//				      		$(".sucursal1").focus();
//					      		$("#sucur1").fadeIn();
//					      	}else{
	//				      	$("#sucur1").fadeOut();
	//					      if (call == "") {
	//					      	$(".calle").focus();
	//					          $("#alertacalle").fadeIn();
	//					          return false;
	//					      }else{						   
//						      	$("#alertacalle").fadeOut();
//							      if (num_e == "" || isNaN(num_e)) {
	//						      	$(".num_ext").focus();
	//						          $("#alertanum_ext").fadeIn();
	//						          return false;
	//						      }else{
	//						      	$("#alertanum_ext").fadeOut();
	//							      if (num_i == "" || isNaN(num_i)) {
//								      	$(".num_int").focus();
//								          $("#alertanum_int").fadeIn();
	//							          return false;
	//							      }else{
	//							      	$("#alertanum_int").fadeOut();
	//								      if (ref == "") {
	//								      	$(".referencia").focus();
	//								          $("#alertaref").fadeIn();
//									          return false;
//									      }else{
	//								      	$("#alertaref").fadeOut();
	//								      }
	//							      }
	//						      }
	//					      }
	//				      }
//				      }
//			      }
//		      }
//	      }
  //    }
    //}
    });
});