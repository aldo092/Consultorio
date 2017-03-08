<?php

/**
 * Created by PhpStorm.
 * User: Pablo
 * Date: 17/08/2016
 * Time: 01:11 PM
 */
class Funcion
{
    private $oAD = null;
    private $nClaveFuncion = 0;
    private $sDescripcion = "";
    private $sRutaPag = "";
    private $nPadre = 0;


    public function getPadre()
    {
        return $this->nPadre;
    }

    public function setPadre($nPadre)
    {
        $this->nPadre = $nPadre;
    }

    public function getAD()
    {
        return $this->oAD;
    }

    public function setAD($oAD)
    {
        $this->oAD = $oAD;
    }

    public function getClaveFuncion()
    {
        return $this->nClaveFuncion;
    }

    public function setClaveFuncion($nClaveFuncion)
    {
        $this->nClaveFuncion = $nClaveFuncion;
    }

    public function getDescripcion()
    {
        return $this->sDescripcion;
    }

    public function setDescripcion($sDescripcion)
    {
        $this->sDescripcion = $sDescripcion;
    }

    public function getRutaPag()
    {
        return $this->sRutaPag;
    }

    public function setRutaPag($sRutaPag)
    {
        $this->sRutaPag = $sRutaPag;
    }

    function buscarFuncionPorMenu($user, $clave){
        $oAD = new AccesoDatos();
        $vObj = null;
        $rst = null;
        $sQuery = "";
        $i= 0;
        $oFuncioon = null;
        if($user == "" && $clave == ""){
            throw new Exception("Funcion->buscarFuncionPorMenu(): error, faltan datos");
        }else{
            if($oAD->Conecta()){
                $sQuery = "call buscarFunciones('".$user."',".$clave.");";
                $rst = $oAD->ejecutaQuery($sQuery);
                $oAD->Desconecta();
            }
            if($rst){
                foreach ($rst as $vRow){
                    $oFuncion = new Funcion();
                    $oFuncion->setClaveFuncion($vRow[0]);
                    $oFuncion->setDescripcion($vRow[1]);
                    $oFuncion->setRutaPag($vRow[2]);
                    $oFuncion->setPadre($vRow[3]);
                    $vObj[$i] = $oFuncion;
                    $i = $i + 1;
                }
            }else{
                $vObj = false;
            }
        }
        return $vObj;
    }

    function checkRoot($usuario, $sruta){
        $oAD = new AccesoDatos();
        $sQuery = "";
        $rst = null;
        $bRet = false;
        if($usuario == "" and $sruta == ""){
            throw new Exception("Funcion->checkRoot(): error, faltan datos");
        }else{
            if($oAD->Conecta()){
                $sQuery = "call checkAccess('".$usuario."','".$sruta."');";
                var_dump($sQuery);
                $rst = $oAD->ejecutaQuery($sQuery);
                $oAD->Desconecta();
                if($rst){
                    if($rst[0][0] != ""){
                        $bRet = true;
                    }
                }
            }
        }
        return $bRet;
    }

}

?>