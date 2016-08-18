<?php

/**
 * Created by PhpStorm.
 * User: Pablo
 * Date: 17/08/2016
 * Time: 01:11 PM
 */
include_once ("AccesoDatos.php");
include_once ("Funcion.php");
include_once ("Usuarios.php");
class Menu
{
    private $oAD = null;
    private $oFuncion = null;
    private $nClave = 0;
    private $sDescrip = "";
    private $nPadre = 0;
    private $oUsuario = null;
    private $arrFunciones;


    public function getArrFunciones()
    {
        return $this->arrFunciones;
    }

    public function setArrFunciones($arrFunciones)
    {
        $this->arrFunciones = $arrFunciones;
    }

    public function getUsuario()
    {
        return $this->oUsuario;
    }

    public function setUsuario($oUsuario)
    {
        $this->oUsuario = $oUsuario;
    }

    public function getAD()
    {
        return $this->oAD;
    }

    public function setAD($oAD)
    {
        $this->oAD = $oAD;
    }

    public function getFuncion()
    {
        return $this->oFuncion;
    }

    public function setFuncion($oFuncion)
    {
        $this->oFuncion = $oFuncion;
    }

    public function getClave()
    {
        return $this->nClave;
    }

    public function setClave($nClave)
    {
        $this->nClave = $nClave;
    }

    public function getDescrip()
    {
        return $this->sDescrip;
    }

    public function setDescrip($sDescrip)
    {
        $this->sDescrip = $sDescrip;
    }

    public function getPadre()
    {
        return $this->nPadre;
    }

    public function setPadre($nPadre)
    {
        $this->nPadre = $nPadre;
    }

    function buscarTodos(){
        $oAD = new AccesoDatos();
        $vObj = null;
        $rst = null;
        $sQuery = "";
        $i = 0;
        $oMenu = null;
        if($oAD->Conecta()){
            $sQuery = "call buscarTodosMenu();";
            $rst = $oAD->ejecutaQuery($sQuery);
            $oAD->Desconecta();
        }
        if($rst){
            foreach($rst as $vRowTemp){
                $oMenu = new Menu();
                $oMenu->setClave($vRowTemp[0]);
                $oMenu->setDescrip($vRowTemp[1]);
                $oMenu->setPadre($vRowTemp[2]);
                $vObj[$i] = $oMenu;
                $i = $i + 1;
            }
        }else{
            $vObj = false;
        }
        return $vObj;
    }

    function buscarMenuUsuario(){
        $oAD = new AccesoDatos();
        $vObj = null;
        $rst = null;
        $sQuery = "";
        $i = 0;
        $sValor = "";
        $oFuncion = null;
        $oMenu = null;
        if($this->getUsuario()->getEmail() == ""){
            throw new Exception("Menu->buscarMenuUsuario(): error, faltan datos");
        }else{
            if($oAD->Conecta()){
                $sQuery = "call buscarPermisos('".$this->getUsuario()->getEmail()."');";
                $rst = $oAD->ejecutaQuery($sQuery);
                $oAD->Desconecta();
            }
            if($rst){
                foreach ($rst as $vRow){
                    $oMenu = new Menu();
                    $oMenu->setFuncion(new Funcion());
                    $oMenu->setClave($vRow[0]);
                    $oMenu->setDescrip($vRow[1]);
                    $oMenu->setArrFunciones($oMenu->getFuncion()->buscarFuncionPorMenu($this->getUsuario()->getEmail(), $oMenu->getClave()));
                    //var_dump($oMenu->getArrFunciones());
                    if($this->arrFunciones==null)
                        $this->arrFunciones = array();
                    $vObj[$i] = $oMenu;
                    $i = $i + 1;
                }

            }else{
                $vObj = false;
            }
        }
        return $vObj;
    }



}

?>