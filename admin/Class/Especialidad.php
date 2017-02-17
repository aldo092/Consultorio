<?php

/**
 * Created by PhpStorm.
 * User: Pablo
 * Date: 07/09/2016
 * Time: 07:47 PM
 */
include_once ("AccesoDatos.php");
class Especialidad
{
    private $oAD = null;
    private $nIdEspecialidad = 0;
    private $sDescripcion = "";


    public function getAD()
    {
        return $this->oAD;
    }

    public function setAD($oAD)
    {
        $this->oAD = $oAD;
    }

    public function getIdEspecialidad()
    {
        return $this->nIdEspecialidad;
    }

    public function setIdEspecialidad($nIdEspecialidad)
    {
        $this->nIdEspecialidad = $nIdEspecialidad;
    }

    public function getDescripcion()
    {
        return $this->sDescripcion;
    }

    public function setDescripcion($sDescripcion)
    {
        $this->sDescripcion = $sDescripcion;
    }

    function buscarTodos(){
        $oAD = new AccesoDatos();
        $rst = null;
        $vObj = null;
        $sQuery = "";
        $oEspe = null;
        $i = 0;
        if($oAD->Conecta()){
            $sQuery = "call buscarTodosEspecialidad();";
            $rst = $oAD->ejecutaQuery($sQuery);
            $oAD->Desconecta();
        }
        if($rst){
            foreach ($rst as $vRow){
                $oEspe = new Especialidad();
                $oEspe->setIdEspecialidad($vRow[0]);
                $oEspe->setDescripcion($vRow[1]);
                $vObj[$i] = $oEspe;
                $i = $i + 1;
            }
        }else{
            $vObj = false;
        }
        return $vObj;
    }

    function medicoEspecialidad($medico){
        $oAD = new AccesoDatos();
        $rst = null;
        $vObj = null;
        $oNota = null;
        $sQuery = "";
        $i = 0;
        if ($oAD->Conecta()) {
            $sQuery = "call especialidad('".$medico."');";
            $rst = $oAD->ejecutaQuery($sQuery);
            $oAD->Desconecta();
        }
        if ($rst) {
            $this->setIdEspecialidad($rst[0][0]);
            $bRet=true;
        }
        return $bRet;

    }

}