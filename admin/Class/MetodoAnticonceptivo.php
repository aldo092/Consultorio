<?php

/**
 * Created by PhpStorm.
 * User: Pablo
 * Date: 03/08/2016
 * Time: 07:05 PM
 */
include_once ("AccesoDatos.php");
class MetodoAnticonceptivo
{
    private $oAD = null;
    private $nClaveAnticonceptivo=0;
    private $sDescripcion="";


    public function getAD()
    {
        return $this->oAD;
    }
    
    public function setAD($oAD)
    {
        $this->oAD = $oAD;
    }

    public function getClaveAnticonceptivo()
    {
        return $this->nClaveAnticonceptivo;
    }

    public function setClaveAnticonceptivo($nClaveAnticonceptivo)
    {
        $this->nClaveAnticonceptivo = $nClaveAnticonceptivo;
    }

    public function getDescripcion()
    {
        return $this->sDescripcion;
    }

    public function setDescripcion($sDescripcion)
    {
        $this->sDescripcion = $sDescripcion;
    }



}