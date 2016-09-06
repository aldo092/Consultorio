<?php
/**
 * Created by PhpStorm.
 * User: Aldo
 * Date: 31/08/2016
 * Time: 03:58 PM
 */


error_reporting(E_ALL);
include_once ("../Class/Usuarios.php");
include "../Class/AntecGinecobstetricos.php";
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
$Gestaciones=0;
$Partos=0;
$Abortos=0;
$Ivsa=0;
$Parejas=0;
$ETS="";
$Cesareas=0;
$Papanicolau="";
$Anticonceptivo="";
$oAntGin= new AntecGinecobstetricos();
$NAfec=0;
$user= $_SESSION['sUser']->getEmail();

if( isset($_POST["nExpediente"])&&!empty($_POST["nExpediente"])&&
    isset($_POST["gestaciones"]) && !empty($_POST["gestaciones"]) &&
    isset($_POST["partos"]) && !empty($_POST["partos"]) &&
    isset($_POST["abortos"]) && !empty($_POST["abortos"]) &&
    isset($_POST["ivsa"]) && !empty($_POST["ivsa"]) &&
    isset($_POST["parejas"]) && !empty($_POST["parejas"]) &&
    isset($_POST["ets"]) && !empty($_POST["ets"]) &&
    isset($_POST["cesareas"]) && !empty($_POST["cesareas"]) &&
    isset($_POST["papanicolau"]) && !empty($_POST["papanicolau"]) &&
    isset($_POST["anticonceptivo"]) && !empty($_POST["anticonceptivo"])) {

    $Expediente = $_POST["nExpediente"];
    $Gestaciones = $_POST["gestaciones"];
    $Partos = $_POST["partos"];
    $Abortos = $_POST["abortos"];
    $Ivsa= $_POST["ivsa"];
    $Parejas = $_POST["parejas"];
    $ETS= $_POST["ets"];
    $Cesareas = $_POST["cesareas"];
    $Papanicolau = $_POST["papanicolau"];
    $Anticonceptivo = $_POST["anticonceptivo"];


    $oAntGin->setExpediente($Expediente);
    $oAntGin->setGestaciones($Gestaciones);
    $oAntGin->setPartos($Partos);
    $oAntGin->setAbortos($Abortos);
    $oAntGin->setIVSA($Ivsa);
    $oAntGin->setParejasSexuales($Parejas);
    $oAntGin->setETS($ETS);
    $oAntGin->setCesareas($Cesareas);
    $oAntGin->setUltPapanicolau($Papanicolau);
    $oAntGin->setAnticonceptivos($Anticonceptivo);

    $NAfec = $oAntGin->insertar($user);


    if ($NAfec==1) {
        $sMsj = "Registro  de antecedentes  gineco-obstétricos del expediente ".$Expediente." correcto";
        header("Location:../mensajes.php?sMensaje=".$sMsj);
    } else {
        $sMsj = "Error al guardar los antecedentes  gineco-obstétricos del expediente".$Expediente;
        header("Location:../mensajes.php?sMensaje=".$sMsj);

    }

}else{
    $sMsj = "Faltan datos, registre todos los campos";
    header("Location:../mensajes.php?sMensaje=".$sMsj);

}

?>















