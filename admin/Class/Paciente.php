<?php

/**
 * Created by PhpStorm.
 * User: Pablo
 * Date: 03/08/2016
 * Time: 01:40 PM
 */
include_once ("AccesoDatos.php");
class Paciente
{
    private $sCurpPaciente="";
    private $sNombre="";
    private $sApPaterno="";
    private $sApMaterno="";
    private $dFechaNacimiento="";
    private $sTelefono="";
    private $sDireccion="";
    private $sCP="";
    private $bEstadoCivil;

    public function getCurpPaciente()
    {
        return $this->sCurpPaciente;
    }

    public function setCurpPaciente($sCurpPaciente)
    {
        $this->sCurpPaciente = $sCurpPaciente;
        return $this;
    }

    public function getNombre()
    {
        return $this->sNombre;
    }

    public function setNombre($sNombre)
    {
        $this->sNombre = $sNombre;
        return $this;
    }

    public function getApPaterno()
    {
        return $this->sApPaterno;
    }

    public function setApPaterno($sApPaterno)
    {
        $this->sApPaterno = $sApPaterno;
        return $this;
    }

    public function getApMaterno()
    {
        return $this->sApMaterno;
    }

    public function setApMaterno($sApMaterno)
    {
        $this->sApMaterno = $sApMaterno;
        return $this;
    }

    public function getFechaNacimiento()
    {
        return $this->dFechaNacimiento;
    }

    public function setFechaNacimiento($dFechaNacimiento)
    {
        $this->dFechaNacimiento = $dFechaNacimiento;
        return $this;
    }

    public function getTelefono()
    {
        return $this->sTelefono;
    }

    public function setTelefono($sTelefono)
    {
        $this->sTelefono = $sTelefono;
        return $this;
    }

    public function getDireccion()
    {
        return $this->sDireccion;
    }

    public function setDireccion($sDireccion)
    {
        $this->sDireccion = $sDireccion;
        return $this;
    }

    public function getCP()
    {
        return $this->sCP;
    }

    public function setCP($sCP)
    {
        $this->sCP = $sCP;
        return $this;
    }

    public function getEstadoCivil()
    {
        return $this->bEstadoCivil;
    }

    public function setEstadoCivil($bEstadoCivil)
    {
        $this->bEstadoCivil = $bEstadoCivil;
        return $this;
    }


}