<?php
   require('../../class/classProductos.php');
    $productos = new Productos();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Cargar Datos</title>
    <link rel="stylesheet" href="../../css/estilos.css">
</head>
    <body>
        <form action="" method="post" name="formulario" onsubmit="return false;">
            <!-- <h2 style="box-shadow:0px -1px 1px;width:400px;background:#16555B; color:white;border-top-right-radius:10px;border-top-left-radius:10px;">Agregar datos Producto</h2> -->
            <div style="width:400px;background:#fff; text-align:left;padding:20px 20px 1px 25px;">
                <table style="width: auto;"> 
                    <tr>
                        <td colspan="2"><h3 style='color:#000;text-align:center;'>Agregar Datos</h3></td>
                    <tr>
                    <tr>
                        <?php
                            // print_r($_REQUEST)."\n";
                            $id_concepto = $_REQUEST['conceptoid'];
                        ?>
                        <input type="hidden" name="idconcepto" id="idconcepto" value="<?=$id_concepto?>" disabled/>
                    </tr>
                    <tr>
                        <td><label>Categoría</label></td>
                        <td>
                            <select name="categoria" style="line-height: 0px;" id="selcategoria">
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
                            <select name="id_subcategoria" style="line-height: 0px;" id="selsubcategoria">
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
                            <select name="id_division" style="line-height: 0px;" id="seldivision">
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
                            <select name="id_nombre" style="line-height: 0px;" id="selnombre">
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
                            <select name="id_tipo" style="line-height: 0px;" id="seltipo">
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
                            <select name="id_marca" style="line-height: 0px;" id="selmarca">
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
                        <td><label> Moneda :</label></td>
                        <td>
                            <select name="moneda" style="line-height: 0px;" id="selmoneda">
                                <option value="0">Elige</option>
                                <?php
                                        $monedas = $productos->getMonedas();
                                        foreach($monedas as $moneda) :
                                ?>
                                        <option value='<?=$moneda['id_moneda']?>'><?=$moneda['nombre_moneda']?></option>		
                                <?php endforeach;?>	
                            </select>
                        </td>
                    </tr>
                </table>
                <div style="">
                    <center><input type="submit" onclick="agregarDatos()" class="btn primary" value="Agregar Datos"></center>
                </div>
            </div>
        </form>
    </body>
</html>
