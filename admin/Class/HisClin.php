<?php
/**
 * Created by PhpStorm.
 * User: Aldo
 * Date: 02/02/2017
 * Time: 08:10 PM
 */
include_once ("AccesoDatos.php");
include_once ("Paciente.php");
include_once ("Expediente.php");
include_once ("AntecFamiliares.php");
include_once ("AntecNoPatologicos.php");
include_once ("AntePatologicos.php");
include_once ("AntecGinecobstetricos.php");
require ("../pdf/fpdf.php");

class HisClin
{
    private $oAD = null;
    private $oPaciente = null;
    private $oExpediente = null;
    private $oAntFam = null;
    private $oAntNPat = null;
    private $oAntPat = null;
    private $oAntGin = null;


    public function getOPaciente()
    {
        return $this->oPaciente;
    }

    public function setOPaciente($oPaciente)
    {
        $this->oPaciente = $oPaciente;
    }

    public function getOExpediente()
    {
        return $this->oExpediente;
    }

    public function setOExpediente($oExpediente)
    {
        $this->oExpediente = $oExpediente;
    }

    public function getOAntFam()
    {
        return $this->oAntFam;
    }

    public function setOAntFam($oAntFam)
    {
        $this->oAntFam = $oAntFam;
    }


    public function getOAntNPat()
    {
        return $this->oAntNPat;
    }

    public function setOAntNPat($oAntNPat)
    {
        $this->oAntNPat = $oAntNPat;
    }


    public function getOAntPat()
    {
        return $this->oAntPat;
    }


    public function setOAntPat($oAntPat)
    {
        $this->oAntPat = $oAntPat;
    }


    public function getOAntGin()
    {
        return $this->oAntGin;
    }


    public function setOAntGin($oAntGin)
    {
        $this->oAntGin = $oAntGin;
    }


    function buscarHisClinGin($expediente)
    {
        $oAD = new AccesoDatos();
        $rst = null;
        $vObj = null;
        $oNota = null;
        $sQuery = "";
        $i = 0;
        if ($oAD->Conecta()) {
            $sQuery = "call consultarHistorialClinicoGin('".$expediente."');";
            $rst = $oAD->ejecutaQuery($sQuery);
            $oAD->Desconecta();
        }
        if ($rst) {
                $this->setOPaciente(new Paciente());
                $this->setOExpediente(new Expediente());
                $this->getOPaciente()->setApPaterno($rst[0][0]);
                $this->getOPaciente()->setApMaterno($rst[0][1]);
                $this->getOPaciente()->setNombre($rst[0][2]);
                $this->getOExpediente()->setNumero($rst[0][3]);
                $this->getOPaciente()->setDireccion($rst[0][4]);
                $this->getOPaciente()->setSMunicipio($rst[0][5]);
                $this->getOPaciente()->setEstado($rst[0][6]);
                $this->getOPaciente()->setTelefono($rst[0][7]);
                $this->setOAntFam(new AntecFamiliares());
                $this->getOAntFam()->setDiabetes($rst[0][8]);
                $this->getOAntFam()->setHipertension($rst[0][9]);
                $this->getOAntFam()->setSCardiopatias($rst[0][10]);
                $this->getOAntFam()->setSTuberculosis($rst[0][11]);
                $this->getOAntFam()->setCancer($rst[0][12]);
                $this->getOAntFam()->setSEpilepsia($rst[0][13]);
                $this->getOAntFam()->setSInsRenal($rst[0][14]);
                $this->setOAntNPat(new AntecNoPatologicos());
                $this->getOAntNPat()->setTabaquismo($rst[0][15]);
                $this->getOAntNPat()->setAlcoholismo($rst[0][16]);
                $this->getOAntNPat()->setDrogas($rst[0][17]);
                $this->getOAntNPat()->setSBCG($rst[0][18]);
                $this->getOAntNPat()->setSPolio($rst[0][19]);
                $this->getOAntNPat()->setSPenta($rst[0][20]);
                $this->getOAntNPat()->setSInfluenza($rst[0][21]);
                $this->setOAntPat(new AntePatologicos());
                $this->getOAntPat()->setAlergias($rst[0][22]);
                $this->getOAntPat()->setCardiopatias($rst[0][23]);
                $this->getOAntPat()->setTransfusiones($rst[0][24]);
                $this->getOAntPat()->setDiabetico($rst[0][25]);
                $this->getOAntPat()->setCardiovasculares($rst[0][26]);
                $this->getOAntPat()->setHTA($rst[0][27]);
                $this->getOAntPat()->setSFracturas($rst[0][28]);
                $this->getOAntPat()->setSReumaticas($rst[0][29]);
                $this->getOAntPat()->setSRinitis($rst[0][30]);
                $this->getOAntPat()->setSAsma($rst[0][31]);
                $this->getOAntPat()->setSconvulsiones($rst[0][32]);
                $this->getOAntPat()->setSMigrañas($rst[0][33]);
                $this->getOAntPat()->setSPsiquiatricos($rst[0][34]);
                $this->getOAntPat()->setSTB($rst[0][35]);
                $this->getOAntPat()->setSEVC($rst[0][36]);
                $this->getOAntPat()->setSDermatosis($rst[0][37]);
                $this->getOAntPat()->setSAudicion($rst[0][38]);
                $this->getOAntPat()->setSVision($rst[0][39]);
                $this->getOAntPat()->setSEnfArt($rst[0][40]);
                $this->getOAntPat()->setSVarices($rst[0][41]);
                $this->getOAntPat()->setSUlceras($rst[0][42]);
                $this->getOAntPat()->setSApendicits($rst[0][43]);
                $this->getOAntPat()->setSProstata($rst[0][44]);
                $this->getOAntPat()->setSUrinarias($rst[0][45]);
                $this->getOAntPat()->setSAcidoPep($rst[0][46]);
                $this->getOAntPat()->setSSanDig($rst[0][47]);
                $this->getOAntPat()->setSHepatitis($rst[0][48]);
                $this->getOAntPat()->setSHernias($rst[0][49]);
                $this->getOAntPat()->setSColitis($rst[0][50]);
                $this->getOAntPat()->setSColecis($rst[0][51]);
                $this->getOAntPat()->setSPatAnal($rst[0][52]);
                $this->getOAntPat()->setSInternamientos($rst[0][53]);
                $this->getOAntPat()->setSCirujias($rst[0][54]);
                $this->getOAntPat()->setObesidad($rst[0][64]);
                $this->getOAntPat()->setCancer($rst[0][65]);
                $this->setOAntGin(new AntecGinecobstetricos());
                $this->getOAntGin()->setDMenarca($rst[0][55]);
                $this->getOAntGin()->setIVSA($rst[0][56]);
                $this->getOAntGin()->setDFUM($rst[0][57]);
                $this->getOAntGin()->setDFUP($rst[0][58]);
                $this->getOAntGin()->setGestaciones($rst[0][59]);
                $this->getOAntGin()->setPartos($rst[0][60]);
                $this->getOAntGin()->setCesareas($rst[0][61]);
                $this->getOAntGin()->setAbortos($rst[0][62]);
                $this->getOAntGin()->setSObservaciones($rst[0][63]);
            $bRet=true;
        }

return $bRet;
}

    function buscarHisClinUro($expediente)
    {
        $oAD = new AccesoDatos();
        $rst = null;
        $vObj = null;
        $oNota = null;
        $sQuery = "";
        $i = 0;
        if ($oAD->Conecta()) {
            $sQuery = "call consultarHistorialClinicoUro('".$expediente."');";
            $rst = $oAD->ejecutaQuery($sQuery);
            $oAD->Desconecta();
        }
        if ($rst) {
            $this->setOPaciente(new Paciente());
            $this->setOExpediente(new Expediente());
            $this->getOPaciente()->setApPaterno($rst[0][0]);
            $this->getOPaciente()->setApMaterno($rst[0][1]);
            $this->getOPaciente()->setNombre($rst[0][2]);
            $this->getOExpediente()->setNumero($rst[0][3]);
            $this->getOPaciente()->setDireccion($rst[0][4]);
            $this->getOPaciente()->setSMunicipio($rst[0][5]);
            $this->getOPaciente()->setEstado($rst[0][6]);
            $this->getOPaciente()->setTelefono($rst[0][7]);
            $this->setOAntFam(new AntecFamiliares());
            $this->getOAntFam()->setDiabetes($rst[0][8]);
            $this->getOAntFam()->setHipertension($rst[0][9]);
            $this->getOAntFam()->setSCardiopatias($rst[0][10]);
            $this->getOAntFam()->setSTuberculosis($rst[0][11]);
            $this->getOAntFam()->setCancer($rst[0][12]);
            $this->getOAntFam()->setSEpilepsia($rst[0][13]);
            $this->getOAntFam()->setSInsRenal($rst[0][14]);
            $this->setOAntNPat(new AntecNoPatologicos());
            $this->getOAntNPat()->setTabaquismo($rst[0][15]);
            $this->getOAntNPat()->setAlcoholismo($rst[0][16]);
            $this->getOAntNPat()->setDrogas($rst[0][17]);
            $this->getOAntNPat()->setSBCG($rst[0][18]);
            $this->getOAntNPat()->setSPolio($rst[0][19]);
            $this->getOAntNPat()->setSPenta($rst[0][20]);
            $this->getOAntNPat()->setSInfluenza($rst[0][21]);
            $this->setOAntPat(new AntePatologicos());
            $this->getOAntPat()->setAlergias($rst[0][22]);
            $this->getOAntPat()->setCardiopatias($rst[0][23]);
            $this->getOAntPat()->setTransfusiones($rst[0][24]);
            $this->getOAntPat()->setDiabetico($rst[0][25]);
            $this->getOAntPat()->setCardiovasculares($rst[0][26]);
            $this->getOAntPat()->setHTA($rst[0][27]);
            $this->getOAntPat()->setSFracturas($rst[0][28]);
            $this->getOAntPat()->setSReumaticas($rst[0][29]);
            $this->getOAntPat()->setSRinitis($rst[0][30]);
            $this->getOAntPat()->setSAsma($rst[0][31]);
            $this->getOAntPat()->setSconvulsiones($rst[0][32]);
            $this->getOAntPat()->setSMigrañas($rst[0][33]);
            $this->getOAntPat()->setSPsiquiatricos($rst[0][34]);
            $this->getOAntPat()->setSTB($rst[0][35]);
            $this->getOAntPat()->setSEVC($rst[0][36]);
            $this->getOAntPat()->setSDermatosis($rst[0][37]);
            $this->getOAntPat()->setSAudicion($rst[0][38]);
            $this->getOAntPat()->setSVision($rst[0][39]);
            $this->getOAntPat()->setSEnfArt($rst[0][40]);
            $this->getOAntPat()->setSVarices($rst[0][41]);
            $this->getOAntPat()->setSUlceras($rst[0][42]);
            $this->getOAntPat()->setSApendicits($rst[0][43]);
            $this->getOAntPat()->setSProstata($rst[0][44]);
            $this->getOAntPat()->setSUrinarias($rst[0][45]);
            $this->getOAntPat()->setSAcidoPep($rst[0][46]);
            $this->getOAntPat()->setSSanDig($rst[0][47]);
            $this->getOAntPat()->setSHepatitis($rst[0][48]);
            $this->getOAntPat()->setSHernias($rst[0][49]);
            $this->getOAntPat()->setSColitis($rst[0][50]);
            $this->getOAntPat()->setSColecis($rst[0][51]);
            $this->getOAntPat()->setSPatAnal($rst[0][52]);
            $this->getOAntPat()->setSInternamientos($rst[0][53]);
            $this->getOAntPat()->setSCirujias($rst[0][54]);
            $this->getOAntPat()->setObesidad($rst[0][55]);
            $this->getOAntPat()->setCancer($rst[0][56]);

            $bRet=true;
        }
        return $bRet;
    }



}



