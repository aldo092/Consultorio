<?php
/**
 * Created by PhpStorm.
 * User: Pablo
 * Date: 04/09/2016
 * Time: 01:20 PM
 */
error_reporting(E_ALL);
include_once ("../../Class/Usuarios.php");
require_once ("../../Class/Menu.php");
require_once ("../../Class/Funcion.php");
require_once ("../../Class/Estudios.php");
session_start();
$oUser = new Usuarios();
$oEstudios = new Estudios();
$oFuncion = new Funcion();
$sErr = "";
$arrMenus = null;
$nCve = 0;
$sOp = "";
$sNombre = "";
$url ="".$_SERVER['REQUEST_URI'];
if(isset($_SESSION['sUser']) && !empty($_SESSION['sUser'])){
    if(isset($_POST['txtIdEstudio']) && !empty($_POST['txtIdEstudio']) &&
        isset($_POST['txtOp']) && !empty($_POST['txtOp'])){
        $nCve = $_POST['txtIdEstudio'];
        $sOp = $_POST['txtOp'];

        $oUser = $_SESSION['sUser'];
        $oMenu = new Menu();
        $oMenu->setUsuario($oUser);
        $arrMenus = $oMenu->buscarMenuUsuario();
        if($oUser->buscarDatosBasicos()){
            $sNombre = $oUser->getPersonal()->getNombres() . " " . $oUser->getPersonal()->getApPaterno() . " " . $oUser->getPersonal()->getApMaterno();
        } else {
            $sErr = "Error, datos no encontrados";
        }

        if($sOp == 'a'){
            $oEstudios->setClaveInterna($nCve);
            try{
                
            }catch (Exception $e) {
                error_log($e->getFile() . " " . $e->getLine() . " " . $e->getMessage(),0);
                $sErr2 = "Error en base de datos, comunicarse con el administrador";
            }
        }

    }
}
?>