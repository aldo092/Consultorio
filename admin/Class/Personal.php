<?php

/**
 * Created by PhpStorm.
 * User: Pablo
 * Date: 03/08/2016
 * Time: 07:31 PM
 */
include_once ("AccesoDatos.php");
class Personal
{
    private $oAD = null;
    private $nIdPersonal=0;
    private $sNombres="";
    private $sApPaterno="";
    private $sApMaterno="";
    private $sTelefono="";
    private $sPuesto="";
    private $sSexo="";
    private $sCURP="";


    public function getAD()
    {
        return $this->oAD;
    }
    
    public function setAD($oAD)
    {
        $this->oAD = $oAD;
    }

    public function getIdPersonal()
    {
        return $this->nIdPersonal;
    }

    public function setIdPersonal($nIdPersonal)
    {
        $this->nIdPersonal = $nIdPersonal;
    }

    public function getNombres()
    {
        return $this->sNombres;
    }

    public function setNombres($sNombres)
    {
        $this->sNombres = $sNombres;
    }

    public function getApPaterno()
    {
        return $this->sApPaterno;
    }

    public function setApPaterno($sApPaterno)
    {
        $this->sApPaterno = $sApPaterno;
    }

    public function getApMaterno()
    {
        return $this->sApMaterno;
    }

    public function setApMaterno($sApMaterno)
    {
        $this->sApMaterno = $sApMaterno;
    }

    public function getTelefono()
    {
        return $this->sTelefono;
    }

    public function setTelefono($sTelefono)
    {
        $this->sTelefono = $sTelefono;
    }

    public function getPuesto()
    {
        return $this->sPuesto;
    }

    public function setPuesto($sPuesto)
    {
        $this->sPuesto = $sPuesto;
    }

    public function getSexo()
    {
        return $this->sSexo;
    }

    public function setSexo($sSexo)
    {
        $this->sSexo = $sSexo;
    }

    public function getCURP()
    {
        return $this->sCURP;
    }

    public function setCURP($sCURP)
    {
        $this->sCURP = $sCURP;
    }

    function buscarTodos(){
        $oAD = new AccesoDatos();
        $vObj = null;
        $rst = null;
        $sQuery = "";
        $oPer = null;
        $i = 0;
        if($oAD->Conecta()){
            $sQuery = "call buscarTodosPersonal();";
            $rst = $oAD->ejecutaQuery($sQuery);
            $oAD->Desconecta();
        }
        if($rst){
            foreach ($rst as $vRowTemp){
                $oPer = new Personal();
                $oPer->setIdPersonal($vRowTemp[0]);
                $oPer->setNombres($vRowTemp[1]);
                $oPer->setApPaterno($vRowTemp[2]);
                $oPer->setApMaterno($vRowTemp[3]);
                $oPer->setTelefono($vRowTemp[4]);
                $oPer->setPuesto($vRowTemp[5]);
                $oPer->setSexo($vRowTemp[6]);
                $oPer->setCURP($vRowTemp[7]);
                $vObj[$i] = $oPer;
                $i = $i + 1;
            }
        }else{
            $vObj = false;
        }
        return $vObj;
    }

    function insertarPersonal($usuario){
        $oAD = new AccesoDatos();
        $sQuery = "";
        $i = -1;
        if($oAD->Conecta()){
            $sQuery = "call insertaPersonal('".$usuario."','".$this->getNombres()."',
            '".$this->getApPaterno()."','".$this->getApMaterno()."','".$this->getTelefono()."',
            '".$this->getPuesto()."','".$this->getSexo()."','".$this->getCURP()."');";
            $i = $oAD->ejecutaComando($sQuery);
            $oAD->Desconecta();
        }
        return $i;
    }

    function modificarPersonal($usuario){
        $oAD = new AccesoDatos();
        $sQuery = "";
        $i = -1;
        if($this->getIdPersonal() == 0){
            throw new Exception("Personal->modificarPersonal(): error, faltan datos");
        }else{
            if($oAD->Conecta()){
                $sQuery = "call modificarPersonal('".$usuario."',".$this->getIdPersonal().", '".$this->getNombres()."',
                '".$this->getApPaterno()."','".$this->getApMaterno()."','".$this->getTelefono()."',
                '".$this->getPuesto()."','".$this->getSexo()."','".$this->getCURP()."');";
                $i = $oAD->ejecutaComando($sQuery);
                $oAD->Desconecta();
            }
        }
        return $i;
    }

}