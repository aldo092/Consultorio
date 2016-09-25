<?php

/**
 * Created by PhpStorm.
 * User: Pablo
 * Date: 25/09/2016
 * Time: 11:24 AM
 */
include_once ("AccesoDatos.php");
class ClasificacionHeridas
{
    private $oAD = null;
    private $nIdClasificacion = 0;
    private $sDescripcion = "";


    public function getAD()
    {
        return $this->oAD;
    }

    public function setAD($oAD)
    {
        $this->oAD = $oAD;
    }

    public function getIdClasificacion()
    {
        return $this->nIdClasificacion;
    }

    public function setIdClasificacion($nIdClasificacion)
    {
        $this->nIdClasificacion = $nIdClasificacion;
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
        $sQuery = "";
        $oHerida = null;
        $i = 0;
        if($oAD->Conecta()){
            $sQuery = "call buscarTodosHeridas();";
            $rst = $oAD->ejecutaQuery($sQuery);
            $oAD->Desconecta();
        }
        if($rst){
            foreach ($rst as $vRow){
                $oHerida = new ClasificacionHeridas();
                $oHerida->setIdClasificacion($vRow[0]);
                $oHerida->setDescripcion($vRow[1]);
                $vObj[$i] = $oHerida;
                $i = $i + 1;
            }
        }else{
            $vObj = false;
        }
        return $vObj;
    }

}