<?php

/**
 * Created by PhpStorm.
 * User: Pablo
 * Date: 03/08/2016
 * Time: 07:26 PM
 */
include_once ("AccesoDatos.php");
include_once ("Aseguradora.php");
include_once ("Paciente.php");
class Seguro
{
    private $oAD = null;
    private $oAseguradora;
    private $oPaciente;
    private $dFechaVigencia;


    public function getAD()
    {
        return $this->oAD;
    }

    public function setAD($oAD)
    {
        $this->oAD = $oAD;
    }

    public function getPaciente()
    {
        return $this->oPaciente;
    }

    public function setPaciente($oPaciente)
    {
        $this->oPaciente = $oPaciente;
    }

    public function getAseguradora()
    {
        return $this->oAseguradora;
    }

    public function setOAseguradora($oAseguradora)
    {
        $this->oAseguradora = $oAseguradora;
    }

    public function getFechaVigencia()
    {
        return $this->dFechaVigencia;
    }

    public function setFechaVigencia($dFechaVigencia)
    {
        $this->dFechaVigencia = $dFechaVigencia;
    }


}