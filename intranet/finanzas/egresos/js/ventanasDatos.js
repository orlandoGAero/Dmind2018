// -------- CATEGORIA
let nuevaCat = () => {
    document.getElementById('ventanaFondoCat').style.display='block';
    document.getElementById('nuevaCat').style.display='block';
    $.ajax("datos/agregarCat.php", {
        type: 'POST',
        success: function(res) {
            document.getElementById('nuevaCat').innerHTML = res;
        }
    });
}

let guardarCat = () => {
	let formCat = document.getElementById('formCat');
	let valorCat = formCat.elements["txtNameCatProd"].value;

	$.ajax("../../configuracion/productos/categorias/guardar_categoriap.php", {
        type: 'POST',
        data: {txtNameCatProd: valorCat},

        success: function(res) {
            document.getElementById('resultCat').innerHTML = res;

            let existeError = document.getElementsByClassName('errorConfig').length;
            let existeWar = document.getElementsByClassName('captionConfig').length;
			
            if (existeError === 0 && existeWar === 0) {

            	cerrarCat();
            	
            	$.get("datosSelCat.php", function(htmlexterno){
						$("#selectCat").html(htmlexterno);
				});
            }
        }
    });

    

}

let cerrarCat = () => {
    document.getElementById('nuevaCat').style.display='none';
    document.getElementById('ventanaFondoCat').style.display='none';
}

// -------- SUBCATEGORIA
let nuevaSubCat = () => {
    document.getElementById('ventanaFondoSub').style.display='block';
    document.getElementById('nuevaSub').style.display='block';
    $.ajax("datos/agregarSub.php", {
        type: 'POST',
        success: function(res) {
            document.getElementById('nuevaSub').innerHTML = res;
        }
    });
}

let guardarSub = () => {
	let formSub = document.getElementById('formSub');
	let valorSub = formSub.elements["txtNameSubcatProd"].value;

	$.ajax("../../configuracion/productos/subcategorias/guardar_subcategoriap.php", {
        type: 'POST',
        data: {txtNameSubcatProd: valorSub},

        success: function(res) {
            document.getElementById('resultSub').innerHTML = res;

            let existeError = document.getElementsByClassName('errorConfig').length;
            let existeWar = document.getElementsByClassName('captionConfig').length;

            if (existeError === 0 && existeWar === 0) {

            	cerrarSub();
            	
            	$.get("datosSelSub.php", function(htmlexterno){
						$("#selectSub").html(htmlexterno);
				});
            }
        }
    });
}

let cerrarSub = () => {
    document.getElementById('nuevaSub').style.display='none';
    document.getElementById('ventanaFondoSub').style.display='none';
}

// ---------- DIVISION
let nuevaDiv = () => {
    document.getElementById('ventanaFondoDiv').style.display='block';
    document.getElementById('nuevaDiv').style.display='block';
    $.ajax("datos/agregarDiv.php", {
        type: 'POST',
        success: function(res) {
            document.getElementById('nuevaDiv').innerHTML = res;
        }
    });
}

let guardarDiv = () => {
	let formDiv = document.getElementById('formDiv');
	let valorDiv = formDiv.elements["txtNameDivProd"].value;

	$.ajax("../../configuracion/productos/divisiones/guardar_divisionp.php", {
        type: 'POST',
        data: {txtNameDivProd: valorDiv},

        success: function(res) {
            document.getElementById('resultDiv').innerHTML = res;

            let existeError = document.getElementsByClassName('errorConfig').length;
            let existeWar = document.getElementsByClassName('captionConfig').length;

            if (existeError === 0 && existeWar === 0) {

            	cerrarDiv();
            	
            	$.get("datosSelDiv.php", function(htmlexterno){
						$("#selectDiv").html(htmlexterno);
				});
            }
        }
    });
}

let cerrarDiv = () => {
    document.getElementById('nuevaDiv').style.display='none';
    document.getElementById('ventanaFondoDiv').style.display='none';
}

// ---------- NOMBRE

let nuevoNom = () => {
    document.getElementById('ventanaFondoNom').style.display='block';
    document.getElementById('nuevaNom').style.display='block';
    $.ajax("datos/agregarNom.php", {
        type: 'POST',
        success: function(res) {
            document.getElementById('nuevaNom').innerHTML = res;
        }
    });
}

let guardarNom = () => {
	let formNom = document.getElementById('formNom');
	let valorNom = formNom.elements["txtNomProd"].value;

	$.ajax("../../configuracion/productos/nombres/guardar_nombrep.php", {
        type: 'POST',
        data: {txtNomProd: valorNom},

        success: function(res) {
            document.getElementById('resultNom').innerHTML = res;

            let existeError = document.getElementsByClassName('errorConfig').length;
            let existeWar = document.getElementsByClassName('captionConfig').length;

            if (existeError === 0 && existeWar === 0) {

            	cerrarNom();
            	
            	$.get("datosSelNom.php", function(htmlexterno){
						$("#selectNom").html(htmlexterno);
				});
            }
        }
    });
}

let cerrarNom = () => {
    document.getElementById('nuevaNom').style.display='none';
    document.getElementById('ventanaFondoNom').style.display='none';
}

// --------- TIPO
let nuevoTip = () => {
    document.getElementById('ventanaFondoTip').style.display='block';
    document.getElementById('nuevaTip').style.display='block';
    $.ajax("datos/agregarTip.php", {
        type: 'POST',
        success: function(res) {
            document.getElementById('nuevaTip').innerHTML = res;
        }
    });
}

let guardarTip = () => {
	let formTip = document.getElementById('formTip');
	let valorTip = formTip.elements["txtTipProd"].value;

	$.ajax("../../configuracion/productos/tipos/guardar_tipop.php", {
        type: 'POST',
        data: {txtTipProd: valorTip},

        success: function(res) {
            document.getElementById('resultTip').innerHTML = res;

            let existeError = document.getElementsByClassName('errorConfig').length;
            let existeWar = document.getElementsByClassName('captionConfig').length;

            if (existeError === 0 && existeWar === 0) {

            	cerrarTip();
            	
            	$.get("datosSelTip.php", function(htmlexterno){
						$("#selectTip").html(htmlexterno);
				});
            }
        }
    });
}

let cerrarTip = () => {
    document.getElementById('nuevaTip').style.display='none';
    document.getElementById('ventanaFondoTip').style.display='none';
}

// --------- Marca
let nuevaMar = () => {
    document.getElementById('ventanaFondoMar').style.display='block';
    document.getElementById('nuevaMar').style.display='block';
    $.ajax("datos/agregarMar.php", {
        type: 'POST',
        success: function(res) {
            document.getElementById('nuevaMar').innerHTML = res;
        }
    });
}

let guardarMar = () => {
	let formMar = document.getElementById('formMar');
	let valorMar = formMar.elements["txtNameMarca"].value;

	$.ajax("../../configuracion/productos/marcas/guardar_marca.php", {
        type: 'POST',
        data: {txtNameMarca: valorMar},

        success: function(res) {
            document.getElementById('resultMar').innerHTML = res;

            let existeError = document.getElementsByClassName('errorConfig').length;
            let existeWar = document.getElementsByClassName('captionConfig').length;

            if (existeError === 0 && existeWar === 0) {

            	cerrarMar();
            	
            	$.get("datosSelMar.php", function(htmlexterno){
						$("#selectMar").html(htmlexterno);
				});
            }
        }
    });
}

let cerrarMar = () => {
    document.getElementById('nuevaMar').style.display='none';
    document.getElementById('ventanaFondoMar').style.display='none';
}

// ------ Concepto
// document.getElementById("guar").addEventListener("click", function(event){
//   event.preventDefault()
// 	console.log('click nuevo con')
// });
let nuevoCon = () => {
	document.getElementById('fondoCon').style.display='block';
    document.getElementById('nuevoCon').style.display='block';

    let btnConReg = document.getElementById('btnCon').name;

    if (btnConReg === 'btnConceptoR') {
    	 $.ajax("datos/agregarCon.php", {
	        type: 'POST',
	        success: function(res) {
	            document.getElementById('nuevoCon').innerHTML = res;
	        }
	    });
    } else {

	    let valorIdE = document.getElementById('btnCon').value ;

	    $.ajax("datos/agregarCon.php", {
	        type: 'POST',
	        data: {idE: valorIdE},
	        success: function(res) {
	            document.getElementById('nuevoCon').innerHTML = res;
	        }
	    });
    }

}

let agregarCon = () => {
	let formCon = document.getElementById('form_con');
	let valorCon = formCon.elements["nom_con"].value;
	let valorIdEg = formCon.elements["txt_idEg"].value;

	$.ajax("../../configuracion/finanzas/egresos/conceptos/guardar_concepto.php", {
        type: 'POST',
        data: {nom_con: valorCon},

        success: function(res) {
            document.getElementById('resultCon').innerHTML = res;

            let existeError = document.getElementsByClassName('errorConfig').length;
            let existeWar = document.getElementsByClassName('captionConfig').length;

            if (existeError === 0 && existeWar === 0) {

            	cerrarCon();

            	if (valorIdEg === 'registrarC') {
            		$.get("datosSelConReg.php", function(htmlexterno){
						$("#selectCon").html(htmlexterno);
					});
            	} else {

	            	$.get("datosSelCon.php", {idE: valorIdEg},function(htmlexterno){
						$("#selectCon").html(htmlexterno);
					});
            	}
            }
        }
    });
}

let cerrarCon = () => {
    document.getElementById('nuevoCon').style.display='none';
    document.getElementById('fondoCon').style.display='none';
}

// ------Clasificacion

let nuevaCla = () => {
	document.getElementById('fondoCla').style.display='block';
    document.getElementById('nuevoCla').style.display='block';

    let btnClaReg = document.getElementById('btnCla').name;

    if (btnClaReg === 'btnClasificacionR') {
    	$.ajax("datos/agregarCla.php", {
	        type: 'POST',
	        success: function(res) {
	            document.getElementById('nuevoCla').innerHTML = res;
	        }
	    });
    } else {

    	let valorIdE = document.getElementById('btnCla').value ;

	    $.ajax("datos/agregarCla.php", {
	        type: 'POST',
	        data: {idE: valorIdE},
	        success: function(res) {
	            document.getElementById('nuevoCla').innerHTML = res;
	        }
	    });
	}
}

let agregarCla = () => {
	let formCla = document.getElementById('form_cla');
	let valorCla = formCla.elements["nom_cl"].value;
	let valorIdEg = formCla.elements["txt_idEg"].value;

	$.ajax({
		url: "../../configuracion/finanzas/egresos/clasificaciones/guardar_clasificacion.php",
        type: 'POST',
        data: {nom_cl: valorCla},

        success: function(res) {
            document.getElementById('resultCla').innerHTML = res;

            let existeError = document.getElementsByClassName('errorConfig').length;
            let existeWar = document.getElementsByClassName('captionConfig').length;

            if (existeError === 0 && existeWar === 0) {

            	cerrarCla();
            	
            	if (valorIdEg === 'registrarCla') {
            		$.get("datosSelClaReg.php", function(htmlexterno){
						$("#selectCla").html(htmlexterno);
					});
            	} else {
	            	$.get("datosSelCla.php", {idE: valorIdEg},function(htmlexterno){
						$("#selectCla").html(htmlexterno);
					});
            	}
            }
        }
    });
}

let cerrarCla = () => {
    document.getElementById('nuevoCla').style.display='none';
    document.getElementById('fondoCla').style.display='none';
}

// ---------- Status
let nuevoSta = () => {
	document.getElementById('fondoSta').style.display='block';
    document.getElementById('nuevoSta').style.display='block';

    let btnStaReg = document.getElementById('btnSta').name;

    if (btnStaReg === 'btnStatusR') {
    	$.ajax("datos/agregarSta.php", {
	        type: 'POST',
	        success: function(res) {
	            document.getElementById('nuevoSta').innerHTML = res;
	        }
	    });
    } else {

	    let valorIdE = document.getElementById('btnSta').value ;

	    $.ajax("datos/agregarSta.php", {
	        type: 'POST',
	        data: {idE: valorIdE},
	        success: function(res) {
	            document.getElementById('nuevoSta').innerHTML = res;
	        }
	    });
    }
}

let agregarSta = () => {
	let formSta = document.getElementById('form_st');
	let valorSta = formSta.elements["nom_status"].value;
	let valorIdEg = formSta.elements["txt_idEg"].value;

	$.ajax({
		url: "../../configuracion/finanzas/egresos/status/guardar_status.php",
        type: 'POST',
        data: {nom_status: valorSta},

        success: function(res) {
            document.getElementById('resultSta').innerHTML = res;

            let existeError = document.getElementsByClassName('errorConfig').length;
            let existeWar = document.getElementsByClassName('captionConfig').length;

            if (existeError === 0 && existeWar === 0) {

            	cerrarSta();
            	
            	if (valorIdEg === 'registrarSta') {
            		$.get("datosSelStaReg.php", function(htmlexterno){
						$("#selectSta").html(htmlexterno);
					});
            	} else {
	            	$.get("datosSelSta.php", {idE: valorIdEg},function(htmlexterno){
						$("#selectSta").html(htmlexterno);
					});
            	}
            }
        }
    });
}

let cerrarSta = () => {
    document.getElementById('nuevoSta').style.display='none';
    document.getElementById('fondoSta').style.display='none';
}

// -------- Origen
let nuevoOri = () => {
	document.getElementById('fondoOri').style.display='block';
    document.getElementById('nuevoOri').style.display='block';

    let btnOriReg = document.getElementById('btnOri').name;

    if (btnOriReg === 'btnOrigenR') {
    	$.ajax("datos/agregarOri.php", {
	        type: 'POST',
	        success: function(res) {
	            document.getElementById('nuevoOri').innerHTML = res;
	        }
	    });
    } else {
	    let valorIdE = document.getElementById('btnOri').value ;

	    $.ajax("datos/agregarOri.php", {
	        type: 'POST',
	        data: {idE: valorIdE},
	        success: function(res) {
	            document.getElementById('nuevoOri').innerHTML = res;
	        }
	    });
    }
}

let agregarOri = () => { 
	let formOri = document.getElementById('form_or');
	let valorOri = formOri.elements["nom_ori"].value;
	let valorIdEg = formOri.elements["txt_idEg"].value;

	$.ajax({
		url: "../../configuracion/finanzas/egresos/origenes/guardar_origen.php",
        type: 'POST',
        data: {nom_ori: valorOri},

        success: function(res) {
            document.getElementById('resultOri').innerHTML = res;

            let existeError = document.getElementsByClassName('errorConfig').length;
            let existeWar = document.getElementsByClassName('captionConfig').length;

            if (existeError === 0 && existeWar === 0) {

            	cerrarOri();
            	
            	if (valorIdEg === 'registrarOri') {
            		$.get("datosSelOriReg.php", function(htmlexterno){
						$("#selectOri").html(htmlexterno);
					});
            	} else {
	            	$.get("datosSelOri.php", {idE: valorIdEg},function(htmlexterno){
						$("#selectOri").html(htmlexterno);
					});
            	}
            }
        }
    });
}

let cerrarOri = () => {
    document.getElementById('nuevoOri').style.display='none';
    document.getElementById('fondoOri').style.display='none';
}

// --------- Destino
let nuevoDes = () => {
	document.getElementById('fondoDes').style.display='block';
    document.getElementById('nuevoDes').style.display='block';

    let btnDesReg = document.getElementById('btnDes').name;

    if (btnDesReg === 'btnDestinoR') {
    	$.ajax("datos/agregarDes.php", {
	        type: 'POST',
	        success: function(res) {
	            document.getElementById('nuevoDes').innerHTML = res;
	        }
	    });
    } else {
	    let valorIdE = document.getElementById('btnDes').value ;

	    $.ajax("datos/agregarDes.php", {
	        type: 'POST',
	        data: {idE: valorIdE},
	        success: function(res) {
	            document.getElementById('nuevoDes').innerHTML = res;
	        }
	    });
    }
}

let agregarDes = () => {
	let formDes = document.getElementById('form_des');
	let valorDes = formDes.elements["nom_des"].value;
	let valorIdEg = formDes.elements["txt_idEg"].value;

	$.ajax({
		url: "../../configuracion/finanzas/egresos/destinos/guardar_destino.php",
        type: 'POST',
        data: {nom_des: valorDes},

        success: function(res) {
            document.getElementById('resultDes').innerHTML = res;

            let existeError = document.getElementsByClassName('errorConfig').length;
            let existeWar = document.getElementsByClassName('captionConfig').length;

            if (existeError === 0 && existeWar === 0) {

            	cerrarDes();

            	if (valorIdEg === 'registrarDes') {
            		$.get("datosSelDesReg.php", function(htmlexterno){
						$("#selectDes").html(htmlexterno);
					});
            	} else {
	            	$.get("datosSelDes.php", {idE: valorIdEg},function(htmlexterno){
						$("#selectDes").html(htmlexterno);
					});
            	}
            }
        }
    });
}

let cerrarDes = () => {
    document.getElementById('nuevoDes').style.display='none';
    document.getElementById('fondoDes').style.display='none';
}



