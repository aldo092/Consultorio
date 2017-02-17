<?php

/**
 * Created by PhpStorm.
 * User: Pablo
 * Date: 05/08/2016
 * Time: 02:06 PM
 */
include_once ("AccesoDatos.php");
class Roles
{
    private $oAD = null;
    private $nIdRol = 0;
    private $sDescripcion ="";
    
    
    public function getAD()
    {
        return $this->oAD;
    }
    
    public function setAD($oAD)
    {
        $this->oAD = $oAD;
    }
    
    public function getIdRol()
    {
        return $this->nIdRol;
    }
    
    public function setIdRol($nIdRol)
    {
        $this->nIdRol = $nIdRol;
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
        $sQuery = "";
        $i = 0;
        $oRol = null;
        if($oAD->Conecta()){
            $sQuery = "call buscarTodosRoles();";
            $rst = $oAD->ejecutaQuery($sQuery);
            $oAD->Desconecta();
        }
        if($rst){
            foreach ($rst as $vRowTemp){
                $oRol = new Roles();
                $oRol->setIdRol($vRowTemp[0]);
                $oRol->setDescripcion($vRowTemp[1]);
                $vObj[$i] = $oRol;
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
            $sQuery = "call insertaRol('".$usuario."','".$this->getDescripcion()."');";
            $i = $oAD->ejecutaComando($sQuery);
            $oAD->Desconecta();
        }
        return $i;
    }


    function buscarRol($usuario){
        $oAD = new AccesoDatos();
        $rst = null;
        $vObj = null;
        $oNota = null;
        $sQuery = "";
        $i = 0;
        if ($oAD->Conecta()) {
            $sQuery = "call BuscarRol('".$usuario."');";
            $rst = $oAD->ejecutaQuery($sQuery);
            $oAD->Desconecta();
        }
        if ($rst) {
            $this->setIdRol($rst[0][0]);
            $bRet=true;
        }
        return $bRet;
    }


    
}