<?php
  session_start();
  //manejamos en sesion el nombre del usuario que se ha logeado
  if (!isset($_SESSION["usuario"])){
      header("location:../");  
  }
  $_SESSION["usuario"];
  //termina inicio de sesion
?>
<!DOCTYPE html>
<html lang="es">
<head>
	<meta charset="utf-8" />
	<title>Productos</title>
	<link rel="shortcut icon" type="image/x-icon" href="../images/favicon.ico" />
	<link rel="stylesheet" href="../css/estilos.css" />
	<link rel="stylesheet" href="../css/menu.css" />
	<link rel="stylesheet" href="../css/tabla.css" />
  <link rel="stylesheet" href="../css/formularios.css" />
  <link rel="stylesheet" href="../css/mensajes.css" />
	<script type="text/javascript" src="../js/jquery-2.1.4.js"></script>
</head>

<body>
	<header>
		<a href="../"><img src="../images/logoDigitalMind.png" alt="Página Principal" title="Página Principal" /></a>
	</header>

  <div id="todoaeditar">
    <?php 
	    // require	'../class/dataBaseConn.php';
      // $conn = new dataBaseConn();
      require_once 'classProductos.php';
      $productos = new Productos;	  
      
      require_once("../libs/encrypt_decrypt_strings_urls.php");
      $id_pro = decrypt($_GET["productedit"],"productosDM");

      //este se utiliza para llenar los campos editables
      $datosProducto = $productos->getProductoDet($id_pro);
      print_r($datosProducto);
      
        $desc = $datosProducto["descripcion"];
        $mod = $datosProducto["modelo"];
        $pre = $datosProducto["precio"];
        $mon = $datosProducto["id_moneda"];
        $nom = $datosProducto["nombre_moneda"];
        $ext = $datosProducto["exit_inventario"];
      
    ?>
      <input type="hidden" id="idproed" value="<?=$id_pro?>">
      <img src="../images/loadingAnimation.gif" class="cargand">
      <form action='' method="POST" id='formeditar'>

        <h4>Editando Producto</h4>
        <input type="hidden" name="id_producto" value="<?=$id_pro?>"><br>

        <label>Categoría:</label>
        <select name="id_categoria" class="categoria">
          <!-- categoria del producto -->
          <option value='<?=$datosProducto['id_categoria']?>'>
            <?=$datosProducto['nombre_categoria']?>
          </option>
          <?php
            $categorias = $productos->getCategorias();
            foreach($categorias as $categoria){
              // si ya existe la categoria en el select no la muestre duplicada
              if ($datosProducto['id_categoria'] != $categoria['id_categoria'] ) {
              //se utiliza para llenar el combo de categorias
                echo "<option value='{$categoria['id_categoria']}'>{$categoria['nombre_categoria']}</option>";
              }
            }
          ?>
        </select>
        <spam id="alerta1" class="errores">Selecciona categoria</spam>
        <br>

        <label>Subcategoría:</label>
        <select name="id_subcategoria" class="subcategoria">
            <!-- subcategoria del producto -->
          <option value='<?=$datosProducto['id_subcategoria']?>'>
            <?=$datosProducto['nombre_subcategoria']?>
          </option>
          <?php
            $subcategorias = $productos->getSubCategorias();
            foreach($subcategorias as $subcategoria){
              // si ya existe la subcategoria en el select no la muestre duplicada
              if ($datosProducto['id_subcategoria'] != $subcategoria['id_subcategoria']) {
              //se utiliza para llenar el combo de subcategorias
                echo "<option value='{$subcategoria['id_subcategoria']}'>{$subcategoria['nombre_subcategoria']}</option>";
              }
            }
          ?>
        </select>
        <spam id="alerta2" class="errores">Selecciona subcategoria</spam>
        <br>

        <label>División:</label>
        <select name="id_division" class="division">
          <!-- division del producto -->
          <option value='<?=$datosProducto['id_division']?>'>
            <?=$datosProducto['nombre_division']?>
          </option>
          <?php
            $divisiones = $productos->getDivisiones();
            foreach($divisiones as $division){
              // si ya existe la division en el select no la muestre duplicada
              if ($datosProducto['id_division'] != $division['id_division'] ) {
              //se utiliza para llenar el combo de divisiones
                echo "<option value='{$division['id_division']}'>{$division['nombre_division']}</option>";
              }
            }
          ?>
        </select>
        <spam id="alerta3" class="errores">Selecciona división</spam>
        <br>

        <label>Nombre :</label>
        <select name="id_nombre" class="nombre">
          <!-- nombre del producto -->
          <option value='<?=$datosProducto['id_nombre']?>'>
            <?=$datosProducto['nombre']?>
          </option>
          <?php
            $nombres = $productos->getNombres();
            foreach($nombres as $nombre){
              // si ya existe el nombre en el select no lo muestre duplicado
              if ($datosProducto['id_nombre'] != $nombre['id_nombre'] ) {
              //se utiliza para llenar el combo de nombres
                echo "<option value='{$nombre['id_nombre']}'>{$nombre['nombre']}</option>";
              }
            }
          ?>
        </select>
        <spam id="alerta4" class="errores">Selecciona nombre</spam>
        <br>

        <label>Tipo:</label>
        <select name="id_tipo" class="tipo">
          <!-- tipo del producto -->
          <option value='<?=$datosProducto['id_tipo']?>'>
            <?=$datosProducto['nombre_tipo']?>
          </option>
          <?php
            $tipos = $productos->getTipos();
            foreach($tipos as $tipo){
              // si ya existe el tipo en el select no lo muestre duplicado
              if ($datosProducto['id_tipo'] != $tipo['id_tipo'] ) {
              //se utiliza para llenar el combo de tipos
                echo "<option value='{$tipo['id_tipo']}'>{$tipo['nombre_tipo']}</option>";
              }
            }
          ?>
        </select>
        <spam id="alerta5" class="errores">Selecciona tipo</spam>
        <br>

        <label>Marca :</label>
        <select name="id_marca" class="marca">
          <!-- marca del producto -->
          <option value='<?=$datosProducto['id_marca']?>'>
            <?=$datosProducto['nombre_marca']?>
          </option>
          <?php
            $marcas = $productos->getMarcas();
            foreach($marcas as $marca){
              // si ya existe la marca en el select no la muestre duplicada
              if ($datosProducto['id_marca'] != $marca['id_marca'] ) {
              //se utiliza para llenar el combo de marcas
                echo "<option value='{$marca['id_marca']}'>{$marca['nombre_marca']}</option>";
              }
            }
          ?>
        </select>
        <spam id="alerta6" class="errores">Selecciona marca</spam>
        <br>

        <label>Modelo :</label>
        <input type="text" name="modelo" value="<?php echo $mod ?>" class="modelo">
        <spam id="alerta7" class="errores">Ingrese modelo</spam>
        <br>

        <label> Precio :</label>
        <input type="text" name="precio" value="<?php echo $pre ?>">

        <br>
        <label> Moneda :</label></td>
        <td>
        <select name="moneda">
          <option value='<?=$mon?>'><?=$nom?></option>";
          <?php 
            
            $monedas = $productos->getMonedas();

            foreach($monedas as $moneda) {
              // si ya existe la moneda en el select no la muestre duplicada
              if($mon != $moneda['id_moneda']){
                // llenar combo de moneda
                echo "<option value='{$moneda['id_moneda']}'>{$moneda['nombre_moneda']}</option>";
              }
            }

          ?>   
        </select>
        <br>
        <label>Unidad de Medida:</label>
        <select name="id_unidad" class="unidad">
          <!-- unidad del producto -->
          <option value='<?=$datosProducto['id_unidad']?>'>
            <?=$datosProducto['nombre_unidad']?>
          </option>
          <?php
            $unidades = $productos->getUnidades();
            foreach($unidades as $unidad){
              // si ya existe la unidad en el select no la muestre duplicada
              if ($datosProducto['id_unidad'] != $unidad['id_unidad'] ) {
              //se utiliza para llenar el combo de unidades
                echo "<option value='{$unidad['id_unidad']}'>{$unidad['nombre_unidad']}</option>";
              }
            }
          ?>
        </select>
        <spam id="alerta8" class="errores">Selecciona unidad</spam>
        <br>
        <textarea name="descripcion" placeholder="Descripción del producto..." title="Descripción del producto" style="width:310px;height:90px;resize:none;"><?=$desc?></textarea>
        <br>
        <br>

        <input type="submit" class="btn primary" value="Modificar" />
        <input type="button" id="btnCancelarUpProd" value="Cancelar" class="btneliminar" />
      </form>
      <div id="actualiza"></div>
    </div>
    <br>
    <br>
    <br>
  </body>
</html>
<script type="text/javascript">
  var editarPr = jQuery.noConflict();
  editarPr(document).ready(function() {
    if(editarPr("#idproed").val()>0){
      editarPr("#todoaeditar").css("display","block");
      setTimeout(function() {
        editarPr(".cargand").css("display","none");
      }, 500);
      setTimeout(function() {
        editarPr("#formeditar").slideDown("low");
      }, 1000);
    }
    editarPr("#formeditar").submit(function(editp) {
      editp.preventDefault();
      editarPr("#actualiza").load('actualizar.php?' + editarPr("#formeditar").serialize());
    });

    editarPr("#btnCancelarUpProd").click(function() {
      var msjConfirm = confirm('¿Esta seguro de cancelar la modificación?');
      if (msjConfirm == true) {
        window.location.href = "index.php";
      }
    });
  });
</script>