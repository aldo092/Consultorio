<?php

/**
 * Created by PhpStorm.
 * User: Pablo
 * Date: 03/08/2016
 * Time: 02:06 PM
 */
include_once ("AccesoDatos.php");
include_once ("Expediente.php");
include_once ("Paciente.php");
class AntePatologicos
{
    private $oAD = null;
    private $oExpediente = null;
    private $sAlergias="";
    private $sCardiopatias="";
    private $sTransfusiones="";
    private $sDiabetico="";
    private $sCardiovasculares="";
    private $sHTA="";
    Private	$sFracturas="";
    Private	$sReumaticas="";
    Private	$sRinitis="";
    Private	$sAsma="";
    Private	$Sconvulsiones="";
    Private	$sMigrañas ="";
    Private	$sPsiquiatricos="";
    Private	$sTB="";
    Private	$sEVC="";
    Private	$sDermatosis="";
    Private	$sAudicion="";
    Private	$sVision="";
    Private	$sEnfArt="";
    Private	$sVarices="";
    Private	$sUlceras="";
    Private	$sApendicits="";
    Private	$sProstata="";
    Private	$sUrinarias="";
    Private	$sAcidoPep="";
    Private	$sSanDig="";
    Private	$sHepatitis="";
    Private	$sHernias="";
    Private	$sColitis="";
    Private	$sColecis="";
    Private	$sPatAnal="";
    Private	$sInternamientos="";
    Private	$sCirujias="";
    Private $Cancer="";
    Private $Obesidad="";

    private $oPaciente;


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
    
    public function getAlergias()
    {
        return $this->sAlergias;
    }

    public function setAlergias($sAlergias)
    {
        $this->sAlergias = $sAlergias;
    }

    public function getCardiopatias()
    {
        return $this->sCardiopatias;
    }

    public function setCardiopatias($sCardiopatias)
    {
        $this->sCardiopatias = $sCardiopatias;
    }

    public function getTransfusiones()
    {
        return $this->sTransfusiones;
    }

    public function setTransfusiones($sTransfusiones)
    {
        $this->sTransfusiones = $sTransfusiones;
    }

    public function getDiabetico()
    {
        return $this->sDiabetico;
    }

    public function setDiabetico($sDiabetico)
    {
        $this->sDiabetico = $sDiabetico;
    }

    public function getCardiovasculares()
    {
        return $this->sCardiovasculares;
    }

    public function setCardiovasculares($sCardiovasculares)
    {
        $this->sCardiovasculares = $sCardiovasculares;
    }

    public function getHTA()
    {
        return $this->sHTA;
    }

    public function setHTA($sHTA)
    {
        $this->sHTA = $sHTA;
    }

    public function getSFracturas()
    {
        return $this->sFracturas;
    }

    public function setSFracturas($sFracturas)
    {
        $this->sFracturas = $sFracturas;
    }

    public function getSReumaticas()
    {
        return $this->sReumaticas;
    }

    public function setSReumaticas($sReumaticas)
    {
        $this->sReumaticas = $sReumaticas;
    }


    public function getSRinitis()
    {
        return $this->sRinitis;
    }

    public function setSRinitis($sRinitis)
    {
        $this->sRinitis = $sRinitis;
    }

    public function getSAsma()
    {
        return $this->sAsma;
    }

    public function setSAsma($sAsma)
    {
        $this->sAsma = $sAsma;
    }
    public function getSconvulsiones()
    {
        return $this->Sconvulsiones;
    }

    public function setSconvulsiones($Sconvulsiones)
    {
        $this->Sconvulsiones = $Sconvulsiones;
    }

    public function getSMigrañas()
    {
        return $this->sMigrañas;
    }

    public function setSMigrañas($sMigrañas)
    {
        $this->sMigrañas = $sMigrañas;
    }

    public function getSPsiquiatricos()
    {
        return $this->sPsiquiatricos;
    }

    public function setSPsiquiatricos($sPsiquiatricos)
    {
        $this->sPsiquiatricos = $sPsiquiatricos;
    }

    public function getSTB()
    {
        return $this->sTB;
    }

    public function setSTB($sTB)
    {
        $this->sTB = $sTB;
    }

    public function getSEVC()
    {
        return $this->sEVC;
    }

    public function setSEVC($sEVC)
    {
        $this->sEVC = $sEVC;
    }

    public function getSDermatosis()
    {
        return $this->sDermatosis;
    }

    public function setSDermatosis($sDermatosis)
    {
        $this->sDermatosis = $sDermatosis;
    }

    public function getSAudicion()
    {
        return $this->sAudicion;
    }

    public function setSAudicion($sAudicion)
    {
        $this->sAudicion = $sAudicion;
    }

    public function getSVision()
    {
        return $this->sVision;
    }

    public function setSVision($sVision)
    {
        $this->sVision = $sVision;
    }

    public function getSEnfArt()
    {
        return $this->sEnfArt;
    }

    public function setSEnfArt($sEnfArt)
    {
        $this->sEnfArt = $sEnfArt;
    }

    public function getSVarices()
    {
        return $this->sVarices;
    }

    public function setSVarices($sVarices)
    {
        $this->sVarices = $sVarices;
    }

    public function getSUlceras()
    {
        return $this->sUlceras;
    }

    public function setSUlceras($sUlceras)
    {
        $this->sUlceras = $sUlceras;
    }

    public function getSApendicits()
    {
        return $this->sApendicits;
    }
    public function setSApendicits($sApendicits)
    {
        $this->sApendicits = $sApendicits;
    }

    public function getSProstata()
    {
        return $this->sProstata;
    }

    public function setSProstata($sProstata)
    {
        $this->sProstata = $sProstata;
    }

    public function getSUrinarias()
    {
        return $this->sUrinarias;
    }

    public function setSUrinarias($sUrinarias)
    {
        $this->sUrinarias = $sUrinarias;
    }

    public function getSAcidoPep()
    {
        return $this->sAcidoPep;
    }

    public function setSAcidoPep($sAcidoPep)
    {
        $this->sAcidoPep = $sAcidoPep;
    }

    public function getSSanDig()
    {
        return $this->sSanDig;
    }

    public function setSSanDig($sSanDig)
    {
        $this->sSanDig = $sSanDig;
    }
    public function getSHepatitis()
    {
        return $this->sHepatitis;
    }

    public function setSHepatitis($sHepatitis)
    {
        $this->sHepatitis = $sHepatitis;
    }

    public function getSHernias()
    {
        return $this->sHernias;
    }

    public function setSHernias($sHernias)
    {
        $this->sHernias = $sHernias;
    }

    public function getSColitis()
    {
        return $this->sColitis;
    }

    public function setSColitis($sColitis)
    {
        $this->sColitis = $sColitis;
    }

    public function getSColecis()
    {
        return $this->sColecis;
    }

    public function setSColecis($sColecis)
    {
        $this->sColecis = $sColecis;
    }

    public function getSPatAnal()
    {
        return $this->sPatAnal;
    }

    public function setSPatAnal($sPatAnal)
    {
        $this->sPatAnal = $sPatAnal;
    }

    public function getSInternamientos()
    {
        return $this->sInternamientos;
    }

    public function setSInternamientos($sInternamientos)
    {
        $this->sInternamientos = $sInternamientos;
    }

    public function getSCirujias()
    {
        return $this->sCirujias;
    }

    public function setSCirujias($sCirujias)
    {
        $this->sCirujias = $sCirujias;
    }

    public function getCancer()
    {
        return $this->Cancer;
    }

    public function setCancer($Cancer)
    {
        $this->Cancer = $Cancer;
    }

    public function getObesidad()
    {
        return $this->Obesidad;
    }

    public function setObesidad($Obesidad)
    {
        $this->Obesidad = $Obesidad;
    }




    function buscarPorPaciente(){
        $oAD = new AccesoDatos();
        $rst = null;
        $oPat = null;
        $sQuery = "";
        if($this->getPaciente()->getCurpPaciente() == ""){
            throw new Exception("AntePatologicos->buscarPorPaciente(): error, faltan datos");
        }else{
            if($oAD->Conecta()){
                $sQuery = "";
                $rst = $oAD->ejecutaQuery($sQuery);
                $oAD->Desconecta();
                if($rst){
                    $this->setAlergias($rst[0][0]);
                    $this->setCardiopatias($rst[0][1]);
                    $this->setTransfusiones($rst[0][2]);
                    $this->setDiabetico($rst[0][3]);
                    $this->setCardiovasculares($rst[0][4]);
                    $this->setHTA($rst[0][5]);
                    $bRet=true;
                }
            }
        }
        return $bRet;
    }

    function insertar($usuario){
        $oAD = new AccesoDatos();
        $sQuery = "";
        $i = -1;
        if($this->getExpediente() == ""){
            throw new Exception("Paciente->insertar(): error, faltan datos");
        }else{
            if($oAD->Conecta()){
                $sQuery = "call insertarAntPat('".$usuario."',
                                                 '".$this->oExpediente."',
                                                 '".$this->sAlergias."',
                                                 '".$this->sCardiopatias."',
                                                  '".$this->sTransfusiones."',
                                                  '".$this->sDiabetico."',
                                                  '".$this->sCardiovasculares."',
                                                  '".$this->sHTA."',
                                                  '".$this->sFracturas."',
                                                  '".$this->sReumaticas."',
                                                  '".$this->sRinitis."',
                                                  '".$this->sAsma."',
                                                  '".$this->Sconvulsiones."',
                                                  '".$this->sMigrañas."',
                                                  '".$this->sPsiquiatricos."',
                                                  '".$this->sTB."',
                                                  '".$this->sEVC."',
                                                  '".$this->sDermatosis."',
                                                  '".$this->sAudicion."',
                                                  '".$this->sVision."',
                                                  '".$this->sEnfArt."',
                                                  '".$this->sVarices."',
                                                  '".$this->sUlceras."',
                                                  '".$this->sApendicits."',
                                                  '".$this->sProstata."',
                                                  '".$this->sUrinarias."',
                                                  '".$this->sAcidoPep."',
                                                  '".$this->sSanDig."',
                                                  '".$this->sHepatitis."',
                                                  '".$this->sHernias."',
                                                  '".$this->sColitis."',
                                                  '".$this->sColecis."',
                                                  '".$this->sPatAnal."',
                                                  '".$this->sInternamientos."',
                                                  '".$this->sCirujias."',
                                                  '".$this->Obesidad."',
                                                  '".$this->Cancer."');";
                $i = $oAD->ejecutaComando($sQuery);
                $oAD->Desconecta();
            }
        }
        return $i;
        }

    function ExisteAntPat($expediente){
        $oAD = new AccesoDatos();
        $sQuery = "";
        $rst = null;
        $bRet = false;
        if($expediente==""){
            throw new Exception("Usuarios->buscarAPat(): error ,faltan expediente");
        }else{
            if($oAD->Conecta()){
                $sQuery = "call ExisteAntPat('".$expediente."');";
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