<?php

/**
 * Created by PhpStorm.
 * User: Pablo
 * Date: 03/08/2016
 * Time: 01:40 PM
 */
include_once ("AccesoDatos.php");
include_once ("Expediente.php");
class Paciente
{
    private $oAD = null;
    private $sCurpPaciente="";
    private $sNombre="";
    private $sApPaterno="";
    private $sApMaterno="";
    private $dFechaNacimiento="";
    private $sTelefono="";
    private $sDireccion="";
    private $sCP="";
    private $bEstadoCivil;
    private $oExpediente;
    private $sSexo="";
    private $cCorreo="";


    public function getExpediente()
    {
        return $this->oExpediente;
    }

    public function setExpediente($oExpediente)
    {
        $this->oExpediente = $oExpediente;
    }

    public function getAD()
    {
        return $this->oAD;
    }

    public function setAD($oAD)
    {
        $this->oAD = $oAD;
    }

    public function getCurpPaciente()
    {
        return $this->sCurpPaciente;
    }

    public function setCurpPaciente($sCurpPaciente)
    {
        $this->sCurpPaciente = $sCurpPaciente;
        return $this;
    }

    public function getNombre()
    {
        return $this->sNombre;
    }

    public function setNombre($sNombre)
    {
        $this->sNombre = $sNombre;
        return $this;
    }

    public function getApPaterno()
    {
        return $this->sApPaterno;
    }

    public function setApPaterno($sApPaterno)
    {
        $this->sApPaterno = $sApPaterno;
        return $this;
    }

    public function getApMaterno()
    {
        return $this->sApMaterno;
    }

    public function setApMaterno($sApMaterno)
    {
        $this->sApMaterno = $sApMaterno;
        return $this;
    }

    public function getFechaNacimiento()
    {
        return $this->dFechaNacimiento;
    }

    public function setFechaNacimiento($dFechaNacimiento)
    {
        $this->dFechaNacimiento = $dFechaNacimiento;
        return $this;
    }

    public function getTelefono()
    {
        return $this->sTelefono;
    }

    public function setTelefono($sTelefono)
    {
        $this->sTelefono = $sTelefono;
        return $this;
    }

    public function getDireccion()
    {
        return $this->sDireccion;
    }

    public function setDireccion($sDireccion)
    {
        $this->sDireccion = $sDireccion;
        return $this;
    }

    public function getCP()
    {
        return $this->sCP;
    }

    public function setCP($sCP)
    {
        $this->sCP = $sCP;
        return $this;
    }

    public function getEstadoCivil()
    {
        return $this->bEstadoCivil;
    }

    public function setEstadoCivil($bEstadoCivil)
    {
        $this->bEstadoCivil = $bEstadoCivil;
        return $this;
    }

    public function getSexo()
    {
      return $this->sSexo;
    }

    public function setSexo($sSexo)
    {
        $this->sSexo=$sSexo;
        return $this;
    }

    public function getCorreo()
    {
        return $this->cCorreo;
    }

    public function setCorreo($cCorreo)
    {
        $this->cCorreo=$cCorreo;
        return $this;
    }




    function buscarTodos(){
        $oAD = new AccesoDatos();
        $vObj = null;
        $rst = null;
        $sQuery = "";
        $i = 0;
        $oPac = null;
        if($oAD->Conecta()){
            $sQuery = "call buscarTodosPacientes();";
            $rst = $oAD->ejecutaQuery($sQuery);
            $oAD->Desconecta();
        }
        if($rst){
            foreach ($rst as $vRowTemp){
                $oPac = new Paciente();
                $oPac->setExpediente(new Expediente());
                $oPac->setCurpPaciente($vRowTemp[0]);
                $oPac->setNombre($vRowTemp[1]);
                $oPac->setApPaterno($vRowTemp[2]);
                $oPac->setApMaterno($vRowTemp[3]);
                $oPac->setFechaNacimiento($vRowTemp[4]);
                $oPac->setTelefono($vRowTemp[5]);
                $oPac->setDireccion($vRowTemp[6]);
                $oPac->setCP($vRowTemp[7]);
                $oPac->setEstadoCivil($vRowTemp[8]);
                $oPac->getExpediente()->setNumero($vRowTemp[9]);
                $vObj[$i]=$oPac;
                $i = $i + 1;
            }
        }else{
            $vObj = false;
        }
        return $vObj;
    }

    function buscarPacientePorCurp(){
        $oAD = new AccesoDatos();
        $rst = null;
        $sQuery = "";
        $bRet = false;
        if($this->getCurpPaciente() == ""){
            throw new Exception("Paciente->buscarPacientePorCurp(): error, faltan datos");
        }else{
            if($oAD->Conecta()){
                $sQuery = "call buscarPacientePorCurp('".$this->getCurpPaciente()."');";
                $rst = $oAD->ejecutaQuery($sQuery);
                $oAD->Desconecta();
                if($rst){
                    $this->setExpediente(new Expediente());
                    $this->setCurpPaciente($rst[0][0]);
                    $this->setNombre($rst[0][1]);
                    $this->setApPaterno($rst[0][2]);
                    $this->setApMaterno($rst[0][3]);
                    $this->setFechaNacimiento($rst[0][4]);
                    $this->setTelefono($rst[0][5]);
                    $this->setDireccion($rst[0][6]);
                    $this->setCP($rst[0][7]);
                    $this->setEstadoCivil($rst[0][8]);
                    $this->getExpediente()->setNumero($rst[0][9]);
                    $bRet = true;
                }
            }
        }
        return $bRet;
    }

    function insertar($usuario){
        $oAD = new AccesoDatos();
        $sQuery = "";
        $i = 0;
        if($this->getCurpPaciente() == ""){
            throw new Exception("Paciente->insertar(): error, faltan datos");
        }else{
            if($oAD->Conecta()){
                $sQuery = "call insertarPaciente('aldo092@gmail.com',
                                                 '".$this->sCurpPaciente."',
                                                 '".$this->sNombre."',
                                                 '".$this->sApPaterno."',
                                                  '".$this->sApMaterno."',
                                                  '".$this->sSexo."',
                                                  '".$this->dFechaNacimiento."',
                                                  '".$this->sTelefono."',
                                                  '".$this->sDireccion."',
                                                  '".$this->sCP."',
                                                  '".$this->cCorreo."',
                                                  '".$this->bEstadoCivil."');";
                $i = $oAD->ejecutaComando($sQuery);
                $oAD->Desconecta();
            }
        }
        return $i;
    }





}