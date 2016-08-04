<?php

/**
 * Created by PhpStorm.
 * User: Pablo
 * Date: 03/08/2016
 * Time: 07:23 PM
 */
include_once ("AccesoDatos.php");
class Aseguradora
{
    private $nIdAseguradora=0;
    private $sNombre="";
    private $sDireccion="";
    private $sTelefono="";

    public function getIdAseguradora()
    {
        return $this->nIdAseguradora;
    }

    public function setIdAseguradora($nIdAseguradora)
    {
        $this->nIdAseguradora = $nIdAseguradora;
    }

    public function getNombre()
    {
        return $this->sNombre;
    }

    public function setNombre($sNombre)
    {
        $this->sNombre = $sNombre;
    }

    public function getDireccion()
    {
        return $this->sDireccion;
    }

    public function setDireccion($sDireccion)
    {
        $this->sDireccion = $sDireccion;
    }

    public function getTelefono()
    {
        return $this->sTelefono;
    }

    public function setTelefono($sTelefono)
    {
        $this->sTelefono = $sTelefono;
    }


}