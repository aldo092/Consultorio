<?php

/**
 * Created by PhpStorm.
 * User: Aldo
 * Date: 06/10/2016
 * Time: 02:05 PM
 */
include_once ("AccesoDatos.php");
include_once ("Paciente.php");
include_once ("Medico.php");
require ("../pdf/fpdf.php");

class Receta{
    private $oAD=null;
    private $Folio=0;
    private $oPaciente=null;
    private $oMedico=null;
    private $Descripcion="";
    private $Fecha_expedicion="";


    public function getOAD()
    {
        return $this->oAD;
    }

    public function setOAD($oAD)
    {
        $this->oAD = $oAD;
    }

    public function getFolio()
    {
        return $this->Folio;
    }

    public function setFolio($Folio)
    {
        $this->Folio = $Folio;
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


    public function getDescripcion()
    {
        return $this->Descripcion;
    }


    public function setDescripcion($Descripcion)
    {
        $this->Descripcion = $Descripcion;
    }

    public function getFechaExpedicion()
    {
        return $this->Fecha_expedicion;
    }


    public function setFechaExpedicion($Fecha_expedicion)
    {
        $this->Fecha_expedicion = $Fecha_expedicion;
    }

    function insertar($usuario){
        $oAD = new AccesoDatos();
        $sQuery = "";
        $i = -1;
        if($this->getPaciente() == ""){
            throw new Exception("Paciente->insertar(): error, faltan datos");
        }else{
            if($oAD->Conecta()){

                $sQuery = "call insertarReceta('".$usuario."',
                                                 '".$this->oPaciente."',
                                                 '".$this->Descripcion."',                                                   
                                                 '".$this->oMedico."');";
                $i = $oAD->ejecutaComando($sQuery);
                $oAD->Desconecta();
            }
        }
        return $i;
    }

    function RecetaPdf($paciente,$medicamento){

            $fecha = date("j/n/Y");
            $nombreArchivo = "Receta de " . $paciente . $fecha . ".pdf";

            $pdf = new FPDF('P', 'cm', 'rec');
            $pdf->AddPage();
            $pdf->Image('../images/urologo.jpg', 0, 0, 0, 0, 'JPG');
            /*Texto predeterminado*/
            $pdf->SetFont('Arial', '', 12);
            $pdf->Text(1, 5, "Paciente:");
            $pdf->Text(15, 4, "Fecha:");
            $pdf->Text(1, 6,"Medicamento:");
            /*Datos Cambiantes*/
            $pdf->SetFont('Courier', 'B', 14);
            $pdf->Text(3, 5, utf8_decode($paciente));
            $pdf->Text(16.5, 4, $fecha);
            $pdf->SetY(6);
            $pdf->MultiCell(0, 1, utf8_decode($medicamento));
        $pdf->SetAuthor('COEM');
            $pdf->Output($nombreArchivo, 'D');
        }

}