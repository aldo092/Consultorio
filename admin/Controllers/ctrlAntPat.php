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
$Fracturas="";
$Reumaticas="";
$Rinitis="";
$Asma="";
$Convulsiones="";
$Migrañas="";
$Psiquiatricos="";
$TB="";
$EVC="";
$Dermatosis="";
$Audicion="";
$Vision="";
$EnfArt="";
$Varices="";
$Ulceras="";
$Apendicitis="";
$Prostata="";
$Urinarias="";
$AciPep="";
$SanDig="";
$Hepatitis="";
$Hernias="";
$Colitis="";
$Colecis="";
$PatAnal="";
$Internamientos="";
$Cirujias="";
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
    isset($_POST["alergias"]) && !empty($_POST["alergias"])&&
    isset($_POST["fracturas"]) && !empty($_POST["fracturas"])&&
    isset($_POST["reumaticas"]) && !empty($_POST["reumaticas"])&&
    isset($_POST["rinitis"]) && !empty($_POST["rinitis"])&&
    isset($_POST["asma"]) && !empty($_POST["asma"])&&
    isset($_POST["convulsiones"]) && !empty($_POST["convulsiones"])&&
    isset($_POST["migrañas"]) && !empty($_POST["migrañas"])&&
    isset($_POST["psiquiatricos"]) && !empty($_POST["psiquiatricos"])&&
    isset($_POST["tb"]) && !empty($_POST["tb"])&&
    isset($_POST["evc"]) && !empty($_POST["evc"])&&
    isset($_POST["dermatosis"]) && !empty($_POST["dermatosis"])&&
    isset($_POST["audicion"]) && !empty($_POST["audicion"])&&
    isset($_POST["vision"]) && !empty($_POST["vision"])&&
    isset($_POST["enfart"]) && !empty($_POST["enfart"])&&
    isset($_POST["varices"]) && !empty($_POST["varices"])&&
    isset($_POST["ulceras"]) && !empty($_POST["ulceras"])&&
    isset($_POST["apendicitis"]) && !empty($_POST["apendicitis"])&&
    isset($_POST["prostata"]) && !empty($_POST["prostata"])&&
    isset($_POST["urinarias"]) && !empty($_POST["urinarias"])&&
    isset($_POST["acipep"]) && !empty($_POST["acipep"])&&
    isset($_POST["sandig"]) && !empty($_POST["sandig"])&&
    isset($_POST["hepatitis"]) && !empty($_POST["hepatitis"])&&
    isset($_POST["hernias"]) && !empty($_POST["hernias"])&&
    isset($_POST["colitis"]) && !empty($_POST["colitis"])&&
    isset($_POST["colecis"]) && !empty($_POST["colecis"])&&
    isset($_POST["patanal"]) && !empty($_POST["patanal"])&&
    isset($_POST["internamientos"]) && !empty($_POST["internamientos"])&&
    isset($_POST["cirujias"]) && !empty($_POST["cirujias"])){

    $Expediente = $_POST["nExpediente"];
    $Alergias = $_POST["alergias"];
    $Cardipatias =$_POST["cardiopatia"];
    $Transfusiones = $_POST["transfusiones"];
    $Diabetes = $_POST["diabetes"];
    $Cardiovascular= $_POST["cardiovascular"];
    $HTA = $_POST["hiper"];
    $Fracturas= $_POST["fracturas"];
    $Reumaticas= $_POST["reumaticas"];
    $Rinitis= $_POST["rinitis"];
    $Asma=$_POST["asma"];
    $Convulsiones=$_POST["convulsiones"];
    $Migrañas= $_POST["migrañas"];
    $Psiquiatricos= $_POST["psiquiatricos"];
    $TB= $_POST["tb"];
    $EVC=$_POST["evc"];
    $Dermatosis= $_POST["dermatosis"];
    $Audicion= $_POST["audicion"];
    $Vision= $_POST["vision"];
    $EnfArt= $_POST["enfart"];
    $Varices= $_POST["varices"];
    $Ulceras= $_POST["ulceras"];
    $Apendicitis= $_POST["apendicitis"];
    $Prostata= $_POST["prostata"];
    $Urinarias=$_POST["urinarias"];
    $AciPep= $_POST["acipep"];
    $SanDig=$_POST["sandig"];
    $Hepatitis= $_POST["hepatitis"];
    $Hernias= $_POST["hernias"];
    $Colitis= $_POST["colitis"];
    $Colecis= $_POST["colecis"];
    $PatAnal= $_POST["patanal"];
    $Internamientos=$_POST["internamientos"];
    $Cirujias= $_POST["cirujias"];


    $oAntPat->setExpediente($Expediente);
    $oAntPat->setAlergias($Alergias);
    $oAntPat->setCardiopatias($Cardipatias);
    $oAntPat->setTransfusiones($Transfusiones);
    $oAntPat->setDiabetico($Diabetes);
    $oAntPat->setCardiovasculares($Cardiovascular);
    $oAntPat->setHTA($HTA);
    $oAntPat->setSFracturas($Fracturas);
    $oAntPat->setSReumaticas($Reumaticas);
    $oAntPat->setSRinitis($Rinitis);
    $oAntPat->setSAsma($Asma);
    $oAntPat->setSconvulsiones($Convulsiones);
    $oAntPat->setSMigrañas($Migrañas);
    $oAntPat->setSPsiquiatricos($Psiquiatricos);
    $oAntPat->setSTB($TB);
    $oAntPat->setSEVC($EVC);
    $oAntPat->setSDermatosis($Dermatosis);
    $oAntPat->setSAudicion($Audicion);
    $oAntPat->setSVision($Vision);
    $oAntPat->setSEnfArt($EnfArt);
    $oAntPat->setSVarices($Varices);
    $oAntPat->setSUlceras($Ulceras);
    $oAntPat->setSApendicits($Apendicitis);
    $oAntPat->setSProstata($Prostata);
    $oAntPat->setSUrinarias($Urinarias);
    $oAntPat->setSAcidoPep($AciPep);
    $oAntPat->setSSanDig($SanDig);
    $oAntPat->setSHepatitis($Hepatitis);
    $oAntPat->setSHernias($Hernias);
    $oAntPat->setSColitis($Colitis);
    $oAntPat->setSColecis($Colecis);
    $oAntPat->setSPatAnal($PatAnal);
    $oAntPat->setSInternamientos($Internamientos);
    $oAntPat->setSCirujias($Cirujias);


    $NAfec=$oAntPat->insertar($user);
    var_dump($NAfec);

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




