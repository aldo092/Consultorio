<?php

/**
 * Created by PhpStorm.
 * User: Pablo
 * Date: 04/08/2016
 * Time: 03:27 PM
 */
include_once ("AccesoDatos.php");
class Estudios
{
    private $oAD = null;
    private $nClaveInterna = 0;
    private $sDescripcion = "";
    private $nIVA = 0.0;
    private $nCostoNormal = 0.0;
    private $nCostoAseg = 0.0;


    public function getAD()
    {
        return $this->oAD;
    }

    public function setAD($oAD)
    {
        $this->oAD = $oAD;
    }

    public function getClaveInterna()
    {
        return $this->nClaveInterna;
    }

    public function setClaveInterna($nClaveInterna)
    {
        $this->nClaveInterna = $nClaveInterna;
    }

    public function getDescripcion()
    {
        return $this->sDescripcion;
    }

    public function setDescripcion($sDescripcion)
    {
        $this->sDescripcion = $sDescripcion;
    }

    public function getIVA()
    {
        return $this->nIVA;
    }

    public function setIVA($nIVA)
    {
        $this->nIVA = $nIVA;
    }

    public function getCostoNormal()
    {
        return $this->nCostoNormal;
    }

    public function setCostoNormal($nCostoNormal)
    {
        $this->nCostoNormal = $nCostoNormal;
    }

    public function getCostoAseg()
    {
        return $this->nCostoAseg;
    }

    public function setCostoAseg($nCostoAseg)
    {
        $this->nCostoAseg = $nCostoAseg;
    }

    function buscarTodos(){
        $oAD = new AccesoDatos();
        $vObj = null;
        $rst = null;
        $sQuery = "";
        $i = 0;
        $oEst = null;
        if($oAD->Conecta()){
            $sQuery = "call buscarTodosEstudios()";
            $rst = $oAD->ejecutaQuery($sQuery);
            $oAD->Desconecta();
        }
        if($rst){
            foreach ($rst as $vRowTemp){
                $oEst = new Estudios();
                $oEst->setClaveInterna($vRowTemp[0]);
                $oEst->setDescripcion($vRowTemp[1]);
                $oEst->setIVA($vRowTemp[2]);
                $oEst->setCostoNormal($vRowTemp[3]);
                $oEst->setCostoAseg($vRowTemp[4]);
                $vObj[$i] = $oEst;
                $i = $i + 1;
            }
        }
        else{
            $vObj = false;
        }
        return $vObj;
    }

    function insertar($usuario){
        $oAD = new AccesoDatos();
        $sQuery = "";
        $i = -1;
        if($oAD->Conecta()){
            $sQuery = "call insertaEstudios('".$usuario."',".$this->getDescripcion()."', ".$this->getIVA().", ".$this->getCostoNormal().",
            ".$this->getCostoAseg().");";
            $i = $oAD->ejecutaComando($sQuery);
            $oAD->Desconecta();
        }
        return $i;
    }
    
    function modificar($usuario){
        $oAD = new AccesoDatos();
        $sQuery = "";
        $i = -1;
        if($this->getClaveInterna() == 0){
            throw new Exception("Estudios->modificar(): error, faltan datos");
        }else{
            if($oAD->Conecta()){
                $sQuery = "call modificaEstudio('".$usuario."',".$this->getClaveInterna().", '".$this->getDescripcion()."',
                ".$this->getIVA().", ".$this->getCostoNormal().",".$this->getCostoAseg().");";
                $i = $oAD->ejecutaComando($sQuery);
            }
        }
        return $i;
    }
    
    function eliminar($usuario){
        $oAD = new AccesoDatos();
        $sQuery = "";
        $i = -1;
        if($this->getClaveInterna() == 0){
            throw new Exception("Estudios->eliminar():error, faltan datos");
        }else{
            if($oAD->Conecta()){
                $sQuery = "call eliminaEstudio('".$usuario."', ".$this->getClaveInterna().");";
                $i = $oAD->ejecutaComando();
                $oAD->Desconecta();
            }
        }
        return $i;
    }

}