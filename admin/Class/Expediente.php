<?php

/**
 * Created by PhpStorm.
 * User: Pablo
 * Date: 03/08/2016
 * Time: 07:02 PM
 */
include_once ("Paciente.php");
include_once ("AccesoDatos.php");
class Expediente
{
    private $oPaciente;
    private $nNumero=0;


    public function getOPaciente()
    {
        return $this->oPaciente;
    }

    public function setOPaciente($oPaciente)
    {
        $this->oPaciente = $oPaciente;
    }

    public function getNNumero()
    {
        return $this->nNumero;
    }

    public function setNNumero($nNumero)
    {
        $this->nNumero = $nNumero;
    }

}