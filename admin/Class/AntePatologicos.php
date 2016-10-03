<?php

/**
 * Created by PhpStorm.
 * User: Pablo
 * Date: 03/08/2016
 * Time: 02:06 PM
 */
include_once ("AccesoDatos.php");
include_once ("Expediente.php");
include_once ("Paciente.php");
class AntePatologicos
{
    private $oAD = null;
    private $oExpediente = null;
    private $sAlergias="";
    private $sCardiopatias="";
    private $sTransfusiones="";
    private $sDiabetico="";
    private $sCardiovasculares="";
    private $sHTA="";
    private $oPaciente;


    public function getPaciente()
    {
        return $this->oPaciente;
    }

    public function setPaciente($oPaciente)
    {
        $this->oPaciente = $oPaciente;
    }
    
    public function getAD()
    {
        return $this->oAD;
    }

    public function setAD($oAD)
    {
        $this->oAD = $oAD;
    }
    
    public function getExpediente()
    {
        return $this->oExpediente;
    }
    
    public function setExpediente($oExpediente)
    {
        $this->oExpediente = $oExpediente;
    }
    
    public function getAlergias()
    {
        return $this->sAlergias;
    }

    public function setAlergias($sAlergias)
    {
        $this->sAlergias = $sAlergias;
    }

    public function getCardiopatias()
    {
        return $this->sCardiopatias;
    }

    public function setCardiopatias($sCardiopatias)
    {
        $this->sCardiopatias = $sCardiopatias;
    }

    public function getTransfusiones()
    {
        return $this->sTransfusiones;
    }

    public function setTransfusiones($sTransfusiones)
    {
        $this->sTransfusiones = $sTransfusiones;
    }

    public function getDiabetico()
    {
        return $this->sDiabetico;
    }

    public function setDiabetico($sDiabetico)
    {
        $this->sDiabetico = $sDiabetico;
    }

    public function getCardiovasculares()
    {
        return $this->sCardiovasculares;
    }

    public function setCardiovasculares($sCardiovasculares)
    {
        $this->sCardiovasculares = $sCardiovasculares;
    }

    public function getHTA()
    {
        return $this->sHTA;
    }

    public function setHTA($sHTA)
    {
        $this->sHTA = $sHTA;
    }

    function buscarPorPaciente(){
        $oAD = new AccesoDatos();
        $rst = null;
        $oPat = null;
        $sQuery = "";
        if($this->getPaciente()->getCurpPaciente() == ""){
            throw new Exception("AntePatologicos->buscarPorPaciente(): error, faltan datos");
        }else{
            if($oAD->Conecta()){
                $sQuery = "";
                $rst = $oAD->ejecutaQuery($sQuery);
                $oAD->Desconecta();
                if($rst){
                    $this->setAlergias($rst[0][0]);
                    $this->setCardiopatias($rst[0][1]);
                    $this->setTransfusiones($rst[0][2]);
                    $this->setDiabetico($rst[0][3]);
                    $this->setCardiovasculares($rst[0][4]);
                    $this->setHTA($rst[0][5]);
                    $bRet=true;
                }
            }
        }
        return $bRet;
    }

    function insertar($usuario){
        $oAD = new AccesoDatos();
        $sQuery = "";
        $i = -1;
        if($this->getExpediente() == ""){
            throw new Exception("Paciente->insertar(): error, faltan datos");
        }else{
            if($oAD->Conecta()){
                $sQuery = "call insertarAntPat('".$usuario."',
                                                 '".$this->oExpediente."',
                                                 '".$this->sAlergias."',
                                                 '".$this->sCardiopatias."',
                                                  '".$this->sTransfusiones."',
                                                  '".$this->sDiabetico."',
                                                  '".$this->sCardiovasculares."',
                                                  '".$this->sHTA."');";
                $i = $oAD->ejecutaComando($sQuery);
                $oAD->Desconecta();
            }
        }
        return $i;
        }

    function ExisteAntPat($expediente){
        $oAD = new AccesoDatos();
        $sQuery = "";
        $rst = null;
        $bRet = false;
        if($expediente==""){
            throw new Exception("Usuarios->buscarAPat(): error ,faltan expediente");
        }else{
            if($oAD->Conecta()){
                $sQuery = "call ExisteAntPat('".$expediente."');";
                $rst = $oAD->ejecutaQuery($sQuery);
                $oAD->Desconecta();
                if($rst){
                    $this->setExpediente($rst[0][0]);
                    $bRet = true;
                }
            }
        }
        return $bRet;
    }
}