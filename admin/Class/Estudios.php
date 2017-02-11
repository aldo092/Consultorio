<?php

/**
 * Created by PhpStorm.
 * User: Pablo
 * Date: 04/08/2016
 * Time: 03:27 PM
 */
include_once ("AccesoDatos.php");
include_once ("Especialidad.php");
class Estudios
{
    private $oAD = null;
    private $nClaveInterna = 0;
    private $sDescripcion = "";
    private $nIVA = 0.0;
    private $nCostoNormal = 0.0;
    private $nCostoAseg = 0.0;
    private $oEspecialidad = null;


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
            $sQuery = "call buscarEstudios()";
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

    function buscarDatosEstudio(){
        $oAD = new AccesoDatos();
        $sQuery = "";
        $rst = null;
        $bRet = false;
        if($this->getClaveInterna() == 0){
            throw new Exception("Estudios->buscarDatosEstudio(): error, faltan datos");
        }else{
            if($oAD->Conecta()){
                $sQuery = "call buscarDatosEstudio(".$this->getClaveInterna().");";
                $rst = $oAD->ejecutaQuery($sQuery);
                $oAD->Desconecta();
                if($rst){
                    $this->setEspecialidad(new Especialidad());
                    $this->setClaveInterna($rst[0][0]);
                    $this->setDescripcion($rst[0][1]);
                    $this->setIVA($rst[0][2]);
                    $this->setCostoNormal($rst[0][3]);
                    $this->setCostoAseg($rst[0][4]);
                    $this->getEspecialidad()->setDescripcion($rst[0][5]);
                    $bRet = true;

                }
            }
        }
        return $bRet;
    }

    function buscarEstudiosPorEspecialidad($usuario){
        $oAD = new AccesoDatos();
        $sQuery = "";
        $rst = null;
        $vObj = null;
        $bRet = false;
        $oEstudios = null;
        $i = 0;
        if($usuario == ""){
            throw new Exception("Estudios->buscarEstudiosPorEspecialidad(): error, faltan datos");
        }else{
            if($oAD->Conecta()){
                $sQuery = "call buscarEstudiosPorEspecialidad('".$usuario."');";
                $rst = $oAD->ejecutaQuery($sQuery);
                $oAD->Desconecta();
            }
            if($rst){
                foreach ($rst as $vRow){
                    $oEstudios = new Estudios();
                    $oEstudios->setClaveInterna($vRow[0]);
                    $oEstudios->setDescripcion($vRow[1]);
                    $vObj[$i] = $oEstudios;
                    $i = $i + 1;
                }
            }else{
                $vObj = false;
            }
        }
        return $vObj;
    }

    function insertar($usuario){
        $oAD = new AccesoDatos();
        $sQuery = "";
        $i = -1;
        if($oAD->Conecta()){
            $sQuery = "call insertarEstudios('".$usuario."','".$this->getDescripcion()."', ".$this->getIVA().", ".$this->getCostoNormal().",
            ".$this->getCostoAseg().",".$this->getEspecialidad()->getIdEspecialidad().");";
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
                $oAD->Desconecta();
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
                $i = $oAD->ejecutaComando($sQuery);
                $oAD->Desconecta();
            }
        }
        return $i;
    }

}