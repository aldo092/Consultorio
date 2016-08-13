<?php
/**
 * Created by PhpStorm.
 * User: Aldo
 * Date: 13/08/2016
 * Time: 12:53 AM
 */
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

if(isset($_POST["nombre"]) && !empty($_POST["nombre"]) &&
        ($_POST["ApPat"]) && !empty($_POST["ApPat"])&&
        ($_POST["ApMat"]) && !empty($_POST["ApMat"])&&
        ($_POST["curp"]) && !empty($_POST["curp"])&&
        ($_POST["sexo"]) && !empty($_POST["sexo"])&&
        ($_POST["nacimiento"]) && !empty($_POST["nacimiento"])&&
        ($_POST["telefono"]) && !empty($_POST["telefono"])&&
        ($_POST["direccion"]) && !empty($_POST["direccion"])&&
        ($_POST["cp"]) && !empty($_POST["cp"])&&
        ($_POST["email"]) && !empty($_POST["email"])&&
        ($_POST["edocivil"]) && !empty($_POST["edocivil"])){

    $curp= $_POST["curp"];
    $nombre= $_POST["nombre"];
    $apepa= $_POST["ApPat"];
    $apema= $_POST["ApMat"];
    $sexo= $_POST["sexo"];
    $FechaNa= $_POST["nacimiento"];
    $telefono= $_POST["telefono"];
    $direccion= $_POST["direccion"];
    $cp= $_POST["cp"];
    $correo= $_POST["email"];
    $edocivil= $_POST["edocivil"];

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

}

