<?php

/**
 * Created by PhpStorm.
 * User: Pablo
 * Date: 20/09/2016
 * Time: 05:16 PM
 */
include_once ("AccesoDatos.php");
include_once ("Paciente.php");
include_once ("Estudios.php");
include_once ("Medico.php");
class EstudioRealizado
{
    private $oAD = null;
    private $oEstudios = null;
    private $oPaciente = null;
    private $oMedico = null;
    private $sDiagnostica = "";
    private $dFechaRealizado = null;
    private $sRutaArchivo = "";


    public function getAD()
    {
        return $this->oAD;
    }

    public function setAD($oAD)
    {
        $this->oAD = $oAD;
    }

    public function getEstudios()
    {
        return $this->oEstudios;
    }

    public function setEstudios($oEstudios)
    {
        $this->oEstudios = $oEstudios;
    }

    public function getPaciente()
    {
        return $this->oPaciente;
    }

    public function setPaciente($oPaciente)
    {
        $this->oPaciente = $oPaciente;
    }

    public function getMedico()
    {
        return $this->oMedico;
    }

    public function setMedico($oMedico)
    {
        $this->oMedico = $oMedico;
    }

    public function getDiagnostica()
    {
        return $this->sDiagnostica;
    }

    public function setDiagnostica($sDiagnostica)
    {
        $this->sDiagnostica = $sDiagnostica;
    }

    public function getFechaRealizado()
    {
        return $this->dFechaRealizado;
    }

    public function setFechaRealizado($dFechaRealizado)
    {
        $this->dFechaRealizado = $dFechaRealizado;
    }

    public function getRutaArchivo()
    {
        return $this->sRutaArchivo;
    }

    public function setRutaArchivo($sRutaArchivo)
    {
        $this->sRutaArchivo = $sRutaArchivo;
    }




}