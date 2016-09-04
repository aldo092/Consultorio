<?php

/**
 * Created by PhpStorm.
 * User: Pablo
 * Date: 02/09/2016
 * Time: 03:55 PM
 */
include_once ("AccesoDatos.php");
class Bitacora
{
    private $oAD = null;
    private $nClaveAccion = 0;
    private $sEmail = "";
    private $sTabla = "";
    private $dFechaAccion = null;
    private $sDescripcionAccion = "";


    public function getAD()
    {
        return $this->oAD;
    }

    public function setAD($oAD)
    {
        $this->oAD = $oAD;
    }

    public function getClaveAccion()
    {
        return $this->nClaveAccion;
    }

    public function setClaveAccion($nClaveAccion)
    {
        $this->nClaveAccion = $nClaveAccion;
    }

    public function getEmail()
    {
        return $this->sEmail;
    }

    public function setEmail($sEmail)
    {
        $this->sEmail = $sEmail;
    }

    public function getTabla()
    {
        return $this->sTabla;
    }

    public function setTabla($sTabla)
    {
        $this->$sTabla = $sTabla;
    }

    public function getFechaAccion()
    {
        return $this->dFechaAccion;
    }

    public function setFechaAccion($dFechaAccion)
    {
        $this->dFechaAccion = $dFechaAccion;
    }

    public function getDescripcionAccion()
    {
        return $this->sDescripcionAccion;
    }

    public function setDescripcionAccion($sDescripcionAccion)
    {
        $this->sDescripcionAccion = $sDescripcionAccion;
    }

    function consultarBitacora(){
        $oAD = new AccesoDatos();
        $rst = null;
        $sQuery = "";
        $vObj = null;
        $i = 0;
        $oBitacora = null;
        if($oAD->Conecta()){
            $sQuery = "call consultarBitacora();";
            $rst = $oAD->ejecutaQuery($sQuery);
            $oAD->Desconecta();
        }
        if($rst){
            foreach ($rst as $vRow){
                $oBitacora = new Bitacora();
                $oBitacora->setClaveAccion($vRow[0]);
                $oBitacora->setEmail($vRow[1]);
                $oBitacora->setFechaAccion($vRow[2]);
                $oBitacora->setTabla($vRow[3]);
                $oBitacora->setDescripcionAccion($vRow[4]);
                $vObj[$i] = $oBitacora;
                $i = $i + 1;
            }
        }else{
            $vObj = false;
        }
        return $vObj;
    }

}