<?php
/**
 * Created by PhpStorm.
 * User: Aldo
 * Date: 13/08/2016
 * Time: 12:53 AM
 */

error_reporting(E_ALL);
include_once ("../Class/Usuarios.php");
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





include_once ("../Class/Paciente.php");
include_once ("../Class/Expediente.php");

$curp="";
$nombre="";
$apepa="";
$apema="";
$sexo="";
$FechaNa="";
$telefono="";
$direccion="";
$cp="";
$correo="";
$edocivil="";
$oPaciente= new Paciente();
$Err="";
$sMsj="";
$Nexpediente="";
$oExpediente= new Expediente();


if(isset($_COOKIE['cUser']) && !empty($_COOKIE['cUser'])&&
    isset($_POST["nombre"]) && !empty($_POST["nombre"]) &&
        ($_POST["ApPat"]) && !empty($_POST["ApPat"])&&
        ($_POST["ApMat"]) && !empty($_POST["ApMat"])&&
        ($_POST["curp"]) && !empty($_POST["curp"])&&
        ($_POST["sexo"]) && !empty($_POST["sexo"])&&
        ($_POST["birthday"]) && !empty($_POST["birthday"])&&
        ($_POST["telefono"]) && !empty($_POST["telefono"])&&
        ($_POST["direccion"]) && !empty($_POST["direccion"])&&
        ($_POST["cp"]) && !empty($_POST["cp"])&&
        ($_POST["email"]) && !empty($_POST["email"])&&
        ($_POST["edocivil"]) && !empty($_POST["edocivil"])) {

    $curp = $_POST["curp"];
    $nombre = $_POST["nombre"];
    $apepa = $_POST["ApPat"];
    $apema = $_POST["ApMat"];
    $sexo = $_POST["sexo"];
    $FechaNa = date('Y-m-d', strtotime($_POST['birthday']));
    $telefono = $_POST["telefono"];
    $direccion = $_POST["direccion"];
    $cp = $_POST["cp"];
    $correo = $_POST["email"];
    $edocivil = $_POST["edocivil"];

    $Nexpediente=date("y").date("m").date("d").$Nexpediente=substr($curp,4,6).$Nexpediente=substr($curp,0,4).$Nexpediente=substr($curp,13,5);


    $oPaciente->setNombre($nombre);
    $oPaciente->setApPaterno($apepa);
    $oPaciente->setApMaterno($apema);
    $oPaciente->setCurpPaciente($curp);
    $oPaciente->setSexo($sexo);
    $oPaciente->setFechaNacimiento($FechaNa);
    $oPaciente->setTelefono($telefono);
    $oPaciente->setDireccion($direccion);
    $oPaciente->setCP($cp);
    $oPaciente->setEstadoCivil($edocivil);
    $oPaciente->setCorreo($correo);




    $oExpediente->setPaciente($curp);
    $oExpediente->setNumero($Nexpediente);

    if ($oPaciente->insertar($oUser)) {
        $sMsj = "Registro  de nuevo paciente correcto";
        if ($oExpediente->insertarExpediente($oUser)){
            header("Location:../exito.php?sMensaje=".$sMsj);


        }

    } else {
        $sErr = "error al guardar el nuevo paciente";
    }

    }else{
    $sErr = "Faltan datos, registre todos los campos";
}

if($sErr != "")
    header("Location: ../error.php?sError=".$sErr);

?>


