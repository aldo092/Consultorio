<?php
/**
 * Created by PhpStorm.
 * User: Pablo
 * Date: 17/09/2016
 * Time: 03:42 PM
 */
error_reporting(E_ALL);
include_once ("../Class/Estudios.php");
include_once ("../Class/Usuarios.php");
session_start();
$sErr = "";
$sOp = "";
$sClave = "";
$nAfec = 0;
$oEstudios = new Estudios();
$oUsuarios = new Usuarios();

    if(isset($_SESSION['sUser']) && !empty($_SESSION['sUser'])){
        if(isset($_POST['txtOp']) && !empty($_POST['txtOp'])){
            $sOp = $_POST['txtOp'];
            $sClave = $_POST['txtClave'];
            $oUsuarios = $_SESSION['sUser'];

            if($sOp == 'm'){
                $oEstudios->setClaveInterna($sClave);
            }

            if($sOp == 'a'){
                $oEstudios->setDescripcion($_POST['txtNombreEst']);
                $oEstudios->setIVA($_POST['txtiva']);
                $oEstudios->setCostoNormal($_POST['txtCosto1']);
                $oEstudios->setCostoAseg($_POST['txtCosto2']);
            }else if($sOp == 'm'){
                $oEstudios->setDescripcion($_POST['txtNombreEst']);
                $oEstudios->setIVA($_POST['txtiva']);
                $oEstudios->setCostoNormal($_POST['txtCosto1']);
                $oEstudios->setCostoAseg($_POST['txtCosto2']);
            }

            if($sOp == 'a'){
                $nAfec = $oEstudios->insertar($oUsuarios->getEmail());
            }else if($sOp == 'm'){
                $nAfec = $oEstudios->modificar($oUsuarios->getEmail());
            }

            if($nAfec == 1){
                header("Location: ../Sesiones/Estudios/controlEstudios.php");
            }else{
                $sErr = "Error en la base de datos, comuníquese con el administrador";
            }

        }else{
            $sErr = "Faltan datos";
        }
    }else{
        $sErr = "Acceso denegado, inicie sesión";
    }

    if($sErr != ""){
        //header("Location: error.php?sError=".$sErr);
    }
?>