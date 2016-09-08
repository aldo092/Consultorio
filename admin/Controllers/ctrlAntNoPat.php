<?php
/**
 * Created by PhpStorm.
 * User: Aldo
 * Date: 30/08/2016
 * Time: 02:33 PM
 */
error_reporting(E_ALL);
include_once ("../Class/Usuarios.php");
include "../Class/AntecNoPatologicos.php";
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
$Alcoholico="";
$Fumador="";
$Drogadicto="";
$Luz="";
$Agua="";
$Drenaje="";
$WC="";
$Escolaridad="";
$Religion="";
$Ocupacion="";
$url="../admin/Sesiones/Pacientes/Pacientes.php";

$oAntNopat= new AntecNoPatologicos();
$NAfec=0;
$user= $_SESSION['sUser']->getEmail();

if( isset($_POST["nExpediente"])&&!empty($_POST["nExpediente"])&&
    isset($_POST["alcoholismo"]) && !empty($_POST["alcoholismo"]) &&
    isset($_POST["tabaquismo"]) && !empty($_POST["tabaquismo"]) &&
    isset($_POST["drogas"]) && !empty($_POST["drogas"]) &&
    isset($_POST["luz"]) && !empty($_POST["luz"]) &&
    isset($_POST["aguapotable"]) && !empty($_POST["aguapotable"]) &&
    isset($_POST["drenaje"]) && !empty($_POST["drenaje"]) &&
    isset($_POST["water"]) && !empty($_POST["water"]) &&
    isset($_POST["estudios"]) && !empty($_POST["estudios"]) &&
    isset($_POST["religion"]) && !empty($_POST["religion"]) &&
    isset($_POST["ocupacion"]) && !empty($_POST["ocupacion"])) {

    $Expediente = $_POST["nExpediente"];
    $Alcoholico = $_POST["alcoholismo"];
    $Fumador = $_POST["tabaquismo"];
    $Drogadicto = $_POST["drogas"];
    $Luz = $_POST["luz"];
    $Agua = $_POST["aguapotable"];
    $Drenaje = $_POST["drenaje"];
    $WC = $_POST["water"];
    $Escolaridad = $_POST["estudios"];
    $Religion = $_POST["religion"];
    $Ocupacion = $_POST["ocupacion"];

    $oAntNopat->setExpediente($Expediente);
    $oAntNopat->setAlcoholismo($Alcoholico);
    $oAntNopat->setTabaquismo($Fumador);
    $oAntNopat->setDrogas($Drogadicto);
    $oAntNopat->setElectricidad($Luz);
    $oAntNopat->setAguaPotable($Agua);
    $oAntNopat->setDrenaje($Drenaje);
    $oAntNopat->setServSan($WC);
    $oAntNopat->setEscolaridad($Escolaridad);
    $oAntNopat->setReligion($Religion);
    $oAntNopat->setOcupacion($Ocupacion);

    $NAfec = $oAntNopat->insertar($user);

    if ($NAfec==1) {
        $sMsj = "Registro  de antecedentes No patológicos del expediente ".$Expediente." correcto";
        header("Location:../mensajes.php?sMensaje=".$sMsj."&Destino=".$url);
    } else {
        $sMsj = "Error al guardar los antecedentes No patológicos del expediente".$Expediente;
        header("Location:../mensajes.php?sMensaje=".$sMsj."&Destino=".$url);

    }

}else{
    $sMsj = "Faltan datos, registre todos los campos";
    header("Location:../mensajes.php?sMensaje=".$sMsj."&Destino=".$url);

}

?>















