<?php

/**
 * Created by PhpStorm.
 * User: Pablo
 * Date: 03/08/2016
 * Time: 06:22 PM
 */
include_once ("AccesoDatos.php");
include_once ("Expediente.php");
class AntecFamiliares
{
    private $sAlcoholismo="";
    private $sAlergias="";
    private $sAsma="";
    private $sCancer="";
    private $sCongenitos="";
    private $sConvulsiones="";
    private $sDiabetes="";
    private $sHipertension="";
    private $sDrogradiccion="";
    private $sTabaquismo;


    public function getAlcoholismo()
    {
        return $this->sAlcoholismo;
    }

    public function setAlcoholismo($sAlcoholismo)
    {
        $this->sAlcoholismo = $sAlcoholismo;
    }

    public function getAlergias()
    {
        return $this->sAlergias;
    }

    public function setAlergias($sAlergias)
    {
        $this->sAlergias = $sAlergias;
    }

    public function getAsma()
    {
        return $this->sAsma;
    }

    public function setAsma($sAsma)
    {
        $this->sAsma = $sAsma;
    }

    public function getCancer()
    {
        return $this->sCancer;
    }

    public function setCancer($sCancer)
    {
        $this->sCancer = $sCancer;
    }

    public function getCongenitos()
    {
        return $this->sCongenitos;
    }

    public function setCongenitos($sCongenitos)
    {
        $this->sCongenitos = $sCongenitos;
    }

    public function getConvulsiones()
    {
        return $this->sConvulsiones;
    }

    public function setConvulsiones($sConvulsiones)
    {
        $this->sConvulsiones = $sConvulsiones;
    }

    public function getDiabetes()
    {
        return $this->sDiabetes;
    }

    public function setDiabetes($sDiabetes)
    {
        $this->sDiabetes = $sDiabetes;
    }

    public function getHipertension()
    {
        return $this->sHipertension;
    }

    public function setHipertension($sHipertension)
    {
        $this->sHipertension = $sHipertension;
    }

    public function getDrogradiccion()
    {
        return $this->sDrogradiccion;
    }

    public function setDrogradiccion($sDrogradiccion)
    {
        $this->sDrogradiccion = $sDrogradiccion;
    }

    public function getTabaquismo()
    {
        return $this->sTabaquismo;
    }

    public function setTabaquismo($sTabaquismo)
    {
        $this->sTabaquismo = $sTabaquismo;
    }


}