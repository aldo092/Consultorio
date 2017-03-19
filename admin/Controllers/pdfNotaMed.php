<?php
/**
 * Created by PhpStorm.
 * User: Pablo
 * Date: 12/03/2017
 * Time: 08:02 PM
 */
require_once ("../pdf/fpdf.php");
require_once ("../Class/EstudioRealizado.php");
$oEstReal = new EstudioRealizado();
$sErr = "";
$oEstReal->setPaciente(new Paciente());
$oEstReal->getPaciente()->setExpediente(new Expediente());
$oEstReal->getPaciente()->getExpediente()->setNumero($_POST['txtExpediente']);
$oEstReal->setIdEstReal($_POST['txtIdEstReal']);
$oEstReal->buscarReporteNotaMed();

class Reporte extends FPDF{
    var $B;
    var $I;
    var $U;
    var $HREF;

    function PDF($orientacion='P',$unit='mm',$size='A4'){
        $this->FPDF($orientacion,$unit,$size);
        $this->B = 0;
        $this->I = 0;
        $this->U = 0;
        $this->HREF = '';
    }

    function WriteHTML($html)
    {
        // Intérprete de HTML
        //$html = str_replace("\n",' ',$html);
        $a = preg_split('/<(.*)>/U',$html,-1,PREG_SPLIT_DELIM_CAPTURE);
        foreach($a as $i=>$e)
        {
            if($i%2==0)
            {
                // Text
                if($this->HREF)
                    $this->PutLink($this->HREF,$e);
                else
                    $this->Write(5,$e);
            }
            else
            {
                // Etiqueta
                if($e[0]=='/')
                    $this->CloseTag(strtoupper(substr($e,1)));
                else
                {
                    // Extraer atributos
                    $a2 = explode(' ',$e);
                    $tag = strtoupper(array_shift($a2));
                    $attr = array();
                    foreach($a2 as $v)
                    {
                        if(preg_match('/([^=]*)=["\']?([^"\']*)/',$v,$a3))
                            $attr[strtoupper($a3[1])] = $a3[2];
                    }
                    $this->OpenTag($tag,$attr);
                }
            }
        }
    }

    function OpenTag($tag, $attr)
    {
        // Etiqueta de apertura
        if($tag=='B' || $tag=='I' || $tag=='U')
            $this->SetStyle($tag,true);
        if($tag=='A')
            $this->HREF = $attr['HREF'];
        if($tag=='BR')
            $this->Ln(5);
    }

    function CloseTag($tag)
    {
        // Etiqueta de cierre
        if($tag=='B' || $tag=='I' || $tag=='U')
            $this->SetStyle($tag,false);
        if($tag=='A')
            $this->HREF = '';
    }

    function SetStyle($tag, $enable)
    {
        // Modificar estilo y escoger la fuente correspondiente
        $this->$tag += ($enable ? 1 : -1);
        $style = '';
        foreach(array('B', 'I', 'U') as $s)
        {
            if($this->$s>0)
                $style .= $s;
        }
        $this->SetFont('',$style);
    }

    function PutLink($URL, $txt)
    {
        // Escribir un hiper-enlace
        $this->SetTextColor(0,0,255);
        $this->SetStyle('U',true);
        $this->Write(5,$txt,$URL);
        $this->SetStyle('U',false);
        $this->SetTextColor(0);
    }

    function Header(){
        global $title;
        $this->Image('../images/m1.png',10,5,190,40);
        $this->SetFont('Arial','B',15);
        $w = $this->GetStringWidth($title)+6;
        $this->SetX((210-$w)/2);
        $this->Cell(70,80,$title,0,0);
        $this->Ln(10);
    }

    function Footer()
    {
        $this->SetY(-15);
        $this->SetFont('Arial','I',8);
        $this->Cell(0,10,'Page '.$this->PageNo().'/{nb}',0,0,'C');
    }

    function ChapterTitle($label){
        $this->SetFont('Arial','',12);
        $this->Ln(4);
    }
}
$html = utf8_decode("Resumen Clínico: <br> </br><b>".$oEstReal->getNota()->getResumen()."</b><br> </br></br><br>");
$html2 = utf8_decode("Estudios de Imagenología Solicitados: <br> </br><b>".$oEstReal->getEstImagen()->getEstudioSolicitado()."</b><br> </br></br><br>");
$html3 = utf8_decode("Otros Estudios de Imagenología Solicitados: <br> </br><b>".$oEstReal->getEstImagen()->getOtrosEstudios()."</b><br> </br></br><br>");
$html4 = utf8_decode("Estudios de Laboratorio: <br> </br><b>".$oEstReal->getEstLab()->getEstudiosSolicitados()."</b><br> </br></br><br>");
$rep = new Reporte();
$rep->AliasNbPages();
$rep->AddPage();
$title = utf8_decode('REPORTE DE NOTA MÉDICA');
$rep->SetTitle($title);
$rep->SetFont('Times','',12);
$rep->Cell(0,10,'',0,1);
$rep->Cell(0,10,'',0,1);
$rep->Cell(0,10,utf8_decode('Reporte de Nota Médica'),0,1,'C');
$rep->Cell(0,5,utf8_decode('Nombre y No. Expediente: '." ".$oEstReal->getPaciente()->getApPaterno()." ".$oEstReal->getPaciente()->getApMaterno()." ".$oEstReal->getPaciente()->getNombre().' ('.$oEstReal->getPaciente()->getExpediente()->getNumero().')'),0,0,'L');
$rep->Ln();
$rep->Cell(0,5,utf8_decode('Edad: '.$oEstReal->getPaciente()->getEdad()." años"),0,0);
$rep->Ln();
$rep->Ln();
$rep->Cell(0,5,utf8_decode('Estudio realizado: '." ".$oEstReal->getEstudios()->getDescripcion()),0,0);
$rep->Ln();
$rep->Cell(0,5,utf8_decode('Nivel de Urgencia: '." ".$oEstReal->getEstImagen()->getNivelUrgencia()),0,0);
$rep->Ln();
$rep->Ln();
$rep->Cell(0,5,utf8_decode('Diagnóstico: '." ".$oEstReal->getDiagnostica()),0,0);
$rep->Ln();
$rep->WriteHTML($html);
$rep->Cell(0,5,utf8_decode('Presión Arterial: '." ".$oEstReal->getNota()->getPresionArterial()),0,0);
$rep->Ln();
$rep->Cell(0,5,utf8_decode('Signos Vitales: '." ".$oEstReal->getNota()->getSignosVitales()),0,0);
$rep->Ln();
$rep->Cell(0,5,utf8_decode('Temperatura: '." ".$oEstReal->getNota()->getTemperatura()."°C"),0,0);
$rep->Ln();
$rep->Ln();
$rep->WriteHTML($html2);
$rep->WriteHTML($html3);
$rep->Cell(0,5,utf8_decode('Región a estudiar solicitada: '." ".$oEstReal->getEstImagen()->getRegionSol()),0,0);
$rep->WriteHTML($html4);
$rep->Ln();
$rep->Cell(0,5,utf8_decode('Costo total del Estudio (Incluye I.V.A.) $'.$oEstReal->getRecibo()->getTotal()),0,0);
$rep->Ln();
$rep->Ln();
$rep->Cell(0,5,"                                             ".utf8_decode($oEstReal->getMedico()->getNombres()." ".$oEstReal->getMedico()->getApPaterno()." ".$oEstReal->getMedico()->getApMaterno() .", No. Cédula: ".$oEstReal->getMedico()->getNumCedula()."                              "),0,0);
$rep->Ln();
$rep->Cell(0,5,"                                               ________________________________________________                               ",0,0);
$rep->Ln();
$rep->Cell(0,5,utf8_decode("                                                    Nombre completo, matrícula y  firma del médico                      "),0,0);

$rep->Output();

?>