<?php

/**
 * Created by PhpStorm.
 * User: Pablo
 * Date: 04/08/2016
 * Time: 03:19 PM
 */
include_once ("AccesoDatos.php");
include_once ("Especialidad.php");
class Medico
{
    private $oAD = null;
    private $sNumCedula = "";
    private $dFechaExpedicionCed=null;
    private $sNumCedEsp = "";
    private $dFecExpedCedEsp=null;
    private $sNumTelefono1="";
    private $sNumTelefono2="";
    private $oEspecialidad=null;


    public function getEspecialidad()
    {
        return $this->oEspecialidad;
    }

    public function setEspecialidad($oEspecialidad)
    {
        $this->oEspecialidad = $oEspecialidad;
    }

    public function getAD()
    {
        return $this->oAD;
    }

    public function setAD($oAD)
    {
        $this->oAD = $oAD;
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

    function buscarDatosMedico($nPersonal){
        $oAD = new AccesoDatos();
        $sQuery = "";
        $rst = null;
        //$oMedico = null;
        if($nPersonal == 0){
            throw new Exception("Medico->buscarDatosMedico(): error, faltan datos");
        }else{
            if($oAD->Conecta()){
                $sQuery = "call buscarDatosMedico(".$nPersonal.");";
                $rst = $oAD->ejecutaQuery($sQuery);
                $oAD->Desconecta();
                if($rst){
                    $this->setEspecialidad(new Especialidad());
                    $this->setNumCedula($rst[0][0]);
                    $this->setFechaExpedicionCed($rst[0][1]);
                    $this->setNumCedEsp($rst[0][2]);
                    $this->setFecExpedCedEsp($rst[0][3]);
                    $this->setNumTelefono1($rst[0][4]);
                    $this->getEspecialidad()->setDescripcion($rst[0][5]);
                }
            }
        }
        return $this;
    }

}