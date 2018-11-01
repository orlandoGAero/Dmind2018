<?php
session_start();
//manejamos en sesion el nombre del usuario que se ha logeado
if (!isset($_SESSION["usuario"])){
    header("location:../");  
}
$_SESSION["usuario"];
//termina inicio de sesion
?>
<?php header("Content-type: text/html; charset=utf-8");
include ('../../Conexion.php');
 ?>
 <!DOCTYPE html>
<html>
  <head>
      <title>Digital Mind</title>
        <meta charset="utf-8" />
        <link rel="shortcut icon" type="image/x-icon" href="../../images/favicon.ico" />
        <link rel=stylesheet href="../../css/scroll.css" type="text/css">
        <link rel=stylesheet href="../../css/formularios.css" type="text/css">
        <link rel=stylesheet href="../../css/formatocotizacion.css" type="text/css">
        <script type='text/javascript' src='../../js/jquery-2.1.4.js'></script>
        <script src="Js/configuracion.js" type="text/javascript"></script>
        <script type="text/javascript">
        $(document).ready(function(){
        $(".nuevos").click(function(){  
        $(".pro").css("display","none");
        $(".clie").css("display","block");
        $(".cerrar").css("display","block");
        });
        $(".nuevop").click(function(){  
        $(".todasacciones").slideDown("low"); 
        $(".pro").css("display","block");
        $(".clie").css("display","none");
        $(".cerrar").css("display","block");
        });
        });
        </script>
</head>
<body background="../imagenes/bg.jpg">
  <header>
    <img src="../../images/logoDigitalMind.png" alt="Página Principal" title="Página Principal" />
  </header>
  <nav>
    <ul>
      <li><a href="../../Home" alt="Inicio" title="Inicio"><img src="../../images/home.png"/></a></li>
      <li></li><li></li><li></li><li></li>
      <li><a href="../../salir.php" alt="Cerrar Sesion" title="Cerrar Sesion"><img src="../../images/lock.png"/></a></li>
    </ul>
  </nav>
<article>
<img class="icono" src="../Imagenes/banner.png" >
<br>
<div><spam>
<?php
$id_cotizacion=$_GET["id_cotizacion"];
$query = "SELECT id_cotizacion, fecha FROM cotizacion where id_cotizacion=$id_cotizacion";
$result = mysql_query($query) or die ("la consulta fallo:".mysql_error());

    while ($row = mysql_fetch_array($result))
    {
        echo "COTIZACION DIGITAL<br> COT ", $row[0], "<br> ";
        echo "FECHA : ", $row['fecha'], " ";
}
?>
</spam>
</div>
<table><tr>
<td>
<div class="datosclie" id="camposclie" style="padding:5px;">
<h3>EN ATENCION A</h3><br>
<?php
$id_cotizacion=$_GET["id_cotizacion"];
$query="SELECT C.id_cotizacion, nombre_cliente, calle, num_ext,num_int, localidad, municipio, D.estado, pais, cod_postal,F.rfc from cotizacion C
       inner join clientes on C.id_cliente=clientes.id_cliente 
       inner join datos_fiscales F on clientes.id_datfiscal=F.id_datfiscal
       inner join direcciones D on F.id_direccion=D.id_direccion where id_cotizacion=$id_cotizacion";
$result=mysql_query($query);
while($row=mysql_fetch_array($result))
{
    echo "<li>", $row['nombre_cliente'],"</li>";
    echo "<br>";
    echo "<li>RFC:<b>", $row['rfc'],"</b></li>";
    echo "<li>Dirección:<b>", $row['calle']," ", $row['num_ext']," ", $row['num_int'],"</b></li>";
    echo "<li>Colonia:<b>", $row['localidad'],"</b></li>";
    echo "<li>Localidad:<b>", $row['localidad'],"</b></li>";
    echo "<li>Municipio:<b>", $row['municipio'],"</b></li>";
    echo "<li>Estado:<b>", $row['estado'],"</b></li>";
    echo "<li>C.P. /Pais:<b>", $row['cod_postal'],"/", $row['pais'],"</b></li>";
    } 
?>
</div>
</td>
<td colspan="2" class="vacio" style="padding:5px;"></td>
<td>
<div class="datoscotizador">
    <h3>COTIZACIÓN DE</h3><br>
    <li>EMANUEL ESPEJEL RODRIGUEZ</li>
    <br>
    <li>RFC:</spam><b> EERE780924Q89</b></li>
    <li>Dirección:<b> MANUEL VILLA VERDE 1 40 B</b></li>
    <li>Colonia:<b> CARLOS HANK GONZALES</b></li>
    <li>Localidad:<b> </b></li>
    <li>Municipio:<b>TOLUCA </b></li>
    <li>Estado:<b> EDO. DE MÉXICO</b></li>
    <li>C.P. /Pais:<b> 50026 / MÉXICO</b></li>
</div>
</td>
</tr></table>
<section>
<table cellpadding="0" cellspacing="0" class="products">
<tr>
<th class="cantidad">CANTIDAD</th>
<th>DESCRIPCION</th>
<th>PRECIO UNITARIO</th>
<th>IMPORTE</th>

</tr>
<?php
$id_cotizacion=$_GET["id_cotizacion"];
$query="SELECT * FROM detalle_cotizacion 
          where id_cotizacion=$id_cotizacion";
$result=mysql_query($query);
while($row=mysql_fetch_array($result))
{
        echo "<tr>";
        echo "<td class='cantidad'>", $row['cantidad'], " Piezas</td>";
        echo "<td class='desc'>", $row['descripcion'],"<br> ",$row["nota"], "</td>";
        echo "<td class='preciou'>", $row['precio'], "</td>";
        echo "<td class='importe'>", $row['importe'], "</td>";
        echo "<td><a href='editarnota.php?id_cotizacion=", $row["id_cotizacion"],"&id_producto=", $row["id_producto"],"'><img src='../Imagenes/editar.png'></a></td>";
        echo "<td><a href='eliminarpro.php?descripcion=", $row['descripcion'],"&id_cotizacion=", $row['id_cotizacion'],"'>";
        echo "<img src='../Imagenes/borrar.png'></a></td>";
        echo "</tr>";
}
?>
</table>
<aside class="operaciones">
<?php
$id_cotizacion=$_GET["id_cotizacion"];
$sql="SELECT SUM(importe) FROM detalle_cotizacion WHERE id_cotizacion= $id_cotizacion";
$result=mysql_query("$sql");
?>
<b> SUBTOTAL:</b>
<?php 
while ($row = mysql_fetch_array($result)){
     
     $subt=$row[0]; 
    }
    //rowspan="2"
?>
<?php
$id_cotizacion=$_GET["id_cotizacion"];
$sql="SELECT subtotal,iva,total,id_moneda FROM cotizacion WHERE id_cotizacion= $id_cotizacion";
$result=mysql_query("$sql");
?>
<?php
while ($row = mysql_fetch_array($result)){
 echo "<b class='num1'>$",$row["subtotal"],"</b>";
 $iv=$row["iva"];
  $iva=$iv*.01;//iva del subtotal
    $cuent=$subt*$iva;
  echo "<br><b> I.V.A: </b>";
  echo '<b class="num2">$';
  echo $cuent;
  echo '</b>';
  echo "<br><b> TOTAL: </b>";
  echo '<b class="num3">$';
  echo $row["total"];
  echo '</b>';
  $moneda=$row["id_moneda"];
    }
?> 
</aside>
<form action="editaiva.php" id="ivass">
<input type="hidden" name="id_cotizacion" value="<?php echo $_GET["id_cotizacion"]; ?>">
<input type="text" name="iva" id="ivas">
<button id="addiva">Cambiar</button>
<select class="moneda" name="moneda">
<?php 
$sql="SELECT * FROM moneda where id_moneda=$moneda";
$result=mysql_query("$sql");
while ($fila = mysql_fetch_array($result)){
  echo "<option value='",$fila[0],"'>",$fila[1],"</option>";
}
$sql="SELECT * FROM moneda where not id_moneda=$moneda";
$result=mysql_query("$sql");
while ($fila = mysql_fetch_array($result)){
  echo "<option value='",$fila[0],"'>",$fila[1],"</option>";
}
 ?>
</select>
</form>
</article>
<div id="addproductos">
<form action="agregarproductos.php">
<div id="adpro">
    <spam class="nuevop">Nuevo Producto</spam>
    <input type="hidden" name="id_cotizacion" id="id_cotizacion" value="<?php echo $_GET["id_cotizacion"]; ?>">
    <br>
  <label> Categoria:</label>
<select id="categoria">
<option value="0">Elija</option>
<?php //este se utiliza para llenar el combo de categorias
$query = "SELECT * FROM categorias";
$result=mysql_query($query);
while($fila=mysql_fetch_array($result))
{
  echo "<option value='", $fila[0],"'>",$fila[1],"</option>";
}
?>
</select>
  <label> Subcategoria:</label>
<select id="subcategoria">
<option value="0">Elija</option>
</select>
<label>División:</label>
    <select id="divisiones">
      <option value="0">Elige</option>
    </select>
<label>Nombre:</label>
<select id="nombres">
<option value="0">Elija</option>
</select>
<label>Tipo:</label>
<select id="tipos">
<option value="0">Elija</option>
</select>
  <label>Marca</label>
  <select id="marcas">
  <option value="0">Elige un marca</option>
  </select>     
  <label>Modelo</label>
     <select id="modelos" class="producto" name="id_producto"><option>Elige un producto</option>
<textarea name="nota" cols="20" rows="3" style="resize:none;">
  
</textarea>
     </select>
        <label>Cantidad</label><br>
            <input type='text' name='cantidad' id="cantidad" /><br>  
        <label>Precio</label><br>
        <select id="precu"  type="hidden" class="precio">
          
        </select>
        <input name="precio" id="precio"/>
        
            <label id="imp"></label>
            <input type='hidden' name="importe" id="importe" />
            <button style="width:100px;border-radius:4px;height:30px;">Agregar</button><br>
</div>
</form>    
</div>
<div id="botones">
<br>
<a href="../registrocotizaciones.php"><div id="buscotizacion">Buscar Cotizacion</div></a>
<br>
<a href="pdfcot.php?id_cotizacion=<?php echo $_GET["id_cotizacion"]; ?>" target="_blank">
<button id="guardar"> Imprimir </button></a><br>
</section>
        <a href='quitarproductos.php?id_cotizacion=<?php echo $_GET["id_cotizacion"]; ?>'>
        <button id="borrtodo">Quitar productos</button></a><br>
        <a href='../registrocotizaciones.php'>
        <button id="cancelacot">Cancelar</button></a><br>
        <a href="guardar.php"><button class="btn" style="width:145px;">Guardar y Salir</button></a><br><br>
        <a href="agregarcotizacion.php"><button id="nuevacot">Nueva Cotizacion</button></a>
<br><br>

</div>
<div class="todasacciones">
<div class="scrollbar" id="barra" style="height:600px;">
  <?php include("clientenuevo.php"); ?>
  <?php include("productnuevo.php"); ?>
<div class="contbarra"></div>
 </div>  
</div>
 <b class="cerrar">Cerrar</b>

?>
<aside class="client">
<label>Seleccione cliente:</label>
        <select id="cliente">
        <option value="0">Elija</option>
<?php
$query="SELECT * FROM clientes";
$result=mysql_query($query);
while($fila=mysql_fetch_array($result))
  {
     echo '<option value="'.$fila["id_cliente"].'">'.$fila["nombre_cliente"].'</option>';
  }
?>
        </select><br><br>
        <br><br>
</aside>
<div class="agregaclie nuevos">Agregar Cliente </div><br>
</body>
</html>
