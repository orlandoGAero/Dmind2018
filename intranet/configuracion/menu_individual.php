<!-- código html flechita -> &#9660; -->
<?php
	$posicion = $_SERVER['PHP_SELF']."<br><br>";
	$dirBasicas = stristr($posicion, 'basicas');
	$dirCatClientes = stristr($posicion, 'clientes');
	$dirAreaContacto = stristr($posicion, 'contactos');
	$dirProductos = stristr($posicion, 'productos');
	$dirProveedores = stristr($posicion, 'proveedores');
	$dirTransacciones = stristr($posicion, 'tipo-transaccion');
	$dirInventario = stristr($posicion, 'inventario');
	$dirVentas = stristr($posicion, 'ventas');
	$dirEgresos = stristr($posicion, 'egresos');
?>
<?php if(preg_match("/basicas/", $dirBasicas)) :?>
	<span class="posicion first ultimo">Básicas</span>
	<ul id="menu">
	    <li><a href="../usuarios/">Usuarios</a></li>
	    <li><a href="../direcciones/">Direcciones</a></li>
	    <li><a href="../moneda/">Moneda</a></li>
	    <li><a href="../datosfiscales/">Datos Fiscales</a></li>
	    <li><a href="../cuentasbancarias/">Cuentas Bancarias</a></li>
	</ul>
<?php elseif(preg_match("/clientes/", $dirCatClientes)) :?>
	<span class="posicion first ultimo">Clientes</span>
	<ul id="menu">
	    <li><a href="../categorias-cliente/">Categorías</a></li>
	</ul>
<?php elseif(preg_match("/contactos/", $dirAreaContacto)) :?>
	<span class="posicion first ultimo">Contactos</span>
	<ul id="menu">
	    <li><a href="../area-contacto/">Áreas</a></li>
	</ul>
<?php elseif(preg_match("/productos/", $dirProductos)) :?>
	<span class="posicion first ultimo">Productos</span>
	<ul id="menu">
	    <li><a href="../productos/">Productos</a></li>
	    <li><a href="../categorias/">Categorías</a></li>
	    <li><a href="../subcategorias/">Subcategorías</a></li>
	    <li><a href="../divisiones/">Divisiones</a></li>
	    <li><a href="../marcas/">Marcas</a></li>
	    <li><a href="../nombres/">Nombres</a></li>
	    <li><a href="../tipos/">Tipos</a></li>
	    <li><a href="../unidades/">Unidades</a></li>
	    <li><a href="../formulario/">Formulario</a></li>
	</ul>
<?php elseif(preg_match("/proveedores/", $dirProveedores)) :?>
	<span class="posicion first ultimo">Proveedores</span>
	<ul id="menu">
	    <li><a href="../proveedores/">Proveedores</a></li>
	    <li><a href="../categorias-proveedor/">Categorías</a></li>
	</ul>
<?php elseif(preg_match("/tipo-transaccion/", $dirTransacciones)) :?>
	<span class="posicion first ultimo">Transacciones</span>
	<ul id="menu">
	    <li><a href="../tipo-transaccion/">Tipos</a></li>
	    <li>
	    	<a href="#">Inventario <span>&#9660;</span></a>
	    	<ul>
	    		<li><a href="../inventario/estados/">Estados</a></li>
	    		<li><a href="../inventario/status/">Status</a></li>
	    		<li><a href="../inventario/ubicaciones/">Ubicaciones</a></li>
	    	</ul>
	    </li>
	    <li>
	    	<a href="#">Ventas <span>&#9660;</span></a>
	    	<ul>
	    		<li><a href="../ventas/status-venta/">Status</a></li>
	    		<li><a href="../ventas/tipos-venta/">Tipos Venta</a></li>
	    		<li><a href="../ventas/tipos-pago/">Formas de Pago</a></li>
	    	</ul>
	    </li>
	</ul>
<?php elseif(preg_match("/inventario/", $dirInventario)) :?>
	<span class="posicion first ">Transacciones</span>
	<span class="posicion separator">></span>
	<span class="posicion ultimo">Inventario</span>
	<ul id="menu">
	    <li><a href="../../tipo-transaccion/">Tipos</a></li>
	    <li>
	    	<a href="#">Inventario <span>&#9660;</span></a>
	    	<ul>
	    		<li><a href="../estados/">Estados</a></li>
	    		<li><a href="../status/">Status</a></li>
	    		<li><a href="../ubicaciones/">Ubicaciones</a></li>
	    	</ul>
	    </li>
	    <li>
	    	<a href="#">Ventas <span>&#9660;</span></a>
	    	<ul>
	    		<li><a href="../../ventas/status-venta/">Status</a></li>
	    		<li><a href="../../ventas/tipos-venta/">Tipos Venta</a></li>
	    		<li><a href="../../ventas/tipos-pago/">Formas de Pago</a></li>
	    	</ul>
	    </li>
	</ul>
<?php elseif(preg_match("/ventas/", $dirVentas)) :?>
	<span class="posicion first ">Transacciones</span>
	<span class="posicion separator">></span>
	<span class="posicion ultimo">Ventas</span>
	<ul id="menu">
	    <li><a href="../../tipo-transaccion/">Tipos</a></li>
	    <li>
	    	<a href="#">Inventario <span>&#9660;</span></a>
	    	<ul>
	    		<li><a href="../../inventario/estados/">Estados</a></li>
	    		<li><a href="../../inventario/status/">Status</a></li>
	    		<li><a href="../../inventario/ubicaciones/">Ubicaciones</a></li>
	    	</ul>
	    </li>
	    <li>
	    	<a href="#">Ventas <span>&#9660;</span></a>
	    	<ul>
	    		<li><a href="../status-venta/">Status</a></li>
	    		<li><a href="../tipos-venta/">Tipos Venta</a></li>
	    		<li><a href="../tipos-pago/">Formas de Pago</a></li>
	    	</ul>
	    </li>
	</ul>
<?php elseif(preg_match("/egresos/", $dirEgresos)) :?>
	<span class="posicion first">Finanzas</span>
	<span class="posicion separator">></span>
	<span class="posicion ultimo">Egresos</span>
	<ul id="menu">
	    <li><a href="../conceptos/">Conceptos</a></li>
	    <li><a href="../clasificaciones/">Clasificación</a></li>
	    <li><a href="../status/">Status</a></li>
	    <li><a href="../origenes/">Origenes</a></li>
	    <li><a href="../destinos/">Destinos</a></li>
	</ul>
<?php endif; ?>