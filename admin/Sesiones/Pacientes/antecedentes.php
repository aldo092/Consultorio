<?php

error_reporting(E_ALL);
include_once ("../../Class/Usuarios.php");
session_start();
$oUser = new Usuarios();
$sErr = "";
if(isset($_SESSION['sUser']) && !empty($_SESSION['sUser'])){
$oUser = $_SESSION['sUser'];
}else{
$sErr = "Acceso denegado, inicie sesión";
}

if($sErr != ""){
header("Location: error.php?sError=".$sErr);
}

?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <!-- Meta, title, CSS, favicons, etc. -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Consultorio Médico</title>

    <!-- Bootstrap -->
    <link href="../../../vendors/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link href="../../../vendors/font-awesome/css/font-awesome.min.css" rel="stylesheet">
    <!-- NProgress -->
    <link href="../../../vendors/nprogress/nprogress.css" rel="stylesheet">
    <!-- iCheck -->
    <link href="../../../vendors/iCheck/skins/flat/green.css" rel="stylesheet">
    <!-- bootstrap-progressbar -->
    <link href="../../../vendors/bootstrap-progressbar/css/bootstrap-progressbar-3.3.4.min.css" rel="stylesheet">
    <!-- JQVMap -->
    <link href="../../../vendors/jqvmap/dist/jqvmap.min.css" rel="stylesheet"/>

    <!-- Custom Theme Style -->
    <link href="../../../build/css/custom.min.css" rel="stylesheet">
</head>

<body class="nav-md">
<div class="container body">
    <div class="main_container">
        <div class="col-md-3 left_col">
            <div class="left_col scroll-view">
                <div class="navbar nav_title" style="border: 0;">
                    <a href="menuprincipal.html" class="site_title"><i class="fa fa-plus-square"></i> <span>Control Médico</span></a>
                </div>

                <div class="clearfix"></div>

                <!-- menu profile quick info -->
                <div class="profile">
                    <div class="profile_pic">
                        <img src="../../images/img.png" alt="..." class="img-circle profile_img">
                    </div>
                    <div class="profile_info">
                        <span>Bienvenido</span>
                        <h2>Usuario</h2>
                    </div>
                </div>
                <!-- /menu profile quick info -->

                <br />

                <!-- sidebar menu -->
                <div id="sidebar-menu" class="main_menu_side hidden-print main_menu">
                    <div class="menu_section">
                        <h3>Menú</h3>
                        <ul class="nav side-menu">
                            <li><a><i class="fa fa-home"></i> Principal<span class="fa fa-chevron-down"></span></a>
                                <ul class="nav child_menu">
                                    <li><a href="menuprincipal.html">Principal</a></li>
                                </ul>
                            </li>
                            <li><a><i class="fa fa-edit"></i> Pacientes <span class="fa fa-chevron-down"></span></a>
                                <ul class="nav child_menu">
                                    <li><a href="registroPacientes.php">Registro de Pacientes</a></li>


                                </ul>
                            </li>
                            <li><a><i class="fa fa-desktop"></i> Usuarios <span class="fa fa-chevron-down"></span></a>
                                <ul class="nav child_menu">
                                    <li><a href="NUsuario.html">Crear Usuario</a></li>
                                </ul>
                            </li>
                            <li><a><i class="fa fa-table"></i> Estudios <span class="fa fa-chevron-down"></span></a>
                                <ul class="nav child_menu">
                                    <li><a href="tables.html">Estudios</a></li>
                                </ul>
                            </li>
                            <li><a><i class="fa fa-bar-chart-o"></i> Reportes<span class="fa fa-chevron-down"></span></a>
                                <ul class="nav child_menu">
                                    <li><a href="reportes.html">Reportes</a></li>
                                </ul>
                            </li>
                        </ul>
                    </div>


                </div>

            </div>
        </div>
    </div>
    </div>

        <!-- top navigation -->
        <div class="top_nav">
            <div class="nav_menu">
                <nav>
                    <div class="nav toggle">
                        <a id="menu_toggle"><i class="fa fa-bars"></i></a>
                    </div>

                    <ul class="nav navbar-nav navbar-right">
                        <li class="">
                            <a href="javascript:;" class="user-profile dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
                                <img src="../../images/img.png" alt="">Usuario
                                <span class=" fa fa-angle-down"></span>
                            </a>
                            <ul class="dropdown-menu dropdown-usermenu pull-right">

                                <li><a href="../../login.html"><i class="fa fa-sign-out pull-right"></i>Salir de la Sesión</a></li>
                            </ul>
                        </li>
                    </ul>
                </nav>
            </div>
        </div>


        <!-- /top navigation -->

        <!-- page content -->
        <div class="right_col" role="main">
            <div class="">
                <div class="page-title">
                    <div class="title_left">
                        <h3>Registro de Antecedentes de Pacientes </h3>
                    </div>


                </div>
                <div class="clearfix"></div>
                <div class="row">
                    <div class="col-md-12 col-sm-12 col-xs-12">
                        <div class="x_panel">
                            <div class="x_title">
                                <h2>favor de capturar todos los campos</h2>

                                <div class="clearfix"></div>
                            </div>
                            <div class="x_content">
                                <br>
                                <ul id="myTab" class="nav nav-tabs bar_tabs" role="tablist">
                                    <li role="presentation" class="active"><a href="#tab_content1" id="AntFam"
                                                                              role="tab" data-toggle="tab"
                                                                              aria-expanded="true">Antecentes
                                        Familiares</a>
                                    </li>
                                    <li role="presentation" class=""><a href="#tab_content2" role="tab" id="AntPat"
                                                                        data-toggle="tab" aria-expanded="false">Antecedentes
                                        Patológicos</a>
                                    </li>
                                    <li role="presentation" class=""><a href="#tab_content3" role="tab" id="AntNPat"
                                                                        data-toggle="tab" aria-expanded="false">Antecedentes
                                        No patológicos</a>
                                    </li>
                                    <li role="presentation" class=""><a href="#tab_content4" role="tab" id="AntGin"
                                                                        data-toggle="tab" aria-expanded="false">Antecentes
                                        ginecoobstetricos</a>
                                    </li>
                                </ul>
                                <div id="myTabContent" class="tab-content">
                                    <div role="tabpanel" class="tab-pane fade active in" id="tab_content1"
                                         aria-labelledby="home-tab">

                                        <form class="form-horizontal" role="form" method="post"
                                              action="../../Controllers/CtrlAntFam.php">
                                            <div class="form-group ">
                                                <div class="col-md-4 col-md-offset-4">

                                                    <div class="form-group">
                                                        <label class="control-label col-xs-7 ">Existen familiares con
                                                            alcoholismo</label>
                                                        <div class="col-xs-2">
                                                            <label class="radio-inline">
                                                                <input type="radio" name="alcoholismo" value="si"> si
                                                            </label>
                                                        </div>
                                                        <div class="col-xs-2">
                                                            <label class="radio-inline">
                                                                <input type="radio" name="alcoholismo" value="no"> no
                                                            </label>
                                                        </div>
                                                    </div>
                                                    <div class="form-group">
                                                        <label class="control-label col-xs-7">Existen familiares con
                                                            tabaquismo</label>
                                                        <div class="col-xs-2">
                                                            <label class="radio-inline">
                                                                <input type="radio" name="tabaquismo" value="si"> si
                                                            </label>
                                                        </div>
                                                        <div class="col-xs-2">
                                                            <label class="radio-inline">
                                                                <input type="radio" name="tabaquismo" value="no"> no
                                                            </label>
                                                        </div>
                                                    </div>


                                                    <div class="form-group">
                                                        <label class="control-label col-xs-7">Existen familiares con
                                                            problemas de drogadicción</label>
                                                        <div class="col-xs-2">
                                                            <label class="radio-inline">
                                                                <input type="radio" name="drogas" value="si"> si
                                                            </label>
                                                        </div>
                                                        <div class="col-xs-2">
                                                            <label class="radio-inline">
                                                                <input type="radio" name="drogas" value="no"> no
                                                            </label>
                                                        </div>
                                                    </div>
                                                    <div class="form-group">
                                                        <label class="control-label col-xs-7">Existen familiares con
                                                            asma</label>
                                                        <div class="col-xs-2">
                                                            <label class="radio-inline">
                                                                <input type="radio" name="asma" value="si"> si
                                                            </label>
                                                        </div>
                                                        <div class="col-xs-2">
                                                            <label class="radio-inline">
                                                                <input type="radio" name="asma" value="no"> no
                                                            </label>
                                                        </div>
                                                    </div>
                                                    <div class="form-group">
                                                        <label class="control-label col-xs-7">Existen familiares con
                                                            diabetes</label>
                                                        <div class="col-xs-2">
                                                            <label class="radio-inline">
                                                                <input type="radio" name="diabetes" value="si"> si
                                                            </label>
                                                        </div>
                                                        <div class="col-xs-2">
                                                            <label class="radio-inline">
                                                                <input type="radio" name="diabetes" value="no"> no
                                                            </label>
                                                        </div>
                                                    </div>
                                                    <div class="form-group">
                                                        <label class="control-label col-xs-7">Existen familiares con
                                                            hipertensión</label>
                                                        <div class="col-xs-2">
                                                            <label class="radio-inline">
                                                                <input type="radio" name="hipertension" value="si"> si
                                                            </label>
                                                        </div>
                                                        <div class="col-xs-2">
                                                            <label class="radio-inline">
                                                                <input type="radio" name="hipertension" value="no"> no
                                                            </label>
                                                        </div>
                                                    </div>
                                                    <div class="form-group">
                                                        <label class="control-label col-xs-7">Existen familiares con
                                                            alergias</label>
                                                        <div class="col-xs-2">
                                                            <label class="radio-inline">
                                                                <input type="radio" name="alergias" value="si"> si
                                                            </label>
                                                        </div>
                                                        <div class="col-xs-2">
                                                            <label class="radio-inline">
                                                                <input type="radio" name="alergias" value="no"> no
                                                            </label>
                                                        </div>
                                                    </div>
                                                    <div class="form-group">
                                                        <label class="control-label col-xs-7">Existen familiares que
                                                            presenten convulsiones</label>
                                                        <div class="col-xs-2">
                                                            <label class="radio-inline">
                                                                <input type="radio" name="convulsiones" value="si"> si
                                                            </label>
                                                        </div>
                                                        <div class="col-xs-2">
                                                            <label class="radio-inline">
                                                                <input type="radio" name="convulsiones" value="no"> no
                                                            </label>
                                                        </div>
                                                    </div>
                                                    <div class="form-group">
                                                        <label class="control-label col-xs-7">Existen familiares con
                                                            defectos congenitos</label>
                                                        <div class="col-xs-2">
                                                            <label class="radio-inline">
                                                                <input type="radio" name="congenitos" value="si"> si
                                                            </label>
                                                        </div>
                                                        <div class="col-xs-2">
                                                            <label class="radio-inline">
                                                                <input type="radio" name="congenitos" value="no"> no
                                                            </label>
                                                        </div>
                                                    </div>
                                                    <div class="form-group">
                                                        <label class="control-label col-xs-7">Existen familiares con
                                                            cáncer</label>
                                                        <div class="col-xs-2">
                                                            <label class="radio-inline">
                                                                <input type="radio" name="cancer" value="si"> si
                                                            </label>
                                                        </div>
                                                        <div class="col-xs-2">
                                                            <label class="radio-inline">
                                                                <input type="radio" name="cancer" value="no"> no
                                                            </label>
                                                        </div>
                                                    </div>

                                                    <div class="form-group">
                                                        <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
                                                            <button type="submit" class="btn btn-success">Guardar
                                                            </button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </form>
                                    </div>

                                    <div role="tabpanel" class="tab-pane fade " id="tab_content2"
                                         aria-labelledby="home-tab">
                                        <form class="form-horizontal" role="form" method="post" action="../../Controllers/ctrlAntPat.php">
                                            <div class="form-group ">
                                                <div class="col-md-4 col-md-offset-4">

                                                    <div class="form-group">
                                                        <label class="control-label col-xs-7 ">Tiene problemas
                                                            Cardiavasculares</label>
                                                        <div class="col-xs-2">
                                                            <label class="radio-inline">
                                                                <input type="radio" name="cardiovascular" value="si"> si
                                                            </label>
                                                        </div>
                                                        <div class="col-xs-2">
                                                            <label class="radio-inline">
                                                                <input type="radio" name="cardiovascular" value="no"> no
                                                            </label>
                                                        </div>
                                                    </div>
                                                    <div class="form-group">
                                                        <label class="control-label col-xs-7">Padece Hipertensión
                                                            Arterial</label>
                                                        <div class="col-xs-2">
                                                            <label class="radio-inline">
                                                                <input type="radio" name="hiper" value="si"> si
                                                            </label>
                                                        </div>
                                                        <div class="col-xs-2">
                                                            <label class="radio-inline">
                                                                <input type="radio" name="hiper" value="no"> no
                                                            </label>
                                                        </div>
                                                    </div>


                                                    <div class="form-group">
                                                        <label class="control-label col-xs-7">Padece Cardiopatía</label>
                                                        <div class="col-xs-2">
                                                            <label class="radio-inline">
                                                                <input type="radio" name="cardiopatia" value="si"> si
                                                            </label>
                                                        </div>
                                                        <div class="col-xs-2">
                                                            <label class="radio-inline">
                                                                <input type="radio" name="cardipatia" value="no"> no
                                                            </label>
                                                        </div>
                                                    </div>
                                                    <div class="form-group">
                                                        <label class="control-label col-xs-7">Ha recibido trnasfusiones
                                                            de sangre</label>
                                                        <div class="col-xs-2">
                                                            <label class="radio-inline">
                                                                <input type="radio" name="transfusiones" value="si"> si
                                                            </label>
                                                        </div>
                                                        <div class="col-xs-2">
                                                            <label class="radio-inline">
                                                                <input type="radio" name="transfusiones" value="no"> no
                                                            </label>
                                                        </div>
                                                    </div>


                                                    <div class="form-group">
                                                        <label class="control-label col-xs-7">Padece Diabetes</label>
                                                        <div class="col-xs-5">
                                                            <select class="form-control input-sm"name="diabetes">

                                                                <option value="""">No</option>
                                                                <option value="Tipo1">Tipo 1</option>
                                                                <option value="Tipo2">Tipo 2</option>
                                                                <option value="Gestacion">Durante gestación</option>

                                                            </select>
                                                        </div>

                                                    </div>


                                                    <label class="control-label col-xs-7">Describa sus alergías</label>
                                                    <div class="col-xs-5">
                                                        <input class="form-control input-sm" type="text" name ="alergias"
                                                               placeholder="ninguna">
                                                    </div>

                                                    <div class="form-group">
                                                        <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
                                                            <button type="submit" class="btn btn-success">Guardar
                                                            </button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </form>
                                    </div>

                                    <div role="tabpanel" class="tab-pane fade" id="tab_content3"
                                         aria-labelledby="home-tab">

                                        <form class="form-horizontal" role="form">
                                            <div class="form-group ">
                                                <div class="col-md-4 col-md-offset-4">

                                                    <div class="form-group">
                                                        <label class="control-label col-xs-7 ">Padece
                                                            alcoholismo</label>
                                                        <div class="col-xs-2">
                                                            <label class="radio-inline">
                                                                <input type="radio" name="alcoholismo" value="si"> si
                                                            </label>
                                                        </div>
                                                        <div class="col-xs-2">
                                                            <label class="radio-inline">
                                                                <input type="radio" name="alcoholismo" value="no"> no
                                                            </label>
                                                        </div>
                                                    </div>
                                                    <div class="form-group">
                                                        <label class="control-label col-xs-7">Fumador activo</label>
                                                        <div class="col-xs-2">
                                                            <label class="radio-inline">
                                                                <input type="radio" name="tabaquismo" value="si"> si
                                                            </label>
                                                        </div>
                                                        <div class="col-xs-2">
                                                            <label class="radio-inline">
                                                                <input type="radio" name="tabaquismo" value="no"> no
                                                            </label>
                                                        </div>
                                                    </div>


                                                    <div class="form-group">
                                                        <label class="control-label col-xs-7">Consume drogas</label>
                                                        <div class="col-xs-2">
                                                            <label class="radio-inline">
                                                                <input type="radio" name="drogas" value="si"> si
                                                            </label>
                                                        </div>
                                                        <div class="col-xs-2">
                                                            <label class="radio-inline">
                                                                <input type="radio" name="drogas" value="no"> no
                                                            </label>
                                                        </div>
                                                    </div>
                                                    <div class="form-group">
                                                        <label class="control-label col-xs-7">cuenta con servicio de
                                                            electicidad</label>
                                                        <div class="col-xs-2">
                                                            <label class="radio-inline">
                                                                <input type="radio" name="luz" value="si"> si
                                                            </label>
                                                        </div>
                                                        <div class="col-xs-2">
                                                            <label class="radio-inline">
                                                                <input type="radio" name="luz" value="no"> no
                                                            </label>
                                                        </div>
                                                    </div>
                                                    <div class="form-group">
                                                        <label class="control-label col-xs-7">Cuenta con agua
                                                            potable</label>
                                                        <div class="col-xs-2">
                                                            <label class="radio-inline">
                                                                <input type="radio" name="aguapotable" value="si"> si
                                                            </label>
                                                        </div>
                                                        <div class="col-xs-2">
                                                            <label class="radio-inline">
                                                                <input type="radio" name="aguapotable" value="no"> no
                                                            </label>
                                                        </div>
                                                    </div>
                                                    <div class="form-group">
                                                        <label class="control-label col-xs-7">Cuenta con serivicio de
                                                            drenaje</label>
                                                        <div class="col-xs-2">
                                                            <label class="radio-inline">
                                                                <input type="radio" name="drenaje" value="si"> si
                                                            </label>
                                                        </div>
                                                        <div class="col-xs-2">
                                                            <label class="radio-inline">
                                                                <input type="radio" name="drenaje" value="no"> no
                                                            </label>
                                                        </div>
                                                    </div>

                                                    <div class="form-group">
                                                        <label class="control-label col-xs-7">Cual es su mayor Grado de
                                                            estudios</label>
                                                        <div class="col-xs-5">
                                                            <select class="form-control input-sm">
                                                                <option></option>
                                                                <option>sin estudios</option>
                                                                <option>primaria completa</option>
                                                                <option>primaria incompleta</option>
                                                                <option>secundaria completa</option>
                                                                <option>secundaria incompleta</option>
                                                                <option>preparatoria completa</option>
                                                                <option>preparatoria incompleta</option>
                                                                <option>universidad completa</option>
                                                                <option>universidad incompleta</option>
                                                                <option>maestría</option>
                                                                <option>doctorado</option>
                                                            </select>
                                                        </div>

                                                    </div>
                                                    <div class="form-group">
                                                        <label class="control-label col-xs-7">Cual es su
                                                            religión</label>
                                                        <div class="col-xs-5">
                                                            <select class="form-control input-sm">
                                                                <option></option>
                                                                <option>ateo</option>
                                                                <option>católico</option>
                                                                <option>cristiano</option>
                                                                <option>Testigo de jehová</option>
                                                                <option>musulman</option>
                                                                <option>budista</option>
                                                                <option>Luz del mundo</option>
                                                                <option>Anglicano</option>
                                                                <option>Ortodoxo</option>
                                                                <option>Judio</option>
                                                                <option>Evangelista</option>
                                                                <option>Mormón</option>
                                                            </select>
                                                        </div>
                                                    </div>

                                                    <div class="form-group">
                                                        <label class="control-label col-xs-7">Cúal es su
                                                            ocupación</label>
                                                        <div class="col-xs-5">
                                                            <input class="form-control input-sm" type="text"
                                                                   placeholder="ocupación">
                                                        </div>
                                                    </div>
                                                    <div class="form-group">
                                                        <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
                                                            <button type="submit" class="btn btn-success">Guardar
                                                            </button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </form>
                                    </div>

                                    <div role="tabpanel" class="tab-pane fade" id="tab_content4"
                                         aria-labelledby="home-tab">

                                    <form class="form-horizontal" role="form">
                                        <div class="form-group ">
                                            <div class="col-md-4 col-md-offset-4">
                                                <div class="form-group">
                                                    <label class="control-label col-xs-7">¿Cuantas gestaciones ha
                                                        tenido?</label>
                                                    <div class="col-xs-5">
                                                        <input class="form-control input-sm" type="number"
                                                               id="gestaciones">
                                                    </div>
                                                </div>

                                                <div class="form-group">
                                                    <label class="control-label col-xs-7">¿Cuantas partos ha
                                                        tenido?</label>
                                                    <div class="col-xs-5">
                                                        <input class="form-control input-sm" type="number" id="partos">
                                                    </div>
                                                </div>

                                                <div class="form-group">
                                                    <label class="control-label col-xs-7">¿Cuantas abortos ha
                                                        tenido?</label>
                                                    <div class="col-xs-5">
                                                        <input class="form-control input-sm" type="number" id="abortos">
                                                    </div>
                                                </div>

                                                <div class="form-group">
                                                    <label class="control-label col-xs-7">¿A que edad comenzó su vida
                                                        sexual activa?</label>
                                                    <div class="col-xs-5">
                                                        <input class="form-control input-sm" type="number" id="ivsa">
                                                    </div>
                                                </div>

                                                <div class="form-group">
                                                    <label class="control-label col-xs-7">¿Cuantas parejas sexuales ha
                                                        tenido?</label>
                                                    <div class="col-xs-5">
                                                        <input class="form-control input-sm" type="number" id="parejas">
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label class="control-label col-xs-7">¿Ha tenido ETS?</label>
                                                    <div class="col-xs-2">
                                                        <label class="radio-inline">
                                                            <input type="radio" name="ets" value="si"> si
                                                        </label>
                                                    </div>
                                                    <div class="col-xs-2">
                                                        <label class="radio-inline">
                                                            <input type="radio" name="ets" value="no"> no
                                                        </label>
                                                    </div>
                                                </div>

                                                <div class="form-group">
                                                    <label class="control-label col-xs-7">¿Cuantas cesareas ha
                                                        tenido?</label>
                                                    <div class="col-xs-5">
                                                        <input class="form-control input-sm" type="number"
                                                               id="cesareas">
                                                    </div>
                                                </div>


                                                <div class="form-group">
                                                    <label class="control-label col-xs-7">Fecha de último
                                                        papanicolau </span>
                                                </label>
                                                <div class=" col-xs-5">
                                                    <input id="birthday"
                                                           class="date-picker form-control col-md-7 col-xs-12 active"
                                                           required="required" type="text">
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label class="control-label col-xs-7">Método anticonceptivo que
                                                    utiliza</label>
                                                <div class="col-xs-5">
                                                    <select class="form-control input-sm" id="anticonceptivo">
                                                        <option></option>

                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </form>
                             </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>


        <!-- jQuery -->
        <script src="../../../vendors/jquery/dist/jquery.min.js"></script>
        <!-- Bootstrap -->
        <script src="../../../vendors/bootstrap/dist/js/bootstrap.min.js"></script>
        <!-- FastClick -->
        <script src="../../../vendors/fastclick/lib/fastclick.js"></script>
        <!-- NProgress -->
        <script src="../../../vendors/nprogress/nprogress.js"></script>
        <!-- Chart.js -->
        <script src="../../../vendors/Chart.js/dist/Chart.min.js"></script>
        <!-- gauge.js -->
        <script src="../../../vendors/gauge.js/dist/gauge.min.js"></script>
        <!-- bootstrap-progressbar -->
        <script src="../../../vendors/bootstrap-progressbar/bootstrap-progressbar.min.js"></script>
        <!-- iCheck -->
        <script src="../../../vendors/iCheck/icheck.min.js"></script>
        <!-- Skycons -->
        <script src="../../../vendors/skycons/skycons.js"></script>
        <!-- Flot -->
        <script src="../../../vendors/Flot/jquery.flot.js"></script>
        <script src="../../../vendors/Flot/jquery.flot.pie.js"></script>
        <script src="../../../vendors/Flot/jquery.flot.time.js"></script>
        <script src="../../../vendors/Flot/jquery.flot.stack.js"></script>
        <script src="../../../vendors/Flot/jquery.flot.resize.js"></script>
        <!-- Flot plugins -->
        <script src="../../js/flot/jquery.flot.orderBars.js"></script>
        <script src="../../js/flot/date.js"></script>
        <script src="../../js/flot/jquery.flot.spline.js"></script>
        <script src="../../js/flot/curvedLines.js"></script>
        <!-- JQVMap -->
        <script src="../../../vendors/jqvmap/dist/jquery.vmap.js"></script>
        <script src="../../../vendors/jqvmap/dist/maps/jquery.vmap.world.js"></script>
        <script src="../../../vendors/jqvmap/examples/js/jquery.vmap.sampledata.js"></script>
        <!-- bootstrap-daterangepicker -->
        <script src="../../js/moment/moment.min.js"></script>
        <script src="../../js/datepicker/daterangepicker.js"></script>

        <!-- Custom Theme Scripts -->
        <script src="../../../build/js/custom.min.js"></script>

        <!-- bootstrap-daterangepicker -->
        <script>
            $(document).ready(function() {
                $('#birthday').daterangepicker({
                    singleDatePicker: true,
                    calender_style: "picker_4"
                }, function(start, end, label) {
                    console.log(start.toISOString(), end.toISOString(), label);
                });
            });
        </script>
        <!-- /bootstrap-daterangepicker -->

        <!-- Parsley -->
        <script>


            $(document).ready(function() {
                $.listen('parsley:field:validate', function() {
                    validateFront();
                });
                $('#demo-form2 .btn').on('click', function() {
                    $('#demo-form2').parsley().validate();
                    validateFront();
                });
                var validateFront = function() {
                    if (true === $('#demo-form2').parsley().isValid()) {
                        $('.bs-callout-info').removeClass('hidden');
                        $('.bs-callout-warning').addClass('hidden');
                    } else {
                        $('.bs-callout-info').addClass('hidden');
                        $('.bs-callout-warning').removeClass('hidden');
                    }
                };
            });
            try {
                hljs.initHighlightingOnLoad();
            } catch (err) {}
        </script>
        <!-- /Parsley -->



        <!-- Flot -->
        <script>
            $(document).ready(function() {
                var data1 = [
                    [gd(2012, 1, 1), 17],
                    [gd(2012, 1, 2), 74],
                    [gd(2012, 1, 3), 6],
                    [gd(2012, 1, 4), 39],
                    [gd(2012, 1, 5), 20],
                    [gd(2012, 1, 6), 85],
                    [gd(2012, 1, 7), 7]
                ];

                var data2 = [
                    [gd(2012, 1, 1), 82],
                    [gd(2012, 1, 2), 23],
                    [gd(2012, 1, 3), 66],
                    [gd(2012, 1, 4), 9],
                    [gd(2012, 1, 5), 119],
                    [gd(2012, 1, 6), 6],
                    [gd(2012, 1, 7), 9]
                ];
                $("#canvas_dahs").length && $.plot($("#canvas_dahs"), [
                    data1, data2
                ], {
                    series: {
                        lines: {
                            show: false,
                            fill: true
                        },
                        splines: {
                            show: true,
                            tension: 0.4,
                            lineWidth: 1,
                            fill: 0.4
                        },
                        points: {
                            radius: 0,
                            show: true
                        },
                        shadowSize: 2
                    },
                    grid: {
                        verticalLines: true,
                        hoverable: true,
                        clickable: true,
                        tickColor: "#d5d5d5",
                        borderWidth: 1,
                        color: '#fff'
                    },
                    colors: ["rgba(38, 185, 154, 0.38)", "rgba(3, 88, 106, 0.38)"],
                    xaxis: {
                        tickColor: "rgba(51, 51, 51, 0.06)",
                        mode: "time",
                        tickSize: [1, "day"],
                        //tickLength: 10,
                        axisLabel: "Date",
                        axisLabelUseCanvas: true,
                        axisLabelFontSizePixels: 12,
                        axisLabelFontFamily: 'Verdana, Arial',
                        axisLabelPadding: 10
                    },
                    yaxis: {
                        ticks: 8,
                        tickColor: "rgba(51, 51, 51, 0.06)",
                    },
                    tooltip: false
                });

                function gd(year, month, day) {
                    return new Date(year, month - 1, day).getTime();
                }
            });
        </script>
        <!-- /Flot -->

        <!-- JQVMap -->
        <script>
            $(document).ready(function(){
                $('#world-map-gdp').vectorMap({
                    map: 'world_en',
                    backgroundColor: null,
                    color: '#ffffff',
                    hoverOpacity: 0.7,
                    selectedColor: '#666666',
                    enableZoom: true,
                    showTooltip: true,
                    values: sample_data,
                    scaleColors: ['#E6F2F0', '#149B7E'],
                    normalizeFunction: 'polynomial'
                });
            });
        </script>
        <!-- /JQVMap -->

        <!-- Skycons -->
        <script>
            $(document).ready(function() {
                var icons = new Skycons({
                            "color": "#73879C"
                        }),
                        list = [
                            "clear-day", "clear-night", "partly-cloudy-day",
                            "partly-cloudy-night", "cloudy", "rain", "sleet", "snow", "wind",
                            "fog"
                        ],
                        i;

                for (i = list.length; i--;)
                    icons.set(list[i], list[i]);

                icons.play();
            });
        </script>
        <!-- /Skycons -->

        <!-- Doughnut Chart -->
        <script>
            $(document).ready(function(){
                var options = {
                    legend: false,
                    responsive: false
                };

                new Chart(document.getElementById("canvas1"), {
                    type: 'doughnut',
                    tooltipFillColor: "rgba(51, 51, 51, 0.55)",
                    data: {
                        labels: [
                            "Symbian",
                            "Blackberry",
                            "Other",
                            "Android",
                            "IOS"
                        ],
                        datasets: [{
                            data: [15, 20, 30, 10, 30],
                            backgroundColor: [
                                "#BDC3C7",
                                "#9B59B6",
                                "#E74C3C",
                                "#26B99A",
                                "#3498DB"
                            ],
                            hoverBackgroundColor: [
                                "#CFD4D8",
                                "#B370CF",
                                "#E95E4F",
                                "#36CAAB",
                                "#49A9EA"
                            ]
                        }]
                    },
                    options: options
                });
            });
        </script>
        <!-- /Doughnut Chart -->

        <!-- bootstrap-daterangepicker -->
        <script>
            $(document).ready(function() {

                var cb = function(start, end, label) {
                    console.log(start.toISOString(), end.toISOString(), label);
                    $('#reportrange span').html(start.format('MMMM D, YYYY') + ' - ' + end.format('MMMM D, YYYY'));
                };

                var optionSet1 = {
                    startDate: moment().subtract(29, 'days'),
                    endDate: moment(),
                    minDate: '01/01/2012',
                    maxDate: '12/31/2015',
                    dateLimit: {
                        days: 60
                    },
                    showDropdowns: true,
                    showWeekNumbers: true,
                    timePicker: false,
                    timePickerIncrement: 1,
                    timePicker12Hour: true,
                    ranges: {
                        'Today': [moment(), moment()],
                        'Yesterday': [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
                        'Last 7 Days': [moment().subtract(6, 'days'), moment()],
                        'Last 30 Days': [moment().subtract(29, 'days'), moment()],
                        'This Month': [moment().startOf('month'), moment().endOf('month')],
                        'Last Month': [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')]
                    },
                    opens: 'left',
                    buttonClasses: ['btn btn-default'],
                    applyClass: 'btn-small btn-primary',
                    cancelClass: 'btn-small',
                    format: 'MM/DD/YYYY',
                    separator: ' to ',
                    locale: {
                        applyLabel: 'Submit',
                        cancelLabel: 'Clear',
                        fromLabel: 'From',
                        toLabel: 'To',
                        customRangeLabel: 'Custom',
                        daysOfWeek: ['Su', 'Mo', 'Tu', 'We', 'Th', 'Fr', 'Sa'],
                        monthNames: ['January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December'],
                        firstDay: 1
                    }
                };
                $('#reportrange span').html(moment().subtract(29, 'days').format('MMMM D, YYYY') + ' - ' + moment().format('MMMM D, YYYY'));
                $('#reportrange').daterangepicker(optionSet1, cb);
                $('#reportrange').on('show.daterangepicker', function() {
                    console.log("show event fired");
                });
                $('#reportrange').on('hide.daterangepicker', function() {
                    console.log("hide event fired");
                });
                $('#reportrange').on('apply.daterangepicker', function(ev, picker) {
                    console.log("apply event fired, start/end dates are " + picker.startDate.format('MMMM D, YYYY') + " to " + picker.endDate.format('MMMM D, YYYY'));
                });
                $('#reportrange').on('cancel.daterangepicker', function(ev, picker) {
                    console.log("cancel event fired");
                });
                $('#options1').click(function() {
                    $('#reportrange').data('daterangepicker').setOptions(optionSet1, cb);
                });
                $('#options2').click(function() {
                    $('#reportrange').data('daterangepicker').setOptions(optionSet2, cb);
                });
                $('#destroy').click(function() {
                    $('#reportrange').data('daterangepicker').remove();
                });
            });
        </script>
        <!-- /bootstrap-daterangepicker -->

        <!-- gauge.js -->
        <script>
            var opts = {
                lines: 12,
                angle: 0,
                lineWidth: 0.4,
                pointer: {
                    length: 0.75,
                    strokeWidth: 0.042,
                    color: '#1D212A'
                },
                limitMax: 'false',
                colorStart: '#1ABC9C',
                colorStop: '#1ABC9C',
                strokeColor: '#F0F3F3',
                generateGradient: true
            };
            var target = document.getElementById('foo'),
                    gauge = new Gauge(target).setOptions(opts);

            gauge.maxValue = 6000;
            gauge.animationSpeed = 32;
            gauge.set(3200);
            gauge.setTextField(document.getElementById("gauge-text"));
        </script>
        <!-- /gauge.js -->

</body>
</html>
