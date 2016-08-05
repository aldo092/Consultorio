<?php

/**
 * Created by PhpStorm.
 * User: Pablo
 * Date: 03/08/2016
 * Time: 07:23 PM
 */
include_once ("AccesoDatos.php");
class Aseguradora
{
    private $oAD = null;
    private $nIdAseguradora=0;
    private $sNombre="";
    private $sDireccion="";
    private $sTelefono="";
    

    public function getAD()
    {
        return $this->oAD;
    }

    public function setAD($oAD)
    {
        $this->oAD = $oAD;
    }
    
    public function getIdAseguradora()
    {
        return $this->nIdAseguradora;
    }

    public function setIdAseguradora($nIdAseguradora)
    {
        $this->nIdAseguradora = $nIdAseguradora;
    }

    public function getNombre()
    {
        return $this->sNombre;
    }

    public function setNombre($sNombre)
    {
        $this->sNombre = $sNombre;
    }

    public function getDireccion()
    {
        return $this->sDireccion;
    }

    public function setDireccion($sDireccion)
    {
        $this->sDireccion = $sDireccion;
    }

    public function getTelefono()
    {
        return $this->sTelefono;
    }

    public function setTelefono($sTelefono)
    {
        $this->sTelefono = $sTelefono;
    }

    function buscarTodos(){
        $oAD = new AccesoDatos();
        $vObj = null;
        $rst = null;
        $sQuery = "";
        $i = 0;
        $oAseg = null;
        if($oAD->Conecta()){
            $sQuery = "";
            $rst = $oAD->ejecutaQuery($sQuery);
        }
        if($rst){
            foreach ($rst as $vRowTemp){
                $oAseg = new Aseguradora();
                $oAseg->setIdAseguradora($vRowTemp[0]);
                $oAseg->setNombre($vRowTemp[1]);
                $oAseg->setDireccion($vRowTemp[2]);
                $oAseg->setTelefono($vRowTemp[3]);
                $vObj[$i] = $oAseg;
                $i = $i + 1;
            }
        }else{
            $vObj = false;
        }
        return $vObj;
    }

}