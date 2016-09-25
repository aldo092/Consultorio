<?php

/**
 * Created by PhpStorm.
 * User: Pablo
 * Date: 25/09/2016
 * Time: 11:25 AM
 */
include_once ("AccesoDatos.php");
class Antibioticos
{
    private $oAD = null;
    private $nIdAntibiotico = 0;
    private $sDescripcion = "";

    public function getAD()
    {
        return $this->oAD;
    }

    public function setAD($oAD)
    {
        $this->oAD = $oAD;
    }

    public function getIdAntibiotico()
    {
        return $this->nIdAntibiotico;
    }

    public function setIdAntibiotico($nIdAntibiotico)
    {
        $this->nIdAntibiotico = $nIdAntibiotico;
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
        $vObj = null;
        $rst = null;
        $oAnti = null;
        $sQuery = "";
        $i = 0;
        if($oAD->Conecta()){
            $sQuery = "call buscarTodosAntibioticos();";
            $rst = $oAD->ejecutaQuery($sQuery);
            $oAD->Desconecta();
        }
        if($rst){
            foreach ($rst as $vRow){
                $oAnti = new Antibioticos();
                $oAnti->setIdAntibiotico($vRow[0]);
                $oAnti->setDescripcion($vRow[1]);
                $vObj[$i] = $oAnti;
                $i = $i + 1;
            }
        }else{
            $vObj = false;
        }
        return $vObj;
    }

}