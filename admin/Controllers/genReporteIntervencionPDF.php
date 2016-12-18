<?php
/**
 * Created by PhpStorm.
 * User: Pablo
 * Date: 30/10/2016
 * Time: 10:39 PM
 */
require_once ("../pdf/fpdf.php");
require_once ("../Class/NotaIntervencion.php");
$oNota = new NotaIntervencion();
$nId = $_POST['txtIdNota'];

$oNota->setIdNota($nId);
$oNota->buscarResultadoNota();
class PDF extends FPDF{
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
$html = utf8_decode("Nombre del Paciente: <b>". $oNota->getPaciente()->getNombre()." ".$oNota->getPaciente()->getApPaterno()." ".$oNota->getPaciente()->getApMaterno() ."</b> <br>.</br>".
                   "Expediente: <b>".$oNota->getPaciente()->getExpediente()->getNumero()."</b><br> </br>".
				   "<br> </br>".
				   "Nombre del Cirujano y número de cédula: <b>".$oNota->getCirujano().", ".$oNota->getCedCirujano()."</b><br> </br>".
				   "Nombre del Anestesiólogo y número de cédula: <b>".$oNota->getAnestesiologo().", ".$oNota->getCedAnestesio()."</b><br> </br>".
				   "<br> </br>".
				   "Diagnóstico Preoperatorio: <br> </br><b>".$oNota->getDiagnosticoPreope()."</b><br> </br><br> </br>".
				   "Operación Realizada: <br> </br><b>".$oNota->getOperacionRealizada()."</b><br> </br><br> </br>".
				   "Examen Histopatológico Transoperatorio Solicitado: <br> </br><b>".$oNota->getExaHistoTransSol()."</b><br> </br><br> </br>".
				   "Otros Estudios Trasoperatorio: <br> </br><b>".$oNota->getOtrosEstTras()."</b><br> </br><br> </br>".
				   "Anestesia Administrada: <b>".$oNota->getAnestesiaAplicada()->getDescripcion()."</b><br> </br><br> </br>".
				   "Fecha y hora del Procedimiento: <b>".$oNota->getFechaProcedimiento()." ".$oNota->getHoraProce()."</b><br> </br><br> </br>".
				   "Descripción Técnica: <br> </br><b> ".$oNota->getDescripcionTecnica()."</b><br> </br></br><br>".
				   "Hallazgos transoperatorio: <br> </br><b> ".$oNota->getHallazgos()."</b><br> </br></br><br>".
				   "Incidentes: <br> </br><b> ".$oNota->getIncidentes()."</b><br> </br></br><br>".
				   "Accidentes: <br> </br><b> ".$oNota->getAccidentes()."</b><br> </br></br><br>");
$html2 = utf8_decode("Complicaciones Transoperatorias: <br> </br><b> ".$oNota->getComplicaciones()."</b><br> </br></br><br>".
					"");

$pdf = new PDF();
$pdf->AliasNbPages();
$pdf->AddPage();
$pdf->SetFont('Times','',12);
$pdf->Cell(0,10,'',0,1);
$pdf->Cell(0,10,'',0,1);
$pdf->Cell(0,10,'Reporte de Procedimiento',0,1,'C');
$pdf->WriteHTML($html);
$pdf->AddPage();
$pdf->SetFont('Times','',12);
$pdf->Cell(0,10,'',0,1);
$pdf->Cell(0,10,'',0,1);
$pdf->Cell(0,10,'',0,1);
$pdf->WriteHTML($html2);
$pdf->Output();
?>