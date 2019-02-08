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

