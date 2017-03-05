<?php
/**
 * Created by PhpStorm.
 * User: Pablo
 * Date: 04/03/2017
 * Time: 06:39 PM
 */
include_once ("../Class/EstudioRealizado.php");
include_once ("../Class/Medico.php");
include_once ("../Class/Usuarios.php");
session_start();
$oEst = new EstudioRealizado();
$oMed = new Medico();
$oUser = new Usuarios();
$sErr = "";
$arrEst = "";
$nIdPersonal = 0;
$sEstudios = "";
$sCad = "";
$sMsj="";
$url="../admin/index.php";
$dFecha = new DateTime();
if(isset($_SESSION['sUser']) && !empty($_SESSION['sUser'])){
    $oUser = $_SESSION['sUser'];
    $nIdPersonal = $oMed->buscarIdMedico($oUser->getEmail());
    $oEst->setEstudios(new Estudios());
    $oEst->setPaciente(new Paciente());
    $oEst->getPaciente()->setExpediente(new Expediente());
    $oEst->setMedico(new Medico());
    $oEst->setEstImagen(new EstImagen());
    $oEst->setEstLab(new EstLaboratorio());
    $oEst->setNota(new NotaMedica());
    $oEst->getEstImagen()->setNivelUrgencia($_POST['urgencia']);
    $oEst->getEstudios()->setClaveInterna($_POST['estudios']);
    $oEst->setDiagnostica($_POST['txtDxIng']);
    $oEst->getNota()->setResumen($_POST['txtResumen']);
    $oEst->getNota()->setPresionArterial($_POST['txtPresion']);
    $oEst->getNota()->setSignosVitales($_POST['txtSignos']);
    $oEst->getNota()->setTemperatura($_POST['txtTemp']);

    $arrEst = $_POST['estImagen'];
    if(count($arrEst) != 0){
        for($i = 0;$i<count($arrEst);$i++){
            $sEstudios = $sEstudios."; ".$arrEst[$i];
        }
        $sCad = substr($sEstudios,1);
    }else{
        $sCad = "No se seleccionaron estudios";
    }

    $oEst->getEstImagen()->setEstudioSolicitado($sCad);
    $oEst->getEstImagen()->setOtrosEstudios($_POST['txtOtrosEst'] != "" ? $_POST['txtOtrosEst'] : 'No se registraron Otros estudios');
    $oEst->getEstImagen()->setRegionSol($_POST['txtRegion'] != "" ? $_POST['txtRegion'] : 'No se registró una región a estudiar');
    $oEst->getEstLab()->setEstudiosSolicitados($_POST['txtEstSolLab'] != "" ? $_POST['txtEstSolLab'] : 'No se registraron estudios de Laboratorio');

    if ($_FILES["imagen"]["error"] == UPLOAD_ERR_OK) {

        if ($_FILES["imagen"]["type"] == "application/pdf"){

            if (($_FILES["imagen"]["size"] <= 4096000)){

                move_uploaded_file($_FILES["imagen"]["tmp_name"],
                    "../archivos/" . $_POST['txtExpe']."".$dFecha->format('Y-m-d').".pdf");
                $sImagen = $_POST['txtExpe']."".$dFecha->format('Y-m-d').".pdf";
                $oEst->getEstImagen()->setRutaArchivo("../archivos/".$sImagen);
            }
            else
                $sErr = "Error en la longitud de la imagen";
        }
        else
            $sErr = "Error, la imagen no es png o gif";
    }
    else
        $sErr = "Error en archivo ".$_FILES["imagen"]["error"];

    $oEst->getPaciente()->getExpediente()->setNumero($_POST['txtExpe']);
    $oEst->getMedico()->setIdPersonal($nIdPersonal);
    
    try{
        if($oEst->insertarEstudioRealizado($oUser->getEmail()) == 1){
            $sMsj = "Se guardó correctamente los datos de la Nota Médica en la base de datos";
            header("Location:../mensajes.php?sMensaje=" . $sMsj . "&Destino=" . $url);
        }
    }catch (Exception $e){
        error_log($e->getFile()." ".$e->getLine()." ".$e->getMessage(),0);
        $sErr = "Error en base de datos, comunicarse con el administrador";
    }
}