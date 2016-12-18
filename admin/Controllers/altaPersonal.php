<?php
/**
 * Created by PhpStorm.
 * User: Pablo
 * Date: 24/08/2016
 * Time: 06:57 PM
 */
error_reporting(E_ALL);
include_once ("../Class/Personal.php");
include_once ("../Class/AccesoDatos.php");
include_once ("../Class/Accesos.php");
include_once ("../Class/Roles.php");
include_once ("../Class/Usuarios.php");
include_once ("../Class/Medico.php");
include_once ("../Class/Especialidad.php");
session_start();
$sErr = "";
$sErr2 = "";
$sOp = "";
$sClave = "";
$sRol = "";
$sImg = "";
$sRolAct = "";
$sMiRol = "";
$nAfec =0;
$nEst = 0;
$oPersonal = new Personal();
$oAccesos = new Accesos();
$oUsuario = null;

    if(isset($_SESSION['sUser']) && !empty($_SESSION['sUser'])){
        if(isset($_POST['txtOp']) && !empty($_POST['txtOp'])) {
            $sOp = $_POST['txtOp'];
            $sClave = $_POST['txtClave'];
            $sRol = $_POST['rol'];
            $sRolAct = $_POST['txtRol'];
            $sMiRol = $_POST['miRol'];
            $oUsuario = $_SESSION['sUser'];

            if($sOp == 'm'){
                $oPersonal->setIdPersonal($sClave);
            }

            if($sOp == 'a' && $sRol != '2'){
                $oPersonal->setRol(new Roles());
                $oPersonal->setUsuario(new Usuarios());
                $oPersonal->setNombres($_POST['txtNombre']);
                $oPersonal->setApPaterno($_POST['txtApPat']);
                $oPersonal->setApMaterno($_POST['txtApMat']);
                $oPersonal->setTelefono($_POST['txtTel1']);
                $oPersonal->setSexo($_POST['sexo']);
                $oPersonal->setCURP($_POST['curp']);
                $oPersonal->setEmail($_POST['txtEmail']);
                $oPersonal->getUsuario()->setPassword($_POST['password']);
                $oPersonal->getRol()->setIdRol($_POST['rol']);
                if ($_FILES["imagen"]["error"] == UPLOAD_ERR_OK) {

                    if (($_FILES["imagen"]["type"] == "image/jpeg") ||
                        ($_FILES["imagen"]["type"] == "image/gif") ){

                        if (($_FILES["imagen"]["size"] <= 1024000)){

                            move_uploaded_file($_FILES["imagen"]["tmp_name"],
                                "../imagenesperfiles/" . substr($oPersonal->getCURP(),0,6)."".substr($oPersonal->getEmail(),0,-4)."".substr($_FILES["imagen"]["name"],-4));
                            $sImg = substr($oPersonal->getCURP(),0,6)."".substr($oPersonal->getEmail(),0,-4)."".substr($_FILES["imagen"]["name"],-4);
                        }
                        else
                            $sErr2 = "Error en la longitud de la imagen";
                    }
                    else
                        $sErr2 = "Error, la imagen no es png o gif";
                }else
                    $sErr2 = "Error al intentar cargar el archivo";
                $oPersonal->setEstatus(1);
                $oPersonal->setImagen($sImg);
            }else if($sOp == 'a' && $sRol == '2'){
                $oPersonal->setRol(new Roles());
                $oPersonal->setMedico(new Medico());
                $oPersonal->setUsuario(new Usuarios());
                $oPersonal->setNombres($_POST['txtNombre']);
                $oPersonal->setApPaterno($_POST['txtApPat']);
                $oPersonal->setApMaterno($_POST['txtApMat']);
                $oPersonal->setTelefono($_POST['txtTel1']);
                $oPersonal->setSexo($_POST['sexo']);
                $oPersonal->setCURP($_POST['curp']);
                $oPersonal->setEmail($_POST['txtEmail']);
                $oPersonal->getUsuario()->setPassword($_POST['password']);
                $oPersonal->getRol()->setIdRol($_POST['rol']);
                $oPersonal->getMedico()->setNumCedula($_POST['txtCedula']);
                $oPersonal->getMedico()->setFechaExpedicionCed($_POST['dCedula']);
                $oPersonal->getMedico()->setNumCedEsp($_POST['txtCedEsp']);
                $oPersonal->getMedico()->setFecExpedCedEsp($_POST['dCedulaEsp']);
                $oPersonal->getMedico()->setNumTelefono1($_POST['txtTel2'] == '' ? 'Sin No.': $_POST['txtTel2']);
                $oPersonal->getMedico()->setEspecialidad(new Especialidad());
                $oPersonal->getMedico()->getEspecialidad()->setIdEspecialidad($_POST['esp']);
                if ($_FILES["imagen"]["error"] == UPLOAD_ERR_OK) {

                    if (($_FILES["imagen"]["type"] == "image/jpeg") ||
                        ($_FILES["imagen"]["type"] == "image/gif") ){

                        if (($_FILES["imagen"]["size"] <= 1024000)){

                            move_uploaded_file($_FILES["imagen"]["tmp_name"],
                                "../imagenesperfiles/" . substr($oPersonal->getCURP(),0,6)."".substr($oPersonal->getEmail(),0,-4)."".substr($_FILES["imagen"]["name"],-4));
                            $sImg = substr($oPersonal->getCURP(),0,6)."".substr($oPersonal->getEmail(),0,-4)."".substr($_FILES["imagen"]["name"],-4);

                        }
                        else
                            $sErr2 = "Error en la longitud de la imagen";
                    }
                    else
                        $sErr2 = "Error, la imagen no es png o gif";
                }else
                    $sErr2 = "Error al intentar cargar el archivo";
                $oPersonal->setEstatus(1);
                $oPersonal->setImagen($sImg);

            }else if($sOp == 'm' && $sMiRol != '2'){
                $oPersonal->setUsuario(new Usuarios());
                $oPersonal->setNombres($_POST['txtNombre']);
                $oPersonal->setApPaterno($_POST['txtApPat']);
                $oPersonal->setApMaterno($_POST['txtApMat']);
                $oPersonal->setTelefono($_POST['txtTel1']);
                if($_POST['password'] != ''){
                    $oPersonal->getUsuario()->setPassword($_POST['password']);
                }else{
                    $oPersonal->getUsuario()->setPassword('');
                }
                if($_POST['estatus'] != ""){
                    $oPersonal->setEstatus($_POST['estatus']);
                }else{
                    $nEst = ($_POST['txtEstAct'] == "Activo" ? 1 : 0);
                    $oPersonal->setEstatus($nEst);
                }
            }else if($sOp == 'm' && $sMiRol == '2'){
                $oPersonal->setUsuario(new Usuarios());
                $oPersonal->setMedico(new Medico());
                $oPersonal->setNombres($_POST['txtNombre']);
                $oPersonal->setApPaterno($_POST['txtApPat']);
                $oPersonal->setApMaterno($_POST['txtApMat']);
                $oPersonal->setTelefono($_POST['txtTel1']);
                if($_POST['password'] != ''){
                    $oPersonal->getUsuario()->setPassword($_POST['password']);
                }else{
                    $oPersonal->getUsuario()->setPassword('');
                }
                $oPersonal->getMedico()->setNumCedula($_POST['txtCedula']);
                $oPersonal->getMedico()->setNumCedEsp($_POST['txtCedEsp']);
                $oPersonal->getMedico()->setNumTelefono1($_POST['txtTel2']);
                if($_POST['estatus'] != ''){
                    $oPersonal->setEstatus($_POST['estatus']);
                }else{
                    $nEst = ($_POST['txtEstAct'] == "Activo" ? 1 : 0);
                    $oPersonal->setEstatus($nEst);
                }
            }

            if($sOp == 'a' and $sRol != '2'){
                $nAfec = $oPersonal->insertarPersonal($oUsuario->getEmail());
            }else if($sOp == 'a' and $sRol == '2'){
               $nAfec = $oPersonal->insertaPersonalMedico($oUsuario->getEmail());
            }else if($sOp == 'm' and $sMiRol != '2' and $_POST['password'] == ""){
                $nAfec = $oPersonal->modificaPersonal($oUsuario->getEmail());
            }else if($sOp == 'm' and $sMiRol != '2' and $_POST['password'] != ""){
                $nAfec = $oPersonal->modificarPersonalyPass($oUsuario->getEmail());
            }else if($sOp == 'm' and $sMiRol == '2' and $_POST['password'] != ""){
                $nAfec = $oPersonal->modificaPersonalMedicoyPass($oUsuario->getEmail());
            }else if($sOp == 'm' and $sMiRol == '2' and $_POST['password'] == ""){
                $nAfec = $oPersonal->modificaPersonalMedico($oUsuario->getEmail());
            }else{
                $sErr2 = "No se realizó ninguna acción";
            }

            if($sOp == 'a' and $nAfec == 1){
                $oAccesos->setUsuario(new Usuarios());
                $oAccesos->getUsuario()->setEmail($_POST['txtEmail']);
                if($oAccesos->insertaAcceso2($oUsuario->getEmail()) == 1){
                    if($oAccesos->emailRegistro($_POST['txtEmail'])){
                        header("Location: ../Sesiones/Personal/registroExitoso.php");
                    }
                }
            }else if($sOp == 'm' and $nAfec == 1){
                header("Location: ../Sesiones/Personal/controlPersonal.php");
            }
            
        }
    }

    if($sErr != ""){
        header("Location: error.php?sError=".$sErr);
    }else if($sErr2 != ""){
        header("Location: error2.php?sError=".$sErr2);
    }

?>