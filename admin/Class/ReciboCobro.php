<?php

/**
 * Created by PhpStorm.
 * User: Pablo
 * Date: 25/09/2016
 * Time: 01:14 PM
 */
include_once ("AccesoDatos.php");
include_once ("EstudioRealizado.php");
include_once ("Estudios.php");
class ReciboCobro
{
    private $oAD = null;
    private $oEstReal = null;
    private $oEstudios = null;
    private $nIdFactura = 0;
    private $nTotal = 0.0;


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

    public function getEstudios()
    {
        return $this->oEstudios;
    }

    public function setEstudios($oEstudios)
    {
        $this->oEstudios = $oEstudios;
    }

    public function getIdFactura()
    {
        return $this->nIdFactura;
    }

    public function setIdFactura($nIdFactura)
    {
        $this->nIdFactura = $nIdFactura;
    }

    public function getTotal()
    {
        return $this->nTotal;
    }

    public function setTotal($nTotal)
    {
        $this->nTotal = $nTotal;
    }

}