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
include_once ("Horarios.php");
class Cita
{
    private $oAD=null;
    private $oConsultorio=null;
    private $nFolioCita=0;
    private $dFechaRegistro;
    private $dFechaCita;
    private $sHorario;
    private $oPaciente = null;
    private $Estatus="";


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


    public function getEstatus()
    {
        return $this->Estatus;
    }

    public function setEstatus($Estatus)
    {
        $this->Estatus = $Estatus;
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

    function BuscaTodasCitas (){
        $oAD = new AccesoDatos();
        $vObj = null;
        $rst = null;
        $sQuery = "";
        $i = 0;
        $oCita = null;
        if($oAD->Conecta()){
            $sQuery = "call BuscarTodasCitas();";
            $rst = $oAD->ejecutaQuery($sQuery);
            $oAD->Desconecta();

        }
        if($rst){
            foreach ($rst as $vRowTemp){
                $oCita = new Cita();
                $oCita->setFolioCita($vRowTemp[0]);
                $oCita->setConsultorio($vRowTemp[1]);
                $oCita->setSHorario($vRowTemp[2]);
                $oCita->setPaciente($vRowTemp[3]);
                $oCita->setFechaRegistro($vRowTemp[4]);
                $oCita->setFechaCita($vRowTemp[5]);
                $oCita->setEstatus($vRowTemp[6]);
                $vObj[$i] = $oCita;
                $i = $i + 1;
            }
        }else{
            $vObj = false;



        }
        return $vObj;

    }

    function ModificarEstatusCita($usuario){
        $oAD = new AccesoDatos();
        $sQuery = "";
        $i = -1;
        if($this->getFolioCita() == 0){
            throw new Exception("cita->modificarCita(): error, faltan datos");
        }else{
            if($oAD->Conecta()){
                $sQuery = "call modificaEstatus
                ('".$usuario."',
                ".$this->getFolioCita().", 
                ".$this->getEstatus().");";
                $i = $oAD->ejecutaComando($sQuery);
                $oAD->Desconecta();
            }
        }
        return $i;


    }

    function CancelarCita($usuario){
        $oAD = new AccesoDatos();
        $sQuery = "";
        $i = -1;
        if($this->getFolioCita() == 0){
            throw new Exception("cita->modificarCita(): error, faltan datos");
        }else{
            if($oAD->Conecta()){
                $sQuery = "call CancelarCita
                ('".$usuario."',
                ".$this->getFolioCita().");";
                $i = $oAD->ejecutaComando($sQuery);
                $oAD->Desconecta();
            }
        }
        return $i;


    }






    
}