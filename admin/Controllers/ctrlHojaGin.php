<?php
/**
 * Created by PhpStorm.
 * User: Aldo
 * Date: 08/02/2017
 * Time: 01:32 PM
 */
error_reporting(E_ALL);
include_once ("../Class/Usuarios.php");
include_once ("../Class/HojaGin.php");
include_once ("../Class/Personal.php");

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
$oHoGin= new HojaGin();
$expediente="";
$medico=0;
$padecimiento="";
$TA="";
$FC="";
$FR="";
$Temp=0;
$Talla=0;
$Peso=0;
$IMC=0;
$Exploracion="";
$Laboratoriales="";
$Terapeutica="";
$Diagnosticos="";
$url="../admin/index.php";
$NAfec=0;
$user= $_SESSION['sUser']->getEmail();

if( isset($_POST["paciente"])&&!empty($_POST["paciente"])&&
    isset($_POST["medico"])&&!empty($_POST["medico"])&&
    isset($_POST["padecimiento"])&&!empty($_POST["padecimiento"])&&
    isset($_POST["TA"])&&!empty($_POST["TA"])&&
    isset($_POST["FC"])&&!empty($_POST["FC"])&&
    isset($_POST["FR"])&&!empty($_POST["FR"])&&
    isset($_POST["temp"])&&!empty($_POST["temp"])&&
    isset($_POST["talla"])&&!empty($_POST["talla"])&&
    isset($_POST["peso"])&&!empty($_POST["peso"])&&
    isset($_POST["exploracion"])&&!empty($_POST["exploracion"])&&
    isset($_POST["laboratoriales"])&&!empty($_POST["laboratoriales"])&&
    isset($_POST["terapia"])&&!empty($_POST["terapia"])&&
    isset($_POST["nombre"])&&!empty($_POST["nombre"])&&
    isset($_POST["diagnosticos"])&&!empty($_POST["diagnosticos"])){






    $expediente=$_POST["paciente"];
    $padecimiento=$_POST["padecimiento"];
    $TA=$_POST["TA"];
    $FC=$_POST["FC"];
    $FR=$_POST["FR"];
    $Temp=$_POST["temp"];
    $Talla=$_POST["talla"];
    $Peso=$_POST["peso"];
    $Exploracion=$_POST["exploracion"];
    $Laboratoriales=$_POST["laboratoriales"];
    $Terapeutica=$_POST["terapia"];
    $Diagnosticos=$_POST["diagnosticos"];
    $IMC=round($Peso/($Talla*$Talla),2);
    $medico=$_POST["medico"];
    $nombre=$_POST["nombre"];

    $oPersonal= new Personal();
    $oPersonal->personalMedico($medico);
    $NomMed= $oPersonal->getNombres();
    $ApeP=$oPersonal->getApPaterno();
    $ApeM=$oPersonal->getApMaterno();
    $Doctor= $NomMed." ". $ApeP. " ".$ApeM;
    $Cedula= $oPersonal->getMedico();



    $oHoGin->setPaciente($expediente);
    $oHoGin->setPadecimiento($padecimiento);
    $oHoGin->setTA($TA);
    $oHoGin->setFC($FC);
    $oHoGin->setFR($FR);
    $oHoGin->setTemp($Temp);
    $oHoGin->setTalla($Talla);
    $oHoGin->setPeso($Peso);
    $oHoGin->setExploracion($Exploracion);
    $oHoGin->setLaboratoriales($Laboratoriales);
    $oHoGin->setTerapeutica($Terapeutica);
    $oHoGin->setDiagnosticos($Diagnosticos);
    $oHoGin->setIMC($IMC);
    $oHoGin->setMedico($medico);

    $NAfec=$oHoGin->insertar($user);
    $PDF=$oHoGin->GenerarPDF($nombre, $expediente,$padecimiento,$TA,$FC,$FR,$Temp,$Talla,$Peso,$IMC,$Exploracion,$Laboratoriales,$Terapeutica,$Diagnosticos,$Doctor,$Cedula);



    if ($NAfec==1 ) {
        $sMsj = "Hoja generada correctamente";

        header("Location:../mensajes.php?sMensaje=".$sMsj."&Destino=".$url);


    } else {
        $sMsj = "Error al generar la hoja";
        header("Location:../mensajes.php?sMensaje=".$sMsj."&Destino=".$url);

    }

}else{
    $sMsj = "Faltan datos, registre todos los campos";
    header("Location:../mensajes.php?sMensaje=".$sMsj."&Destino=".$url);

}








