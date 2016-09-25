<?php

/**
 * Created by PhpStorm.
 * User: Pablo
 * Date: 25/09/2016
 * Time: 11:23 AM
 */

include_once ("AccesoDatos.php");
include_once ("EstudioRealizado.php");
class NotaMedica
{
    private $oAD = null;
    private $oEstReal = null;
    private $sNumCama = "";
    private $sResumen = "";
    private $sPresionArterial = "";
    private $sSignosVitales = "";
    private $sTemperatura = "";
    
    
    public function getAD()
    {
        return $this->oAD;
    }

    public function setAD($oAD)
    {
        $this->oAD = $oAD;
    }

    public function getEstReal()
    {
        return $this->oEstReal;
    }

    public function setEstReal($oEstReal)
    {
        $this->oEstReal = $oEstReal;
    }

    public function getNumCama()
    {
        return $this->sNumCama;
    }

    public function setNumCama($sNumCama)
    {
        $this->sNumCama = $sNumCama;
    }

    public function getResumen()
    {
        return $this->sResumen;
    }

    public function setResumen($sResumen)
    {
        $this->sResumen = $sResumen;
    }

    public function getPresionArterial()
    {
        return $this->sPresionArterial;
    }

    public function setPresionArterial($sPresionArterial)
    {
        $this->sPresionArterial = $sPresionArterial;
    }

    public function getSignosVitales()
    {
        return $this->sSignosVitales;
    }
    
    public function setSignosVitales($sSignosVitales)
    {
        $this->sSignosVitales = $sSignosVitales;
    }

    public function getTemperatura()
    {
        return $this->sTemperatura;
    }

    public function setTemperatura($sTemperatura)
    {
        $this->sTemperatura = $sTemperatura;
    }
    
}