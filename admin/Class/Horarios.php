<?php

/**
 * Created by PhpStorm.
 * User: Pablo
 * Date: 03/08/2016
 * Time: 08:04 PM
 */

include_once ("AccesoDatos.php");
include_once ("Consultorio.php");
class Horarios
{
    private $oAD = null;
    private $oConsultorio=null;
    private $sDia="";
    private $sHorarioInicio="";
    private $sHorarioFin="";


    public function getAD()
    {
        return $this->oAD;
    }

    public function setAD($oAD)
    {
        $this->oAD = $oAD;
    }

    public function getConsultorio()
    {
        return $this->oConsultorio;
    }

    public function setConsultorio($oConsultorio)
    {
        $this->oConsultorio = $oConsultorio;
    }

    public function getDia()
    {
        return $this->sDia;
    }

    public function setDia($sDia)
    {
        $this->sDia = $sDia;
    }
    
    public function getHorarioInicio()
    {
        return $this->sHorarioInicio;
    }

    public function setHorarioInicio($sHorarioInicio)
    {
        $this->sHorarioInicio = $sHorarioInicio;
    }

    public function getHorarioFin()
    {
        return $this->sHorarioFin;
    }

    public function setHorarioFin($sHorarioFin)
    {
        $this->sHorarioFin = $sHorarioFin;
    }
    
    
}