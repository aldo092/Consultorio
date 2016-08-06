<?php

/**
 * Created by PhpStorm.
 * User: Pablo
 * Date: 04/08/2016
 * Time: 03:37 PM
 */
include_once ("AccesoDatos.php");
include_once ("Perfil.php");
class Usuarios
{
    private $oAD = null;
    private $nIdUsuario = "";
    private $sEmail = "";
    private $sPassword = "";
    private $dFechaRegistro;
    private $arrPerfil = null;
    private $oPersonal = null;


    public function getAD()
    {
        return $this->oAD;
    }

    public function setAD($oAD)
    {
        $this->oAD = $oAD;
    }

    public function getIdUsuario()
    {
        return $this->nIdUsuario;
    }

    public function setIdUsuario($nIdUsuario)
    {
        $this->nIdUsuario = $nIdUsuario;
    }

    public function getEmail()
    {
        return $this->sEmail;
    }

    public function setEmail($sEmail)
    {
        $this->sEmail = $sEmail;
    }

    public function getPassword()
    {
        return $this->sPassword;
    }

    public function setPassword($sPassword)
    {
        $this->sPassword = $sPassword;
    }

    public function getFechaRegistro()
    {
        return $this->dFechaRegistro;
    }

    public function setFechaRegistro($dFechaRegistro)
    {
        $this->dFechaRegistro = $dFechaRegistro;
    }

    public function getArrPerfil()
    {
        return $this->arrPerfil;
    }

    public function setArrPerfil($arrPerfil)
    {
        $this->arrPerfil = $arrPerfil;
    }

    public function getPersonal()
    {
        return $this->oPersonal;
    }

    public function setPersonal($oPersonal)
    {
        $this->oPersonal = $oPersonal;
    }

    

}