<?php
/**
 * Created by PhpStorm.
 * User: Pablo
 * Date: 27/09/2016
 * Time: 01:41 PM
 */
include_once ("../Class/NotaIntervencion.php");
include_once ("../Class/Paciente.php");
include_once ("../Class/Usuarios.php");
session_start();
$sErr = "";
$sOp = "";
$sExpe = "";
$oNota = new NotaIntervencion();
$oPaciente = new Paciente();
$oUser = new Usuarios();
$nAfec = 0;
$sMensaje = "";
$sRuta = "../admin/Sesiones/NotaIntervencion/genNotaInt.php";
if(isset($_SESSION['sUser']) && !empty($_SESSION['sUser'])){
    if(isset($_POST['txtExpediente']) && !empty($_POST['txtExpediente']) &&
        isset($_POST['txtOp']) && !empty($_POST['txtOp'])){
        $sOp = $_POST['txtOp'];
        $sExpe = $_POST['txtExpediente'];
        $oUser = $_SESSION['sUser'];

        if($sOp == 'a'){
            $oNota->setPaciente(new Paciente());
            $oNota->getPaciente()->setExpediente(new Expediente());
            $oNota->setAnestesia(new Anestesia());
            $oNota->setFechaSolicitada($_POST['dFechaSol']);
            $oNota->getPaciente()->getExpediente()->setNumero($_POST['txtExpediente']);
            $oNota->setPrioridad($_POST['prioridad']);
            $oNota->setDiagnosticoPreope($_POST['txtDxPre']);
            $oNota->setOperacionPlaneada($_POST['txtOperacion']);
            $oNota->setTipoOperacion($_POST['tipoope']);
            $oNota->setGrupoSanguineo($_POST['gruposanguineo']);
            $oNota->setRH($_POST['rh']);
            $oNota->getAnestesia()->setIdAnestesia($_POST['anestesia']);
            $oNota->setTiempoEstimado($_POST['txtEstimado']);
            $oNota->setRiesgos($_POST['txtRiesgos']);
            $oNota->setBeneficios($_POST['txtBeneficios']);
        }else if($sOp == 'r'){
            $oNota->setAnestesia(new Anestesia());
            $oNota->setAntibioticos(new Antibioticos());
            $oNota->setManejo(new ManejoHeridas());
            $oNota->setClasificacion(new ClasificacionHeridas());
            $oNota->setPaciente(new Paciente());
            $oNota->getPaciente()->setExpediente(new Expediente());
            $oNota->getPaciente()->getExpediente()->setNumero($_POST['txtExpediente']);
            $oNota->setDxPosoperatorio($_POST['txtDxPos']);
            $oNota->setOperacionRealizada($_POST['txtOpeReal']);
            $oNota->setCirujano($_POST['txtMedCir']);
            (isset($_POST['txtCedMedCir']) && !empty($_POST['txtCedMedCir'])) ? $oNota->setCedCirujano($_POST['txtCedMedCir']) : $oNota->setCedCirujano("No se registró Cédula");
            $oNota->setAnestesiologo($_POST['txtMedAnes']);
            (isset($_POST['txtCedMedAnes']) && !empty($_POST['txtCedMedAnes'])) ? $oNota->setCedAnestesio($_POST['txtCedMedAnes']) : $oNota->setCedAnestesio("No se registró Cédula");
            (isset($_POST['txtExaH1']) && !empty($_POST['txtExaH1']))  ? $oNota->setExaHistoTransSol($_POST['txtExaH1']) : $oNota->setExaHistoTransSol("No se registró examen");
            (isset($_POST['txtOtrosEst']) && !empty($_POST['txtOtrosEst'])) ? $oNota->setOtrosEstTras($_POST['txtOtrosEst']) : $oNota->setOtrosEstTras("No se registraron otros estudios");
            $oNota->getAnestesia()->setIdAnestesia($_POST['anestesia']);
            $oNota->setFechaSolicitada($_POST['dFechaReal']);
            $oNota->setHoraProce($_POST['hora']);
            (isset($_POST['txtDesTec']) && !empty($_POST['txtDesTec'])) ? $oNota->setDescripcionTecnica($_POST['txtDesTec']) : $oNota->setDescripcionTecnica("No se registró una descripción técnica");
            (isset($_POST['txtHallazgo']) && !empty($_POST['txtHallazgo'])) ? $oNota->setHallazgos($_POST['txtHallazgo']) : $oNota->setHallazgos("No se registraron hallazgos");
            (isset($_POST['txtIncidentes']) && !empty($_POST['txtIncidentes'])) ? $oNota->setIncidentes($_POST['txtIncidentes']) : $oNota->setIncidentes("No se registraron incidentes");
            (isset($_POST['txtAccidentes']) && !empty($_POST['txtAccidentes'])) ? $oNota->setAccidentes($_POST['txtAccidentes']) : $oNota->setAccidentes("No se registraron accidentes");
            (isset($_POST['txtComplicaciones']) && !empty($_POST['txtComplicaciones'])) ? $oNota->setComplicaciones($_POST['txtComplicaciones']) : $oNota->setComplicaciones("No se registraron complicaciones");
            (isset($_POST['txtObservaciones']) && !empty($_POST['txtObservaciones'])) ? $oNota->setObservaciones($_POST['txtObservaciones']) : $oNota->setObservaciones("No se registraron observaciones");
            (isset($_POST['txtEstadoPos']) && !empty($_POST['txtEstadoPos'])) ? $oNota->setEstadoPosope($_POST['txtEstadoPos']) : $oNota->setEstadoPosope("No se registró estado Posoperatorio");
            (isset($_POST['txtPlanManejo']) && !empty($_POST['txtPlanManejo'])) ? $oNota->setPlanManejoPosope($_POST['txtPlanManejo']) : $oNota->setPlanManejoPosope("No se registró un Plan de Manejo Posoperatorio");
            (isset($_POST['txtPronostico']) && !empty($_POST['txtPronostico'])) ? $oNota->setPronostico($_POST['txtPronostico']) : $oNota->setPronostico("No se registró Pronóstico");
            $oNota->getClasificacion()->setIdClasificacion($_POST['cherida']);
            $oNota->setImplante($_POST['implante']);
            (isset($_POST['txtImplante']) && !empty($_POST['txtImplante'])) ? $oNota->setTipoImplante($_POST['txtImplante']) : $oNota->setTipoImplante("No se registró Implante");
            $oNota->getManejo()->setIdManejo($_POST['mherida']);
            $oNota->setOsteomias($_POST['osteomias']);
            (isset($_POST['txtTipoOs']) && !empty($_POST['txtTipoOs'])) ? $oNota->setTipoOsteomias($_POST['txtTipoOs']) : $oNota->setTipoOsteomias("No se registraron Osteomías");
            (isset($_POST['txtLocOs']) && !empty($_POST['txtLocOs'])) ?$oNota->setLocalizacionOsteomias($_POST['txtLocOs']) : $oNota->setTipoOsteomias("No se registraron Osteomías");
            $oNota->setDrenaje($_POST['drenaje']);
            (isset($_POST['drenajetipo']) && !empty($_POST['drenajetipo'])) ? $oNota->setTipoDrenaje($_POST['drenajetipo']) : $oNota->setTipoDrenaje("");
            $oNota->setAntibiotico($_POST['antibiotico']);
            (isset($_POST['tantibiotico']) && !empty($_POST['tantibiotico'])) ? $oNota->getAntibioticos()->setIdAntibiotico($_POST['tantibiotico']) :  $oNota->getAntibioticos()->setIdAntibiotico('null');
            (isset($_POST['dFechaApl']) && !empty($_POST['dFechaApl']))  ? $oNota->setFechaInicioAnt($_POST['dFechaApl']) : $oNota->setFechaInicioAnt('null');
            (isset($_POST['horainicio']) && !empty($_POST['horainicio']))  ? $oNota->setHoraInicioAnt($_POST['horainicio']) : $oNota->setHoraInicioAnt('null');
            //
        }

        try{
            if($sOp == 'a'){
                $nAfec = $oNota->insertarNota($oUser->getEmail());
            }else if($sOp == 'r'){
                //var_dump($oNota);
                $nAfec = $oNota->insertarResultadosNotaInt($oUser->getEmail());
            }

            if($sOp == 'a' and $nAfec == 1){
                $sMensaje = "Registro de nota exitoso";
                header("Location: ../mensajes.php?sMensaje=".$sMensaje."&Destino=".$sRuta);
            }else if($sOp == 'r' and $nAfec == 1){
                $sMensaje = "Registro de Procedimiento guardado exitosamente";
                header("Location: ../mensajes.php?sMensaje=".$sMensaje."&Destino=".$sRuta);
            }else{
                $sErr = "Error en la base de datos";
            }
        }catch(Exception $e){
            error_log($e->getFile()." ".$e->getLine()." ".$e->getMessage(),0);
            $sErr = "Error en base de datos, comunicarse con el administrador";
        }
        //var_dump($oNota);
    }else{
        $sErr = "Faltan datos";
    }
}else{
    $sErr = "Acceso denegado, no ha iniciado sesión";
}

if($sErr != ""){
    //header("Location: ../mensajes.php?sMensaje=".$sErr."&Destino=".$sRuta);
}

?>