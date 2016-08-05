<?php

/**
 * Created by PhpStorm.
 * User: Pablo
 * Date: 03/08/2016
 * Time: 06:33 PM
 */
include_once ("AccesoDatos.php");
include_once ("Expediente.php");
include_once ("Paciente.php");
include_once ("MetodoAnticonceptivo.php");
class AntecGinecobstetricos
{
    private $oAD = null;
    private $oExpediente = null;
    private $oAnticonceptivos;
    private $nGestaciones="";
    private $nPartos=0;
    private $nAbortos=0;
    private $sIVSA=0;
    private $nParejasSexuales=0;
    private $sETS="";
    private $nCesareas=0;
    private $dUltPapanicolau;
    private $oPaciente = null;

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
    
    public function getAnticonceptivos()
    {
        return $this->oAnticonceptivos;
    }

    public function setAnticonceptivos($oAnticonceptivos)
    {
        $this->oAnticonceptivos = $oAnticonceptivos;
    }

    public function getGestaciones()
    {
        return $this->nGestaciones;
    }

    public function setGestaciones($nGestaciones)
    {
        $this->nGestaciones = $nGestaciones;
    }

    public function getPartos()
    {
        return $this->nPartos;
    }

    public function setPartos($nPartos)
    {
        $this->nPartos = $nPartos;
    }

    public function getAbortos()
    {
        return $this->nAbortos;
    }

    public function setAbortos($nAbortos)
    {
        $this->nAbortos = $nAbortos;
    }

    public function getIVSA()
    {
        return $this->sIVSA;
    }

    public function setIVSA($sIVSA)
    {
        $this->sIVSA = $sIVSA;
    }

    public function getParejasSexuales()
    {
        return $this->nParejasSexuales;
    }

    public function setParejasSexuales($nParejasSexuales)
    {
        $this->nParejasSexuales = $nParejasSexuales;
    }

    public function getETS()
    {
        return $this->sETS;
    }

    public function setETS($sETS)
    {
        $this->sETS = $sETS;
    }

    public function getCesareas()
    {
        return $this->nCesareas;
    }

    public function setCesareas($nCesareas)
    {
        $this->nCesareas = $nCesareas;
    }

    public function getUltPapanicolau()
    {
        return $this->dUltPapanicolau;
    }

    public function setUltPapanicolau($dUltPapanicolau)
    {
        $this->dUltPapanicolau = $dUltPapanicolau;
    }

    function buscarPorPaciente(){
        $oAD = new AccesoDatos();
        $sQuery = "";
        $bRet = false;
        $oGine = null;
        $rst = null;
        if($this->getOPaciente()->getCurPaciente() == ""){
            throw new Exception("AntecGinecobstetricos->buscarPorPaciente(): error, faltan datos");
        }else{
            if($oAD->Conecta()){
                $sQuery = "";
                $rst = $oAD->ejecutaQuery($sQuery);
                $oAD->Desconecta();
                if($rst){
                    $oGine = new AntecGinecobstetricos();
                    $oGine->setAnticonceptivos(new MetodoAnticonceptivo());
                    $oGine->getAnticonceptivos()->setDescripcion($rst[0][0]);
                    $oGine->setGestaciones($rst[0][1]);
                    $oGine->setPartos($rst[0][2]);
                    $oGine->setAbortos($rst[0][3]);
                    $oGine->setIVSA($rst[0][4]);
                    $oGine->setParejasSexuales($rst[0][5]);
                    $oGine->setETS($rst[0][6]);
                    $oGine->setCesareas([0][7]);
                    $oGine->setUltPapanicolau($rst[0][8]);
                    $bRet = true;
                }
            }
        }
        return $bRet;
    }
    
}