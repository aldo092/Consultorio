<?php
/**
 * Created by PhpStorm.
 * User: Aldo
 * Date: 02/02/2017
 * Time: 08:05 PM
 */

include_once ("../Class/Paciente.php");
include_once ("../Class/HisClin.php");
require_once ("../pdf/fpdf.php");


$Expediente=$_POST["txtExpediente"];
$Medico=$_POST["txtMedico"];
$fecha = date("j/n/Y");
if($Medico==2){

$oHisClin= new HisClin();
$oHisClin->buscarHisClinGin($Expediente);

$pdf = new FPDF('L', 'mm', 'letter');
$pdf->AddPage();
$pdf->Image('../images/HCG.jpg', 0, 0, 0, 0, 'JPG');
$pdf->SetFont('Arial', '', 12);
$pdf->Text(55, 25,utf8_decode($oHisClin->getOPaciente()->getApPaterno()));
$pdf->Text(105,25,utf8_decode( $oHisClin->getOPaciente()->getApMaterno()) );
$pdf->Text(155,25,utf8_decode($oHisClin->getOPaciente()->getNombre()));
$pdf->Text(200,25,$oHisClin->getOExpediente()->getNumero());
$pdf->Text(15,49,utf8_decode($oHisClin->getOPaciente()->getDireccion()));
$pdf->Text(110,49,utf8_decode($oHisClin->getOPaciente()->getSMunicipio()));
$pdf->Text(170,49,utf8_decode($oHisClin->getOPaciente()->getEstado()));
$pdf->Text(200,49,$oHisClin->getOPaciente()->getTelefono());
$pdf->Text(240,49,$fecha);
/*Ant Familiraes*/
$pdf->Text(62,83,$oHisClin->getOAntFam()->getDiabetes());
$pdf->Text(98,83,$oHisClin->getOAntFam()->getHipertension());
$pdf->Text(133,83,$oHisClin->getOAntFam()->getSCardiopatias());
$pdf->Text(150,83,$oHisClin->getOAntFam()->getSTuberculosis());
$pdf->Text(175,83,$oHisClin->getOAntFam()->getCancer());
$pdf->Text(203,83,$oHisClin->getOAntFam()->getSEpilepsia());
$pdf->Text(240,83,$oHisClin->getOAntFam()->getSInsRenal());
/*No patologicos*/
$pdf->Text(45,97,$oHisClin->getOAntNPat()->getTabaquismo());
$pdf->Text(92,97,$oHisClin->getOAntNPat()->getAlcoholismo());
$pdf->Text(134,97,$oHisClin->getOAntNPat()->getDrogas());
$pdf->Text(174,97,$oHisClin->getOAntNPat()->getSBCG());
$pdf->Text(210,97,$oHisClin->getOAntNPat()->getSPolio());
$pdf->Text(250,97,$oHisClin->getOAntNPat()->getSPenta());
$pdf->Text(45,104,$oHisClin->getOAntNPat()->getSInfluenza());
/*Ant patologicos*/
$pdf->Text(190,67,utf8_decode($oHisClin->getOAntPat()->getAlergias()));
$pdf->Text(92,104,$oHisClin->getOAntPat()->getCardiopatias());
$pdf->Text(134,104,$oHisClin->getOAntPat()->getTransfusiones());
$pdf->Text(174,104,$oHisClin->getOAntPat()->getDiabetico());
$pdf->Text(210,104,$oHisClin->getOAntPat()->getCardiovasculares());
$pdf->Text(250,104,$oHisClin->getOAntPat()->getHTA());
$pdf->Text(45,111,$oHisClin->getOAntPat()->getSFracturas());
$pdf->Text(92,111,$oHisClin->getOAntPat()->getSReumaticas());
$pdf->Text(134,111,$oHisClin->getOAntPat()->getSRinitis());
$pdf->Text(174,111,$oHisClin->getOAntPat()->getSAsma());
$pdf->Text(210,111,$oHisClin->getOAntPat()->getSconvulsiones());
$pdf->Text(250,111,$oHisClin->getOAntPat()->getSMigrañas());
$pdf->Text(45,118,$oHisClin->getOAntPat()->getSPsiquiatricos());
$pdf->Text(92,118,$oHisClin->getOAntPat()->getSTB());
$pdf->Text(134,118,$oHisClin->getOAntPat()->getSEVC());
$pdf->Text(174,118,$oHisClin->getOAntPat()->getSDermatosis());
$pdf->Text(210,118,$oHisClin->getOAntPat()->getSAudicion());
$pdf->Text(250,118,$oHisClin->getOAntPat()->getSvision());
$pdf->Text(45,125,$oHisClin->getOAntPat()->getSEnfArt());
$pdf->Text(92,125,$oHisClin->getOAntPat()->getSVarices());
$pdf->Text(134,125,$oHisClin->getOAntPat()->getSUlceras());
$pdf->Text(174,125,$oHisClin->getOAntPat()->getSApendicits());
$pdf->Text(210,125,$oHisClin->getOAntPat()->getSProstata());
$pdf->Text(250,125,$oHisClin->getOAntPat()->getSUrinarias());
$pdf->Text(45,132,$oHisClin->getOAntPat()->getSAcidoPep());
$pdf->Text(92,132,$oHisClin->getOAntPat()->getSSanDig());
$pdf->Text(134,132,$oHisClin->getOAntPat()->getSHepatitis());
$pdf->Text(174,132,$oHisClin->getOAntPat()->getSHernias());
$pdf->Text(210,132,$oHisClin->getOAntPat()->getSColitis());
$pdf->Text(250,132,$oHisClin->getOAntPat()->getSColecis());
$pdf->Text(45,139,$oHisClin->getOAntPat()->getSPatAnal());
$pdf->Text(92,139,$oHisClin->getOAntPat()->getSInternamientos());
$pdf->Text(134,139,$oHisClin->getOAntPat()->getSCirujias());
$pdf->Text(174,139,$oHisClin->getOAntPat()->getObesidad());
$pdf->Text(210,139,$oHisClin->getOAntPat()->getCancer());


/*Ginecoobstectricios*/
$pdf->Text(150,163,$oHisClin->getOAntGin()->getDMenarca());
$pdf->Text(202,163,$oHisClin->getOAntGin()->getIVSA());
$pdf->Text(243,163,$oHisClin->getOAntGin()->getDFUM());
$pdf->Text(31,170,$oHisClin->getOAntGin()->getDFUP());
$pdf->Text(79,170,$oHisClin->getOAntGin()->getGestaciones());
$pdf->Text(116,170,$oHisClin->getOAntGin()->getPartos());
$pdf->Text(152,170,$oHisClin->getOAntGin()->getCesareas());
$pdf->Text(203,170,$oHisClin->getOAntGin()->getAbortos());
$pdf->Text(20,189,utf8_decode($oHisClin->getOAntGin()->getSObservaciones()));
$pdf->Output("Historial Clínico de " .$oHisClin->getOPaciente()->getNombre()." ". $oHisClin->getOPaciente()->getApPaterno()." ". $oHisClin->getOPaciente()->getApMaterno()." ".$fecha.".pdf","D");
    }
    else{

        $oHisClin= new HisClin();
        $oHisClin->buscarHisClinUro($Expediente);

        $pdf = new FPDF('L', 'mm', 'letter');
        $pdf->AddPage();
        $pdf->Image('../images/HCU.jpg', 0, 0, 0, 0, 'JPG');
        $pdf->SetFont('Arial', '', 12);
        $pdf->Text(55, 25,utf8_decode($oHisClin->getOPaciente()->getApPaterno()));
        $pdf->Text(105,25,utf8_decode( $oHisClin->getOPaciente()->getApMaterno()) );
        $pdf->Text(155,25,utf8_decode($oHisClin->getOPaciente()->getNombre()));
        $pdf->Text(200,25,$oHisClin->getOExpediente()->getNumero());
        $pdf->Text(15,49,utf8_decode($oHisClin->getOPaciente()->getDireccion()));
        $pdf->Text(110,49,utf8_decode($oHisClin->getOPaciente()->getSMunicipio()));
        $pdf->Text(170,49,utf8_decode($oHisClin->getOPaciente()->getEstado()));
        $pdf->Text(200,49,$oHisClin->getOPaciente()->getTelefono());
        $pdf->Text(240,49,$fecha);
        /*Ant Familiraes*/
        $pdf->Text(62,83,$oHisClin->getOAntFam()->getDiabetes());
        $pdf->Text(98,83,$oHisClin->getOAntFam()->getHipertension());
        $pdf->Text(133,83,$oHisClin->getOAntFam()->getSCardiopatias());
        $pdf->Text(150,83,$oHisClin->getOAntFam()->getSTuberculosis());
        $pdf->Text(175,83,$oHisClin->getOAntFam()->getCancer());
        $pdf->Text(203,83,$oHisClin->getOAntFam()->getSEpilepsia());
        $pdf->Text(240,83,$oHisClin->getOAntFam()->getSInsRenal());
        /*No patologicos*/
        $pdf->Text(45,97,$oHisClin->getOAntNPat()->getTabaquismo());
        $pdf->Text(92,97,$oHisClin->getOAntNPat()->getAlcoholismo());
        $pdf->Text(134,97,$oHisClin->getOAntNPat()->getDrogas());
        $pdf->Text(174,97,$oHisClin->getOAntNPat()->getSBCG());
        $pdf->Text(210,97,$oHisClin->getOAntNPat()->getSPolio());
        $pdf->Text(250,97,$oHisClin->getOAntNPat()->getSPenta());
        $pdf->Text(45,104,$oHisClin->getOAntNPat()->getSInfluenza());
        /*Ant patologicos*/
        $pdf->Text(190,67,utf8_decode($oHisClin->getOAntPat()->getAlergias()));
        $pdf->Text(92,104,$oHisClin->getOAntPat()->getCardiopatias());
        $pdf->Text(134,104,$oHisClin->getOAntPat()->getTransfusiones());
        $pdf->Text(174,104,$oHisClin->getOAntPat()->getDiabetico());
        $pdf->Text(210,104,$oHisClin->getOAntPat()->getCardiovasculares());
        $pdf->Text(250,104,$oHisClin->getOAntPat()->getHTA());
        $pdf->Text(45,111,$oHisClin->getOAntPat()->getSFracturas());
        $pdf->Text(92,111,$oHisClin->getOAntPat()->getSReumaticas());
        $pdf->Text(134,111,$oHisClin->getOAntPat()->getSRinitis());
        $pdf->Text(174,111,$oHisClin->getOAntPat()->getSAsma());
        $pdf->Text(210,111,$oHisClin->getOAntPat()->getSconvulsiones());
        $pdf->Text(250,111,$oHisClin->getOAntPat()->getSMigrañas());
        $pdf->Text(45,118,$oHisClin->getOAntPat()->getSPsiquiatricos());
        $pdf->Text(92,118,$oHisClin->getOAntPat()->getSTB());
        $pdf->Text(134,118,$oHisClin->getOAntPat()->getSEVC());
        $pdf->Text(174,118,$oHisClin->getOAntPat()->getSDermatosis());
        $pdf->Text(210,118,$oHisClin->getOAntPat()->getSAudicion());
        $pdf->Text(250,118,$oHisClin->getOAntPat()->getSvision());
        $pdf->Text(45,125,$oHisClin->getOAntPat()->getSEnfArt());
        $pdf->Text(92,125,$oHisClin->getOAntPat()->getSVarices());
        $pdf->Text(134,125,$oHisClin->getOAntPat()->getSUlceras());
        $pdf->Text(174,125,$oHisClin->getOAntPat()->getSApendicits());
        $pdf->Text(210,125,$oHisClin->getOAntPat()->getSProstata());
        $pdf->Text(250,125,$oHisClin->getOAntPat()->getSUrinarias());
        $pdf->Text(45,132,$oHisClin->getOAntPat()->getSAcidoPep());
        $pdf->Text(92,132,$oHisClin->getOAntPat()->getSSanDig());
        $pdf->Text(134,132,$oHisClin->getOAntPat()->getSHepatitis());
        $pdf->Text(174,132,$oHisClin->getOAntPat()->getSHernias());
        $pdf->Text(210,132,$oHisClin->getOAntPat()->getSColitis());
        $pdf->Text(250,132,$oHisClin->getOAntPat()->getSColecis());
        $pdf->Text(45,139,$oHisClin->getOAntPat()->getSPatAnal());
        $pdf->Text(92,139,$oHisClin->getOAntPat()->getSInternamientos());
        $pdf->Text(134,139,$oHisClin->getOAntPat()->getSCirujias());
        $pdf->Text(174,139,$oHisClin->getOAntPat()->getObesidad());
        $pdf->Text(210,139,$oHisClin->getOAntPat()->getCancer());
        $pdf->Output("Historial Clínico de " .$oHisClin->getOPaciente()->getNombre()." ". $oHisClin->getOPaciente()->getApPaterno()." ". $oHisClin->getOPaciente()->getApMaterno()." ". $fecha.".pdf","D");


    }

