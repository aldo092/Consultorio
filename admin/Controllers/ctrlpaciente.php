<?php
/**
 * Created by PhpStorm.
 * User: Aldo
 * Date: 13/08/2016
 * Time: 12:53 AM
 */

error_reporting(E_ALL);
include_once ("../Class/Usuarios.php");
include_once ("../Class/Paciente.php");
include_once ("../Class/Expediente.php");
include_once ("../Class/Seguro.php");

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


$curp="";
$nombre="";
$apepa="";
$apema="";
$sexo="";
$FechaNa="";
$telefono="";
$direccion="";
$rfc="";
$localidad="";
$municipio="";
$estado="";
$cp="";
$correo="";
$edocivil="";
$medico="";
$consultorio="";

$asegurado="";

$aseguradora="";
$poliza="";
$vigencia="";

$oPaciente= new Paciente();
$oExpediente= new Expediente();
$oSeguro=new Seguro();

$Err="";
$sMsj="";
$Nexpediente="";
$user= $_SESSION['sUser']->getEmail();
$NAfec=0;
$NAfec2=0;
$NAfec3=0;
$url="../admin/Sesiones/Pacientes/registroPacientes.php";



if(isset($_POST["nombre"]) && !empty($_POST["nombre"]) &&
    isset($_POST["ApPat"]) && !empty($_POST["ApPat"])&&
    isset($_POST["ApMat"]) && !empty($_POST["ApMat"])&&
    isset($_POST["curp"]) && !empty($_POST["curp"])&&
    isset ($_POST["sexo"]) && !empty($_POST["sexo"])&&
    isset($_POST["birthday"]) && !empty($_POST["birthday"])&&
    isset($_POST["telefono"]) && !empty($_POST["telefono"])&&
    isset($_POST["direccion"]) && !empty($_POST["direccion"])&&
    isset($_POST["localidad"]) && !empty($_POST["localidad"])&&
    isset($_POST["municipio"]) && !empty($_POST["municipio"])&&
    isset($_POST["estado"]) && !empty($_POST["estado"])&&
    isset($_POST["rfc"]) && !empty($_POST["rfc"])&&
    isset($_POST["cp"]) && !empty($_POST["cp"])&&
    isset($_POST["email"]) && !empty($_POST["email"])&&
    isset($_POST["asegurado"]) && !empty($_POST["asegurado"])&&
    isset($_POST["edocivil"]) && !empty($_POST["edocivil"])&&
    isset($_POST["medico"]) && !empty($_POST["medico"])&&
    isset($_POST["consultorio"])&&!empty($_POST["consultorio"])){

    if(($_POST["asegurado"])=="Si" &&
        isset($_POST["aseguradora"]) && !empty($_POST["aseguradora"]) &&
        isset($_POST["poliza"]) && !empty($_POST["poliza"])&&
        isset ($_POST["vigencia"]) && !empty($_POST["vigencia"])){

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
        $medico=$_POST["medico"];
        $consultorio=$_POST["consultorio"];
        $localidad=$_POST["localidad"];
        $municipio=$_POST["municipio"];
        $estado=$_POST["estado"];
        $rfc=$_POST["rfc"];

        $asegurado = $_POST["asegurado"];

        $aseguradora = $_POST["aseguradora"];
        $poliza = $_POST["poliza"];
        $vigencia = $_POST["vigencia"];

        $Nexpediente = date("y") . date("m") . date("d") . $Nexpediente = substr($curp, 4, 6) . $Nexpediente = substr($curp, 0, 4) . $Nexpediente = substr($curp, 13, 5);


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
        $oPaciente->setSLocalidad($localidad);
        $oPaciente->setSMunicipio($municipio);
        $oPaciente->setEstado($estado);
        $oPaciente->setSRFC($rfc);
        $oPaciente->setSMedico($medico);
        $oPaciente->setNConsultorio($consultorio);

        $oExpediente->setPaciente($curp);
        $oExpediente->setNumero($Nexpediente);

        $oSeguro->setPaciente($Nexpediente);
        $oSeguro->setOAseguradora($aseguradora);
        $oSeguro->setFechaVigencia($vigencia);
        $oSeguro->setOPoliza($poliza);


        $NAfec = $oPaciente->insertar($user);
        $NAfec2 = $oExpediente->insertarExpediente($user);
        $NAfec3=$oSeguro->insertar($user);

        if ($NAfec == 1 && $NAfec2 == 1 && $NAfec3==1) {
            $sMsj = "Se agregó el paciente a la base de datos";
            header("Location:../mensajes.php?sMensaje=" . $sMsj . "&Destino=" . $url);
        } else {
            $sMsj = "Error al guardar el nuevo paciente";
            header("Location:../mensajes.php?sMensaje=" . $sMsj . "&Destino=" . $url);
        }
    }
    else
    {
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
        $medico=$_POST["medico"];
        $consultorio=$_POST["consultorio"];
        $localidad=$_POST["localidad"];
        $municipio=$_POST["municipio"];
        $estado=$_POST["estado"];
        $rfc=$_POST["rfc"];



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
        $oPaciente->setSLocalidad($localidad);
        $oPaciente->setSMunicipio($municipio);
        $oPaciente->setEstado($estado);
        $oPaciente->setSRFC($rfc);
        $oPaciente->setSMedico($medico);
        $oPaciente->setNConsultorio($consultorio);

        $oExpediente->setPaciente($curp);
        $oExpediente->setNumero($Nexpediente);


        $NAfec=$oPaciente->insertar($user);
        $NAfec2=$oExpediente->insertarExpediente($user);

        if ($NAfec==1 && $NAfec2==1) {
            $sMsj = "Se agregó el paciente a la base de datos";
            header("Location:../mensajes.php?sMensaje=".$sMsj."&Destino=".$url);
        }

        else {
            $sMsj = "Error al guardar el nuevo paciente";
            header("Location:../mensajes.php?sMensaje=".$sMsj."&Destino=".$url);
        }

    }

    }
    else{
    $sMsj = "Faltan datos, registre todos los campos";
    header("Location:../mensajes.php?sMensaje=".$sMsj."&Destino=".$url);
    }
    ?>


