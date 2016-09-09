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
    private $oPoliza;


    public function getOPoliza()
    {
        return $this->oPoliza;
    }

    public function setOPoliza($oPoliza)
    {
        $this->oPoliza = $oPoliza;
    }
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



    function insertar($usuario){
        $oAD = new AccesoDatos();
        $sQuery = "";
        $i = -1;
        if($this->getOPoliza() == ""){
            throw new Exception("Paciente->insertar(): error, faltan datos");
        }else{
            if($oAD->Conecta()){
                $sQuery = "call insertarSeguro('".$usuario."',
                                                 '".$this->oPoliza."',
                                                 '".$this->oAseguradora."',
                                                 '".$this->oPaciente."',
                                                 '".$this->dFechaVigencia."');";
                $i = $oAD->ejecutaComando($sQuery);
                $oAD->Desconecta();
            }
        }
        return $i;
    }


}