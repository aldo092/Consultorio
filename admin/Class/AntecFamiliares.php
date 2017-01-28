<?php

/**
 * Created by PhpStorm.
 * User: Pablo
 * Date: 03/08/2016
 * Time: 06:22 PM
 */
include_once ("AccesoDatos.php");
include_once ("Expediente.php");
include_once ("Paciente.php");
class AntecFamiliares
{
    private $oAD=null;

    private $oExpediente="";
    private $sAlcoholismo="";
    private $sAlergias="";
    private $sAsma="";
    private $sCancer="";
    private $sCongenitos="";
    private $sConvulsiones="";
    private $sDiabetes="";
    private $sHipertension="";
    private $sDrogradiccion="";
    private $sTabaquismo;
    private $sCardiopatias;
    private $sTuberculosis;
    private $sEpilepsia;
    private $sInsRenal;

    private $oPaciente = null;

    public function getPaciente()
    {
        return $this->oPaciente;
    }

    public function setPaciente($oPaciente)
    {
        $this->oPaciente = $oPaciente;
    }

    public function getAD()
    {
        return $this->oAD;
    }

    public function setAD($oAD)
    {
        $this->oAD = $oAD;
    }

    public function getExpediente()
    {
        return $this->oExpediente;
    }

    public function setExpediente($oExpediente)
    {
        $this->oExpediente = $oExpediente;
    }

    public function getAlcoholismo()
    {
        return $this->sAlcoholismo;
    }

    public function setAlcoholismo($sAlcoholismo)
    {
        $this->sAlcoholismo = $sAlcoholismo;
    }

    public function getAlergias()
    {
        return $this->sAlergias;
    }

    public function setAlergias($sAlergias)
    {
        $this->sAlergias = $sAlergias;
    }

    public function getAsma()
    {
        return $this->sAsma;
    }

    public function setAsma($sAsma)
    {
        $this->sAsma = $sAsma;
    }

    public function getCancer()
    {
        return $this->sCancer;
    }

    public function setCancer($sCancer)
    {
        $this->sCancer = $sCancer;
    }

    public function getCongenitos()
    {
        return $this->sCongenitos;
    }

    public function setCongenitos($sCongenitos)
    {
        $this->sCongenitos = $sCongenitos;
    }

    public function getConvulsiones()
    {
        return $this->sConvulsiones;
    }

    public function setConvulsiones($sConvulsiones)
    {
        $this->sConvulsiones = $sConvulsiones;
    }

    public function getDiabetes()
    {
        return $this->sDiabetes;
    }

    public function setDiabetes($sDiabetes)
    {
        $this->sDiabetes = $sDiabetes;
    }

    public function getHipertension()
    {
        return $this->sHipertension;
    }

    public function setHipertension($sHipertension)
    {
        $this->sHipertension = $sHipertension;
    }

    public function getDrogradiccion()
    {
        return $this->sDrogradiccion;
    }

    public function setDrogradiccion($sDrogradiccion)
    {
        $this->sDrogradiccion = $sDrogradiccion;
    }

    public function getTabaquismo()
    {
        return $this->sTabaquismo;
    }

    public function setTabaquismo($sTabaquismo)
    {
        $this->sTabaquismo = $sTabaquismo;
    }


    public function getSCardiopatias()
    {
        return $this->sCardiopatias;
    }


    public function setSCardiopatias($sCardiopatias)
    {
        $this->sCardiopatias = $sCardiopatias;
    }

    public function getSTuberculosis()
    {
        return $this->sTuberculosis;
    }

    public function setSTuberculosis($sTuberculosis)
    {
        $this->sTuberculosis = $sTuberculosis;
    }


    public function getSEpilepsia()
    {
        return $this->sEpilepsia;
    }

    public function setSEpilepsia($sEpilepsia)
    {
        $this->sEpilepsia = $sEpilepsia;
    }

    public function getSInsRenal()
    {
        return $this->sInsRenal;
    }


    public function setSInsRenal($sInsRenal)
    {
        $this->sInsRenal = $sInsRenal;
    }



    function buscarPorPaciente(){
        $oAD = new AccesoDatos();
        $oAntFam = null;
        $rst = null;
        $bRet = false;
        $sQuery = "";
        if($this->getPaciente()->getCurpPaciente() == ""){
            throw new Exception("AntecFamiliares->buscarPorPaciente(): error, faltan datos");
        }else{
            if($oAD->Conecta()){
                $sQuery = "";
                $rst = $oAD->ejecutaQuery($sQuery);
                if($rst) {
                    $oAntFam = new AntecFamiliares();
                    $oAntFam->setAlcoholismo($rst[0][0]);
                    $oAntFam->setAlergias($rst[0][1]);
                    $oAntFam->setAsma($rst[0][2]);
                    $oAntFam->setCancer($rst[0][3]);
                    $oAntFam->setCongenitos($rst[0][4]);
                    $oAntFam->setConvulsiones($rst[0][5]);
                    $oAntFam->setDiabetes($rst[0][6]);
                    $oAntFam->setHipertension($rst[0][7]);
                    $oAntFam->setDrogradiccion($rst[0][8]);
                    $oAntFam->setTabaquismo($rst[0][9]);
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
        if($this->getExpediente() == ""){
            throw new Exception("Paciente->insertar(): error, faltan datos");
        }else{
            if($oAD->Conecta()){
                $sQuery = "call insertarAntFam('".$usuario."',
                                                 '".$this->oExpediente."',
                                                  '".$this->sAlcoholismo."',
                                                  '".$this->sAlergias."',
                                                   '".$this->sAsma."',
                                                  '".$this->sCancer."',
                                                  '".$this->sCongenitos."',
                                                  '".$this->sConvulsiones."',
                                                  '".$this->sDiabetes."',
                                                  '".$this->sHipertension."',
                                                  '".$this->sDrogradiccion."',
                                                  '".$this->sTabaquismo."',
                                                  '".$this->sCardiopatias."',
                                                  '".$this->sTuberculosis."',
                                                  '".$this->sEpilepsia."',
                                                  '".$this->sInsRenal."');";
                $i = $oAD->ejecutaComando($sQuery);
                $oAD->Desconecta();
            }
        }
        return $i;
    }




        function ExisteAntFam($expediente){
            $oAD = new AccesoDatos();
            $sQuery = "";
            $rst = null;
            $bRet = false;
            if($expediente==""){
                throw new Exception("Usuarios->buscarAntFam(): error ,faltan expediente");
            }else{
                if($oAD->Conecta()){
                    $sQuery = "call ExisteAntFam('".$expediente."');";
                    $rst = $oAD->ejecutaQuery($sQuery);
                    $oAD->Desconecta();
                    if($rst){
                        $this->setExpediente($rst[0][0]);
                        $bRet = true;
                    }
                }
            }
            return $bRet;
        }

    }