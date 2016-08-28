<?php
/**
 * Created by PhpStorm.
 * User: Pablo
 * Date: 24/08/2016
 * Time: 06:57 PM
 */
include_once ("../Class/Personal.php");
include_once ("../Class/AccesoDatos.php");
include_once ("../Class/Accesos.php");
include_once ("../Class/Roles.php");
include_once ("../Class/Usuarios.php");
include_once ("../Class/Medico.php");

$sErr = "";
$sOp = "";
$sClave = "";
$sRol = "";
$sImg = "";
$sRolAct = "";
$nAfec =0;
$oPersonal = new Personal();
$oAccesos = new Accesos();
$oUsuario = null;

    if(isset($_SESSION['sUser']) && !empty($_SESSION['sUser'])){
        if(isset($_POST['txtOp']) && !empty($_POST['txtOp'])) {
            $sOp = $_POST['txtOp'];
            $sClave = $_POST['txtClave'];
            $sRol = $_POST['rol'];
            $sRolAct = $_POST['txtRol'];
            $oUsuario = $_SESSION['sUser'];

            if($sOp == 'm' || $sOp == 'e'){
                $oPersonal->setIdPersonal($sClave);
            }

            if($sOp == 'a' && $sRol != 2){
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
                                "../imagenesperfiles" . $_FILES["imagen"]["name"]);
                            $sImg = $_FILES["imagen"]["name"];

                        }
                        else
                            $sErr = "Error en la longitud de la imagen";
                    }
                    else
                        $sErr = "Error, la imagen no es png o gif";
                }else
                    $sErr = "Error al intentar cargar el archivo";
                $oPersonal->setEstatus(1);
                $oPersonal->setImagen($sImg);
            }else if($sOp == 'a' && $sRol == 2){
                $oPersonal->setRol(new Roles());
                $oPersonal->setUsuario(new Usuarios());
                $oPersonal->setMedico(new Medico());
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
                $oPersonal->getMedico()->setEspecialidad($_POST['txtEspecialidad']);
                if ($_FILES["imagen"]["error"] == UPLOAD_ERR_OK) {

                    if (($_FILES["imagen"]["type"] == "image/jpeg") ||
                        ($_FILES["imagen"]["type"] == "image/gif") ){

                        if (($_FILES["imagen"]["size"] <= 1024000)){

                            move_uploaded_file($_FILES["imagen"]["tmp_name"],
                                "../imagenesperfiles" . $_FILES["imagen"]["name"]);
                            $sImg = $_FILES["imagen"]["name"];

                        }
                        else
                            $sErr = "Error en la longitud de la imagen";
                    }
                    else
                        $sErr = "Error, la imagen no es png o gif";
                }else
                    $sErr = "Error al intentar cargar el archivo";
                $oPersonal->setEstatus(1);
                $oPersonal->setImagen($sImg);
            }else if($sOp == 'm' && $sRol != 2){
                $oPersonal->setUsuario(new Usuarios());
                $oPersonal->setNombres($_POST['txtNombres']);
                $oPersonal->setApPaterno($_POST['txtApPat']);
                $oPersonal->setApMaterno($_POST['txtApMat']);
                $oPersonal->setTelefono($_POST['txtTel1']);
                if($_POST['password'] != ''){
                    $oPersonal->getUsuario()->setPassword($_POST['password']);
                }else{
                    $oPersonal->getUsuario()->setPassword('');
                }
                if($_POST['estatus'] != ''){
                    $oPersonal->setEstatus($_POST['estatus']);
                }else{
                    $oPersonal->setEstatus($_POST['txtEstAct']);
                }
            }else if($sOp == 'm' && $sRol == 2){
                $oPersonal->setUsuario(new Usuarios());
                $oPersonal->setMedico(new Medico());
                $oPersonal->setNombres($_POST['txtNombres']);
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
                $oPersonal->getMedico()->setEspecialidad($_POST['txtEspecialidad']);
                if($_POST['estatus'] != ''){
                    $oPersonal->setEstatus($_POST['estatus']);
                }else{
                    $oPersonal->setEstatus($_POST['txtEstAct']);
                }
            }

            if($sOp == 'a' and $sRol != 2){
                $nAfec = $oPersonal->insertarPersonal($oUsuario->getEmail());
            }else if($sOp == 'a' and $sRol == 2){
                $nAfec = $oPersonal->insertaPersonalMedico($oUsuario->getEmail());
            }else if($sOp == 'm' and $sRol != 2){
                
            }

            
            
        }
    }

?>