<?PHP 
	include("../conexion.php");
$id_cont=$_GET["id_cont"];
$nom_clie=$_GET["nom_clie"];
$id_areacontacto=$_GET["id_areacontacto"];
$tel_casa=$_GET["tel_casa"];
$tel_oficina=$_GET["tel_oficina"];
$tel_emerg=$_GET["tel_emerg"];
$tel_movil=$_GET["tel_movil"];
$email_personal=$_GET["email_personal"];
$email_institucion=$_GET["email_institucion"];
$facebook=$_GET["facebook"];
$web=$_GET["web"];
$twiter=$_GET["twiter"];
$skype=$_GET["skype"];

$sent="UPDATE contactos SET nombre='$nom_clie',id_areacontacto='$id_areacontacto',telefono_casa='$tel_casa',tel_oficina='$tel_oficina',
	   tel_emergencia='$tel_emerg',movil='$tel_movil',email_personal='$email_personal',email_institucion='$email_institucion',
	   facebook='$facebook',direccion_web='$web',twitter='$twiter',skype='$skype'
	   WHERE id_contacto=$id_cont";
mysql_query($sent) or die(mysql_error());


$id_direc=$_GET["id_direc"];
$calle=$_GET["calle"];
$num_ext=$_GET["num_ext"];
$num_int=$_GET["num_int"];
$colonia=$_GET["colonia"];
$localidad=$_GET["localidad"];
$referencia=$_GET["referencia"];
$municipio=$_GET["municipio"];
$estado=$_GET["estado"];
$pais=$_GET["pais"];
$cod_postal=$_GET["cod_postal"];
$sucursal=$_GET["sucursal"];
$gps_ubicacion=$_GET["gps_ubicacion"];

$sent="UPDATE direcciones SET calle='$calle',num_ext='$num_ext',num_int='$num_int',
	   colonia='$colonia',localidad='$localidad',referencia='$referencia',municipio='$municipio',
	   estado='$estado',pais='$pais',cod_postal='$cod_postal',sucursal='$sucursal',gps_ubicacion='$gps_ubicacion'
	   WHERE id_direccion=$id_direc";
mysql_query($sent) or die(mysql_error());




	header("location: ./detalle.php?id_cont=$id_cont");
?>
