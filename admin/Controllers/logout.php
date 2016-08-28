<?php
/**
 * Created by PhpStorm.
 * User: Pablo
 * Date: 19/08/2016
 * Time: 09:49 AM
 */
session_start();
$sErr="";
	if(isset($_SESSION["sUser"])){
        session_destroy();
    }
    else
        $sErr="Faltan datos de sesión, es posible que no realizara el login";

	if($sErr == "")
        header("Location:../login.html");
    else
        header("Location:../error.php?sError=".$sErr);
?>