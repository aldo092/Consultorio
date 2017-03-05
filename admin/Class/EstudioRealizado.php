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
include_once ("EstImagen.php");
include_once ("EstLaboratorio.php");
include_once ("NotaMedica.php");
class EstudioRealizado
{
    private $oAD = null;
    private $oEstudios = null;
    private $oPaciente = null;
    private $oMedico = null;
    private $sDiagnostica = "";
    private $dFechaRealizado = null;
    private $sRutaArchivo = "";
    private $oEstImagen = null;
    private $oEstLab = null;
    private $oNota = null;


    public function getNota()
    {
        return $this->oNota;
    }

    public function setNota($oNota)
    {
        $this->oNota = $oNota;
    }

    public function getEstImagen()
    {
        return $this->oEstImagen;
    }

    public function setEstImagen($oEstImagen)
    {
        $this->oEstImagen = $oEstImagen;
    }

    public function getEstLab()
    {
        return $this->oEstLab;
    }

    public function setEstLab($oEstLab)
    {
        $this->oEstLab = $oEstLab;
    }

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

    
    function insertarEstudioRealizado($sUser){
        $oAD = new AccesoDatos();
        $sQuery = "";
        $nAfec = 0;
        if($this->getPaciente()->getExpediente()->getNumero() == ""){
            throw new Exception("EstudioRealizado->insertarEstudioRealizado(): error, faltan datos");
        }else{
            $sQuery = "call insertarEstAtendido('".$sUser."',
            ".$this->getEstudios()->getClaveInterna().",
            '".$this->getPaciente()->getExpediente()->getNumero()."',
            ".$this->getMedico()->getIdPersonal().",
            '".$this->getDiagnostica()."',
            current_date(),
            '".$this->getEstImagen()->getRutaArchivo()."',
            '".$this->getEstImagen()->getNivelUrgencia()."',
            current_date(),
            '".$this->getEstImagen()->getEstudioSolicitado()."',
            '".$this->getEstImagen()->getOtrosEstudios()."',
            '".$this->getEstImagen()->getRegionSol()."',
            '".$this->getEstLab()->getEstudiosSolicitados()."',
            '".$this->getNota()->getResumen()."',
            '".$this->getNota()->getPresionArterial()."',
            '".$this->getNota()->getSignosVitales()."',
            '".$this->getNota()->getTemperatura()."');";
            var_dump($sQuery);
            if($oAD->Conecta()){
                $nAfec = $oAD->ejecutaComando($sQuery);
                $oAD->Desconecta();
            }
        }
        return $nAfec;
    }



}