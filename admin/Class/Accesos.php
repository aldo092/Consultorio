<?php

/**
 * Created by PhpStorm.
 * User: Pablo
 * Date: 07/08/2016
 * Time: 04:06 PM
 */
include_once ("AccesoDatos.php");
include_once ("Usuarios.php");
require ("../PHPMailer/class.phpmailer.php");
require ("../PHPMailer/class.smtp.php");
class Accesos
{
    private $oAD = null;
    private $oUsuario = null;
    private $nNIP = 0;
    private $bEstado = 0;


    public function getAD()
    {
        return $this->oAD;
    }

    public function setAD($oAD)
    {
        $this->oAD = $oAD;
    }

    public function getUsuario()
    {
        return $this->oUsuario;
    }

    public function setUsuario($oUsuario)
    {
        $this->oUsuario = $oUsuario;
    }

    public function getNIP()
    {
        return $this->nNIP;
    }

    public function setNIP($nNIP)
    {
        $this->nNIP = $nNIP;
    }

    public function getEstado()
    {
        return $this->bEstado;
    }

    public function setEstado($bEstado)
    {
        $this->bEstado = $bEstado;
    }

    
    function buscarAcceso(){
        $oAD = new AccesoDatos();
        $sQuery = "";
        $bRet = false;
        $value = "";
        $rst = null;
        if($this->getUsuario()->getEmail() == "" && $this->getNIP() == 0){
            throw new Exception("Accesos->buscarNIP(): error, faltan datos");
        }else {
            if ($oAD->Conecta()) {
                $sQuery = "call equalsNIP('".$this->getUsuario()->getEmail()."',".$this->getNIP().");";
                $rst = $oAD->ejecutaQuery($sQuery);
                $oAD->Desconecta();
            }
            if ($rst) {
                $this->setNIP($rst[0][1]);
                if ($this->getNIP() != "") {
                    $bRet = true;
                }
            }
        }
        return $bRet;
    }


    function generatorAccess(){
        $nNum =  rand(1000,9999);
        return $nNum;
    }

    function checkAccess($value){
        $oAD = new AccesoDatos();
        $sQuery = "";
        $result = "";
        $rst = null;
        $bRet = false;
        if($value == 0){
            throw new Exception("Accesos->checkAccess(): error, value is null");
        }else{
            if($oAD->Conecta()){
                $sQuery = "call checkValue(".$value.")";
                $rst = $oAD->ejecutaQuery($sQuery);
                $oAD->Desconecta();
                if($rst){
                    $result = $rst[0][0];
                    if($result != ""){
                        $bRet = true;
                    }
                }
            }
        }
        return $bRet;
    }

    function insertaAcceso(){
        $oAD = new AccesoDatos();
        $sQuery = "";
        $sNum = 0;
        $nAfe = 0;
        if($this->getUsuario()->getEmail() == ""){
            throw new Exception("Accesos->insertaAcceso(): no tiene permisos para realizar esta operación");
        }else{
            do{
                $sNum = $this->generatorAccess();
                if($this->checkAccess($sNum) == false){
                    if($oAD->Conecta()){
                        $sQuery = "call insertaAcceso('".$this->getUsuario()->getEmail()."',".$sNum.");";
                        $nAfe = $oAD->ejecutaComando($sQuery);
                        $oAD->Desconecta();
                        $this->setNIP($sNum);
                    }
                }
            }while($nAfe != 1);
        }
        return $nAfe;
    }

    function updateStatus(){
        $oAD = new AccesoDatos();
        $sQuery = "";
        $nAfe = -1;
        if($this->getNIP() == 0){
            throw new Exception("Accesos->updateStatus(): error, faltan datos");
        }else{
            if($oAD->Conecta()){
                $sQuery = "call updateStatusAccess('".$this->getUsuario()->getEmail()."');";
                $nAfe = $oAD->ejecutaComando($sQuery);
                $oAD->Desconecta();
            }
        }
        return $nAfe;
    }
    
    function email(){
        $bRet = false;
        $mail = new PHPMailer();
        $body = '<table width="537" height="662" align="center" bgcolor="#ffe4c4" title="Violación de Seguridad">
                              <tbody>
                                <tr>
                                  <td width="557">
                                      <p>Estimado usuario '.$this->getUsuario()->getEmail().', excedió el límite de intentos permitidos con su código de acceso.</p>
                                      <p>Como medida de seguridad, su código de acceso actual fué deshabilitado. Para accesar nuevamente al sistema, su nuevo código de seguridad
                                      es el siguiente: NIP: '.$this->getNIP().'.</p>
                                      <p>Recuerde que cuenta con un máximo de 3 intentos antes de que el código vigente sea bloqueado.</p>
                                  </td>
                                </tr>
                                <tr>
                                  <td>SISTEMA DE EXPEDIENTE ELECTRÓNICO</td>
                                </tr>
                              </tbody>
                            </table>';

        $body .= "";
        $mail->IsSMTP();
        $mail->CharSet = "UTF-8";
        $mail->Host = "smtp.gmail.com";
        $mail->Port = 465;
        $mail->SMTPAuth = true;
        $mail->SMTPSecure = "ssl";
        $mail->SMTPDebug = 1;
        $mail->From   = "sisalpasoft@gmail.com";
        $mail->FromName = "Sistema de Expediente Electrónico";
        $mail->Subject = "Notificación de Acceso Denegado";
        $mail->AltBody = "Leer";
        $mail->MsgHTML($body);
        $mail->AddAddress($_COOKIE['cUser']);
        $mail->SMTPAuth = true;
        $mail->Username = "sisalpasoft@gmail.com";
        $mail->Password = "sisalpasoft1234";
        if($mail->Send()){
            $bRet = true;
        }else{
            die();
            
        }
        return $bRet;
    }
}