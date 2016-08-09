<?php

/**
 * Created by PhpStorm.
 * User: Pablo
 * Date: 04/08/2016
 * Time: 03:37 PM
 */
include_once ("AccesoDatos.php");
include_once ("Perfil.php");
class Usuarios
{
    private $oAD = null;
    private $nIdUsuario = "";
    private $sEmail = "";
    private $sPassword = "";
    private $dFechaRegistro;
    private $arrPerfil = null;
    private $oPersonal = null;


    public function getAD()
    {
        return $this->oAD;
    }

    public function setAD($oAD)
    {
        $this->oAD = $oAD;
    }

    public function getIdUsuario()
    {
        return $this->nIdUsuario;
    }

    public function setIdUsuario($nIdUsuario)
    {
        $this->nIdUsuario = $nIdUsuario;
    }

    public function getEmail()
    {
        return $this->sEmail;
    }

    public function setEmail($sEmail)
    {
        $this->sEmail = $sEmail;
    }

    public function getPassword()
    {
        return $this->sPassword;
    }

    public function setPassword($sPassword)
    {
        $this->sPassword = $sPassword;
    }

    public function getFechaRegistro()
    {
        return $this->dFechaRegistro;
    }

    public function setFechaRegistro($dFechaRegistro)
    {
        $this->dFechaRegistro = $dFechaRegistro;
    }

    public function getArrPerfil()
    {
        return $this->arrPerfil;
    }

    public function setArrPerfil($arrPerfil)
    {
        $this->arrPerfil = $arrPerfil;
    }

    public function getPersonal()
    {
        return $this->oPersonal;
    }

    public function setPersonal($oPersonal)
    {
        $this->oPersonal = $oPersonal;
    }

    function buscarTodos(){
        $oAD = new AccesoDatos();
        $vObj = null;
        $rst = null;
        $sQuery = "";
        $i = 0;
        $oUser = null;
        if($oAD->Conecta()){
            $sQuery = "call buscarTodosUsuarios();";
            $rst = $oAD->ejecutaQuery($sQuery);
            $oAD->Desconecta();
        }
        if($rst){
            foreach ($rst as $vRowTemp){
                $oUser = new Usuarios();
                $oUser->setPersonal(new Personal());
                $oUser->setIdUsuario($vRowTemp[0]);
                $oUser->setEmail($vRowTemp[1]);
                $oUser->setFechaRegistro($vRowTemp[2]);
                $oUser->getPersonal()->setNombres($vRowTemp[3]);
                $oUser->getPersonal()->setApPaterno($vRowTemp[4]);
                $oUser->getPersonal()->setApMaterno($vRowTemp[5]);
                $vObj[$i]= $oUser;
                $i = $i + 1;
            }
        }else{
            $vObj = false;
        }
        return $vObj;
    }

    function buscarEmailPass($usuario){
        $oAD = new AccesoDatos();
        $sQuery = "";
        $rst = null;
        $bRet = false;
        if($this->getEmail() == "" && $this->getPassword() == ""){
            throw new Exception("Usuarios->buscarEmailPass(): error ,faltan datos");
        }else{
            if($oAD->Conecta()){
                $sQuery = "call buscarEmailPassUser('".$usuario."','".$this->getEmail()."','".$this->getPassword()."');";
                $rst = $oAD->ejecutaQuery($sQuery);
                $oAD->Desconecta();
                if($rst){
                    $this->setEmail($rst[0][0]);
                    $bRet = true;
                }
            }
        }
        return $bRet;
    }

}