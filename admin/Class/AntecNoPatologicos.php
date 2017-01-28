<?php

/**
 * Created by PhpStorm.
 * User: Pablo
 * Date: 03/08/2016
 * Time: 01:56 PM
 */
include_once ("AccesoDatos.php");
include_once ("Expediente.php");
include_once ("Paciente.php");
class AntecNoPatologicos
{
    private $oAD = null;
    private $oExpediente=null;
    private $sReligion="";
    private $bTabaquismo;
    private $sEscolaridad="";
    private $sOcupacion="";
    private $bAlcoholismo;
    private $sDrogas="";
    private $bAguaPotable;
    private $bElectricidad;
    private $bDrenaje;
    private $bServSan;
    private $sBCG;
    private $sPolio;
    private $sPenta;
    private $sInfluenza;
    private $oPaciente;

    public function getPaciente()
    {
        return $this->oPaciente;
    }

    public function setPaciente($oPaciente)
    {
        $this->oPaciente = $oPaciente;
    }

    public function getOAD()
    {
        return $this->oAD;
    }

    public function setOAD($oAD)
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
        return $this;
    }

    public function getReligion()
    {
        return $this->sReligion;
    }

    public function setReligion($sReligion)
    {
        $this->sReligion = $sReligion;
        return $this;
    }

    public function getTabaquismo()
    {
        return $this->bTabaquismo;
    }

    public function setTabaquismo($bTabaquismo)
    {
        $this->bTabaquismo = $bTabaquismo;
        return $this;
    }

    public function getEscolaridad()
    {
        return $this->sEscolaridad;
    }

    public function setEscolaridad($sEscolaridad)
    {
        $this->sEscolaridad = $sEscolaridad;
        return $this;
    }

    public function getOcupacion()
    {
        return $this->sOcupacion;
    }

    public function setOcupacion($sOcupacion)
    {
        $this->sOcupacion = $sOcupacion;
        return $this;
    }

    public function getAlcoholismo()
    {
        return $this->bAlcoholismo;
    }

    public function setAlcoholismo($bAlcoholismo)
    {
        $this->bAlcoholismo = $bAlcoholismo;
        return $this;
    }

    public function getDrogas()
    {
        return $this->sDrogas;
    }

    public function setDrogas($sDrogas)
    {
        $this->sDrogas = $sDrogas;
        return $this;
    }

    public function getAguaPotable()
    {
        return $this->bAguaPotable;
    }

    public function setAguaPotable($bAguaPotable)
    {
        $this->bAguaPotable = $bAguaPotable;
        return $this;
    }

    public function getElectricidad()
    {
        return $this->bElectricidad;
    }

    public function setElectricidad($bElectricidad)
    {
        $this->bElectricidad = $bElectricidad;
        return $this;
    }

    public function getDrenaje()
    {
        return $this->bDrenaje;
    }

    public function setDrenaje($bDrenaje)
    {
        $this->bDrenaje = $bDrenaje;
        return $this;
    }

    public function getServSan()
    {
        return $this->bServSan;
    }

    public function setServSan($bServSan)
    {
        $this->bServSan = $bServSan;
        return $this;
    }

    public function getSBCG()
    {
        return $this->sBCG;
    }

    public function setSBCG($sBCG)
    {
        $this->sBCG = $sBCG;
    }


    public function getSPolio()
    {
        return $this->sPolio;
    }


    public function setSPolio($sPolio)
    {
        $this->sPolio = $sPolio;
    }

    public function getSPenta()
    {
        return $this->sPenta;
    }


    public function setSPenta($sPenta)
    {
        $this->sPenta = $sPenta;
    }


    public function getSInfluenza()
    {
        return $this->sInfluenza;
    }


    public function setSInfluenza($sInfluenza)
    {
        $this->sInfluenza = $sInfluenza;
    }


    
    function buscarPorPaciente(){
        $oAD = new AccesoDatos();
        $rst = null;
        $bRet = false;
        $sQuery = "";
        $oPat = null;
        if($this->getPaciente()->getCurpPaciente() == ""){
            throw new Exception("AntecNoPatologicos->buscarPorPaciente(): error, faltan datos");
        }else{
            if($oAD->Conecta()){
                $sQuery = "";
                $rst = $oAD->ejecutaQuery($sQuery);
                $oAD->Desconecta();
                if($rst){
                    $this->setReligion($rst[0][0]);
                    $this->setTabaquismo($rst[0][1]);
                    $this->setEscolaridad($rst[0][2]);
                    $this->setOcupacion($rst[0][3]);
                    $this->setAlcoholismo($rst[0][4]);
                    $this->setDrogas($rst[0][5]);
                    $this->setAguaPotable($rst[0][6]);
                    $this->setElectricidad($rst[0][7]);
                    $this->setDrenaje($rst[0][8]);
                    $this->setServSan($rst[0][9]);
                    $bRet = true;
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
                $sQuery = "call insertarAntNoPat ('".$usuario."',
                                                  '".$this->oExpediente."',
                                                  '".$this->sReligion."',
                                                  '".$this->bTabaquismo."',
                                                 '".$this->sEscolaridad."',
                                                   '".$this->sOcupacion."',
                                                  '".$this->bAlcoholismo."',
                                                  '".$this->sDrogas."',
                                                  '".$this->bAguaPotable."',
                                                  '".$this->bElectricidad."',
                                                  '".$this->bDrenaje."',
                                                  '".$this->bServSan."',
                                                  '".$this->sBCG."',
                                                  '".$this->sPolio."',
                                                  '".$this->sPenta."',
                                                  '".$this->sInfluenza."');";
                $i = $oAD->ejecutaComando($sQuery);
                $oAD->Desconecta();
            }
        }
        return $i;
    }

    function ExisteAntNoPat($expediente){
        $oAD = new AccesoDatos();
        $sQuery = "";
        $rst = null;
        $bRet = false;
        if($expediente==""){
            throw new Exception("Usuarios->buscarAPat(): error ,faltan expediente");
        }else{
            if($oAD->Conecta()){
                $sQuery = "call ExisteAntNoPat('".$expediente."');";
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