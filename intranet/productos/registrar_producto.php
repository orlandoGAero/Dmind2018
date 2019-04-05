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
					<td><span id="alerta1" class="errores">Selecciona categoria</span><br></td>
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
					<td><span id="alerta2" class="errores">Selecciona subcategoria</span><br></td>
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
					<td><span id="alerta3" class="errores">Selecciona división</span><br><td>
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
					<td><span id="alerta4" class="errores">Selecciona nombre</span><br></td>
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
					<td><span id="alerta5" class="errores">Selecciona tipo</span><br></td>
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
					<td><span id="alerta6" class="errores">Selecciona marca</span><br></td>
				</tr>
				<tr>
					<td><label>Modelo :</label></td>
					<td><input type="text" name="modelo" class="modelo"></td>
					<td><span id="alerta7" class="errores">Ingrese modelo</span><br></td>
				</tr>
				<tr>
					<td><label>Precio :</label></td>
					<td><input type="text" name="precio" class="precio"><br></td>
					<td><span id="alerta8" class="errores">Ingrese precio</span><br></td>
				</tr>
				<tr>
					<td><label> Moneda :</label></td>
					<td>
						<select name="moneda">
							<?php
								 $monedas = $productos->getMonedas();
								 foreach($monedas as $moneda) :
							?>
									<option value='<?=$moneda['id_moneda']?>' <?php if($moneda['nombre_moneda'] == 'PESO') echo 'selected';?>><?=$moneda['nombre_moneda']?></option>		
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
					<td><span id="alerta9" class="errores">Selecciona unidad</span><br></td>
				</tr>
				<tr>
					<td colspan="2">
						<textarea name="descripcion" placeholder="Descripción del producto..." title="Descripción del producto" style="width:310px;height:90px;resize:none;" class="descripcion"></textarea>
					</td>
					<td><span id="alerta10" class="errores">Ingresa la descripción</span><br></td>
				</tr>
			</table>
		</div>
		<div style="width:555px;background:#16555B;border-bottom-right-radius:10px;border-bottom-left-radius:10px;padding:5px;">
			<center><input type="submit" class="btn primary" value="Guardar" /></center>
		</div>
	</form>
	<div id="guardarProd"></div>
</center>
