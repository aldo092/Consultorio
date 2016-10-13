<?php

/**
 * Created by PhpStorm.
 * User: Pablo
 * Date: 25/09/2016
 * Time: 11:24 AM
 */
include_once ("AccesoDatos.php");
class ManejoHeridas
{
    private $oAD = null;
    private $nIdManejo = 0;
    private $sDescripcion = "";


    public function getAD()
    {
        return $this->oAD;
    }

    public function setAD($oAD)
    {
        $this->oAD = $oAD;
    }

    public function getIdManejo()
    {
        return $this->nIdManejo;
    }

    public function setIdManejo($nIdManejo)
    {
        $this->nIdManejo = $nIdManejo;
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
        $oManejo = null;
        $i = 0;
        if($oAD->Conecta()){
            $sQuery = "call buscarTodosManejo();";
            $rst = $oAD->ejecutaQuery($sQuery);
            $oAD->Desconecta();
        }
        if($rst){
            foreach ($rst as $vRow){
                $oManejo = new ManejoHeridas();
                $oManejo->setIdManejo($vRow[0]);
                $oManejo->setDescripcion($vRow[1]);
                $vObj[$i] = $oManejo;
                $i = $i + 1;
            }
        }else{
            $vObj = false;
        }
        return $vObj;
    }

}