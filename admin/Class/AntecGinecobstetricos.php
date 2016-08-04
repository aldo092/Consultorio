<?php

/**
 * Created by PhpStorm.
 * User: Pablo
 * Date: 03/08/2016
 * Time: 06:33 PM
 */
include_once ("AccesoDatos.php");
include_once ("Expediente.php");
class AntecGinecobstetricos
{
    private $oAnticonceptivos;
    private $nGestaciones="";
    private $nPartos=0;
    private $nAbortos=0;
    private $sIVSA=0;
    private $nParejasSexuales=0;
    private $sETS="";
    private $nCesareas=0;
    private $dUltPapanicolau;

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
    
    
}