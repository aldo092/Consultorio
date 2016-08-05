<?php

/**
 * Created by PhpStorm.
 * User: Pablo
 * Date: 03/08/2016
 * Time: 07:05 PM
 */
include_once ("AccesoDatos.php");
class MetodoAnticonceptivo
{
    private $oAD = null;
    private $nClaveAnticonceptivo=0;
    private $sDescripcion="";


    public function getAD()
    {
        return $this->oAD;
    }
    
    public function setAD($oAD)
    {
        $this->oAD = $oAD;
    }

    public function getClaveAnticonceptivo()
    {
        return $this->nClaveAnticonceptivo;
    }

    public function setClaveAnticonceptivo($nClaveAnticonceptivo)
    {
        $this->nClaveAnticonceptivo = $nClaveAnticonceptivo;
    }

    public function getDescripcion()
    {
        return $this->sDescripcion;
    }

    public function setDescripcion($sDescripcion)
    {
        $this->sDescripcion = $sDescripcion;
    }

    function buscarTodos(){
        $oAD = new AccesoDatos();
        $vObj = null;
        $rst = null;
        $oMet = null;
        $sQuery = "";
        $i = 0;
        if($oAD->Conecta()){
            $sQuery = "call  buscarTodosMetodosAntic();";
            $rst = $oAD->ejecutaQuery($sQuery);
            $oAD->Desconecta();
        }
        if($rst){
            foreach ($rst as $vRowTemp){
                $oMet = new MetodoAnticonceptivo();
                $oMet->setClaveAnticonceptivo($vRowTemp[0]);
                $oMet->setDescripcion($vRowTemp[1]);
                $vObj[$i] = $oMet;
                $i = $i + 1;
            }
        }else{
            $vObj = false;
        }
        return $vObj;
    }

    function insertar($usuario){
        $oAD = new AccesoDatos();
        $sQuery = "";
        $i = -1;
        if($oAD->Conecta()){
            $sQuery = "call insertaMetodoAntic('".$usuario."','".$this->getDescripcion()."');";
            $i = $oAD->ejecutaComando($sQuery);
            $oAD->Desconecta();
        }
        return $i;
    }

    function modificar($usuario){
        $oAD = new AccesoDatos();
        $sQuery = "";
        $i = -1;
        if($this->getClaveAnticonceptivo() == 0){
            throw new Exception("MetodoAnticonceptivo->modificar(): error, faltan datos");
        }else{
            if($oAD->Conecta()){
                $sQuery = "call modificaMetodoAntic('".$usuario."','".$this->getDescripcion()."');";
                $i = $oAD->ejecutaComando($sQuery);
                $oAD->Desconecta();
            }
        }
        return $i;
    }

    function eliminar($usuario){
        $oAD = new AccesoDatos();
        $sQuery = "";
        $i = 0;
        if($this->getClaveAnticonceptivo() == 0){
            throw new Exception("MetodoAnticonceptivo->eliminar(): error, faltan datos");
        }else{
            if($oAD->Conecta()){
                $sQuery = "call eliminaMetodoAntic('".$usuario."',".$this->getClaveAnticonceptivo().");";
                $i = $oAD->ejecutaComando($sQuery);
                $oAD->Desconecta();
            }
        }
        return $i;
    }



}