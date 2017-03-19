<?php

/**
 * Created by PhpStorm.
 * User: Pablo
 * Date: 20/09/2016
 * Time: 05:16 PM
 */
include_once ("AccesoDatos.php");
include_once ("Paciente.php");
include_once ("Estudios.php");
include_once ("Medico.php");
include_once ("EstImagen.php");
include_once ("EstLaboratorio.php");
include_once ("NotaMedica.php");
include_once ("ReciboCobro.php");
class EstudioRealizado
{
    private $oAD = null;
    private $oEstudios = null;
    private $oPaciente = null;
    private $oMedico = null;
    private $sDiagnostica = "";
    private $dFechaRealizado = null;
    private $sRutaArchivo = "";
    private $oEstImagen = null;
    private $oEstLab = null;
    private $oNota = null;
    private $nIdEstReal = 0;
    private $oRecibo = null;


    public function getRecibo()
    {
        return $this->oRecibo;
    }

    public function setRecibo($oRecibo)
    {
        $this->oRecibo = $oRecibo;
    }

    public function getIdEstReal()
    {
        return $this->nIdEstReal;
    }

    public function setIdEstReal($nIdEstReal)
    {
        $this->nIdEstReal = $nIdEstReal;
    }

    public function getNota()
    {
        return $this->oNota;
    }

    public function setNota($oNota)
    {
        $this->oNota = $oNota;
    }

    public function getEstImagen()
    {
        return $this->oEstImagen;
    }

    public function setEstImagen($oEstImagen)
    {
        $this->oEstImagen = $oEstImagen;
    }

    public function getEstLab()
    {
        return $this->oEstLab;
    }

    public function setEstLab($oEstLab)
    {
        $this->oEstLab = $oEstLab;
    }

    public function getAD()
    {
        return $this->oAD;
    }

    public function setAD($oAD)
    {
        $this->oAD = $oAD;
    }

    public function getEstudios()
    {
        return $this->oEstudios;
    }

    public function setEstudios($oEstudios)
    {
        $this->oEstudios = $oEstudios;
    }

    public function getPaciente()
    {
        return $this->oPaciente;
    }

    public function setPaciente($oPaciente)
    {
        $this->oPaciente = $oPaciente;
    }

    public function getMedico()
    {
        return $this->oMedico;
    }

    public function setMedico($oMedico)
    {
        $this->oMedico = $oMedico;
    }

    public function getDiagnostica()
    {
        return $this->sDiagnostica;
    }

    public function setDiagnostica($sDiagnostica)
    {
        $this->sDiagnostica = $sDiagnostica;
    }

    public function getFechaRealizado()
    {
        return $this->dFechaRealizado;
    }

    public function setFechaRealizado($dFechaRealizado)
    {
        $this->dFechaRealizado = $dFechaRealizado;
    }

    public function getRutaArchivo()
    {
        return $this->sRutaArchivo;
    }

    public function setRutaArchivo($sRutaArchivo)
    {
        $this->sRutaArchivo = $sRutaArchivo;
    }

    
    function insertarEstudioRealizado($sUser){
        $oAD = new AccesoDatos();
        $sQuery = "";
        $nAfec = 0;
        if($this->getPaciente()->getExpediente()->getNumero() == ""){
            throw new Exception("EstudioRealizado->insertarEstudioRealizado(): error, faltan datos");
        }else{
            $sQuery = "call insertarEstAtendido('".$sUser."',
            ".$this->getEstudios()->getClaveInterna().",
            '".$this->getPaciente()->getExpediente()->getNumero()."',
            ".$this->getMedico()->getIdPersonal().",
            '".$this->getDiagnostica()."',
            current_date(),
            '".$this->getEstImagen()->getRutaArchivo()."',
            '".$this->getEstImagen()->getNivelUrgencia()."',
            current_date(),
            '".$this->getEstImagen()->getEstudioSolicitado()."',
            '".$this->getEstImagen()->getOtrosEstudios()."',
            '".$this->getEstImagen()->getRegionSol()."',
            '".$this->getEstLab()->getEstudiosSolicitados()."',
            '".$this->getNota()->getResumen()."',
            '".$this->getNota()->getPresionArterial()."',
            '".$this->getNota()->getSignosVitales()."',
            '".$this->getNota()->getTemperatura()."');";
            var_dump($sQuery);
            if($oAD->Conecta()){
                $nAfec = $oAD->ejecutaComando($sQuery);
                $oAD->Desconecta();
            }
        }
        return $nAfec;
    }

    function buscarTodosEstRealPorPaciente(){
        $oAD = new AccesoDatos();
        $vObj = null;
        $rst = null;
        $sQuery = "";
        $i = 0;
        $oEstReal  = null;
        if($this->getPaciente()->getExpediente()->getNumero() == ""){
            throw new Exception("EstudioRealizado->buscarTodosEstRealPorPaciente(): error, faltan datos");
        }else{
            if($oAD->Conecta()){
                $sQuery = "call buscarNotasMedicasPaciente('".$this->getPaciente()->getExpediente()->getNumero()."');";
                $rst = $oAD->ejecutaQuery($sQuery);
                $oAD->Desconecta();
            }
            if($rst){
                foreach ($rst as $vRow){
                    $oEstReal = new EstudioRealizado();
                    $oEstReal->setPaciente(new Paciente());
                    $oEstReal->setEstudios(new Estudios());
                    $oEstReal->setIdEstReal($vRow[0]);
                    $oEstReal->getPaciente()->setNombre($vRow[1]);
                    $oEstReal->getPaciente()->setApPaterno($vRow[2]);
                    $oEstReal->getPaciente()->setApMaterno($vRow[3]);
                    $oEstReal->getEstudios()->setDescripcion($vRow[4]);
                    $oEstReal->setFechaRealizado($vRow[5]);
                    $vObj[$i] = $oEstReal;
                    $i = $i + 1;
                }
            }else{
                $vObj = false;
            }
        }
        return $vObj;
    }

    function buscarArchivoEstReal(){
        $oAD = new AccesoDatos();
        $sQuery = "";
        $rst = null;
        $bRet = false;
        if($this->getIdEstReal() == 0){
            throw new Exception("EstudioRealizado->buscarArchivoEstReal(): error, faltan datos");
        }else{
            if($oAD->Conecta()){
                $sQuery = "call buscarArchivosEstReal(".$this->getIdEstReal().");";
                $rst = $oAD->ejecutaQuery($sQuery);
                $oAD->Desconecta();
            }
            if($rst){
                $this->setRutaArchivo($rst[0][0]);
                $bRet = true;
            }
        }
        return $bRet;
    }

    function buscarReporteNotaMed(){
        $oAD = new AccesoDatos();
        $rst = null;
        $bEnc = false;
        $sQuery = "";
        if($this->getPaciente()->getExpediente()->getNumero() == "" and $this->getIdEstReal() == 0){
            throw new Exception("EstudioRealizado->buscarReporteNotaMed(): error, faltan datos");
        }else{
            if($oAD->Conecta()){
                $sQuery = "CALL buscarDatosEstReal('".$this->getPaciente()->getExpediente()->getNumero()."',".$this->getIdEstReal().");";
                $rst = $oAD->ejecutaQuery($sQuery);
                $oAD->Desconecta();
            }
            if($rst){
                $this->setPaciente(new Paciente());
                $this->getPaciente()->setExpediente(new Expediente());
                $this->setEstudios(new Estudios());
                $this->setMedico(new Medico());
                $this->setRecibo(new ReciboCobro());
                $this->setEstImagen(new EstImagen());
                $this->setEstLab(new EstLaboratorio());
                $this->setNota(new NotaMedica());
                $this->getPaciente()->setNombre($rst[0][0]);
                $this->getPaciente()->setApPaterno($rst[0][1]);
                $this->getPaciente()->setApMaterno($rst[0][2]);
                $this->getEstudios()->setDescripcion($rst[0][3]);
                $this->getRecibo()->setTotal($rst[0][4]);
                $this->setDiagnostica($rst[0][5]);
                $this->setFechaRealizado($rst[0][6]);
                $this->getEstImagen()->setNivelUrgencia($rst[0][7]);
                $this->getEstImagen()->setFechaSoliciutd($rst[0][8]);
                $this->getEstImagen()->setEstudioSolicitado($rst[0][9]);
                $this->getEstImagen()->setOtrosEstudios($rst[0][10]);
                $this->getEstImagen()->setRegionSol($rst[0][11]);
                $this->getEstLab()->setEstudiosSolicitados($rst[0][12]);
                $this->getNota()->setNumCama($rst[0][13]);
                $this->getNota()->setResumen($rst[0][14]);
                $this->getNota()->setPresionArterial($rst[0][15]);
                $this->getNota()->setSignosVitales($rst[0][16]);
                $this->getNota()->setTemperatura($rst[0][17]);
                $this->getPaciente()->setEdad($rst[0][18]);
                $this->getPaciente()->getExpediente()->setNumero($rst[0][19]);
                $this->getMedico()->setNombres($rst[0][20]);
                $this->getMedico()->setApPaterno($rst[0][22]);
                $this->getMedico()->setApMaterno($rst[0][21]);
                $this->getMedico()->setNumCedula($rst[0][23]);
                $bEnc = true;
            }
        }
        return $bEnc;
    }



}