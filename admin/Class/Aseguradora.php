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
            $sQuery = "call buscarAseguradora()";
            $rst = $oAD->ejecutaQuery($sQuery);
        }
        if($rst){
            foreach ($rst as $vRowTemp){
                $oAseg = new Aseguradora();
                $oAseg->setIdAseguradora($vRowTemp[0]);
                $oAseg->setNombre($vRowTemp[1]);

                $vObj[$i] = $oAseg;
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
        if($this->getNombre() == ""){
            throw new Exception("Paciente->insertar(): error, faltan datos");
        }else{
            if($oAD->Conecta()){
                $sQuery = "call insertarAseguradora('".$usuario."',
                                                 '".$this->sNombre."',
                                                 '".$this->sTelefono."',
                                                  '".$this->sDireccion."');";
                $i = $oAD->ejecutaComando($sQuery);
                $oAD->Desconecta();
            }
        }
        return $i;
    }


}