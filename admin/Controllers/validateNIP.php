<?php
/**
 * Created by PhpStorm.
 * User: Pablo
 * Date: 09/08/2016
 * Time: 12:09 PM
 */
include_once ("../Class/Accesos.php");
$sErr = "";
$nNum = 0;
$oAcceso = new Accesos();

    if(isset($_COOKIE['cUser']) && !empty($_COOKIE['cUser']) &&
        isset($_POST['txtNum']) && !empty($_POST['txtNum'])){
        $oAcceso->getUsuario()->setEmail($_COOKIE['cUser']);
        $oAcceso->setNIP($_POST['txtNum']);

           if($oAcceso->buscarAcceso()){
               header("Location: Controllers/controlSe.php");
           }else{
               
           }

        
    }else{
        $sErr = "Error de acceso";
    }

?>