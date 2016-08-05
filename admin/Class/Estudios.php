<?php

/**
 * Created by PhpStorm.
 * User: Pablo
 * Date: 04/08/2016
 * Time: 03:27 PM
 */
include_once ("AccesoDatos.php");
class Estudios
{
    private $oAD = null;
    private $nClaveInterna = 0;
    private $sDescripcion = "";
    private $nIVA = 0.0;
    private $nCostoNormal = 0.0;
    private $nCostoAseg = 0.0;


    public function getAD()
    {
        return $this->oAD;
    }

    public function setAD($oAD)
    {
        $this->oAD = $oAD;
    }

    public function getClaveInterna()
    {
        return $this->nClaveInterna;
    }

    public function setClaveInterna($nClaveInterna)
    {
        $this->nClaveInterna = $nClaveInterna;
    }

    public function getDescripcion()
    {
        return $this->sDescripcion;
    }

    public function setDescripcion($sDescripcion)
    {
        $this->sDescripcion = $sDescripcion;
    }

    public function getIVA()
    {
        return $this->nIVA;
    }

    public function setIVA($nIVA)
    {
        $this->nIVA = $nIVA;
    }

    public function getCostoNormal()
    {
        return $this->nCostoNormal;
    }

    public function setCostoNormal($nCostoNormal)
    {
        $this->nCostoNormal = $nCostoNormal;
    }

    public function getCostoAseg()
    {
        return $this->nCostoAseg;
    }

    public function setCostoAseg($nCostoAseg)
    {
        $this->nCostoAseg = $nCostoAseg;
    }

}