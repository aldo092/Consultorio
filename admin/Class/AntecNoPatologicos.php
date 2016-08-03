<?php

/**
 * Created by PhpStorm.
 * User: Pablo
 * Date: 03/08/2016
 * Time: 01:56 PM
 */
include_once ("AccesoDatos.php");
include_once ("Expediente.php");
class AntecPatologicos
{
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
    
    
    
}