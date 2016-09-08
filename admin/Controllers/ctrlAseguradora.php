<?php
/**
 * Created by PhpStorm.
 * User: Aldo
 * Date: 06/09/2016
 * Time: 10:41 PM
 */
error_reporting(E_ALL);
include_once ("../Class/Usuarios.php");
include_once ("../Class/Aseguradora.php");

session_start();
$sErr = "";
$arrMenus = null;
if(isset($_SESSION['sUser']) && !empty($_SESSION['sUser'])){
    $oUser = $_SESSION['sUser'];

}else{
    $sErr = "Acceso denegado, inicie sesión";
}

if($sErr != ""){
    header("Location: error.php?sError=".$sErr);
}
$Nombre="";
$Telefono="";
$Direccion="";
$OSeguro=new Aseguradora();
$user= $_SESSION['sUser']->getEmail();
$NAfec=0;
$Err="";
$sMsj="";
$url="../admin/Sesiones/Seguro/controlSeguros.php";
if(isset($_POST["nombre"]) && !empty($_POST["nombre"]) &&
    isset($_POST["telefono"]) && !empty($_POST["telefono"])&&
    isset($_POST["direccion"]) && !empty($_POST["direccion"])){

    $Nombre=$_POST["nombre"];
    $Telefono = $_POST["telefono"];
    $Direccion = $_POST["direccion"];

    $OSeguro->setNombre("$Nombre");
    $OSeguro->setTelefono("$Telefono");
    $OSeguro->setDireccion("$Direccion");

    $NAfec=$OSeguro->insertar($user);

    if ($NAfec==1) {
        $sMsj = "Se agregó la aseguradora ".$Nombre."  a la base de datos";
        header("Location:../mensajes.php?sMensaje=".$sMsj."&Destino=".$url);
    }

    else {
        $sMsj = "Error al guardar los datos de la aseguradora";
        header("Location:../mensajes.php?sMensaje=".$sMsj."&Destino=".$url);


    }

}else{
    $sMsj = "Faltan datos, registre todos los campos";
    header("Location:../mensajes.php?sMensaje=".$sMsj."&Destino=".$url);

}


?>





