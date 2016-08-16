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

if  (isset($_POST["nombre"]) && !empty($_POST["nombre"]) &&
    ($_POST["ApPat"]) && !empty($_POST["ApPat"])&&
    ($_POST["ApMat"]) && !empty($_POST["ApMat"])&&
    ($_POST["curp"]) && !empty($_POST["curp"])&&
    ($_POST["telefono"]) && !empty($_POST["telefono"])&&
    ($_POST["direccion"]) && !empty($_POST["direccion"])&&
    ($_POST["cp"]) && !empty($_POST["cp"])&&
    ($_POST["email"]) && !empty($_POST["email"]))
{

$curp = $_POST["curp"];
$nombre = $_POST["nombre"];
$apepa = $_POST["ApPat"];
$apema = $_POST["ApMat"];
$telefono = $_POST["telefono"];
$direccion = $_POST["direccion"];
$cp = $_POST["cp"];
$correo = $_POST["email"];

$oPaciente->setNombre($nombre);
$oPaciente->setApPaterno($apepa);
$oPaciente->setApMaterno($apema);
$oPaciente->setCurpPaciente($curp);
$oPaciente->setTelefono($telefono);
$oPaciente->setDireccion($direccion);
$oPaciente->setCP($cp);
$oPaciente->setCorreo($correo);

if ($oPaciente->insertar($oUser)) {
    $sErr = "Registro Correcto";
} else {
    $sErr = "error al guardar el nuevo paciente";
}

}else{
    $sErr = "Faltan datos, regristre todos los campos";
}

if($sErr != "")
    header("Location: ../error.php?sError=".$sErr);

?>


