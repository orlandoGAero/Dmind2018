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
        <script src="../../Js/configuracion.js" type="text/javascript"></script>
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

      $("#cantidad").mouseout(function(){
      var cant = $("#cantidad").val();
      var exi = $("#existencias").val();
      if(cant>exi){
        $("#cantidad").focus();
        //event.preventDefault();
        $(".exit").css("display","block");
        //.slideDown(1500);
        return false;
      }else{
        $(".exit").css("display","none");
        $("#agregar").attr("action","agregarproductos.php");
      }
      });
      $(".enviar").mouseover(function(){
        var cant = $("#cantidad").val();
        var pre = $("#precio").val();
        if(cant==""){
          $(".falta").css("display","block");
        }else{
          if(pre =""){

          }else{
          $(".falta").css("display","none");  
          }
        }
      });
     
        });
        </script>
        <style type="text/css">
        .exit,.falta{
          position: absolute;
          width: 150px;
          height: 40px;
          left: 40px;
          top: 610px;
          border: 1px solid #fff;
          border-radius: 5px;
          background: rgba(220,20,60,.9);
          z-index: 100;
          padding: 5px;
          font-weight: bold;
          display: none;
        }
        </style>
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
$id_venta=$_GET["venta"];
$query = "SELECT id_venta, fecha FROM venta where id_venta=$id_venta";
$result = mysql_query($query) or die ("la consulta fallo:".mysql_error());

    while ($fila = mysql_fetch_array($result))
    {
        echo "COTIZACION DIGITAL<br> COT ", $fila[0], "<br> ";
        echo "FECHA : ", $fila['fecha'], " ";
}
?>
</spam>
</div>
<table><tr>
<td>
<div class="datosclie" id="camposclie" style="padding:5px;">
<h3>EN ATENCION A</h3><br>
<?php
$query="SELECT V.id_venta, nombre_cliente, calle, num_ext,num_int, localidad, municipio, D.estado, pais, cod_postal,F.rfc from venta V
       inner join clientes on V.id_cliente=clientes.id_cliente 
       inner join datos_fiscales F on clientes.id_datfiscal=F.id_datfiscal
       inner join direcciones D on F.id_direccion=D.id_direccion where id_venta=$id_venta";
$result=mysql_query($query);
while($fila=mysql_fetch_array($result))
{
    echo "<li>", $fila['nombre_cliente'],"</li>";
    echo "<br>";
    echo "<li>RFC:<b>", $fila['rfc'],"</b></li>";
    echo "<li>Dirección:<b>", $fila['calle']," ", $fila['num_ext']," ", $fila['num_int'],"</b></li>";
    echo "<li>Colonia:<b>", $fila['localidad'],"</b></li>";
    echo "<li>Localidad:<b>", $fila['localidad'],"</b></li>";
    echo "<li>Municipio:<b>", $fila['municipio'],"</b></li>";
    echo "<li>Estado:<b>", $fila['estado'],"</b></li>";
    echo "<li>C.P. /Pais:<b>", $fila['cod_postal'],"/", $fila['pais'],"</b></li>";
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
$query="SELECT * FROM detalle_venta 
          where id_venta=$id_venta";
$result=mysql_query($query);
while($fila=mysql_fetch_array($result))
{
        echo "<tr>";
        echo "<td class='cantidad'>", $fila['cantidad'], " Piezas</td>";
        echo "<td class='desc'>", $fila['descripcion'],"<br> ",$fila["nota"], "</td>";
        echo "<td class='preciou'>", $fila['precio'], "</td>";
        echo "<td class='importe'>", $fila['importe'], "</td>";
        echo "<td><a href='editarnota.php?id_venta=", $fila["id_venta"],"&id_producto=", $fila["id_producto"],"'><img src='../Imagenes/editar.png'></a></td>";
        echo "<td><a href='eliminarpro.php?descripcion=", $fila['descripcion'],"&id_venta=", $fila['id_venta'],"'>";
        echo "<img src='../Imagenes/borrar.png'></a></td>";
        echo "</tr>";
}
?>
</table>
<aside class="operaciones" style="margin-left:400px;">
<?php
$sql="SELECT SUM(importe) FROM detalle_venta WHERE id_venta= $id_venta";
$result=mysql_query("$sql");
?>
<b> SUBTOTAL:</b>
<?php 
while ($fila = mysql_fetch_array($result)){
     $subt=$fila[0]; 
    }
    //rowspan="2"
?>
<?php
$sql="SELECT id_moneda,subtotal,iva,total,tipo_venta FROM venta WHERE id_venta= $id_venta";
$result=mysql_query("$sql");

while ($fila = mysql_fetch_array($result)){
 echo "<b class='num1'>$",number_format($fila["subtotal"], 2, '.', ''),"</b>";
 $iv=$fila["iva"];
  $iva=$iv*.01;//iva del subtotal
    $cuent=$subt*$iva;
  echo "<br><b> I.V.A: </b>";
  echo '<b class="num2">$';
  echo number_format($cuent, 2, '.', '');
  echo '</b>';
  echo "<br><b> TOTAL: </b>";
  echo '<b class="num3">$';
  echo number_format($fila["total"], 2, '.', '');
  echo '</b>';
  $moneda=$fila["id_moneda"];
  $tipo_venta=$fila["tipo_venta"];
    }
?> 
</aside>
<form action="editaiva.php" id="ivass">
<input type="hidden" id="venta" name="id_venta" value="<?php echo $_GET["venta"]; ?>">
Iva:<input type="text" name="iva" id="ivas">
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

  <select name="tipo" class="moneda" name="tipo" style="margin-left:20px;">
<?php 
$sql="SELECT tipo_venta FROM venta where id_venta=$id_venta";
$result=mysql_query("$sql");
while ($fila = mysql_fetch_array($result)){
  if($fila[0]=="0"){
    echo "<option value='0'>Tipo Venta</option>";
    echo "<option value='Nota'>Nota</option>";
    echo "<option value='Fiscal'>Fiscal</option>";
  }else{
    if($fila[0]=="Fiscal"){
      echo "<option value='Fiscal'>Fiscal</option>";
      echo "<option value='Nota'>Nota</option>";
    }else{
      if($fila[0]=="Nota"){
      echo "<option value='Nota'>Nota</option>";
      echo "<option value='Fiscal'>Fiscal</option>";
      }
    }
  }
}
?>
  </select>
</form>
</article>
<div id="addproductos">
<form id="agregar">
<div id="adpro">
    <spam class="nuevop">Nuevo Producto</spam>
    <input type="hidden" name="venta" id="id_cotizacion" value="<?php echo $_GET["venta"]; ?>">
    <br>
  <label> Categoria:</label>
<select id="categoria">
<option>Elige</option>
<?php //este se utiliza para llenar el combo de categorias
$query = "SELECT DISTINCT P.id_categoria, nombre_categoria FROM inventario I 
                    INNER JOIN productos P on I.id_producto=P.id_producto
                    INNER JOIN categorias C on P.id_categoria=C.id_categoria where id_status=4";
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
<select id="nombres" name="nombre">
<option value="0">Elija</option>
</select>
<label>Tipo:</label>
<select id="tipos">
<option value="0">Elija</option>
</select>
  <label>Marca</label>
  <select id="marcas" name="marca">
  <option value="0">Elige un marca</option>
  </select>     
  <label>Modelo</label>
     <select id="modelos" class="producto" name="id_producto"><option>Elige un modelo</option></select>
     <select id="noserie" class="producto" name="no_serie"><option>No. Serie</option></select>
     <select id="existencias" style="display:none;width:120px;-webkit-appearance: none;-moz-appearance: none;-o-appearance: none;">
     <option></option>
     </select>
<textarea name="nota" cols="20" rows="3" style="resize:none;">
  
</textarea>
        <label>Cantidad</label><br>
            <input type='text' name='cantidad' id="cantidad" /><br> 

            <spam class="exit">No hay suficientes existencias</spam> 
            <spam class="falta">Faltan datos</spam>
        <label>Precio</label><br>
        <select id="precu">
          <option></option>
        </select>
        <input name="precio" id="precio"/>
        
            <label id="imp"></label>
            <input type='hidden' name="importe" id="importe" />
            <button class="enviar" style="cursor: pointer;width:100px;border-radius:4px;height:30px;">Agregar</button><br>
</div>
</form>    
</div>
<div id="botones">
<br>
<a href="registroventas.php"><div id="buscotizacion">Buscar Cotizacion</div></a>
<br>
<div style="position:absolute;margin-top:30px;color:#000;background:#fff;border-radius:5px;">
<label style="posiition:absolute;">Estado de venta:</label><br>
<select id="estadoventa">
  <?php 
$query="SELECT V.id_status_venta,nombre_status_venta FROM venta V INNER JOIN status_venta S on V.id_status_venta=S.id_status_venta where id_venta=$id_venta";
$result=mysql_query($query);
while($fila=mysql_fetch_array($result))
  {
     echo '<option value="'.$fila["id_status_venta"].'">'.$fila["nombre_status_venta"].'</option>';
     $status=$fila[0];
  }
$sql="SELECT id_status_venta,nombre_status_venta FROM status_venta where not id_status_venta=$status";
$result=mysql_query($sql);
while($fila=mysql_fetch_array($result))
  {
     echo '<option value="'.$fila["id_status_venta"].'">'.$fila["nombre_status_venta"].'</option>';
  }


   ?>
</select>
</div>
<a href="pdfcot.php?id_venta=<?php echo $_GET["venta"]; ?>" target="_blank">
<button id="guardar"> Imprimir </button></a><br>
</section>
        <a href='quitarproductos.php?id_venta=<?php echo $_GET["venta"]; ?>'>
        <button id="borrtodo">Quitar productos</button></a><br>
        <a href='registroventas.php'>
<?php 
$query = "SELECT * FROM detalle_venta where id_venta=$id_venta";
$result = mysql_query($query);
$cuantos=mysql_num_rows($result);
?>
<form action="guardar.php" style="position:absolute;">
<input type="hidden" value="<?php echo $_GET["venta"]; ?>" name="id_venta">
<input type="hidden" value="<?php echo $cuantos ?>" name="cuantos">
<?php
$conta=1;
$se=1;
  while ($fila = mysql_fetch_array($result))
  {
  echo "<input type='hidden' name='p",$conta++,"' value='",$fila["id_producto"],"' />";
  echo "<input type='hidden' name='s",$se++,"' value='",$fila["no_serie"],"' />";
  }
?>
<button class="btn primary si" style="width:140px;heigth:40px;" id="gua">Vender y salir</button>
<a href="registroventas.php" style="width:170px;heigth:35px;color:#fff;background:red;padding:5px;text-decoration:none;border-radius:5px;border:1px solid #fff;">
Cancelar</a><br>
</form>
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
