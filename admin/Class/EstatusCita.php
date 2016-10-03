<?php
/**
 * Created by PhpStorm.
 * User: Aldo
 * Date: 30/09/2016
 * Time: 11:11 PM
 */

include_once ("AccesoDatos.php");

class EstatusCita{

    private $nIdEstatus=0;
    private $nombre="";

    public function getNIdEstatus()
    {
        return $this->nIdEstatus;
    }

    public function setNIdEstatus($nIdEstatus)
    {
        $this->nIdEstatus = $nIdEstatus;
    }

    public function getNombre()
    {
        return $this->nombre;
    }

    public function setNombre($nombre)
    {
        $this->nombre = $nombre;
    }

    function BuscarEstatus (){
        $oAD = new AccesoDatos();
        $vObj = null;
        $rst = null;
        $sQuery = "";
        $i = 0;
        $oEstatus = null;
        if($oAD->Conecta()){
            $sQuery = "call BuscaEstatus();";
            $rst = $oAD->ejecutaQuery($sQuery);
            $oAD->Desconecta();

        }
        if($rst){
            foreach ($rst as $vRowTemp){
                $oEstatus = new EstatusCita();
                $oEstatus->setNIdEstatus($vRowTemp[0]);
                $oEstatus->setNombre($vRowTemp[1]);
                $vObj[$i] = $oEstatus;
                $i = $i + 1;
            }
        }else{
            $vObj = false;



        }
        return $vObj;

    }



}