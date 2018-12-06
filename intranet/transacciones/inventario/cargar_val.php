<?php
	require ('classInventario.php');
	$funInv = new Inventario();

	$estados = json_encode($funInv->getEstado());

	$ubicaciones = json_encode($funInv->getUbicacion());

	$serie = $_REQUEST['txt_serie'];
	$folio = $_REQUEST['txt_folio'];
	$idprov = $_REQUEST['txt_idprov'];
	$proveedor = $_REQUEST['txt_nomprov'];

	$idcat = $_REQUEST['txt_idcat'];
	$categorias = $_REQUEST['txt_categoria'];
	$idsub = $_REQUEST['txt_idsubcat']; 
	$subcategorias = $_REQUEST['txt_subcategoria'];
	$iddiv = $_REQUEST['txt_iddiv']; 
	$divisiones = $_REQUEST['txt_division'];
	$idnom = $_REQUEST['txt_idnom']; 
	$nombres = $_REQUEST['txt_nombre'];
	$idtip = $_REQUEST['txt_idtip']; 
	$tipos = $_REQUEST['txt_tipo'];
	$idmar = $_REQUEST['txt_idmar']; 
	$marcas = $_REQUEST['txt_marca'];
	$idpro = $_REQUEST['txt_idpro'];
	$modelos = $_REQUEST['txt_modelo'];
	$cantidad = $_REQUEST['txt_cantidad'];
	$checkA = $_REQUEST['agregar'];
	$tiene = $_REQUEST['serie'];
	
	$cantSel = count($checkA);

	if (isset($serie) && isset($folio) && isset($proveedor) && isset($idprov) 
		&& isset($idcat) && isset($categorias) && isset($idsub) && isset($subcategorias) 
		&& isset($iddiv) && isset($divisiones) && isset($idnom) && isset($nombres) 
		&& isset($idtip) && isset($tipos) && isset($idmar) && isset($marcas)
		&& isset($idpro) && isset($modelos) && isset($cantidad) 
		&& isset($checkA) && isset($tiene)
	) : ?>
	<style>
		.productosC {
			padding: 1.3rem;
		}

		.alinearC {
			display: flex;
			flex-direction: row;
			
		}

		.tamanioC {
			width: 50%;
			text-align: left;
			margin-bottom: 3px;
		}

		.pestanas {
			overflow: hidden;
		}

		.pestanas button {
			background-color: #259caf;
			float: left;
			border: none;
			outline: none;
			cursor: pointer;
			padding: 14px 6px;
			font-weight: bold;
			transition: 0.3s;

		}

		.pestanas button:hover {
			background-color: #25afa1;
			font-weight: bold;
		}

		.pestanas button.active {
			background-color: #045765;
			font-weight: bold;
			color: #fff;
		}

		.tabContenido {
			display: none;
			border: 3px solid #045765;
		}
	</style>
		<script type='text/javascript'>
				$(document).ready(function(){

					let numConceptos = <?=$cantSel?>;

					$('#txt_f').val('<?=$_REQUEST['txt_serie'].$_REQUEST['txt_folio']?>');
					
					let prov = $('#proveedor');
					prov.find('option').remove();
					prov.append(`<option value='<?=$idprov?>' selected><?=$proveedor?></option>`);
					
					let cargarIdCats = (indice) => {

						let check = <?= json_encode($checkA) ?>;
						let categoriasid = <?= json_encode($idcat) ?>;

						let id_cat = '';
						Object.keys(check).map((key) => {
							id_cat += `${categoriasid[key]},`;
						});

						catIdCon = id_cat.split(',');
						catIdCon.pop();

						return catIdCon[indice];

					}

					let cargarCats = (indice) => {

						let check = <?= json_encode($checkA) ?>;
						let categorias = <?= json_encode($categorias) ?>;

						let nom_cat = '';
						Object.keys(check).map((key) => {
							nom_cat += `${categorias[key]},`;
						});

						catCon = nom_cat.split(',');
						catCon.pop();

						return catCon[indice];

					}

					let cargarIdSubcats = (indice) => {

						let check = <?= json_encode($checkA) ?>;
						let subcatsId = <?= json_encode($idsub) ?>;

						let id_subcat = '';
						Object.keys(check).map((key) => {
							id_subcat += `${subcatsId[key]},`;
						});

						subIdCon = id_subcat.split(',');
						subIdCon.pop();

						return subIdCon[indice];

					}

					let cargarSubcats = (indice) => {

						let check = <?= json_encode($checkA) ?>;
						let subcategorias = <?= json_encode($subcategorias) ?>;

						let nom_sub = '';
						Object.keys(check).map((key) => {
							nom_sub += `${subcategorias[key]},`;
						});

						subCon = nom_sub.split(',');
						subCon.pop();

						return subCon[indice];

					}
					
					let cargarIdDivs = (indice) => {

						let check = <?= json_encode($checkA) ?>;
						let divs_id = <?= json_encode($iddiv) ?>;
							
						let id_div = '';
						Object.keys(check).map((key) => {
							id_div += `${divs_id[key]},`;
						});

						divIdCon = id_div.split(',');
						divIdCon.pop();

						return divIdCon[indice];

					}

					let cargarDivs = (indice) => {

						let check = <?= json_encode($checkA) ?>;
						let divs = <?= json_encode($divisiones) ?>;
						
						let nom_div = '';
						Object.keys(check).map((key) => {
							nom_div += `${divs[key]},`;
						});

						divCon = nom_div.split(',');
						divCon.pop();

						return divCon[indice];

					}

					let cargarIdNom = (indice) => {

						let check = <?= json_encode($checkA) ?>;
						let nom_id = <?= json_encode($idnom) ?>;
							
						let id_nom = '';
						Object.keys(check).map((key) => {
							id_nom += `${nom_id[key]},`;
						});

						nomIdCon = id_nom.split(',');
						nomIdCon.pop();

						return nomIdCon[indice];

					}

					let cargarNom = (indice) => {

						let check = <?= json_encode($checkA) ?>;
						let nombres = <?= json_encode($nombres) ?>;
						
						let nom = '';
						Object.keys(check).map((key) => {
							nom += `${nombres[key]},`;
						});

						nomCon = nom.split(',');
						nomCon.pop();

						return nomCon[indice];

					}

					let cargarIdTipos = index => {

						let check = <?= json_encode($checkA) ?>;
						let tiposid = <?= json_encode($idtip) ?>;

						let id_tip = '';
						Object.keys(check).map(key => {
							id_tip += `${tiposid[key]},`;
						});

						tipoIdCon = id_tip.split(',');
						tipoIdCon.pop();

						return tipoIdCon[index];
					}

					let cargarTipos = (indice) => {

						let check = <?= json_encode($checkA) ?>;
						let tipos = <?= json_encode($tipos) ?>;
						
						let nom_tip = '';
						Object.keys(check).map((key) => {
							nom_tip += `${tipos[key]},`;
						});

						tipoCon = nom_tip.split(',');
						tipoCon.pop();
						
						return tipoCon[indice];
						
					}

					let cargarIdMar = (indice) => {

						let check = <?= json_encode($checkA) ?>;
						let mar_id = <?= json_encode($idmar) ?>;
							
						let id_mar = '';
						Object.keys(check).map((key) => {
							id_mar += `${mar_id[key]},`;
						});

						marIdCon = id_mar.split(',');
						marIdCon.pop();

						return marIdCon[indice];

					}

					let cargarMar = (indice) => {

						let check = <?= json_encode($checkA) ?>;
						let marcas = <?= json_encode($marcas) ?>;

						let nom_marca = '';
						Object.keys(check).map((key) => {
							nom_marca += `${marcas[key]},`;
						});

						marCon = nom_marca.split(',');
						marCon.pop();

						return marCon[indice];

					}

					let cargarIdPro = (indice) => {

						let check = <?= json_encode($checkA) ?>;
						let prod_id = <?= json_encode($idpro) ?>;
							
						let id_prod = '';
						Object.keys(check).map((key) => {
							id_prod += `${prod_id[key]},`;
						});

						prodIdCon = id_prod.split(',');
						prodIdCon.pop();

						return prodIdCon[indice];

					}

					let cargarMod = (indice) => {

						let check = <?= json_encode($checkA) ?>;
						let modelos = <?= json_encode($modelos) ?>;
						
						let nom_modelo = '';
						Object.keys(check).map((key) => {
							nom_modelo += `${modelos[key]},`;
						});

						modeloCon = nom_modelo.split(',');
						modeloCon.pop();

						return modeloCon[indice];

					}

					let cargarCantidad = (indice) => {

						let check = <?= json_encode($checkA) ?>;
						let cantidad = <?= json_encode($cantidad) ?>;
						
						let cant = '';
						Object.keys(check).map((key) => {
							cant += `${cantidad[key]},`;
						});

						cantCon = cant.split(',');
						cantCon.pop();
						
						return cantCon[indice];

					}

					let validarSerie = (indice) => {

						let check = <?= json_encode($checkA) ?>;
						let tiene = <?= json_encode($tiene) ?>;
						
						let serie = '';
						Object.keys(check).map((key) => {
							serie += `${tiene[key]},`;
						});

						serieCon = serie.split(',');
						serieCon.pop();

						return serieCon[indice];

					}

					let agregarForm = () => {
						let html = '';

						let numCon = <?=$cantSel?>;
						
						if(numCon > 1) {

							html = `<div class='remover'>
								<p class='productosC'>Se agregaron <b>${ numCon }</b> Conceptos</p>`;
						} else {
							html = `<div class='remover'>
								<p class='productosC'>Se agrego <b>${ numCon }</b> Concepto</p>`;
						}

						html += `
								<div class='pestanas'>`;
						
						for(let i = 1; i <= numCon; i++) {	
							html += `
								<button class='tablinks' onclick='return false;' id='btn-pestana${i}'>Concepto ${i}</button>
									`;
						}

						html += `</div>`;

						for(let i = 1; i <= numCon; i++) {
							
							html += `

								
								<div class='productosC tabContenido' id='pestana${i}'>
								
									<p><b>PRODUCTO</b></p>

									<div class='alinearC'>
										<label class='tamanioC'>Categoría:</label>
										<label class='tamanioC'>Subcategoría:</label>
									</div>

									<div class='alinearC'>
										<div class='tamanioC'>
											<select id="categoria[${i}]" required>
												<option value='${cargarIdCats(i-1)}'>${cargarCats(i-1)}</option>
											</select>
										</div>
										<div class='tamanioC'>
											<select id="subcategoria[${i}]" required>
												<option value='${cargarIdSubcats(i-1)}'>${cargarSubcats(i-1)}</option>
											</select>
										</div>
									</div>

									<div class='alinearC'>
										<label class='tamanioC'>División:</label>
										<label class='tamanioC'>Nombre:</label>
									</div>

									<div class='alinearC'>
										<div class='tamanioC'>
											<select id="division[${i}]" required>
												<option value='${cargarIdDivs(i-1)}'>${cargarDivs(i-1)}</option>
											</select>
										</div>
										<div class='tamanioC'>
											<select id="nombres[${i}]" required>
												<option value='${cargarIdNom(i-1)}'>${cargarNom(i-1)}</option>
											</select>
										</div>
									</div>

									<div class='alinearC'>
										<label class='tamanioC'>Tipo:</label>
										<label class='tamanioC'>Marca:</label>
									</div>

									<div class='alinearC'>
										<div class='tamanioC'>
											<select id="tipos[${i}]" required>
												<option value='${cargarIdTipos(i-1)}'>${cargarTipos(i-1)}</option>
											</select>
										</div>

										<div class='tamanioC'>	
											<select id="marcas[${i}]" required>
												<option value='${cargarIdMar(i-1)}'>${cargarMar(i-1)}</option>
											</select> 
										</div>
									</div>

									<div class='alinearC'>
										<label class='tamanioC'>Modelo:</label>
									</div>

									<div class='alinearC'>
										<div class='tamanioC'>
											<select id="modelos[${i}]" class="producto" name="idProducto" required>
												<option value='${cargarIdPro(i-1)}'>${cargarMod(i-1)}</option>
											</select>
										</div>
									</div>
									
									<div class='alinearC'>
										<label class='tamanioC'>No. Serie:</label>`;

							if ( validarSerie(i-1) == 'No') {
								html += `<label class='tamanioC'>Cantidad:</label>`;
							}

							html += `</div>

									<div class='alinearC'>
										<div class='tamanioC'>`;

										if ( validarSerie(i-1) == 'No') {
											html += `<div id="inputBoton${i}">
														<input type="text" name="noSerie[${i}]" maxlength="14" required class="inputOculto mSerie" id="serie${i}" />
														<img src="../../images/barcode-32.png" title="Generar No. Serie Interno" id="bntInterno${i}" class="bntInterno pointer mt3"/>
													</div>`;
										} else if( validarSerie(i-1) == 'Si') {
											let cantP = cargarCantidad(i-1);
											for(let j = 1; j <= cantP; j++) {

												html += `<div id="inputBoton${i}">
															<input type="text" name="noSerie[${j}]" placeholder="Número de Serie (${j})" maxlength="14" required style="margin-bottom: 2px;"  class="inputOculto mSerie" />
														</div>`;
											}
										}
							html += `</div>`;

							if ( validarSerie(i-1) == 'No') {
								html += `	
										<div class='tamanioC'>
											<div>
												<input type="text" name="txtCantidad[${i}]" id="cantidad" class="numbers" value="${cargarCantidad(i-1)}" min="0" max="999" maxlength="3" style="width:25px; height:16px; " readonly>
											</div>
										</div>`;
							}

							html += `
								</div>
									<div class='alinearC'>
										<label class='tamanioC'>Pedido de importación:</label>
										<label class='tamanioC'>Color:</label>
									</div>

									<div class='alinearC'>
										<div class='tamanioC'>
											<div id="inputBoton">
												<input type="text" class="inputOculto mPImport" id="txt_pi${i}" name="pedidoImportacion[${i}]" maxlength="35" required/>
												<img src="../../images/notapplies-24.png" title="N/A" id="btnPedImport${i}" class="btnPedImport pointer mt6">
											</div> 
										</div>
										<div class='tamanioC'>
											<input type="text" name="color" style="height:27px;" />
										</div>
									</div>

									<div class='alinearC'>
										<label class='tamanioC'>Estado:</label>
										<label class='tamanioC'>Ubicación:</label>
									</div>

									<div class='alinearC'>
										<div class='tamanioC'>
											<select name="idEstado[${i}]" required>
												<option value="" selected>Selecciona Estado</option>`;
												let estados = <?= $estados ?>;
												estados.forEach((data) => {
													let {id_estado, nombre_estado} = data;
													html += `<option value='${id_estado}'>${nombre_estado}</option>`
												});
							html += `		</select>
										</div>
										<div class='tamanioC'>
											<select name="idUbicacion[${i}]" required>
												<option value="" selected>Selecciona Ubicación</option>`;
												let ubicaciones = <?= $ubicaciones?>;
												ubicaciones.forEach((data) => {
													let {id_ubicacion, nombre_ubicacion} = data;
													html += `<option value='${id_ubicacion}'>${nombre_ubicacion}</option>`;
												});
							html += `		</select>
										</div>
									</div>
								</div>`;
							
								
						}
						
						html += '</div>';

						return html;	

					}
					
					$('.remover').replaceWith(agregarForm());
					
					let abrirConcepto = (evt,conceptoNom) => {
						let i, tabcontent, tablinks;

						tabcontent = document.getElementsByClassName("tabContenido");
						for(i = 0; i < tabcontent.length; i++) {
							tabcontent[i].style.display = "none";
						}

						tablinks = document.getElementsByClassName("tablinks");
						for(i = 0; i < tablinks.length; i++) {
							tablinks[i].className = tablinks[i].className.replace(" active", "");
						}

						document.getElementById(conceptoNom).style.display = "block";
						evt.currentTarget.className += " active";

					}
					
					for(let i = 1; i <= numConceptos; i++) {	
						$(`#btn-pestana${i}`).click(function(){
							abrirConcepto(event,`pestana${i}`);
						});
					

						$(`#bntInterno${i}`).click(function() {
							var numSerieInterno = 0;
							$.post('generar_noserie_interno.php', {numSerieInterno}, function(obtenerFecha) {
								$(`#serie${i}`).val(obtenerFecha);
							});
						});

						$(`#btnPedImport${i}`).click(function(){
							$(`#txt_pi${i}`).val('N/A');
						});
					}

				});
				</script>
			<?php endif; ?>



			