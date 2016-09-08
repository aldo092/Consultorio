<?php
/**
 * Created by PhpStorm.
 * User: nancy
 * Date: 17/08/2016
 * Time: 05:49 PM
 */
error_reporting(E_ALL);
include_once ("../Class/Usuarios.php");
include "../Class/AntePatologicos.php";
session_start();
$oUser = new Usuarios();
$sErr = "";
if(isset($_SESSION['sUser']) && !empty($_SESSION['sUser'])){
    $oUser = $_SESSION['sUser'];
}else{
    $sErr = "Acceso denegado, inicie sesión";
}

if($sErr != ""){
    header("Location: error.php?sError=".$sErr);
}
$Expediente="";
$Alergias="";
$Cardipatias="";
$Transfusiones="";
$Diabetes="";
$Cardiovascular="";
$HTA="";
$oAntPat = new AntePatologicos();
$NAfec=0;
$user= $_SESSION['sUser']->getEmail();
$url="../admin/Sesiones/Pacientes/Pacientes.php";




if( isset($_POST["nExpediente"])&&!empty($_POST["nExpediente"])&&
    isset($_POST["cardiovascular"]) && !empty($_POST["cardiovascular"]) &&
    isset($_POST["hiper"]) && !empty($_POST["hiper"]) &&
    isset($_POST["cardiopatia"]) && !empty($_POST["cardiopatia"]) &&
    isset($_POST["transfusiones"]) && !empty($_POST["transfusiones"]) &&
    isset($_POST["diabetes"]) && !empty($_POST["diabetes"]) &&
    isset($_POST["alergias"]) && !empty($_POST["alergias"])){

    $Expediente = $_POST["nExpediente"];
    $Alergias = $_POST["alergias"];
    $Cardipatias =$_POST["cardiopatia"];
    $Transfusiones = $_POST["transfusiones"];
    $Diabetes = $_POST["diabetes"];
    $Cardiovascular= $_POST["cardiovascular"];
    $HTA = $_POST["hiper"];

    $oAntPat->setExpediente($Expediente);
    $oAntPat->setAlergias($Alergias);
    $oAntPat->setCardiopatias($Cardipatias);
    $oAntPat->setTransfusiones($Transfusiones);
    $oAntPat->setDiabetico($Diabetes);
    $oAntPat->setCardiovasculares($Cardiovascular);
    $oAntPat->setHTA($HTA);

    $NAfec=$oAntPat->insertar($user);

    if ($NAfec==1) {
        $sMsj = "Registro  de antecedentes patológicos del expediente ".$Expediente." correcto";
        header("Location:../mensajes.php?sMensaje=".$sMsj."&Destino=".$url);
    } else {
        $sMsj = "Error al guardar los antecedente patológicos del expediente".$Expediente;
        header("Location:../mensajes.php?sMensaje=".$sMsj."&Destino=".$url);

    }

}else{
    $sMsj = "Faltan datos, registre todos los campos";
    header("Location:../mensajes.php?sMensaje=".$sMsj."&Destino=".$url);

}

?>




