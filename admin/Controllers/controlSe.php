<?php
/**
 * Created by PhpStorm.
 * User: Pablo
 * Date: 14/08/2016
 * Time: 12:37 PM
 */
include_once ("../Class/Usuarios.php");
session_start();
$oUser = null;
$sErr = "";
if(isset($_COOKIE['cUser']) && !empty($_COOKIE['cUser'])){
    $oUser = new Usuarios();
    $oUser->setEmail($_COOKIE['cUser']);
    setcookie('cUser',"",time()-40);
    setcookie('cIntentos',"",time()-40);
    $_SESSION['sUser'] = $oUser;
    header("Location: ../index.php");
}else{
    $sErr = "Error, no tiene permiso de acceso";
}

if($sErr != ""){
    header("Location: ../error.php?sError=".$sErr);
}

?>

