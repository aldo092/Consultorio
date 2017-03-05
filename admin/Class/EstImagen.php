<?php

/**
 * Created by PhpStorm.
 * User: Pablo
 * Date: 25/09/2016
 * Time: 11:23 AM
 */
include_once ("AccesoDatos.php");
include_once ("EstudioRealizado.php");
class EstImagen extends EstudioRealizado
{
    private $sNivelUrgencia = "";
    private $dFechaSoliciutd = null;
    private $sEstudioSolicitado = "";
    private $sOtrosEstudios = "";
    private $sRegionSol = "";


    public function getOtrosEstudios()
    {
        return $this->sOtrosEstudios;
    }
    
    public function setOtrosEstudios($sOtrosEstudios)
    {
        $this->sOtrosEstudios = $sOtrosEstudios;
    }
    
    public function getRegionSol()
    {
        return $this->sRegionSol;
    }

    public function setRegionSol($sRegionSol)
    {
        $this->sRegionSol = $sRegionSol;
    }

    public function getNivelUrgencia()
    {
        return $this->sNivelUrgencia;
    }

    public function setNivelUrgencia($sNivelUrgencia)
    {
        $this->sNivelUrgencia = $sNivelUrgencia;
    }

    public function getFechaSoliciutd()
    {
        return $this->dFechaSoliciutd;
    }

    public function setFechaSoliciutd($dFechaSoliciutd)
    {
        $this->dFechaSoliciutd = $dFechaSoliciutd;
    }

    public function getEstudioSolicitado()
    {
        return $this->sEstudioSolicitado;
    }

    public function setEstudioSolicitado($sEstudioSolicitado)
    {
        $this->sEstudioSolicitado = $sEstudioSolicitado;
    }

}