<?php
/**
 * Created by PhpStorm.
 * User: Aldo
 * Date: 08/02/2017
 * Time: 01:33 PM
 */
include_once ("AccesoDatos.php");
include_once ("Paciente.php");
include_once ("Medico.php");
require ("../pdf/fpdf.php");

class HojaGin
{
    private $oAD = null;
    private $Paciente = "";
    private $Medico = "";
    private $Padecimiento = "";
    private $TA = "";
    private $FC = "";
    private $FR = "";
    private $Temp = 0;
    private $Talla = 0;
    private $Peso = 0;
    private $IMC = 0;
    private $Exploracion = "";
    private $Laboratoriales = "";
    private $Terapeutica = "";
    private $Diagnosticos = "";

    public function getPaciente()
    {
        return $this->Paciente;
    }

    public function setPaciente($Paciente)
    {
        $this->Paciente = $Paciente;
    }


    public function getMedico()
    {
        return $this->Medico;
    }


    public function setMedico($Medico)
    {
        $this->Medico = $Medico;
    }


    public function getPadecimiento()
    {
        return $this->Padecimiento;
    }


    public function setPadecimiento($Padecimiento)
    {
        $this->Padecimiento = $Padecimiento;
    }


    public function getTA()
    {
        return $this->TA;
    }


    public function setTA($TA)
    {
        $this->TA = $TA;
    }


    public function getFC()
    {
        return $this->FC;
    }


    public function setFC($FC)
    {
        $this->FC = $FC;
    }


    public function getFR()
    {
        return $this->FR;
    }


    public function setFR($FR)
    {
        $this->FR = $FR;
    }


    public function getTemp()
    {
        return $this->Temp;
    }


    public function setTemp($Temp)
    {
        $this->Temp = $Temp;
    }


    public function getTalla()
    {
        return $this->Talla;
    }


    public function setTalla($Talla)
    {
        $this->Talla = $Talla;
    }


    public function getPeso()
    {
        return $this->Peso;
    }


    public function setPeso($Peso)
    {
        $this->Peso = $Peso;
    }


    public function getIMC()
    {
        return $this->IMC;
    }


    public function setIMC($IMC)
    {
        $this->IMC = $IMC;
    }


    public function getExploracion()
    {
        return $this->Exploracion;
    }


    public function setExploracion($Exploracion)
    {
        $this->Exploracion = $Exploracion;
    }


    public function getLaboratoriales()
    {
        return $this->Laboratoriales;
    }


    public function setLaboratoriales($Laboratoriales)
    {
        $this->Laboratoriales = $Laboratoriales;
    }


    public function getTerapeutica()
    {
        return $this->Terapeutica;
    }

    public function setTerapeutica($Terapeutica)
    {
        $this->Terapeutica = $Terapeutica;
    }


    public function getDiagnosticos()
    {
        return $this->Diagnosticos;
    }


    public function setDiagnosticos($Diagnosticos)
    {
        $this->Diagnosticos = $Diagnosticos;
    }


    function insertar($usuario)
    {
        $oAD = new AccesoDatos();
        $sQuery = "";
        $i = -1;
        if ($this->getPaciente() == "") {
            throw new Exception("Paciente->insertar(): error, faltan datos");
        } else {
            if ($oAD->Conecta()) {

                $sQuery = "call insertarHojaGin  ('" . $usuario . "',
                                                 '" . $this->Paciente . "',
                                                 '" . $this->Medico . "',
                                                 '" . $this->Padecimiento . "',
                                                 '" . $this->TA . "',  
                                                  '" . $this->FC . "',
                                                  '" . $this->FR . "',
                                                  '" . $this->Temp . "',
                                                  '" . $this->Talla . "',
                                                  '" . $this->Peso . "',
                                                  '" . $this->IMC . "',
                                                  '" . $this->Exploracion . "',
                                                  '" . $this->Laboratoriales . "',
                                                  '" . $this->Terapeutica . "',
                                                  '" . $this->Diagnosticos . "');";
                $i = $oAD->ejecutaComando($sQuery);
                $oAD->Desconecta();
            }
        }
        return $i;
    }


    function GenerarPDF($paciente,$expediente,$padecimiento,$TA,$FC, $FR, $Temp, $Talla, $Peso, $IMC, $exploracion,$Laboratoriales, $Terapeutica, $Diagnosticos,$Medico,$Cedula)
    {
        $fecha = date("j/n/Y");
        $pdf = new FPDF('P', 'mm', 'Letter');
        $pdf->AddPage();
        $pdf->Image('../images/Consulta2.jpg', 0, 0, 0, 0, 'JPG');
        $pdf->SetFont('Arial', '', 11);
        $pdf->Text(15, 12, utf8_decode($paciente));
        $pdf->Text(110, 12, $expediente);
        $pdf->Text(180, 12, $fecha);
        $pdf->setY(27);
        $pdf->setX(15);
        $pdf->MultiCell(0, 5, utf8_decode($padecimiento));
        $pdf->Text(92, 60, $TA);
        $pdf->Text(127, 60, $FC);
        $pdf->Text(157, 60, $FR);
        $pdf->Text(193, 60, $Temp);
        $pdf->Text(125, 68, $Talla);
        $pdf->Text(154, 68, $Peso);
        $pdf->Text(187, 68, $IMC);
        $pdf->setY(72);
        $pdf->setX(15);
        $pdf->MultiCell(0, 5, utf8_decode($exploracion));
        $pdf->setY(129);
        $pdf->setX(15);
        $pdf->MultiCell(0, 5, utf8_decode($Laboratoriales));
        $pdf->setY(165);
        $pdf->setX(15);
        $pdf->MultiCell(0, 5, utf8_decode($Terapeutica));
        $pdf->setY(203);
        $pdf->setX(15);
        $pdf->MultiCell(0, 5, utf8_decode($Diagnosticos));
        $pdf->setY(240);
        $pdf->setX(15);
        $pdf->MultiCell(60, 5, utf8_decode($Medico), 0, "C");
        $pdf->Text(170, 243, $Cedula);
        $pdf->SetAuthor('COEM');
        $nombreArchivo = "Historia Clinica de" . $paciente . $fecha . ".pdf";
        $pdf->Output($nombreArchivo, 'D');
    }

}








