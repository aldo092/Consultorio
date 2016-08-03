<?php

/**
 * Created by PhpStorm.
 * User: Pablo
 * Date: 03/08/2016
 * Time: 02:06 PM
 */
include_once ("AccesoDatos.php");
include_once ("Expediente.php");
class AntePatologicos
{
    private $sAlergias="";
    private $sCardiopatias="";
    private $sTransfusiones="";
    private $sDiabetico="";
    private $sCardiovasculares="";
    private $sHTA="";

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

}