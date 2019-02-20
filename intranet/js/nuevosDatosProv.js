
let nuevaCatProv = () => {
	document.getElementById('fondoCatProv').style.display='block';
    document.getElementById('nuevoCatProv').style.display='block';

    let btnCtPvReg = document.getElementById('btnCatProv').name;

    if (btnCtPvReg === 'btnCatProvReg') {
    	$.ajax("datos/agregarCatPv.php", {
	        type: 'POST',
	        success: function(res) {
	            document.getElementById('nuevoCatProv').innerHTML = res;
	        }
	    });
    } else if (btnCtPvReg == 'btnCatProvMod') {
    	let valorIdPv = document.getElementById('btnCatProv').value;
    	
    	$.ajax("datos/agregarCatPv.php", {
	        type: 'POST',
	        data: {idPv: valorIdPv},
	        success: function(res) {
	            document.getElementById('nuevoCatProv').innerHTML = res;
	        }
	    });
    }
}

let guardarCatPv = () => {
	let formCPv = document.getElementById('form_catProv');
	let valorCPv = formCPv.elements["txtNameCatProv"].value;
	let valorIdPv = formCPv.elements["txt_idPv"].value;

	$.ajax("../configuracion/proveedores/categorias-proveedor/guardar_categoria_proveedor.php", {
        type: 'POST',
        data: {txtNameCatProv: valorCPv},
        success: function(res) {
			document.getElementById('resultCpv').innerHTML = res;

            let existeError = document.getElementsByClassName('errorConfig').length;
            let existeWar = document.getElementsByClassName('captionConfig').length;

            if (existeError === 0 && existeWar === 0) {
            	cerrarCatProv();

            	if (valorIdPv === 'registrarCPv') {
	            	$.get("datosSelCatPvReg.php", function(htmlexterno){
						$("#selectCatPv").html(htmlexterno);
					});
            	} else {
            		
					$.get("datosSelCatPvMod.php", {idPv: valorIdPv},function(htmlexterno){
						$("#selectCatPv").html(htmlexterno);
					});
            	}

            }

        }
    });
}

let cerrarCatProv = () => {
	document.getElementById('nuevoCatProv').style.display='none';
    document.getElementById('fondoCatProv').style.display='none';
}