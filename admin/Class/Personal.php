<?php

/**
 * Created by PhpStorm.
 * User: Pablo
 * Date: 03/08/2016
 * Time: 07:31 PM
 */
include_once ("AccesoDatos.php");
include_once ("Roles.php");
include_once ("Medico.php");
include_once ("Usuarios.php");
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
    private $bEstatus=0;
    private $oRol = null;
    private $sEmail = "";
    private $sImagen = "";
    private $oMedico = null;
    private $oUsuario = null;


    public function getUsuario()
    {
        return $this->oUsuario;
    }

    public function setUsuario($oUsuario)
    {
        $this->oUsuario = $oUsuario;
    }
    
    public function getMedico()
    {
        return $this->oMedico;
    }
    
    public function setMedico($oMedico)
    {
        $this->oMedico = $oMedico;
    }
    
    public function getImagen()
    {
        return $this->sImagen;
    }

    public function setImagen($sImagen)
    {
        $this->sImagen = $sImagen;
    }

    public function getEmail()
    {
        return $this->sEmail;
    }

    public function setEmail($sEmail)
    {
        $this->sEmail = $sEmail;
    }

    public function getRol()
    {
        return $this->oRol;
    }

    public function setRol($oRol)
    {
        $this->oRol = $oRol;
    }

    public function getEstatus()
    {
        return $this->bEstatus;
    }

    public function setEstatus($bEstatus)
    {
        $this->bEstatus = $bEstatus;
    }

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
                $oPer->setRol(new Roles());
                $oPer->setIdPersonal($vRowTemp[0]);
                $oPer->setNombres($vRowTemp[1]);
                $oPer->setApPaterno($vRowTemp[2]);
                $oPer->setApMaterno($vRowTemp[3]);
                $oPer->setTelefono($vRowTemp[4]);
                $oPer->setSexo($vRowTemp[5]);
                $oPer->setCURP($vRowTemp[6]);
                $oPer->setEmail($vRowTemp[7]);
                $oPer->setEstatus($vRowTemp[8]);
                $oPer->getRol()->setDescripcion($vRowTemp[9]);
                $vObj[$i] = $oPer;
                $i = $i + 1;
            }
        }else{
            $vObj = false;
        }
        return $vObj;
    }

    function buscarDatosPorPersona(){
        $oAD = new AccesoDatos();
        $sQuery = "";
        $bRet = false;
        $rst = null;
        if($this->getIdPersonal() == 0){
            throw new Exception("Personal->buscarDatosPorPersona(): error, faltan datos");
        }else{
            if($oAD->Conecta()){
                $sQuery = "call buscaDatosPersona(".$this->getIdPersonal().");";
                $rst = $oAD->ejecutaQuery($sQuery);
                $oAD->Desconecta();
                if($rst){
                    $oMedico = new Medico();
                    $this->setRol(new Roles());
                    $this->setIdPersonal($rst[0][0]);
                    $this->setNombres($rst[0][1]);
                    $this->setApPaterno($rst[0][2]);
                    $this->setApMaterno($rst[0][3]);
                    $this->setTelefono($rst[0][4]);
                    $this->setSexo($rst[0][5]);
                    $this->setCURP($rst[0][6]);
                    $this->setEmail($rst[0][7]);
                    $this->setEstatus($rst[0][8]);
                    $this->getRol()->setDescripcion($rst[0][9]);
                    $this->setImagen($rst[0][10]);
                    $this->getRol()->setIdRol($rst[0][11]);
                    $this->setMedico($oMedico->buscarDatosMedico($this->getIdPersonal()));
                    $bRet = true;
                }
            }
        }
        return $bRet;
    }

    function buscarDatosPorPersona2(){
        $oAD = new AccesoDatos();
        $sQuery = "";
        $bRet = false;
        $rst = null;
        if($this->getIdPersonal() == 0){
            throw new Exception("Personal->buscarDatosPorPersona(): error, faltan datos");
        }else{
            if($oAD->Conecta()){
                $sQuery = "call buscaDatosPersona(".$this->getIdPersonal().");";
                $rst = $oAD->ejecutaQuery($sQuery);
                $oAD->Desconecta();
                if($rst){
                    $oMedico = new Medico();
                    $this->setRol(new Roles());
                    $this->setIdPersonal($rst[0][0]);
                    $this->setNombres($rst[0][1]);
                    $this->setApPaterno($rst[0][2]);
                    $this->setApMaterno($rst[0][3]);
                    $this->setTelefono($rst[0][4]);
                    $this->setSexo($rst[0][5]);
                    $this->setCURP($rst[0][6]);
                    $this->setEmail($rst[0][7]);
                    $this->setEstatus($rst[0][8]);
                    $this->getRol()->setDescripcion($rst[0][9]);
                    $this->setImagen($rst[0][10]);
                    $this->getRol()->setIdRol($rst[0][11]);
                    $bRet = true;
                }
            }
        }
        return $bRet;
    }

    function insertarPersonal($usuario){
        $oAD = new AccesoDatos();
        $sQuery = "";
        $i = -1;
        if($oAD->Conecta()){
            $sQuery = "call insertarPersonal('".$usuario."','".$this->getNombres()."',
            '".$this->getApPaterno()."','".$this->getApMaterno()."','".$this->getTelefono()."',
            '".$this->getSexo()."','".$this->getCURP()."',".$this->getRol()->getIdRol().",
            '".$this->getEmail()."','".$this->getUsuario()->getPassword()."','".$this->getImagen()."');";
            $i = $oAD->ejecutaComando($sQuery);
            $oAD->Desconecta();
        }
        return $i;
    }

    function modificarPersonalyPass($usuario){
        $oAD = new AccesoDatos();
        $sQuery = "";
        $i = -1;
        if($this->getIdPersonal() == 0){
            throw new Exception("Personal->modificarPersonal(): error, faltan datos");
        }else{
            if($oAD->Conecta()){
                $sQuery = "call modificaPersonal1('".$usuario."',".$this->getIdPersonal().", '".$this->getNombres()."',
                '".$this->getApPaterno()."','".$this->getApMaterno()."','".$this->getTelefono()."',
                '".$this->getUsuario()->getPassword()."',".$this->getEstatus().");";
                $i = $oAD->ejecutaComando($sQuery);
                $oAD->Desconecta();
            }
        }
        return $i;
    }

    function insertaPersonalMedico($usuario){
        $oAD = new AccesoDatos();
        $sQuery = "";
        $i = -1;
        if($oAD->Conecta()){
            $sQuery = "call insertaPersonalMedico('".$usuario."', '".$this->getNombres()."', '".$this->getApPaterno()."',
            '".$this->getApMaterno()."','".$this->getTelefono()."','".$this->getSexo()."','".$this->getCURP()."',
            ".$this->getRol()->getIdRol().", '".$this->getEmail()."','".$this->getUsuario()->getPassword()."',
            '".$this->getMedico()->getNumCedula()."','".$this->getMedico()->getFechaExpedicionCed()."',
            '".$this->getMedico()->getNumCedEsp()."','".$this->getMedico()->getFecExpedCedEsp()."',
            '".$this->getMedico()->getNumTelefono1()."',".$this->getMedico()->getEspecialidad()->getIdEspecialidad().",'".$this->getImagen()."');";
            $i = $oAD->ejecutaComando($sQuery);
            $oAD->Desconecta();
        }
        return $i;

    }

    function modificaPersonal($usuario){
        $oAD = new AccesoDatos();
        $sQuery = "";
        $i = -1;
        if($this->getIdPersonal() == 0){
            throw new Exception("Personal->modificaPersonalyPass(): error, faltan datos");
        }else{
            if($oAD->Conecta()){
                $sQuery = "call modificaPersonal2('".$usuario."',".$this->getIdPersonal().",'".$this->getNombres()."','".$this->getApPaterno()."',
                '".$this->getApMaterno()."','".$this->getTelefono()."',".$this->getEstatus().");";
                $i = $oAD->ejecutaComando($sQuery);
                $oAD->Desconecta();
            }
        }
        return $i;
    }

    function modificaPersonalMedicoyPass($usuario){
        $oAD = new AccesoDatos();
        $sQuery = "";
        $i = -1;
        if($this->getIdPersonal() == 0){
            throw new Exception("Personal->modificaPersonalMedicoyPass(): error, faltan datos");
        }else{
            if($oAD->Conecta()){
                $sQuery = "call modificarPersonalMedico1('".$usuario."','".$this->getIdPersonal()."','".$this->getNombres()."','".$this->getApPaterno()."',
                '".$this->getApMaterno()."','".$this->getTelefono()."','".$this->getUsuario()->getPassword()."','".$this->getMedico()->getNumCedula()."',
                '".$this->getMedico()->getNumCedEsp()."','".$this->getMedico()->getNumTelefono1()."',".$this->getEstatus().");";
                $i = $oAD->ejecutaComando($sQuery);
                $oAD->Desconecta();
            }
        }
        return $i;
    }

    function modificaPersonalMedico($usuario){
        $oAD = new AccesoDatos();
        $sQuery = "";
        $i = -1;
        if($this->getIdPersonal() == 0){
            throw new Exception("Personal->modificaPersonalMedico(): error, faltan datos");
        }else{
            if($oAD->Conecta()){
                $sQuery = "call modificarPersonalMedico2('".$usuario."','".$this->getIdPersonal()."','".$this->getNombres()."','".$this->getApPaterno()."',
                '".$this->getApMaterno()."','".$this->getTelefono()."','".$this->getMedico()->getNumCedula()."','".$this->getMedico()->getNumCedEsp()."',
                '".$this->getMedico()->getNumTelefono1()."',".$this->getEstatus().")";
                $i = $oAD->ejecutaComando($sQuery);
                $oAD->Desconecta();
            }
        }
        return $i;
    }

    function buscarMedicos(){
        $oAD = new AccesoDatos();
        $vObj = null;
        $rst = null;
        $sQuery = "";
        $i = 0;
        $oPer= null;
        if($oAD->Conecta()){
            $sQuery = "call buscarMedicoEspecialidad();";
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
                $vObj[$i] = $oPer;
                $i = $i + 1;
            }
        }else{
            $vObj = false;
        }
        return $vObj;
    }




}
