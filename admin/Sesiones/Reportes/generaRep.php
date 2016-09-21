<?php
/**
 * Created by PhpStorm.
 * User: Pablo
 * Date: 20/09/2016
 * Time: 05:12 PM
 */
error_reporting(E_ALL);
include_once ("../../Class/Paciente.php");
include_once ("../../Class/Expediente.php");
session_start();
$sErr = "";
$oPaciente = new Paciente();
$oExpediente = new Expediente();

    if(isset($_SESSION['sUser']) && !empty($_SESSION['sUser']) &&
        isset($_POST['txtExpediente']) && !empty($_POST['txtExpediente'])){
        

    }else{
        $sErr = "Acceso denegado, no tiene permisos para accesar a esta sección del Sistema";
    }
?>