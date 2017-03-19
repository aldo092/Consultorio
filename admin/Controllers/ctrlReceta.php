<?php
/**
 * Created by PhpStorm.
 * User: Aldo
 * Date: 06/10/2016
 * Time: 01:56 PM
 */

error_reporting(E_ALL);
include_once ("../Class/Usuarios.php");
include_once ("../Class/Receta.php");
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
$oReceta=new Receta();
$Expediente="";
$Receta="";
$Medico=0;
$Nombre="";
$url="../admin/index.php";
$NAfec=0;
$user= $_SESSION['sUser']->getEmail();
//Comentario sobre el reporte

if( isset($_POST["paciente"])&&!empty($_POST["paciente"])&&
    isset($_POST["medico"]) && !empty($_POST["medico"])&&
    isset($_POST["receta"]) && !empty($_POST["receta"])){

    $Expediente = $_POST["paciente"];
    $Receta = $_POST["receta"];
    $Medico= $_POST["medico"];
    $Nombre= $_POST["nombre"];

    $oReceta->setPaciente($Expediente);
    $oReceta->setDescripcion($Receta);
    $oReceta->setMedico($Medico);
    $NAfec = $oReceta->insertar($user);


    if ($NAfec==1 ) {
        $Rec= $oReceta->RecetaPdf($Nombre,$Receta);
        $sMsj = "Receta generada correctamente";
        header("Location:../mensajes.php?sMensaje=".$sMsj."&Destino=".$url);
        $Rec= $oReceta->RecetaPdf($Nombre,$Receta);

    } else {
        $sMsj = "Error al generar la receta";
        header("Location:../mensajes.php?sMensaje=".$sMsj."&Destino=".$url);

    }

}else{
    $sMsj = "Faltan datos, registre todos los campos";
    header("Location:../mensajes.php?sMensaje=".$sMsj."&Destino=".$url);

}

?>