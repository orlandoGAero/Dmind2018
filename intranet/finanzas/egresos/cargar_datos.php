<?php
   // include_once('../../class/classProductosEg.php');
   // $productos = new Productos();
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
        <!-- divs nuevos datos -->
        <div id="nuevaCat" class="modal-egresos"></div>
        <div id='ventanaFondoCat' class='overlay-nuevo' onclick="cerrarCat()"></div>

        <div id="nuevaSub" class="modal-egresos"></div>
        <div id='ventanaFondoSub' class='overlay-nuevo' onclick="cerrarSub()"></div>

        <div id="nuevaDiv" class="modal-egresos"></div>
        <div id='ventanaFondoDiv' class='overlay-nuevo' onclick="cerrarDiv()"></div>

        <div id="nuevaNom" class="modal-egresos"></div>
        <div id='ventanaFondoNom' class='overlay-nuevo' onclick="cerrarNom()"></div>

        <div id="nuevaTip" class="modal-egresos"></div>
        <div id='ventanaFondoTip' class='overlay-nuevo' onclick="cerrarTip()"></div>

        <div id="nuevaMar" class="modal-egresos"></div>
        <div id='ventanaFondoMar' class='overlay-nuevo' onclick="cerrarMar()"></div>


        <!-- FIN divs nuevos datos -->
    
        <form action="" method="post" name="formulario" onsubmit="return false;">
            <!-- <h2 style="box-shadow:0px -1px 1px;width:400px;background:#16555B; color:white;border-top-right-radius:10px;border-top-left-radius:10px;">Agregar datos Producto</h2> -->
            <div style="width:600px;background:#fff; text-align:left;padding:20px 20px 1px 25px;">
                
                <table style="width: auto;"> 
                    <tr>
                        <td colspan="3"><h3 style='color:#000;text-align:center;'>Agregar Datos</h3></td>
                    <tr>
                    <tr>
                        <?php
                            // print_r($_REQUEST)."\n";
                            $id_concepto = $_REQUEST['conceptoid'];
                        ?>
                        <input type="hidden" name="idconcepto" id="idconcepto" value="<?=$id_concepto?>" disabled/>
                    </tr>
                    <tr>
                        <td><label>Categoría:</label></td>
                        <td>
                            <div id="selectCat">
                                <?php 
                                    include_once('datosSelCat.php');
                                ?>
                            </div>
                        </td>
                        <td>
                            <button class="botonesDatos" onclick="nuevaCat()">
                                Nueva Categoria
                            </button>
                        </td>
                        <td><span id="alerta1" class="errores-e">Elige categoria</span></td>
                    </tr>
                    <tr>
                        
                    </tr>
                    <tr>
                        <td><label>Subcategoría:</label></td>
                        <td>
                            <div id="selectSub">
                                <?php include_once 'datosSelSub.php'; ?>
                            </div>
                        </td>
                        <td>
                            <button class="botonesDatos" onclick="nuevaSubCat()">
                                Nueva Subcategoria
                            </button>
                        </td>
                        <td><span id="alerta2" class="errores-e">Elige subcategoria</span><br></td>
                    </tr>
                    <tr>
                        <td><label>División:</label></td>
                        <td>
                            <div id="selectDiv">
                                <?php include_once 'datosSelDiv.php'; ?>
                            </div>
                        </td>
                        <td>
                            <button class="botonesDatos" onclick="nuevaDiv()">
                                Nueva División
                            </button>
                        </td>
                        <td><span id="alerta3" class="errores-e">Elige división</span><br><td>
                    </tr>
                    <tr>
                        <td><label>Nombre :</label></td>
                        <td>
                            <div id="selectNom">
                                <?php include_once 'datosSelNom.php' ?>
                            </div>
                        </td>
                        <td>
                            <button class="botonesDatos" onclick="nuevoNom()">
                                Nuevo Nombre
                            </button>
                        </td>
                        <td><span id="alerta4" class="errores-e">Elige nombre</span><br></td>
                    </tr>
                    <tr>
                        <td><label>Tipo:</label>
                        <td>
                            <div id="selectTip">
                                <?php include_once 'datosSelTip.php'; ?>
                            </div>
                        </td>
                        <td>
                            <button class="botonesDatos" onclick="nuevoTip()">
                                Nuevo Tipo
                            </button>
                        </td>
                        <td><span id="alerta5" class="errores-e">Elige tipo</span><br></td>
                    </tr>
                    <tr>
                        <td><label>Marca :</label></td>
                        <td>
                            <div id="selectMar">
                                <?php include_once 'datosSelMar.php'; ?>
                            </div>
                        </td>
                        <td>
                            <button class="botonesDatos" onclick="nuevaMar()">
                                Nueva Marca
                            </button>
                        </td>
                        <td><span id="alerta6" class="errores-e">Elige marca</span><br></td>
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
                        <td><span id="alerta7" class="errores-e">Elige moneda</span><br></td>
                    </tr>
                </table>
                <div style="">
                    <center><input type="submit" onclick="agregarDatos()" class="btn primary" value="Agregar Datos"></center>
                </div>
            </div>
        </form>
    </body>
</html>
