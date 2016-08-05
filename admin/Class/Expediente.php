<?php

/**
 * Created by PhpStorm.
 * User: Pablo
 * Date: 03/08/2016
 * Time: 07:02 PM
 */
include_once ("Paciente.php");
include_once ("AccesoDatos.php");
class Expediente
{
    private $oPaciente;
    private $nNumero=0;


    public function getPaciente()
    {
        return $this->oPaciente;
    }

    public function setPaciente($oPaciente)
    {
        $this->oPaciente = $oPaciente;
    }

    public function getNumero()
    {
        return $this->nNumero;
    }

    public function setNumero($nNumero)
    {
        $this->nNumero = $nNumero;
    }

    function buscarUltimoNumExpediente(){
        $oAD = new AccesoDatos();
        $rst = null;
        $sQuery = "";
        $sNumero = "";
        if($oAD->Conecta()){
            $sQuery = "call buscarUltimoExpediente()";
            $rst = $oAD->ejecutaQuery($sQuery);
            $oAD->Desconecta();
            if($rst){
                $sNumero = $rst[0][0];
            }
        }
        return $sNumero;
    }

    function insertarExpediente($usuario){
        $oAD = new AccesoDatos();
        $sQuery = "";
        $nReg = 0;
        if($this->getPaciente()->getCurpPaciente() == "" && $this->getNumero() == 0) {
            throw new Exception("Expediente->insertarExpediente(): error, faltan datos");
        }else{
            $sQuery = "call insertaNumeroExpediente('".$this->getPaciente()->getCurpPaciente()."',".$this->getNumero().");";
            $nReg = $oAD->ejecutaComando($sQuery);
            $oAD->Desconecta();
        }
        return $nReg;
    }

}