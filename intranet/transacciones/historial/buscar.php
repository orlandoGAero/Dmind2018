<?php  include ("../../configuracion/head.php");?>
<?php  include ("../../configuracion/nav.php");?>
  <h1 style="text-align:center;">Busqueda de Producto</h1>
  <section id="contenido">
    <section id="principal">
    <form action="buscar.php">
    <label>Buscar :</label>
    <input name="buscar" type="text" list="lista" value="<?php echo $_GET["buscar"] ?>"  title="Ingresa descripcion para buscar">
    <button class="buscar">.</button>
    </form>
<?php  
include ("../../conexion.php");
  $b=$_GET["buscar"];

  $sql="SELECT distinct P.id_producto, C.nombre_categoria, S.nombre_subcategoria,
            nombre,no_serie, M.nombre_marca, P.modelo, P.precio from inventario I
          inner join productos P on I.id_producto=P.id_producto
            inner join categorias C on P.id_categoria=C.id_categoria 
            inner join subcategorias S on P.id_subcategoria=S.id_subcategoria 
            inner join marcas M on P.id_marca=M.id_marca 
            inner join nombres N on P.id_nombre=N.id_nombre
            WHERE nombre LIKE '%".$b."%'";
  $result=mysql_query($sql);
  $conta=mysql_num_rows($result);
if($conta>0){
  echo "<b style='color:#fff;'>Existen ",$conta," coincidencias</b>";
}
  if($conta==0 || $b ==""){
      echo "<br><br><img src='../../images/nohay.jpg' style='border-radius:10px;-moz-border-radius:10px;' />";
  }else{
?>
<table class="datos" id="allregistros">
        <tr>
          <th>ID</th>
          <th>CATEGORIA</th>
          <th>SUBCATEGORIA</th>
          <th>NOMBRE</th>
          <th>MODELO</th>
          <th>NO. SERIE</th>
          <th>MARCA</th>
          <th>PRECIO</th>
          <th></th>
          <th></th>
        </tr>
<?php
  while($fila=mysql_fetch_array($result)){
       echo "<tr>";
       echo '<td align="center">'.$fila["id_producto"].'</td>';
       echo '<td align="center">'.$fila["nombre_categoria"].'</td>';
       echo '<td align="center">'.$fila["nombre_subcategoria"].'</td>';
       echo '<td align="center">'.$fila["nombre"].'</td>';
       echo '<td align="center">'.$fila["modelo"].'</td>';
       echo '<td align="center">'.$fila["no_serie"].'</td>';
       echo '<td align="center">'.$fila["nombre_marca"].'</td>';
       echo '<td align="center">'.$fila["precio"].'</td>';
       echo '<td><a href="ventas.php?id_pro='.$fila[0].'&no_serie='.$fila["no_serie"].'"><img src="../../images/ventas.png" title="Ventas"></a></td>';
       echo '<td><a href="inventario.php?id_pro='.$fila['id_producto'].'&no_serie='.$fila["no_serie"].'" class="edita"><img src="../../images/inventario.png" title="inventario"></a></td>';
       echo "</tr>";
  }
}
?>
</table>

    </body>
}
</html>
