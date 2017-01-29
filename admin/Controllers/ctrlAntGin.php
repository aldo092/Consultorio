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
$Gestaciones="";
$Partos="";
$Abortos="";
$Ivsa="";
$Parejas="";
$ETS="";
$Cesareas="";
$Papanicolau="";
$Anticonceptivo="";
$FUP="";
$FUM="";
$Menarca="";
$Observaciones="";
$oAntGin= new AntecGinecobstetricos();
$NAfec=0;
$user= $_SESSION['sUser']->getEmail();
$url="../admin/Sesiones/Pacientes/Pacientes.php";



if( isset($_POST["nExpediente"])&&
    isset($_POST["gestaciones"]) &&
    isset($_POST["partos"]) &&
    isset($_POST["abortos"])&&
    isset($_POST["ivsa"]) &&
    isset($_POST["parejas"]) &&
    isset($_POST["ets"]) &&
    isset($_POST["cesareas"]) &&
    isset($_POST["papanicolau"]) &&
    isset($_POST["anticonceptivo"])&&
    isset($_POST["fup"])&&
    isset($_POST["fum"])&&
    isset($_POST["menarca"])&&
    isset($_POST["observaciones"])){

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
    $FUP= $_POST["fup"];
    $FUM= $_POST["fum"];
    $Menarca=$_POST["menarca"];
    $Observaciones=$_POST["observaciones"];


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
    $oAntGin->setDFUP($FUP);
    $oAntGin->setDFUM($FUM);
    $oAntGin->setDMenarca($Menarca);
    $oAntGin->setSObservaciones($Observaciones);

    $NAfec = $oAntGin->insertar($user);


    if ($NAfec==1) {
        $sMsj = "Registro  de antecedentes ginecoobstectricos del expediente ".$Expediente." correcto";
        header("Location:../mensajes.php?sMensaje=".$sMsj."&Destino=".$url);
    } else {
        $sMsj = "Error al guardar los antecedentes ginecoobstectricos del expediente".$Expediente;
        header("Location:../mensajes.php?sMensaje=".$sMsj."&Destino=".$url);
      }
}
    else{
    $sMsj = "Faltan datos, registre todos los campos";
    header("Location:../mensajes.php?sMensaje=".$sMsj."&Destino=".$url);
}

?>















