<?php

/**
 * Created by PhpStorm.
 * User: Aldo
 * Date: 04/09/2016
 * Time: 12:17 AM
 */
include_once ("AccesoDatos.php");

class Estados
{
    private $oAD = null;
    private $IDEstado=0;
    private $NombreEdo="";
    private $IDMunicipio=0;
    private $NombreMun="";


    public function getAD()
    {
        return $this->oAD;
    }

    public function setAD($oAD)
    {
        $this->oAD = $oAD;
    }

    public function getIDEstado()
    {
        return $this->IDEstado;
    }

    public function setIDEstado($IDEstado)
    {
        $this->IDEstado = $IDEstado;
    }


    public function getNombreEdo()
    {
        return $this->NombreEdo;
    }


    public function setNombreEdo($NombreEdo)
    {
        $this->NombreEdo = $NombreEdo;
    }


    public function getIDMunicipio()
    {
        return $this->IDMunicipio;
    }

    public function setIDMunicipio($IDMunicipio)
    {
        $this->IDMunicipio = $IDMunicipio;
    }

    public function getNombreMun()
    {
        return $this->NombreMun;
    }


    public function setNombreMun($NombreMun)
    {
        $this->NombreMun = $NombreMun;
    }

    function buscarEstados(){
        $oAD = new AccesoDatos();
        $vObj = null;
        $rst = null;
        $sQuery = "";
        $i = 0;
        $oRol = null;
        if($oAD->Conecta()){
            $sQuery = "call buscarEstados();";
            $rst = $oAD->ejecutaQuery($sQuery);
            $oAD->Desconecta();
        }
        if($rst){
            foreach ($rst as $vRowTemp){
                $oEdo = new Estados();
                $oEdo->setIDEstado($vRowTemp[0]);
                $oEdo->setNombreEdo($vRowTemp[1]);
                $vObj[$i] = $oEdo;
                $i = $i + 1;
            }
        }else{
            $vObj = false;
        }
        return $vObj;
    }


    function buscarMunicipios($dato){
        $oAD = new AccesoDatos();
        $vObj = null;
        $rst = null;
        $sQuery = "";
        $i = 0;
        $oRol = null;
        if($oAD->Conecta()){
            $sQuery = "call buscarMunicipios(".$dato.");";
            $rst = $oAD->ejecutaQuery($sQuery);
            $oAD->Desconecta();
        }
        if($rst){
            foreach ($rst as $vRowTemp){
                $oEdo = new Estados();
                $oEdo->setIDMunicipio($vRowTemp[0]);
                $oEdo->setNombreMun($vRowTemp[1]);
                $vObj[$i] = $oEdo;
                $i = $i + 1;
            }
        }else{
            $vObj = false;
        }
        return $vObj;
    }




}