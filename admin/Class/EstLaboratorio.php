<?php

/**
 * Created by PhpStorm.
 * User: Pablo
 * Date: 25/09/2016
 * Time: 11:23 AM
 */
include_once ("EstudioRealizado.php");
class EstLaboratorio extends EstudioRealizado
{
    private $sEstudiosSolicitados = "";


    public function getEstudiosSolicitados()
    {
        return $this->sEstudiosSolicitados;
    }

    public function setEstudiosSolicitados($sEstudiosSolicitados)
    {
        $this->sEstudiosSolicitados = $sEstudiosSolicitados;
    }
}