<?php 
	require_once 'classProductos.php'; 
	$productos = new Productos;	
?>
<center>
	<form action="" method="POST" target="_self" id="formProdAdd">
		<h2 style="box-shadow:0px -1px 1px;width:565px;background:#16555B; color:white;border-top-right-radius:10px;border-top-left-radius:10px;">NUEVO PRODUCTO</h2>
		<div style="width:520px;background:#fff; text-align:left;padding:20px 20px 1px 25px;">
			<table style="width: auto;"> 
				<tr>
					<td><label>Categoría</label></td>
					<td>
						<select name="id_categoria" class="categoria">
							<option value="0">Elige</option>		
							<?php 
								$categorias = $productos->getCategorias();
								foreach($categorias as $categoria) :
							?>
									<option value='<?=$categoria['id_categoria']?>'><?=$categoria['nombre_categoria']?></option>
							
							<?php endforeach; ?>
						</select>
					</td>
					<td><spam id="alerta1" class="errores">Selecciona categoria</spam><br></td>
				</tr>
				<tr>
					<td><label>Subcategoría</label></td>
					<td>
						<select name="id_subcategoria" class="subcategoria">
							<option value="0">Elige</option>		
							<?php
								$subcategorias = $productos->getSubCategorias();
								foreach($subcategorias as $subcategoria) :
							?>
									<option value='<?=$subcategoria['id_subcategoria']?>'><?=$subcategoria['nombre_subcategoria']?></option>
							<?php endforeach; ?>
						</select>
					</td>
					<td><spam id="alerta2" class="errores">Selecciona subcategoria</spam><br></td>
				</tr>
				<tr>
					<td><label>División:</label></td>
					<td>
						<select name="id_division" class="division">
							<option value="0">Elige</option>		
							<?php
								 $divisiones = $productos->getDivisiones();
								 foreach($divisiones as $division) :
							?>
									<option value='<?=$division['id_division']?>'><?=$division['nombre_division']?></option>		
							<?php endforeach;?>
						</select>
					</td>
					<td><spam id="alerta3" class="errores">Selecciona división</spam><br><td>
				</tr>
				<tr>
					<td><label>Nombre :</label></td>
					<td>
						<select name="id_nombre" class="nombre">
							<option value="0">Elige</option>		
							<?php
								 $nombres = $productos->getNombres();
								 foreach($nombres as $nombre) :
							?>
									<option value='<?=$nombre['id_nombre']?>'><?=$nombre['nombre']?></option>		
							<?php endforeach;?>
						</select>
					</td>
					<td><spam id="alerta4" class="errores">Selecciona nombre</spam><br></td>
				</tr>
				<tr>
					<td><label>Tipo:</label>
					<td>
						<select name="id_tipo" class="tipo">
							<option value="0">Elige</option>		
							<?php
								 $tipos = $productos->getTipos();
								 foreach($tipos as $tipo) :
							?>
									<option value='<?=$tipo['id_tipo']?>'><?=$tipo['nombre_tipo']?></option>		
							<?php endforeach;?>		
						</select>
					</td>
					<td><spam id="alerta5" class="errores">Selecciona tipo</spam><br></td>
				</tr>
				<tr>
					<td><label>Marca :</label></td>
					<td>
						<select name="id_marca" class="marca">
							<option value="0">Elige</option>		
							<?php
								 $marcas = $productos->getMarcas();
								 foreach($marcas as $marca) :
							?>
									<option value='<?=$marca['id_marca']?>'><?=$marca['nombre_marca']?></option>		
							<?php endforeach;?>		
						</select>
					</td>
					<td><spam id="alerta6" class="errores">Selecciona marca</spam><br></td>
				</tr>
				<tr>
					<td><label>Modelo :</label></td>
					<td><input type="text" name="modelo" class="modelo"></td>
					<td><spam id="alerta7" class="errores">Ingrese modelo</spam><br></td>
				</tr>
				<tr>
					<td><label>Precio :</label></td>
					<td><input type="text" name="precio" class="precio"><br></td>
					<td><spam id="alerta8" class="errores">Ingrese precio</spam><br></td>
				</tr>
				<tr>
					<td><label> Moneda :</label></td>
					<td>
						<select name="moneda">
							<?php
								 $monedas = $productos->getMonedas();
								 foreach($monedas as $moneda) :
							?>
									<option value='<?=$moneda['id_moneda']?>'><?=$moneda['nombre_moneda']?></option>		
							<?php endforeach;?>	
						</select>
					</td>
				</tr>
				<tr>
					<td><label>Unidad de medida:</label></td>
					<td>
						<select name="id_unidad" class="unidad">
							<option value="0">Elige</option>		
							<?php
								 $unidades = $productos->getUnidades();
								 foreach($unidades as $unidad) :
							?>
									<option value='<?=$unidad['id_unidad']?>'><?=$unidad['nombre_unidad']?></option>		
							<?php endforeach;?>
						</select>
					</td>
					<td><spam id="alerta9" class="errores">Selecciona unidad</spam><br></td>
				</tr>
				<tr>
					<td colspan="2">
						<textarea name="descripcion" placeholder="Descripción del producto..." title="Descripción del producto" style="width:310px;height:90px;resize:none;" class="descripcion"></textarea>
					</td>
					<td><spam id="alerta10" class="errores">Ingresa la descripción</spam><br></td>
				</tr>
			</table>
			<div id="guardarProd"></div>
		</div>
		<div style="width:555px;background:#16555B;border-bottom-right-radius:10px;border-bottom-left-radius:10px;padding:5px;">
			<center><input type="submit" class="btn primary" value="Guardar" /></center>
		</div>
	</form>
</center>
<script type="text/javascript">
var regProd = jQuery.noConflict();
regProd(document).ready(function(){
	regProd(".btn").click(function(){
	    var cat = regProd(".categoria").val();
	    var subcat = regProd(".subcategoria").val();
		var div = regProd(".division").val();
		var nom = regProd(".nombre").val();
		var tip = regProd(".tipo").val();
		var marc = regProd(".marca").val();
		var mod = regProd(".modelo").val();
		var prec = regProd(".precio").val();
		var uni = regProd(".unidad").val();
		var desc = regProd(".descripcion").val();

      if (cat==0) {
      	  regProd(".nombre").focus();
          regProd("#alerta1").fadeIn();
          return false;
      }else{
      	regProd("#alerta1").fadeOut();
	      if (subcat==0) {
	      	  regProd(".subcategoria").focus();
	          regProd("#alerta2").fadeIn();
	          return false;
	      }else{
	      	regProd("#alerta2").fadeOut();
		      if (div==0) {
		      	  regProd(".division").focus();
		          regProd("#alerta3").fadeIn();
		          return false;
		      }else{
		      	regProd("#alerta3").fadeOut();
			      if (nom==0) {
			      	  regProd(".nombre").focus();
			          regProd("#alerta4").fadeIn();
			          return false;
			      }else{
			      	regProd("#alerta4").fadeOut();
				      if (tip==0) {
				      	  regProd(".tipo").focus();
				          regProd("#alerta5").fadeIn();
				          return false;
				      }else{
				      	regProd("#alerta5").fadeOut();
					      if (marc==0) {
					      	  regProd(".marca").focus();
					          regProd("#alerta6").fadeIn();
					          return false;
					      }else{
					      	regProd("#alerta6").fadeOut();
						      if (mod=="") {
						      	  regProd(".modelo").focus();
						          regProd("#alerta7").fadeIn();
						          return false;
						      }else{
						      	 regProd("#alerta7").fadeOut();
								    if (prec=="") {
								   	  regProd(".precio").focus();
								      regProd("#alerta8").fadeIn();
								      return false;
						      	}else{
							      regProd("#alerta8").fadeOut();
								    if (uni==0) {
								   	  regProd(".unidad").focus();
								      regProd("#alerta9").fadeIn();
								      return false;
								    }else{
								      	regProd("#alerta9").fadeOut();
								      	if (desc == 0) {
								      		regProd(".descripcion").focus();
								      		regProd("#alerta10").fadeIn();
								      		return false;
								      	}else{
								      		regProd("#alerta10").fadeOut();
								      	}
								    }
								 }
						      }
					      }
				      }
			      }
		      }

	      }
      }
    });

    regProd("#formProdAdd").submit(function(newProd) {
    	newProd.preventDefault();
    	regProd("#guardarProd").load('guardar_producto.php?' + regProd("#formProdAdd").serialize());
    });
});
</script>