<?php

/**
 * Created by PhpStorm.
 * User: Pablo
 * Date: 25/09/2016
 * Time: 11:24 AM
 */
include_once ("AccesoDatos.php");
include_once ("Paciente.php");
include_once ("Expediente.php");
include_once ("ClasificacionHeridas.php");
include_once ("Medico.php");
include_once ("ManejoHeridas.php");
include_once ("Anestesia.php");
include_once ("Antibioticos.php");
class NotaIntervencion
{
    private $oAD = null;
    private $oPaciente = null;
    private $oExpediente = null;
    private $oClasificacion = null;
    private $oMedico = null;
    private $oManejo = null;
    private $oAnestesia = null;
    private $oAnestesiaAplicada = null;
    private $oAntibioticos = null;
    private $nIdNota = 0;
    private $dFechaSol = null;
    private $dFechaSolicitada = null;
    private $sPrioridad = "";
    private $sDiagnosticoPreope = "";
    private $sOperacionPlaneada = "";
    private $sTipoOperacion = "";
    private $sGrupoSanguineo = "";
    private $sRH = "";
    private $sTiempoEstimado = "";
    private $sRiesgos = "";
    private $sBeneficios = "";
    private $sDxPosoperatorio = "";
    private $sOperacionRealizada = "";
    private $sAyudante1 = "";
    private $sAyudante2 = "";
    private $sAyudante3 = "";
    private $sEnfermeraEspeQui = "";
    private $sEnfermeraGen = "";
    private $sExaHistoTransSol = "";
    private $sOtrosEstTras = "";
    private $dFechaProcedimiento = null;
    private $sHoraProce = "";
    private $sDescripcionTecnica = "";
    private $sHallazgos = "";
    private $sIncidentes = "";
    private $sAccidentes = "";
    private $sComplicaciones = "";
    private $sObservaciones = "";
    private $sEstadoPosope = "";
    private $sPlanManejoPosope = "";
    private $sPronostico = "";
    private $sImplante = "";
    private $sTipoImplante = "";
    private $sOsteomias = "";
    private $sTipoOsteomias = "";
    private $sLocalizacionOsteomias = "";
    private $sDrenaje = "";
    private $sTipoDrenaje = "";
    private $sAntibiotico = "";
    private $sCirujano = "";
    private $sCedCirujano  = "";
    private $sAnestesiologo = "";
    private $sCedAnestesio = "";
    private $dFechaInicioAnt = null;
    private $sHoraInicioAnt = "";
    private $bEstadoProce = 0;


    public function getCirujano()
    {
        return $this->sCirujano;
    }

    public function setCirujano($sCirujano)
    {
        $this->sCirujano = $sCirujano;
    }

    public function getCedCirujano()
    {
        return $this->sCedCirujano;
    }

    public function setCedCirujano($sCedCirujano)
    {
        $this->sCedCirujano = $sCedCirujano;
    }

    public function getAnestesiologo()
    {
        return $this->sAnestesiologo;
    }

    public function setAnestesiologo($sAnestesiologo)
    {
        $this->sAnestesiologo = $sAnestesiologo;
    }

    public function getCedAnestesio()
    {
        return $this->sCedAnestesio;
    }

    public function setCedAnestesio($sCedAnestesio)
    {
        $this->sCedAnestesio = $sCedAnestesio;
    }

    public function getFechaSolicitada()
    {
        return $this->dFechaSolicitada;
    }

    public function setFechaSolicitada($dFechaSolicitada)
    {
        $this->dFechaSolicitada = $dFechaSolicitada;
    }

    public function getTiempoEstimado()
    {
        return $this->sTiempoEstimado;
    }

    public function setTiempoEstimado($sTiempoEstimado)
    {
        $this->sTiempoEstimado = $sTiempoEstimado;
    }

    public function getAD()
    {
        return $this->oAD;
    }

    public function setAD($oAD)
    {
        $this->oAD = $oAD;
    }

    public function getPaciente()
    {
        return $this->oPaciente;
    }

    public function setPaciente($oPaciente)
    {
        $this->oPaciente = $oPaciente;
    }

    public function getExpediente()
    {
        return $this->oExpediente;
    }

    public function setExpediente($oExpediente)
    {
        $this->oExpediente = $oExpediente;
    }

    public function getClasificacion()
    {
        return $this->oClasificacion;
    }

    public function setClasificacion($oClasificacion)
    {
        $this->oClasificacion = $oClasificacion;
    }

    public function getMedico()
    {
        return $this->oMedico;
    }

    public function setMedico($oMedico)
    {
        $this->oMedico = $oMedico;
    }

    public function getManejo()
    {
        return $this->oManejo;
    }

    public function setManejo($oManejo)
    {
        $this->oManejo = $oManejo;
    }

    public function getAnestesia()
    {
        return $this->oAnestesia;
    }

    public function setAnestesia($oAnestesia)
    {
        $this->oAnestesia = $oAnestesia;
    }

    public function getAntibioticos()
    {
        return $this->oAntibioticos;
    }

    public function getAnestesiaAplicada()
    {
        return $this->oAnestesiaAplicada;
    }

    public function setAnestesiaAplicada($oAnestesiaAplicada)
    {
        $this->oAnestesiaAplicada = $oAnestesiaAplicada;
    }

    public function setAntibioticos($oAntibioticos)
    {
        $this->oAntibioticos = $oAntibioticos;
    }

    public function getIdNota()
    {
        return $this->nIdNota;
    }

    public function setIdNota($nIdNota)
    {
        $this->nIdNota = $nIdNota;
    }

    public function getFechaSol()
    {
        return $this->dFechaSol;
    }

    public function setFechaSol($dFechaSol)
    {
        $this->dFechaSol = $dFechaSol;
    }

    public function getPrioridad()
    {
        return $this->sPrioridad;
    }

    public function setPrioridad($sPrioridad)
    {
        $this->sPrioridad = $sPrioridad;
    }

    public function getDiagnosticoPreope()
    {
        return $this->sDiagnosticoPreope;
    }

    public function setDiagnosticoPreope($sDiagnosticoPreope)
    {
        $this->sDiagnosticoPreope = $sDiagnosticoPreope;
    }

    public function getOperacionPlaneada()
    {
        return $this->sOperacionPlaneada;
    }

    public function setOperacionPlaneada($sOperacionPlaneada)
    {
        $this->sOperacionPlaneada = $sOperacionPlaneada;
    }

    public function getTipoOperacion()
    {
        return $this->sTipoOperacion;
    }

    public function setTipoOperacion($sTipoOperacion)
    {
        $this->sTipoOperacion = $sTipoOperacion;
    }

    public function getGrupoSanguineo()
    {
        return $this->sGrupoSanguineo;
    }

    public function setGrupoSanguineo($sGrupoSanguineo)
    {
        $this->sGrupoSanguineo = $sGrupoSanguineo;
    }

    public function getRH()
    {
        return $this->sRH;
    }

    public function setRH($sRH)
    {
        $this->sRH = $sRH;
    }

    public function getRiesgos()
    {
        return $this->sRiesgos;
    }

    public function setRiesgos($sRiesgos)
    {
        $this->sRiesgos = $sRiesgos;
    }

    public function getBeneficios()
    {
        return $this->sBeneficios;
    }

    public function setBeneficios($sBeneficios)
    {
        $this->sBeneficios = $sBeneficios;
    }

    public function getDxPosoperatorio()
    {
        return $this->sDxPosoperatorio;
    }

    public function setDxPosoperatorio($sDxPosoperatorio)
    {
        $this->sDxPosoperatorio = $sDxPosoperatorio;
    }

    public function getOperacionRealizada()
    {
        return $this->sOperacionRealizada;
    }

    public function setOperacionRealizada($sOperacionRealizada)
    {
        $this->sOperacionRealizada = $sOperacionRealizada;
    }

    public function getAyudante1()
    {
        return $this->sAyudante1;
    }

    public function setAyudante1($sAyudante1)
    {
        $this->sAyudante1 = $sAyudante1;
    }

    public function getAyudante2()
    {
        return $this->sAyudante2;
    }

    public function setAyudante2($sAyudante2)
    {
        $this->sAyudante2 = $sAyudante2;
    }

    public function getAyudante3()
    {
        return $this->sAyudante3;
    }

    public function setAyudante3($sAyudante3)
    {
        $this->sAyudante3 = $sAyudante3;
    }

    public function getEnfermeraEspeQui()
    {
        return $this->sEnfermeraEspeQui;
    }

    public function setEnfermeraEspeQui($sEnfermeraEspeQui)
    {
        $this->sEnfermeraEspeQui = $sEnfermeraEspeQui;
    }

    public function getEnfermeraGen()
    {
        return $this->sEnfermeraGen;
    }

    public function setEnfermeraGen($sEnfermeraGen)
    {
        $this->sEnfermeraGen = $sEnfermeraGen;
    }

    public function getExaHistoTransSol()
    {
        return $this->sExaHistoTransSol;
    }

    public function setExaHistoTransSol($sExaHistoTransSol)
    {
        $this->sExaHistoTransSol = $sExaHistoTransSol;
    }

    public function getOtrosEstTras()
    {
        return $this->sOtrosEstTras;
    }

    public function setOtrosEstTras($sOtrosEstTras)
    {
        $this->sOtrosEstTras = $sOtrosEstTras;
    }

    public function getFechaProcedimiento()
    {
        return $this->dFechaProcedimiento;
    }

    public function setFechaProcedimiento($dFechaProcedimiento)
    {
        $this->dFechaProcedimiento = $dFechaProcedimiento;
    }

    public function getHoraProce()
    {
        return $this->sHoraProce;
    }

    public function setHoraProce($sHoraProce)
    {
        $this->sHoraProce = $sHoraProce;
    }

    public function getDescripcionTecnica()
    {
        return $this->sDescripcionTecnica;
    }

    public function setDescripcionTecnica($sDescripcionTecnica)
    {
        $this->sDescripcionTecnica = $sDescripcionTecnica;
    }

    public function getHallazgos()
    {
        return $this->sHallazgos;
    }

    public function setHallazgos($sHallazgos)
    {
        $this->sHallazgos = $sHallazgos;
    }

    public function getIncidentes()
    {
        return $this->sIncidentes;
    }

    public function setIncidentes($sIncidentes)
    {
        $this->sIncidentes = $sIncidentes;
    }

    public function getAccidentes()
    {
        return $this->sAccidentes;
    }

    public function setAccidentes($sAccidentes)
    {
        $this->sAccidentes = $sAccidentes;
    }

    public function getComplicaciones()
    {
        return $this->sComplicaciones;
    }

    public function setComplicaciones($sComplicaciones)
    {
        $this->sComplicaciones = $sComplicaciones;
    }

    public function getObservaciones()
    {
        return $this->sObservaciones;
    }

    public function setObservaciones($sObservaciones)
    {
        $this->sObservaciones = $sObservaciones;
    }

    public function getEstadoPosope()
    {
        return $this->sEstadoPosope;
    }

    public function setEstadoPosope($sEstadoPosope)
    {
        $this->sEstadoPosope = $sEstadoPosope;
    }

    public function getPlanManejoPosope()
    {
        return $this->sPlanManejoPosope;
    }

    public function setPlanManejoPosope($sPlanManejoPosope)
    {
        $this->sPlanManejoPosope = $sPlanManejoPosope;
    }

    public function getPronostico()
    {
        return $this->sPronostico;
    }

    public function setPronostico($sPronostico)
    {
        $this->sPronostico = $sPronostico;
    }

    public function getImplante()
    {
        return $this->sImplante;
    }

    public function setImplante($sImplante)
    {
        $this->sImplante = $sImplante;
    }

    public function getTipoImplante()
    {
        return $this->sTipoImplante;
    }

    public function setTipoImplante($sTipoImplante)
    {
        $this->sTipoImplante = $sTipoImplante;
    }

    public function getOsteomias()
    {
        return $this->sOsteomias;
    }

    public function setOsteomias($sOsteomias)
    {
        $this->sOsteomias = $sOsteomias;
    }

    public function getTipoOsteomias()
    {
        return $this->sTipoOsteomias;
    }

    public function setTipoOsteomias($sTipoOsteomias)
    {
        $this->sTipoOsteomias = $sTipoOsteomias;
    }

    public function getLocalizacionOsteomias()
    {
        return $this->sLocalizacionOsteomias;
    }

    public function setLocalizacionOsteomias($sLocalizacionOsteomias)
    {
        $this->sLocalizacionOsteomias = $sLocalizacionOsteomias;
    }

    public function getDrenaje()
    {
        return $this->sDrenaje;
    }

    public function setDrenaje($sDrenaje)
    {
        $this->sDrenaje = $sDrenaje;
    }

    public function getTipoDrenaje()
    {
        return $this->sTipoDrenaje;
    }

    public function setTipoDrenaje($sTipoDrenaje)
    {
        $this->sTipoDrenaje = $sTipoDrenaje;
    }

    public function getAntibiotico()
    {
        return $this->sAntibiotico;
    }

    public function setAntibiotico($sAntibiotico)
    {
        $this->sAntibiotico = $sAntibiotico;
    }

    public function getFechaInicioAnt()
    {
        return $this->dFechaInicioAnt;
    }

    public function setFechaInicioAnt($dFechaInicioAnt)
    {
        $this->dFechaInicioAnt = $dFechaInicioAnt;
    }

    public function getHoraInicioAnt()
    {
        return $this->sHoraInicioAnt;
    }

    public function setHoraInicioAnt($sHoraInicioAnt)
    {
        $this->sHoraInicioAnt = $sHoraInicioAnt;
    }

    public function getEstadoProce()
    {
        return $this->bEstadoProce;
    }

    public function setEstadoProce($bEstadoProce)
    {
        $this->bEstadoProce = $bEstadoProce;
    }

    function insertarNota($usuario){
        $oAD = new AccesoDatos();
        $sQuery = "";
        $nAfec = 0;
        if($usuario == ""){
            throw new Exception("NotaIntervencion->insertarNota(): error, faltan datos");
        }else{
            if($oAD->Conecta()){
                $sQuery = "call insertaNotaIntervencion('".$usuario."',
                '".$this->getFechaSolicitada()."',
                '".$this->getPaciente()->getExpediente()->getNumero()."',
                '".$this->getPrioridad()."',
                '".$this->getDiagnosticoPreope()."',
                '".$this->getOperacionPlaneada()."',
                '".$this->getTipoOperacion()."',
                '".$this->getGrupoSanguineo()."',
                '".$this->getRH()."',
                ".$this->getAnestesia()->getIdAnestesia().",
                '".$this->getTiempoEstimado()."',
                '".$this->getRiesgos()."',
                '".$this->getBeneficios()."');";
                $nAfec = $oAD->ejecutaComando($sQuery);
                //var_dump($sQuery);
                $oAD->Desconecta();
            }
        }
        return $nAfec;
    }

    function buscarDatosNotaInt(){
        $oAD = new AccesoDatos();
        $rst = null;
        $sQuery = "";
        $bRet = false;
        if($this->getPaciente()->getExpediente()->getNumero() == ""){
            throw new Exception("NotaIntervencion->buscarDatosNotaInt(): error, faltan datos");
        }else{
            if($oAD->Conecta()){
                $sQuery = "call buscarDatosProcedimiento('".$this->getPaciente()->getExpediente()->getNumero()."');";
                $rst = $oAD->ejecutaQuery($sQuery);
                $oAD->Desconecta();
                if($rst){
                    $this->setMedico(new Medico());
                    $this->setTipoOperacion($rst[0][0]);
                    $this->setDiagnosticoPreope($rst[0][1]);
                    $this->setOperacionPlaneada($rst[0][2]);
                    $this->setRiesgos($rst[0][3]);
                    $this->setBeneficios($rst[0][4]);
                    $this->getMedico()->setNombres($rst[0][5]);
                    $this->getMedico()->setApPaterno($rst[0][6]);
                    $this->getMedico()->setApMaterno($rst[0][7]);
                    $this->getMedico()->setNumCedula($rst[0][8]);
                    $bRet = true;
                }
            }
        }
        return $bRet;
    }

    function insertarResultadosNotaInt($usuario){
        $oAD = new AccesoDatos();
        $sQuery = "";
        $nAfec = 0;
        if($this->getPaciente()->getExpediente()->getNumero() == ""){
            throw  new Exception("NotaIntervencion->insertarResultadosNotaInt(): error, faltan datos");
        }else{
            if($oAD->Conecta()){
                $sQuery = "call insertarResultadosIntervencion('".$usuario."',
                   '".$this->getPaciente()->getExpediente()->getNumero()."',
                   '".$this->getDxPosoperatorio()."',
                   '".$this->getOperacionRealizada()."',
                   ".$this->getAnestesia()->getIdAnestesia().",
                   '".$this->getExaHistoTransSol()."',
                   '".$this->getOtrosEstTras()."',
                   '".$this->getFechaSolicitada()."',
                   '".$this->getHoraProce()."',
                   '".$this->getDescripcionTecnica()."',
                   '".$this->getHallazgos()."',
                   '".$this->getIncidentes()."',
                   '".$this->getAccidentes()."',
                   '".$this->getComplicaciones()."',
                   '".$this->getObservaciones()."',
                   '".$this->getEstadoPosope()."',
                   '".$this->getPlanManejoPosope()."',
                   '".$this->getPronostico()."',
                   ".$this->getClasificacion()->getIdClasificacion().",
                   '".$this->getImplante()."',
                   '".$this->getTipoImplante()."',
                   ".$this->getManejo()->getIdManejo().",
                   '".$this->getOsteomias()."',
                   '".$this->getTipoOsteomias()."',
                   '".$this->getLocalizacionOsteomias()."',
                   '".$this->getDrenaje()."',
                   '".$this->getTipoDrenaje()."',
                   '".$this->getAntibiotico()."',
                   ".$this->getAntibioticos()->getIdAntibiotico().",
                   '".$this->getCirujano()."',
                   '".$this->getCedCirujano()."',
                   '".$this->getAnestesiologo()."',
                   '".$this->getCedAnestesio()."',";
                $sQuery = $this->getFechaInicioAnt() != 'null' ? $sQuery ."'".$this->getFechaInicioAnt()."'," : $sQuery . "".$this->getFechaInicioAnt().",";
                $sQuery = $sQuery ."'".$this->getHoraInicioAnt()."');";
                $nAfec = $oAD->ejecutaComando($sQuery);
                $oAD->Desconecta();
            }
        }
        return $nAfec;
    }

    function buscarTodosProcePaciente(){
        $oAD = new AccesoDatos();
        $rst = null;
        $vObj = null;
        $oNota = null;
        $sQuery = "";
        $i = 0;
        if($this->getPaciente()->getExpediente()->getNumero() == ""){
            throw new Exception("NotaIntervecion->buscarTodosProcePaciente(): error, faltan datos");
        }else{
            if($oAD->Conecta()){
                $sQuery = "call buscarTodosProcePacientes('".$this->getPaciente()->getExpediente()->getNumero()."');";
                $rst = $oAD->ejecutaQuery($sQuery);
                $oAD->Desconecta();
            }
            if($rst){
                foreach ($rst as $vRow){
                    $oNota = new NotaIntervencion();
                    $oNota->setPaciente(new Paciente());
                    $oNota->getPaciente()->setExpediente(new Expediente());
                    $oNota->getPaciente()->setNombre($vRow[0]);
                    $oNota->getPaciente()->setApPaterno($vRow[1]);
                    $oNota->getPaciente()->setApMaterno($vRow[2]);
                    $oNota->getPaciente()->getExpediente()->setNumero($vRow[3]);
                    $oNota->setIdNota($vRow[4]);
                    $oNota->setFechaProcedimiento($vRow[5]);
                    $oNota->setDiagnosticoPreope($vRow[6]);
                    $oNota->setOperacionPlaneada($vRow[7]);
                    $oNota->setOperacionRealizada($vRow[8]);
                    $vObj[$i] = $oNota;
                    $i = $i + 1;
                }
            }else{
                $vObj = false;
            }
        }
        return $vObj;
    }

    function buscarResultadoNota(){
        $oAD = new AccesoDatos();
        $sQuery = "";
        $rst = null;
        $bRet = false;
        if($this->getIdNota() == 0){
            throw new Exception("NotaIntervencion->buscarResultadosNota(): error, faltan datos");
        }else{
            if($oAD->Conecta()){
                $sQuery = "call buscarReporteIntervencion(".$this->getIdNota().");";
                $rst = $oAD->ejecutaQuery($sQuery);
                if($rst){
                    $this->setPaciente(new Paciente());
                    $this->getPaciente()->setExpediente(new Expediente());
                    $this->setAnestesiaAplicada(new Anestesia());
                    $this->setManejo(new ManejoHeridas());
                    $this->setClasificacion(new ClasificacionHeridas());
                    $this->setAntibioticos(new Antibioticos());
                    $this->setDiagnosticoPreope($rst[0][0]);
                    $this->setDxPosoperatorio($rst[0][1]);
                    $this->setOperacionRealizada($rst[0][2]);
                    $this->setCirujano($rst[0][3]);
                    $this->setCedCirujano($rst[0][4]);
                    $this->setAnestesiologo($rst[0][5]);
                    $this->setCedAnestesio($rst[0][6]);
                    $this->setExaHistoTransSol($rst[0][7]);
                    $this->setOtrosEstTras($rst[0][8]);
                    $this->getAnestesiaAplicada()->setDescripcion($rst[0][9]);
                    $this->setFechaProcedimiento($rst[0][10]);
                    $this->setHoraProce($rst[0][11]);
                    $this->setDescripcionTecnica($rst[0][12]);
                    $this->setHallazgos($rst[0][13]);
                    $this->setIncidentes($rst[0][14]);
                    $this->setAccidentes($rst[0][15]);
                    $this->setComplicaciones($rst[0][16]);
                    $this->setObservaciones($rst[0][17]);
                    $this->setEstadoPosope($rst[0][18]);
                    $this->setPlanManejoPosope($rst[0][19]);
                    $this->setPronostico($rst[0][20]);
                    $this->getClasificacion()->setDescripcion($rst[0][21]);
                    $this->setImplante($rst[0][22]);
                    $this->setTipoImplante($rst[0][23]);
                    $this->getManejo()->setDescripcion($rst[0][24]);
                    $this->setOsteomias($rst[0][25]);
                    $this->setTipoOsteomias($rst[0][26]);
                    $this->setLocalizacionOsteomias($rst[0][27]);
                    $this->setDrenaje($rst[0][28]);
                    $this->setTipoDrenaje($rst[0][29]);
                    $this->setAntibiotico($rst[0][30]);
                    $this->getAntibioticos()->setDescripcion($rst[0][31]);
                    $this->setFechaInicioAnt($rst[0][32]);
                    $this->setHoraInicioAnt($rst[0][33]);
                    $this->getPaciente()->setNombre($rst[0][34]);
                    $this->getPaciente()->setApPaterno($rst[0][35]);
                    $this->getPaciente()->setApMaterno($rst[0][36]);
                    $this->getPaciente()->getExpediente()->setNumero($rst[0][37]);
                    $bRet = true;
                }
            }
        }
        return $bRet;
    }

}