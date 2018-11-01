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
  include ('../Conexion.php');
  require_once("../libs/encrypt_decrypt_strings_urls.php");
  $id_pro = decrypt($_GET["productedit"],"productosDM");
?>

<?php //este se utiliza para llenar los campos editables
  $query = "SELECT descripcion, modelo, precio,id_moneda, exit_inventario FROM productos C where id_producto=$id_pro";
  $result=mysql_query($query);
  while($fila=mysql_fetch_array($result)){
     $desc=''.$fila["descripcion"].'';
     $mod=''.$fila["modelo"].'';
     $pre=''.$fila["precio"].'';
     $mon=''.$fila["id_moneda"].'';
     $ext=''.$fila["exit_inventario"].'';
  }
?>
<input type="hidden" id="idproed" value="<?=$id_pro?>">
<img src="../images/loadingAnimation.gif" class="cargand">
	<form action='' method="POST" id='formeditar'>
	<h4>Editando Producto</h4>
<input type="hidden" name="id_producto" value="<?=$id_pro?>"><br>
<?php
include ('../conexion.php');
?>

<label>Categoría:</label>
<select name="id_categoria" class="categoria">
<?php
//este se utiliza para llenar el combo de categorias
  $query = "SELECT P.id_categoria, C.nombre_categoria FROM productos P 
            inner join categorias C on P.id_categoria=C.id_categoria 
            where id_producto=$id_pro";
  $result=mysql_query($query);
  while($fila=mysql_fetch_array($result)){
  echo "<option value='",$fila[0],"'>",$fila[1],"</opion>";
  $idc=$fila[0];
  }
  $query = "SELECT id_categoria, nombre_categoria FROM categorias where not id_categoria=$idc";
  $result=mysql_query($query);
  while($fila=mysql_fetch_array($result)){
  echo "<option value='",$fila[0],"'>",$fila[1],"</opion>";
  }
?>
</select>
<spam id="alerta1" class="errores">Selecciona categoria</spam>
<br>
	<label>Subcategoría:</label>
	<select name="id_subcategoria" class="subcategoria">
<?php
 //este se utiliza para llenar el combo de subcategorias
  $query = "SELECT S.id_subcategoria, S.nombre_subcategoria FROM subcategorias S 
            where id_subcategoria=(select id_subcategoria from productos where id_producto=$id_pro) ";
  $result=mysql_query($query);
  while($fila=mysql_fetch_array($result)){
  echo "<option value='",$fila[0],"'>",$fila[1],"</opion>";
  $ids=$fila[0];
  }
  $query = "SELECT id_subcategoria, nombre_subcategoria FROM subcategorias where not id_subcategoria=$ids";
  $result=mysql_query($query);
  while($fila=mysql_fetch_array($result)){
  echo "<option value='",$fila[0],"'>",$fila[1],"</opion>";
  }?>
	</select>
<spam id="alerta2" class="errores">Selecciona subcategoria</spam>
<br>

<label>División:</label>
	<select name="id_division" class="division">
<?php 
//este se utiliza para llenar el combo de divisiones
  $query = "SELECT D.id_division, nombre_division FROM productos D 
            inner join division on D.id_division=division.id_division
            where id_producto=$id_pro";
  $result=mysql_query($query);
  while($fila=mysql_fetch_array($result)){
  echo "<option value='",$fila[0],"'>",$fila[1],"</opion>";
  $idd=$fila[0];
  }
  $query = "SELECT id_division, nombre_division FROM division where not id_division=$idd";
  $result=mysql_query($query);
  while($fila=mysql_fetch_array($result)){
  echo "<option value='",$fila[0],"'>",$fila[1],"</opion>";
  }
?>
</select>
<spam id="alerta3" class="errores">Selecciona división</spam>
<br>

<label>Nombre :</label>
<select name="id_nombre" class="nombre">
<?php 
//este se utiliza para llenar el combo de nombres
  $query = "SELECT 
              N.id_nombre,
              N.nombre 
            FROM
              productos P 
              INNER JOIN nombres N 
                ON P.id_nombre = N.id_nombre 
            WHERE P.id_producto = ".$id_pro;
  $result=mysql_query($query);
  while($fila=mysql_fetch_array($result)){
    echo "<option value='",$fila[0],"'>",$fila[1],"</opion>";
    $idNombreProd = $fila[0];
  }
  $query = "SELECT id_nombre, nombre FROM nombres WHERE NOT id_nombre =".$idNombreProd;
  $result=mysql_query($query);
  while($fila=mysql_fetch_array($result)){
  echo "<option value='",$fila[0],"'>",$fila[1],"</opion>";
  }
?>
</select>
<spam id="alerta4" class="errores">Selecciona nombre</spam>
<br>

<label>Tipo:</label>
<select name="id_tipo" class="tipo">
<?php
//este se utiliza para llenar el combo de tipos
  $query = "SELECT T.id_tipo, T.nombre_tipo FROM tipos T 
            where id_tipo=(select id_tipo from productos where id_producto=$id_pro) ";
  $result=mysql_query($query);
  while($fila=mysql_fetch_array($result)){
  echo "<option value='",$fila[0],"'>",$fila[1],"</opion>";
  $idt=$fila[0];
  }
  $query = "SELECT id_tipo, nombre_tipo FROM tipos where not id_tipo=$idt";
  $result=mysql_query($query);
  while($fila=mysql_fetch_array($result)){
  echo "<option value='",$fila[0],"'>",$fila[1],"</opion>";
  }
if($idt==0){
  echo "<option value='0'>Elige</option>";
  $query = "SELECT id_tipo, nombre_tipo FROM tipos";
  $result=mysql_query($query);
  while($fila=mysql_fetch_array($result)){
  echo "<option value='",$fila[0],"'>",$fila[1],"</opion>";
  }
}
?>
</select>
<spam id="alerta5" class="errores">Selecciona tipo</spam>
<br>

<label>Marca :</label>
<select name="id_marca" class="marca">
<?php
//este se utiliza para llenar el combo de marcas 
  $query = "SELECT P.id_marca,nombre_marca FROM productos P 
            inner join marca_productos M on P.id_marca=M.id_marca where id_producto=$id_pro";
  $result=mysql_query($query);
  while($fila=mysql_fetch_array($result))
  {
  echo "<option value='",$fila[0],"'>",$fila[1],"</option>";
  $id=$fila[0];
  }
      $query = "SELECT id_marca, nombre_marca FROM marca_productos where not id_marca=$id";
  $result=mysql_query($query);
  while($fila=mysql_fetch_array($result)){
  echo '<option value="',$fila[0],'">';
  echo $fila[1];
  echo '</option>';
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
  <td><select name="moneda">
<?php 
  $query = "select id_moneda, nombre_moneda from moneda where id_moneda=$mon";
$result=mysql_query($query);
  while($fila=mysql_fetch_array($result)){
  echo "<option value='",$fila[0],"'>",$fila[1],"</opion>";
  }
  $query = "select id_moneda, nombre_moneda from moneda where not id_moneda=$mon";
$result=mysql_query($query);
  while($fila=mysql_fetch_array($result)){
  echo "<option value='",$fila[0],"'>",$fila[1],"</opion>";
  }
 ?>   
  </select><br>
<label>Unidad de Medida:</label>
<select name="id_unidad" class="unidad">
<?php //este se utiliza para llenar el combo de unidad de medida
  $query = "SELECT U.id_unidad, U.nombre_unidad FROM unidades U 
            where id_unidad=(select id_unidad from productos where id_producto=$id_pro) ";
  $result=mysql_query($query);
  while($fila=mysql_fetch_array($result)){
    echo "<option value='",$fila[0],"'>",$fila[1],"</opion>";
    $idUnidad = $fila[0];
  }

  $query = "SELECT id_unidad, nombre_unidad FROM unidades WHERE NOT id_unidad = ".$idUnidad;
  $result=mysql_query($query);
  while($fila=mysql_fetch_array($result)){
  echo "<option value='",$fila[0],"'>",$fila[1],"</opion>";
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

<?php //este se utiliza para llenar el combo de productos
  $conexion= new mysqli("localhost","root","","digitalm",3306);
    $strConsulta = "SELECT C.nombre_categoria FROM categorias C";
  $result = $conexion->query($strConsulta);
  $des = '<option></option>';
  while( $fila = $result->fetch_array())
  {
     $des.='<option>'.$fila["nombre_categoria"].'</option>';
  }
?>
<datalist id="listacat">
<?php echo $des; ?>
</datalist>
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