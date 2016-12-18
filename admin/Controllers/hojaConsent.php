<?php
/**
 * Created by PhpStorm.
 * User: Pablo
 * Date: 29/09/2016
 * Time: 03:22 PM
 */
require_once ("../pdf/fpdf.php");
include_once ("../Class/Paciente.php");
include_once ("../Class/NotaIntervencion.php");
$oPaciente = new Paciente();
$oNota = new NotaIntervencion();
$oPaciente->setExpediente(new Expediente());
$oPaciente->getExpediente()->setNumero($_REQUEST['sExp']);
$oPaciente->busscarDatosPaciente();
$oNota->setPaciente(new Paciente());
$oNota->getPaciente()->setExpediente(new Expediente());
$oNota->getPaciente()->getExpediente()->setNumero($_REQUEST['sExp']);
$oNota->buscarDatosNotaInt();
$dFecha = new DateTime();
class PDF extends  FPDF{

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

    function ChapterBody($file){
        $txt = file_get_contents($file);
        $this->SetFont('Times','',12);
        $this->MultiCell(0,5,$txt);
        $this->Ln();
        $this->SetFont('','I');
    }

    function PrintChapter($title, $file){
        $this->AddPage();
        $this->ChapterTitle($title);
        $this->ChapterBody($file);
    }

    function PrintChapter2($title, $file){
        //$this->AddPage();
        $this->ChapterTitle($title);
        $this->ChapterBody($file);
    }

}

$html = utf8_decode('Electiva o Urgencias: <b>'.$oNota->getTipoOperacion().'</b> <br>.</br>'.
        'Diagnóstico previo al procedimiento o intervención quirúrgica: <b>'.$oNota->getDiagnosticoPreope().'asdasdasdasdadasdasdasd</b> <br>.</br>'.
        'Procedimiento o intervención quirúrgica  proyectada: <b>'.$oNota->getOperacionPlaneada().'</b> <br>.</br>'.
        'Riesgos más frecuentes inherentes al procedimiento o intervención quirúrgica y a las condiciones actuales del paciente: <b>'.$oNota->getRiesgos().'</b> <br>.</br>'.
        'Beneficios: <b>'.$oNota->getBeneficios().'</b> <br>.</br>');

$pdf = new PDF();
$pdf->AliasNbPages();
$title = 'Consentimiento Informado';
$pdf->SetTitle($title);
$pdf->PrintChapter('','ley1.txt');
$pdf->SetFont('Times','',12);
$pdf->Cell(0,5,utf8_decode('Nombre: '." ".$oPaciente->getApPaterno()." ".$oPaciente->getApMaterno()." ".$oPaciente->getNombre()),0,0,'L');
$pdf->Ln();
$pdf->Cell(0,5,utf8_decode('Expediente: '." ".$oPaciente->getExpediente()->getNumero()),0,0);
$pdf->Ln();
$pdf->Cell(0,5,utf8_decode('Edad: '." ".$oPaciente->getEdad()." años"),0,0);
$pdf->Ln();
$pdf->Cell(0,5,utf8_decode('Lugar y Fecha:  Córdoba Veracruz, '.$dFecha->format('d/m/Y')),0,0);
$pdf->Ln();
$pdf->Ln();
$pdf->SetFont('Times','B',14);
$pdf->Cell(0,5,utf8_decode(strtoupper('Yo: '." ".$oPaciente->getApPaterno()." ".$oPaciente->getApMaterno()." ".$oPaciente->getNombre())),0,0,'C');
$pdf->Ln();
$pdf->PrintChapter2('','msg1.txt');
$pdf->Ln();
$pdf->SetFont('Times','',12);
$pdf->WriteHTML($html);
$pdf->Ln();
$pdf->Ln();
$pdf->Ln();
$pdf->Cell(0,5,"           ________________________________                                ________________________________",0,0);
$pdf->Ln();
$pdf->Cell(0,5,"          Nombre completo y firma de paciente,                                       Nombre completo y firma del testigo",0,0);
$pdf->Ln();
$pdf->Cell(0,5,"          familiar, tutor o persona legalmente responsable",0,0);
$pdf->Ln();
$pdf->Ln();
$pdf->Cell(0,5,"          ".utf8_decode($oNota->getMedico()->getNombres()." ".$oNota->getMedico()->getApPaterno()." ".$oNota->getMedico()->getApMaterno().", ".$oNota->getMedico()->getNumCedula())."",0,0);
$pdf->Ln();
$pdf->Cell(0,5,"           ________________________________                                ________________________________",0,0);
$pdf->Ln();
$pdf->Cell(0,5,utf8_decode("          Nombre completo, matrícula y  firma del médico                       Nombre completo y firma del testigo"),0,0);
$pdf->Output();

?>