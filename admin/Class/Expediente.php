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
        $i = 0;
        if($this->getNumero() == ""){
            throw new Exception("Paciente->insertar(): error, faltan datos");
        }else{
            if($oAD->Conecta()){
                $sQuery = "call insertarExpediente('aldo092@gmail.com',
                                                 '".$this->nNumero."',
                                                 '".$this->oPaciente."');";
                $i = $oAD->ejecutaComando($sQuery);
                $oAD->Desconecta();
            }
        }
        return $i;
    }
}