<?php

/**
 * Created by PhpStorm.
 * User: Pablo
 * Date: 25/09/2016
 * Time: 11:24 AM
 */
include_once ("AccesoDatos.php");
class Anestesia
{
    private $oAD = null;
    private $nIdAnestesia = 0;
    private $sDescripcion = "";


    public function getAD()
    {
        return $this->oAD;
    }

    public function setAD($oAD)
    {
        $this->oAD = $oAD;
    }

    public function getIdAnestesia()
    {
        return $this->nIdAnestesia;
    }

    public function setIdAnestesia($nIdAnestesia)
    {
        $this->nIdAnestesia = $nIdAnestesia;
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
        $i = 0;
        $oAnest = null;
        $sQuery = "";
        if($oAD->Conecta()){
            $sQuery = "call buscarTodosAnestesia();";
            $rst = $oAD->ejecutaQuery($sQuery);
            $oAD->Desconecta();
        }
        if($rst){
            foreach ($rst as $vRow){
                $oAnest = new Anestesia();
                $oAnest->setIdAnestesia($vRow[0]);
                $oAnest->setDescripcion($vRow[1]);
                $vObj[$i] = $oAnest;
                $i = $i + 1;
            }
        }else{
            $vObj = false;
        }
        return $vObj;
    }

}