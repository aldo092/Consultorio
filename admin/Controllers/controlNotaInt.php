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
            }

            try{
                if($sOp == 'a'){
                    $nAfec = $oNota->insertarNota($oUser->getEmail());
                }

                if($sOp == 'a' and $nAfec == 1){
                    $sMensaje = "Registro del nota exitoso";
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
       header("Location: ../mensajes.php?sMensaje=".$sErr."&Destino=".$sRuta);
    }

?>