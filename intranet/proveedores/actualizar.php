<?PHP 
include("../conexion.php");
$id_prov=trim($_POST["id_prov"]);
$nom_clie=trim(mb_strtoupper($_POST["nom_clie"]));
$razonsocial=trim(mb_strtoupper($_POST["razonsocial"]));
$telefono=trim($_POST["telefono"]);
$id_categoria_cli=trim($_POST["id_categoria_prov"]);
$web=trim($_POST["web"]);
//actualiza info del cliente
$query="UPDATE proveedores SET nom_proveedor='$nom_clie',
		telefono='$telefono',id_cat_prov='$id_categoria_cli',direccion_web='$web'
		WHERE id_proveedor=$id_prov";
mysql_query($query) or die(mysql_error());

$id_datfiscal=trim($_POST["id_datfiscal"]);
$rfc=trim(mb_strtoupper($_POST["rfc"]));
$tipoRason_Soc=trim(mb_strtoupper($_POST["tipoRason_Soc"]));
$femail=trim($_POST["femail"]);
$sql="UPDATE datos_fiscales SET razon_social='$razonsocial',rfc='$rfc',
		tipo_razon_social='$tipoRason_Soc',email='$femail'
		WHERE id_datfiscal=$id_datfiscal";
mysql_query($sql) or die(mysql_error());

//para actualizar la direccion fiscal
$fid_direc=trim($_POST["fid_direc"]);
$fcalle=trim(mb_strtoupper($_POST["fcalle"]));
$fnum_ext=trim(mb_strtoupper($_POST["fnum_ext"]));
$fnum_int=trim(mb_strtoupper($_POST["fnum_int"]));
$fcolonia=trim(mb_strtoupper($_POST["fcolonia"]));
$flocalidad=trim(mb_strtoupper($_POST["flocalidad"]));
$freferencia=trim(mb_strtoupper($_POST["freferencia"]));
$fmunicipio=trim(mb_strtoupper($_POST["fmunicipio"]));
$festado=trim(mb_strtoupper($_POST["festado"]));
$fcod_postal=trim($_POST["fcod_postal"]);

$sent="UPDATE direcciones SET calle='$fcalle',num_ext='$fnum_ext',num_int='$fnum_int',
	   colonia='$fcolonia',localidad='$flocalidad',referencia='$freferencia',municipio='$fmunicipio',
	   estado='$festado',pais=Null,cod_postal='$fcod_postal'
	   WHERE id_direccion=$fid_direc";
mysql_query($sent) or die(mysql_error());


//para actualizar los datos bancarios

$id_bancarios=trim($_POST["id_bancarios"]);
$nombre_banco=trim(mb_strtoupper($_POST["nombre_banco"]));
$bsucursal=trim(mb_strtoupper($_POST["bsucursal"]));
$titular=trim(mb_strtoupper($_POST["titular"]));
$no_cuenta=trim($_POST["no_cuenta"]);
$clave_interbancaria=trim($_POST["clave_interbancaria"]);
$tipo_cuenta=trim(mb_strtoupper($_POST["tipo_cuenta"]));

$sent="UPDATE datos_bancarios SET id_bancarios='$id_bancarios',nombre_banco='$nombre_banco',
		sucursal='$bsucursal',titular='$titular',no_cuenta='$no_cuenta',clave_interbancaria='$clave_interbancaria',tipo_cuenta='$tipo_cuenta'
		WHERE id_bancarios=$id_bancarios";
mysql_query($sent) or die(mysql_error());

//para actualizar la direccion del cliente
$id_direc=trim($_POST["id_direc"]);
$calle=trim(mb_strtoupper($_POST["calle"]));
$num_ext=trim(mb_strtoupper($_POST["num_ext"]));
$num_int=trim(mb_strtoupper($_POST["num_int"]));
$colonia=trim(mb_strtoupper($_POST["colonia"]));
$localidad=trim(mb_strtoupper($_POST["localidad"]));
$referencia=trim(mb_strtoupper($_POST["referencia"]));
$municipio=trim(mb_strtoupper($_POST["municipio"]));
$estado=trim(mb_strtoupper($_POST["estado"]));
$pais=trim(mb_strtoupper($_POST["pais"]));
$cod_postal=trim($_POST["cod_postal"]);
$gps_ubicacion=trim($_POST["gps_ubicacion"]);

$sent="UPDATE direcciones SET calle='$calle',num_ext='$num_ext',num_int='$num_int',
	   colonia='$colonia',localidad='$localidad',referencia='$referencia',municipio='$municipio',
	   estado='$estado',pais='$pais',cod_postal='$cod_postal',gps_ubicacion='$gps_ubicacion'
	   WHERE id_direccion=$id_direc";
mysql_query($sent) or die(mysql_error());


header("location: ./detalle.php?id_prov=$id_prov");
?>

