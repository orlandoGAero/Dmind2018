import { Productos } from './productos.js';
const productos = new Productos();

const divCargar = document.querySelector('#cargando-res');
const formBuscar = document.querySelector('#formBuscarP');
const btnNuevo = document.querySelector('.addProducto');
const btnMostrarAll = document.querySelector('#mostrarTodo');
const ventanaPro = document.querySelector('#nuevoProd');
const fondoPro = document.querySelector('#fondoProd');
const tbProd = document.querySelector('#tablaProductos');

btnMostrarAll.addEventListener('click', async () => {
	divCargar.innerHTML = "<center class='img-car'><img src='../images/esperando.gif'/></center>";
	const data = await productos.mostrarTodaTabla();
	tbProd.innerHTML = data;
    productos.mostrarDataTb();
	const imgC = document.querySelector('.img-car');
	divCargar.removeChild(imgC);

	const thMoneda = document.querySelector('#thMon');

	if (tbProd.contains(document.querySelector('#precioDolares'))) {
		changeDolares(thMoneda);
	}

	if(tbProd.contains(document.querySelector('#precioPesos'))) {
		changePesos(thMoneda)
	}
});

formBuscar.addEventListener('submit', async (e) => {
	e.preventDefault();
	divCargar.innerHTML = await "<center class='img-car'><img src='../images/esperando.gif'/></center>";
	const datos = await productos.buscarProductos(formBuscar);
	tbProd.innerHTML = datos;
	productos.mostrarDataTb();
	const imgC = document.querySelector('.img-car');
	await divCargar.removeChild(imgC);

	const thMoneda = document.querySelector('#thMon');

	if (tbProd.contains(document.querySelector('#precioDolares'))) {
		changeDolares(thMoneda);
	}

	if(tbProd.contains(document.querySelector('#precioPesos'))) {
		changePesos(thMoneda);
	}
});

btnNuevo.addEventListener('click', async () => {
	const data = await productos.abrirNuevoP();
	ventanaPro.innerHTML = data;
	ventanaPro.style.display = 'block';
	fondoPro.style.display = 'block';

	const formProd = document.querySelector('#formProdAdd');
	const divRespuesta = document.querySelector('#guardarProd');

	formProd.addEventListener('submit', async (e) => {
		e.preventDefault();
		const resp = await productos.guardarProductos(formProd);
		divRespuesta.innerHTML = resp;

		const divError = divRespuesta.querySelector('.error');
		const divSuccess = divRespuesta.querySelector('.success');
		const cat = divRespuesta.querySelector('.cat');
		const sub = divRespuesta.querySelector('.sub');
		const div = divRespuesta.querySelector('.div');
		const nom = divRespuesta.querySelector('.nom');
		const tip = divRespuesta.querySelector('.tip');
		const mar = divRespuesta.querySelector('.mar');
		const mod = divRespuesta.querySelector('.mod');
		const pre = divRespuesta.querySelector('.pre');
		const mon = divRespuesta.querySelector('.mon');
		const uni = divRespuesta.querySelector('.uni');
		const Slcat = document.querySelector('.categoria');
		const Slsubcat = document.querySelector('.subcategoria');
		const Sldiv = document.querySelector('.division');
		const Slnom = document.querySelector('.nombre');
		const Sltip = document.querySelector('.tipo');
		const Slmar = document.querySelector('.marca');
		const Slmod = document.querySelector('.modelo');
		const Slpre = document.querySelector('.precio');
		const Sluni = document.querySelector('.unidad');
		const divAlert1 = document.querySelector('#alerta1');
		const divAlert2 = document.querySelector('#alerta2');
		const divAlert3 = document.querySelector('#alerta3');
		const divAlert4 = document.querySelector('#alerta4');
		const divAlert5 = document.querySelector('#alerta5');
		const divAlert6 = document.querySelector('#alerta6');
		const divAlert7 = document.querySelector('#alerta7');
		const divAlert8 = document.querySelector('#alerta8');
		const divAlert9 = document.querySelector('#alerta9');

		if (cat) {
			Slcat.focus();
			productos.fadeIn(divAlert1,'inline');
		} else {
			productos.fadeOut(divAlert1);
		}

		if (sub) {
			Slsubcat.focus();
			productos.fadeIn(divAlert2,'inline');
		} else {
			productos.fadeOut(divAlert2);
		}

		if (div) {
			Sldiv.focus();
			productos.fadeIn(divAlert3,'inline');
		} else {
			productos.fadeOut(divAlert3);
		}

		if (nom) {
			Slnom.focus();
			productos.fadeIn(divAlert4,'inline');
		} else {
			productos.fadeOut(divAlert4);
		}

		if (tip) {
			Sltip.focus();
			productos.fadeIn(divAlert5,'inline');
		} else {
			productos.fadeOut(divAlert5);
		}

		if (mar) {
			Slmar.focus();
			productos.fadeIn(divAlert6,'inline');
		} else {
			productos.fadeOut(divAlert6);
		}

		if (mod) {
			Slmod.focus();
			productos.fadeIn(divAlert7,'inline');
		} else {
			productos.fadeOut(divAlert7);
		}

		if (pre) {
			Slpre.focus();
			productos.fadeIn(divAlert8,'inline');
		} else {
			productos.fadeOut(divAlert8);
		}

		if (uni) {
			Sluni.focus();
			productos.fadeIn(divAlert9,'inline');
		} else {
			productos.fadeOut(divAlert9);
		}

		if (divError) {
			setTimeout(() => {
				productos.fadeOut(divError);
			},5000);
		} else if(divSuccess) {
			setTimeout(()=>{
				productos.fadeOut(divSuccess);
			},2000);
			setTimeout(() => {
				ventanaPro.style.display = 'none';
				fondoPro.style.display = 'none';
			},2800);
		}
	});
});

fondoPro.addEventListener('click', () => {
	ventanaPro.style.display = 'none';
	fondoPro.style.display = 'none';
});

function changeDolares(thM) {
	const btnDolar = document.getElementById('precioDolares');

	btnDolar.addEventListener('click', async () => {

		const data = await productos.cambiarMon(btnDolar);
		
		tbProd.innerHTML = data;
		productos.mostrarDataTb();
		
		thM.innerHTML = `<button title='Cambiar Precio a Pesos' id='precioPesos'>
								<img src="../images/moneda_mex.png">
							</button>`;
		changePesos(thM);

	});
}

function changePesos(thM) {
	const btnPesos = document.getElementById('precioPesos');
	btnPesos.addEventListener('click',async () => {


		const data = await productos.cambiarMon(btnPesos);
	
		tbProd.innerHTML = data;
		productos.mostrarDataTb();
		
		thM.innerHTML = `<button title='Cambiar Precio a Dólares' id='precioDolares'>
								<img src="../images/moneda_usa.png">
							</button>`;
		changeDolares(thM);

	});
}




