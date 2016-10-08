<?php
/**
 * Created by PhpStorm.
 * User: Aldo
 * Date: 21/09/2016
 * Time: 03:43 PM
 */

error_reporting(E_ALL);
include_once ("../Class/Usuarios.php");
include_once ("../Class/Cita.php");

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
$Operacion="";
$Folio=0;
$Estatus=0;
$Consultorio="";
$Horario="";
$Cita="";
$Paciente="";
$OCita=new Cita();
$user= $_SESSION['sUser']->getEmail();
$NAfec=0;
$Err="";
$sMsj="";
$url="../admin/Sesiones/Citas/consultarCitas.php";
if (isset($_POST["Operacion"])&& !empty($_POST["Operacion"]))
{
if( ($_POST["Operacion"])=="Insertar" &&
    isset($_POST["consultorio"]) && !empty($_POST["consultorio"]) &&
    isset($_POST["horario"]) && !empty($_POST["horario"])&&
    isset($_POST["cita"]) && !empty($_POST["cita"]) &&
    isset($_POST["paciente"]) && !empty($_POST["paciente"])) {

    $Consultorio = $_POST["consultorio"];
    $Horario = $_POST["horario"];
    $Cita = $_POST["cita"];
    $Paciente = $_POST["paciente"];

    $OCita->setConsultorio("$Consultorio");
    $OCita->setFechaCita("$Cita");
    $OCita->setSHorario("$Horario");
    $OCita->setPaciente("$Paciente");


    $NAfec = $OCita->insertar($user);

    if ($NAfec == 1) {
        $sMsj = "Se guardó correctamente la cita en la base de datos";
        header("Location:../mensajes.php?sMensaje=" . $sMsj . "&Destino=" . $url);
    } else {
        $sMsj = "Error al guardar la cita";
        header("Location:../mensajes.php?sMensaje=" . $sMsj . "&Destino=" . $url);


    }

}
if (($_POST["Operacion"])=="ModEst"&&
    isset($_POST["Folio"])&& !empty($_POST["Folio"])&&
    isset($_POST["estatus"])&& !empty($_POST["estatus"]))
{
   $Folio=$_POST["Folio"];
   $Estatus=$_POST["estatus"];

    $OCita->setFolioCita("$Folio");
    $OCita->setEstatus("$Estatus");

    $NAfec= $OCita->ModificarEstatusCita($user);
    if ($NAfec==1){
        $sMsj = "Se actualizó el estatus de la cita en la base de datos";
        header("Location:../mensajes.php?sMensaje=" . $sMsj . "&Destino=" . $url);

    }else{
        $sMsj = "Error al actualizar el estatus de la cita";
        header("Location:../mensajes.php?sMensaje=" . $sMsj . "&Destino=" . $url);
    }
}
else {
    if (($_POST["Operacion"])=="Cancelar"&&
    isset($_POST["Folio"])&&!empty($_POST["Folio"])){
        $Folio=$_POST["Folio"];

        $OCita->setFolioCita("$Folio");

        $NAfec =$OCita->CancelarCita($user);
        if ($NAfec==1){
            $sMsj = "Se eliminó correctamenta la  cita ";
            header("Location:../mensajes.php?sMensaje=" . $sMsj . "&Destino=" . $url);

        }else{
            $sMsj = "Error al eliminar la cita cita";
            header("Location:../mensajes.php?sMensaje=" . $sMsj . "&Destino=" . $url);
        }


    }
}
    }
    else{
    $sMsj = "Faltan datos, registre todos los campos";
    header("Location:../mensajes.php?sMensaje=".$sMsj."&Destino=".$url);

}


?>





