<?php

/**
 * Created by PhpStorm.
 * User: Pablo
 * Date: 03/08/2016
 * Time: 08:04 PM
 */

include_once ("AccesoDatos.php");
include_once ("Consultorio.php");
class Horarios
{
    private $oAD = null;
    private $oConsultorio=null;
    private $sDia="";
    private $sHorarioInicio="";
    private $sHorarioFin="";


    public function getAD()
    {
        return $this->oAD;
    }

    public function setAD($oAD)
    {
        $this->oAD = $oAD;
    }

    public function getConsultorio()
    {
        return $this->oConsultorio;
    }

    public function setConsultorio($oConsultorio)
    {
        $this->oConsultorio = $oConsultorio;
    }

    public function getDia()
    {
        return $this->sDia;
    }

    public function setDia($sDia)
    {
        $this->sDia = $sDia;
    }
    
    public function getHorarioInicio()
    {
        return $this->sHorarioInicio;
    }

    public function setHorarioInicio($sHorarioInicio)
    {
        $this->sHorarioInicio = $sHorarioInicio;
    }

    public function getHorarioFin()
    {
        return $this->sHorarioFin;
    }

    public function setHorarioFin($sHorarioFin)
    {
        $this->sHorarioFin = $sHorarioFin;
    }




    function buscarHorarios($consultorio,$fecha,$Dia){
        $oAD = new AccesoDatos();
        $vObj = null;
        $rst = null;
        $sQuery = "";
        $i = 0;
        if($oAD->Conecta()){
            $sQuery = "call buscarHorariosDisponibles(".$consultorio.",'".$fecha."','".$Dia."');";
            $rst = $oAD->ejecutaQuery($sQuery);
            $oAD->Desconecta();
        }
        if($rst){
            foreach ($rst as $vRowTemp){
                $oHor = new Horarios();
                $oHor->setConsultorio($vRowTemp[0]);
                $oHor->setHorarioInicio($vRowTemp[1]);
                $oHor->setHorarioFin($vRowTemp[2]);

                $vObj[$i] = $oHor;
                $i = $i + 1;
            }
        }else{
            $vObj = false;
        }
        return $vObj;
    }


    function get_nombre_dia($fecha){
        $fechats = strtotime($fecha);
        switch (date('w', $fechats)){
            case 0: return "Domingo"; break;
            case 1: return "Lunes"; break;
            case 2: return "Martes"; break;
            case 3: return "Miercoles"; break;
            case 4: return "Jueves"; break;
            case 5: return "Viernes"; break;
            case 6: return "Sabado"; break;
        }
            }
    
}