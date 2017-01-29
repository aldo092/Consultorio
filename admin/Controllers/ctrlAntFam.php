<?php
/**
 * Created by PhpStorm.
 * User: Aldo
 * Date: 09/08/2016
 * Time: 05:45 PM
 */
include_once ("../Class/AntecFamiliares.php");
include_once ("../Class/Usuarios.php");


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

$Expediente="";
$Alcoholismo="";
$fumador="";
$Drogradicto="";
$asma="";
$diabetes="";
$hipertension="";
$alergias="";
$convulsiones="";
$defectosCongenito="";
$Cancer="";
$cardiopatias="";
$TB="";
$Epilepsia="";
$InsRen="";
$oAntFam=new AntecFamiliares();
$sErr="";
$nAfec =0;
$user= $_SESSION['sUser']->getEmail();
$url="../admin/Sesiones/Pacientes/Pacientes.php";



if( isset($_POST["nExpediente"])&&!empty($_POST["nExpediente"])&&
    isset($_POST["alcoholismo"]) && !empty($_POST["alcoholismo"]) &&
    isset($_POST["tabaquismo"]) && !empty($_POST["tabaquismo"])&&
    isset($_POST["drogas"]) && !empty($_POST["drogas"])&&
    isset($_POST["asma"]) && !empty($_POST["asma"])&&
    isset($_POST["diabetes"]) && !empty($_POST["diabetes"])&&
    isset($_POST["hipertension"]) && !empty($_POST["hipertension"])&&
    isset($_POST["alergias"]) && !empty($_POST["alergias"])&&
    isset($_POST["convulsiones"]) && !empty($_POST["convulsiones"])&&
    isset($_POST["congenitos"]) && !empty($_POST["congenitos"])&&
    isset($_POST["cancer"]) && !empty($_POST["cancer"])&&
    isset($_POST["cardiopatias"]) && !empty($_POST["cardiopatias"])&&
    isset($_POST["tb"]) && !empty($_POST["tb"])&&
    isset($_POST["epilepsia"]) && !empty($_POST["epilepsia"])&&
    isset($_POST["insren"]) && !empty($_POST["insren"])){

    $Expediente = $_POST["nExpediente"];
    $Alcoholismo = $_POST["alcoholismo"];
    $fumador = $_POST["tabaquismo"];
    $Drogradicto = $_POST["drogas"];
    $asma = $_POST["asma"];
    $diabetes = $_POST["diabetes"];
    $hipertension = $_POST["hipertension"];
    $alergias = $_POST["alergias"];
    $convulsiones = $_POST["convulsiones"];
    $defectosCongenito = $_POST["congenitos"];
    $Cancer = $_POST["cancer"];
    $cardiopatias=$_POST["cardiopatias"];
    $TB=$_POST["tb"];
    $Epilepsia=$_POST["epilepsia"];
    $InsRen=$_POST["insren"];


    $oAntFam->setExpediente($Expediente);
    $oAntFam->setAlcoholismo($Alcoholismo);
    $oAntFam->setTabaquismo($fumador);
    $oAntFam->setDrogradiccion($Drogradicto);
    $oAntFam->setAsma($asma);
    $oAntFam->setDiabetes($diabetes);
    $oAntFam->setHipertension($hipertension);
    $oAntFam->setAlergias($alergias);
    $oAntFam->setConvulsiones($convulsiones);
    $oAntFam->setCongenitos($defectosCongenito);
    $oAntFam->setCancer($Cancer);
    $oAntFam->setSCardiopatias($cardiopatias);
    $oAntFam->setSTuberculosis($TB);
    $oAntFam->setSEpilepsia($Epilepsia);
    $oAntFam->setSInsRenal($InsRen);

    $nAfec=$oAntFam->insertar($user);

    if ($nAfec==1){
        $sMsj = "Registro  de antecedentes familiares del expediente ".$Expediente." correcto";
        header("Location:../mensajes.php?sMensaje=".$sMsj."&Destino=".$url);
    } else {
        $sMsj = "Error al guardar los antecedente familiares del expediente".$Expediente;
        header("Location:../mensajes.php?sMensaje=".$sMsj."&Destino=".$url);

    }

}else{
    $sMsj = "Faltan datos, registre todos los campos";
    header("Location:../mensajes.php?sMensaje=".$sMsj."&Destino=".$url);

}

?>


