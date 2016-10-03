<?php
/**
 * Created by PhpStorm.
 * User: Aldo
 * Date: 18/09/2016
 * Time: 12:39 AM
 */

error_reporting(E_ALL);
include_once ("../Class/Usuarios.php");
include_once ("../Class/Consultorio.php");

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
$Medico="";
$Nombre="";
$OConsultorio=new Consultorio();
$user= $_SESSION['sUser']->getEmail();
$NAfec=0;
$Err="";
$sMsj="";
$url="../admin/Sesiones/Consultorios/registrarConsultorio.php";
if(isset($_POST["medico"]) && !empty($_POST["medico"]) &&
    isset($_POST["nombre"]) && !empty($_POST["nombre"])){

    $Medico=$_POST["medico"];
    $Nombre=$_POST["nombre"];

    $OConsultorio->setMedico("$Medico");
    $OConsultorio->setNombre("$Nombre");

    $NAfec=$OConsultorio->insertar($user);

    if ($NAfec==1) {
        $sMsj = "Se agregó el consultorio ".$Nombre."  a la base de datos";
        header("Location:../mensajes.php?sMensaje=".$sMsj."&Destino=".$url);
    }

    else {
        $sMsj = "Error al guardar los datos del consultorio";
        header("Location:../mensajes.php?sMensaje=".$sMsj."&Destino=".$url);


    }

}else{
    $sMsj = "Faltan datos, registre todos los campos";
    header("Location:../mensajes.php?sMensaje=".$sMsj."&Destino=".$url);

}


?>





