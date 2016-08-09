<?php

/**
 * Created by PhpStorm.
 * User: Pablo
 * Date: 07/08/2016
 * Time: 04:06 PM
 */
include_once ("AccesoDatos.php");
include_once ("Usuarios.php");
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
        $bRet = true;
        $value = "";
        $rst = null;
        if($this->getUsuario()->getEmail() == "" && $this->getNIP() == 0){
            throw new Exception("Accesos->buscarNIP(): error, faltan datos");
        }else{
            if($oAD->Conecta()){
                $sQuery = "call equalsNIP('".$this->getUsuario()->getEmail()."','".$this->getNIP()."');";
                $rst = $oAD->ejecutaQuery($sQuery);
                $oAD->Desconecta();
            }
            if($rst){
                $value = $rst[0][1];
                if($this->getNIP() == $value){
                    $bRet = true;
                }else{
                    throw new Exception("Accesos->buscarNIP(): intento de acceso incorrecto");
                }
            }else{
                throw new Exception("Accesos->buscarNIP(): intento de acceso incorrecto, el nip no está registrado");
            }
        }
        return $bRet;
    }

    function generatorAccess(){
        $nNum = random_int(1000,9999);
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
                $sQuery = "call checkValue('".$value."')";
                $rst = $oAD->ejecutaQuery($sQuery);
                $oAD->Desconecta();
                if($rst){
                    $result = $rst[0][0];
                    if($value == $result){
                        $bRet = true;
                    }
                }
            }
        }
        return $bRet;
    }

    function insertaAcceso($usuario){
        $oAD = new AccesoDatos();
        $sQuery = "";
        $sNum = 0;
        $nAfe = 0;
        if($usuario == ""){
            throw new Exception("Accesos->insertaAcceso(): no tiene permisos para realizar esta operación");
        }else{
            do{
                $sNum = $this->generatorAccess();
                if($this->checkAccess($sNum) == false){
                    if($oAD->Conecta()){
                        $sQuery = "call insertaAcceso('".$usuario."','".$sNum."');";
                        $nAfe = $oAD->ejecutaComando($sQuery);
                        $oAD->Desconecta();
                        $this->setNIP($sNum);
                    }
                }
            }while($nAfe != 1);
        }
        return $nAfe;
    }


}