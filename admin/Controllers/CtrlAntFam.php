<?php
/**
 * Created by PhpStorm.
 * User: Aldo
 * Date: 09/08/2016
 * Time: 05:45 PM
 */
include_once ("../Class/AntecFamiliares.php");

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
$oAntFam=new AntecFamiliares();
$sErr="";

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
    isset($_POST["cancer"]) && !empty($_POST["cancer"])) {

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

    if ($oAntFam->insertar()){
        $sMsj = "Registro  de antecedentes familiares del expediente ".$Expediente." correcto";
        header("Location:../exito.php?sMensaje=".$sMsj);
    } else {
        $sErr = "error al guardar el nuevo paciente";
    }

}else{
    $sErr = "Faltan datos, registre todos los campos";
}

if($sErr != "")
    header("Location: ../error.php?sError=".$sErr);
?>
    }

