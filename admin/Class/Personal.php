<?php

/**
 * Created by PhpStorm.
 * User: Pablo
 * Date: 03/08/2016
 * Time: 07:31 PM
 */
include_once ("AccesoDatos.php");
class Personal
{
    private $nIdPersonal=0;
    private $sNombres="";
    private $sApPaterno="";
    private $sApMaterno="";
    private $sTelefono="";
    private $sPuesto="";
    private $sSexo="";
    private $sCURP="";


    public function getIdPersonal()
    {
        return $this->nIdPersonal;
    }

    public function setIdPersonal($nIdPersonal)
    {
        $this->nIdPersonal = $nIdPersonal;
    }

    public function getNombres()
    {
        return $this->sNombres;
    }

    public function setNombres($sNombres)
    {
        $this->sNombres = $sNombres;
    }

    public function getApPaterno()
    {
        return $this->sApPaterno;
    }

    public function setApPaterno($sApPaterno)
    {
        $this->sApPaterno = $sApPaterno;
    }

    public function getApMaterno()
    {
        return $this->sApMaterno;
    }

    public function setApMaterno($sApMaterno)
    {
        $this->sApMaterno = $sApMaterno;
    }

    public function getTelefono()
    {
        return $this->sTelefono;
    }

    public function setTelefono($sTelefono)
    {
        $this->sTelefono = $sTelefono;
    }

    public function getPuesto()
    {
        return $this->sPuesto;
    }

    public function setPuesto($sPuesto)
    {
        $this->sPuesto = $sPuesto;
    }

    public function getSexo()
    {
        return $this->sSexo;
    }

    public function setSexo($sSexo)
    {
        $this->sSexo = $sSexo;
    }

    public function getCURP()
    {
        return $this->sCURP;
    }

    public function setCURP($sCURP)
    {
        $this->sCURP = $sCURP;
    }

}