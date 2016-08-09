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
$oUser = new Usuarios();

    if(isset($_POST["txtEmail"]) && !empty($_POST["txtEmail"]) &&
        isset($_POST["txtPass"]) && !empty($_POST["txtPass"])){
            $sEmail = $_POST["txtEmail"];
            $sPass = $_POST["txtPass"];

        $oUser->setEmail($sEmail);
        $oUser->setPassword($sPass);

        if($oUser->buscarEmailPass()){
            header("Location: controlNIP.php");
        }else{
            echo '<script language="javascript">alert("Error de inicio de sesión, los datos no son correctos");</script>';
            header("Location: ../login.html");
        }

    }else{
        header("Location: ../login.html");
        echo '<script language="javascript">alert("Error de inicio de sesión, faltan datos");</script>';
    }
?>