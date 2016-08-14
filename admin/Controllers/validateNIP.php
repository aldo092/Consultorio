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
$sUser = "";
$mail = "";
$oAcceso = new Accesos();


    if(isset($_COOKIE['cUser']) && !empty($_COOKIE['cUser']) &&
        isset($_POST['txtNum']) && !empty($_POST['txtNum'])){
        $oAcceso->setUsuario(new Usuarios());
        $oAcceso->getUsuario()->setEmail($_COOKIE['cUser']);
        $oAcceso->setNIP($_POST['txtNum']);

           if($oAcceso->buscarAcceso()){
               header("Location: Controllers/controlSe.php");
           }else{
               $nNum = $_COOKIE['cIntentos'];
               if($nNum == 3){
                   if($oAcceso->updateStatus() == 1) {
                        if($oAcceso->insertaAcceso()==1){
                            if($oAcceso->email()){
                                header("Location: ../mail.html");
                            }else{
                                $sErr = "Error al enviar el email";
                            }
                        }
                   }
               }else if($nNum < 3){
                   $nNum = $nNum + 1;
                   setcookie('cIntentos',$nNum, time()+180);
                   header("Location: controlNIP.php");
               }
           }
    }else{
        $sErr = "Error de acceso";
    }

    if($sErr != ""){
        header("Location: ../error.php?sError=".$sErr);
    }

?>
