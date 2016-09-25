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
    private $oAntibioticos = null;
    private $nIdNota = 0;
    private $dFechaSol = null;
    private $sPrioridad = "";
    private $sDiagnosticoPreope = "";
    private $sOperacionPlaneada = "";
    private $sTipoOperacion = "";
    private $sGrupoSanguineo = "";
    private $sRH = "";
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
    private $dFechaInicioAnt = null;
    private $sHoraInicioAnt = "";
    private $bEstadoProce = 0;


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

}