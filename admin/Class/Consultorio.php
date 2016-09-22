<?php

/**
 * Created by PhpStorm.
 * User: Pablo
 * Date: 04/08/2016
 * Time: 05:56 PM
 */
include_once ("AccesoDatos.php");
include_once ("Personal.php");

class Consultorio
{
    private $oAD=null;
    private $nIDconsultorio=0;
    private $Medico=0;
    private $Nombre="";


    public function getOAD()
    {
        return $this->oAD;
    }

    public function setOAD($oAD)
    {
        $this->oAD = $oAD;
    }

    public function getNIDconsultorio()
    {
        return $this->nIDconsultorio;
    }


    public function setNIDconsultorio($nIDconsultorio)
    {
        $this->nIDconsultorio = $nIDconsultorio;
    }

    public function getMedico()
    {
        return $this->Medico;
    }


    public function setMedico($Medico)
    {
        $this->Medico = $Medico;
    }


    public function getNombre()
    {
        return $this->Nombre;
    }

    public function setNombre($Nombre)
    {
        $this->Nombre = $Nombre;
    }

    function insertar($usuario){
        $oAD = new AccesoDatos();
        $sQuery = "";
        $i = 0;
        if($this->getMedico() == ""){
            throw new Exception("Paciente->insertar(): error, faltan datos");
        }else{
            if($oAD->Conecta()){
                $sQuery = "call insertarConsultorio('".$usuario."',
                                                 '".$this->Medico."',
                                                 '".$this->Nombre."');";
                $i = $oAD->ejecutaComando($sQuery);
                $oAD->Desconecta();
            }
        }
        return $i;
    }

    function TodosConsultorios(){

            $oAD = new AccesoDatos();
            $vObj = null;
            $rst = null;
            $sQuery = "";
            $i = 0;
            $oCon = null;
            $oPer=null;
            if($oAD->Conecta()){
                $sQuery = "call buscarTodosConsultorios();";
                $rst = $oAD->ejecutaQuery($sQuery);
                $oAD->Desconecta();
            }
            if($rst){
                foreach ($rst as $vRowTemp){
                    $oCon = new Consultorio();
                    $oPer= new Personal();
                    $oCon->setNIDconsultorio($vRowTemp[0]);
                    $oCon->setNombre($vRowTemp[1]);
                    $oCon->setMedico($vRowTemp[2]);

                    ($vRowTemp[2]);
                    ($vRowTemp[3]);
                    ($vRowTemp[4]);
                    $vObj[$i] = $oCon;
                    $i = $i + 1;
                }
            }else{
                $vObj = false;
            }
            return $vObj;
        }



}