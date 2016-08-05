<?php

/**
 * Created by PhpStorm.
 * User: Pablo
 * Date: 04/08/2016
 * Time: 03:19 PM
 */
include_once ("AccesoDatos.php");
include_once ("Personal.php");
class Medico
{
    private $oAD = null;
    private $oPersonal = null;
    private $sNumCedula = "";
    private $dFechaExpedicionCed;
    private $sNumCedEsp = "";
    private $dFecExpedCedEsp;
    private $sNumTelefono1;
    private $sNumTelefono2;
    private $sEspecialidad="";


    public function getAD()
    {
        return $this->oAD;
    }

    public function setAD($oAD)
    {
        $this->oAD = $oAD;
    }

    public function getPersonal()
    {
        return $this->oPersonal;
    }

    public function setPersonal($oPersonal)
    {
        $this->oPersonal = $oPersonal;
    }

    public function getNumCedula()
    {
        return $this->sNumCedula;
    }

    public function setNumCedula($sNumCedula)
    {
        $this->sNumCedula = $sNumCedula;
    }

    public function getFechaExpedicionCed()
    {
        return $this->dFechaExpedicionCed;
    }

    public function setFechaExpedicionCed($dFechaExpedicionCed)
    {
        $this->dFechaExpedicionCed = $dFechaExpedicionCed;
    }

    public function getNumCedEsp()
    {
        return $this->sNumCedEsp;
    }

    public function setNumCedEsp($sNumCedEsp)
    {
        $this->sNumCedEsp = $sNumCedEsp;
    }

    public function getFecExpedCedEsp()
    {
        return $this->dFecExpedCedEsp;
    }

    public function setFecExpedCedEsp($dFecExpedCedEsp)
    {
        $this->dFecExpedCedEsp = $dFecExpedCedEsp;
    }

    public function getNumTelefono1()
    {
        return $this->sNumTelefono1;
    }

    public function setNumTelefono1($sNumTelefono1)
    {
        $this->sNumTelefono1 = $sNumTelefono1;
    }

    public function getNumTelefono2()
    {
        return $this->sNumTelefono2;
    }

    public function setNumTelefono2($sNumTelefono2)
    {
        $this->sNumTelefono2 = $sNumTelefono2;
    }

    public function getEspecialidad()
    {
        return $this->sEspecialidad;
    }

    public function setEspecialidad($sEspecialidad)
    {
        $this->sEspecialidad = $sEspecialidad;
    }

}