<?php

/**
 * Created by PhpStorm.
 * User: Pablo
 * Date: 03/08/2016
 * Time: 07:30 PM
 */
include_once ("AccesoDatos.php");
include_once ("Consultorio.php");
include_once ("Paciente.php");
class Cita
{
    private $oAD=null;
    private $oConsultorio=null;
    private $nFolioCita=0;
    private $dFechaRegistro;
    private $dFechaCita;
    private $sHorario;
    private $oPaciente = null;

    public function getPaciente()
    {
        return $this->oPaciente;
    }

    public function setPaciente($oPaciente)
    {
        $this->oPaciente = $oPaciente;
    }


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

    public function getFolioCita()
    {
        return $this->nFolioCita;
    }

    public function setFolioCita($nFolioCita)
    {
        $this->nFolioCita = $nFolioCita;
    }

    public function getFechaRegistro()
    {
        return $this->dFechaRegistro;
    }

    public function setFechaRegistro($dFechaRegistro)
    {
        $this->dFechaRegistro = $dFechaRegistro;
    }
    
    public function getFechaCita()
    {
        return $this->dFechaCita;
    }

    public function setFechaCita($dFechaCita)
    {
        $this->dFechaCita = $dFechaCita;
    }


    public function getSHorario()
    {
        return $this->sHorario;
    }


    public function setSHorario($sHorario)
    {
        $this->sHorario = $sHorario;
    }


    function insertar($usuario){
        $oAD = new AccesoDatos();
        $sQuery = "";
        $i = -1;
        if($this->getPaciente() == ""){
            throw new Exception("Paciente->insertar(): error, faltan datos");
        }else{
            if($oAD->Conecta()){
                $sQuery = "call insertarCita('".$usuario."',
                                                 '".$this->oConsultorio."',
                                                 '".$this->sHorario."',
                                                 '".$this->oPaciente."',
                                                '".$this->dFechaCita."');";
                $i = $oAD->ejecutaComando($sQuery);
                $oAD->Desconecta();
            }
        }
        return $i;
    }




    
}