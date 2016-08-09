<?php
/**
 * Created by PhpStorm.
 * User: Pablo
 * Date: 06/08/2016
 * Time: 03:11 PM
 */
include_once ("../Class/Usuarios.php");
$sEmail = "";
$sPass = "";
$sErr = "";
$oUser = new Usuarios();

if(isset($_POST["txtEmail"]) && !empty($_POST["txtEmail"]) &&
    isset($_POST["txtPass"]) && !empty($_POST["txtPass"])) {
    $sEmail = $_POST["txtEmail"];
    $sPass = $_POST["txtPass"];
    $oUser->setEmail($sEmail);
    $oUser->setPassword($sPass);
    
        if ($oUser->buscarEmailPass($sEmail)) {
            setcookie('cUser',$sEmail,time()+300);
            header("Location: ../Controllers/controlNIP.php");
        } else {
            $sErr = "Datos Incorrectos, regrese a la pantalla de inicio de sesión";
        }
        }else{
            $sErr = "Faltan datos, regrese a la pantalla de inicio de sesión";
         }

    if($sErr != "")
        header("Location: ../error.php?sError=".$sErr);

?>