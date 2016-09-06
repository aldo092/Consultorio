<?php


error_reporting(E_ALL);
include_once ("../../Class/Usuarios.php");
require_once ("../../Class/Menu.php");
require_once ("../../Class/Paciente.php");
require_once ("../../Class/Personal.php");
require_once ("../../Class/MetodoAnticonceptivo.php");

session_start();
$oUser = new Usuarios();
$sErr = "";
$arrMenus = null;
$Expediente ="";
$oPersonal = new Personal();
$sNombre = "";
$oAnticonceptivo= new MetodoAnticonceptivo();
$arrAnticon=null;


if(isset($_SESSION['sUser']) && !empty($_SESSION['sUser'])){
    if(isset($_POST["txtExpediente"]) && !empty($_POST["txtExpediente"])){
        $Expediente = $_POST['txtExpediente'];

        $oUser = $_SESSION['sUser'];
        $oMenu = new Menu();
        $oMenu->setUsuario($oUser);
        $arrMenus = $oMenu->buscarMenuUsuario();
        $arrAnticon=$oAnticonceptivo->buscarTodos();
        if ($oUser->buscarDatosBasicos()) {
            $sNombre = $oUser->getPersonal()->getNombres() . " " . $oUser->getPersonal()->getApPaterno() . " " . $oUser->getPersonal()->getApMaterno();
        }
}else{
    $sErr = "Faltan datos";
}
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

    <title>Consultorio Médico - Panel de Información</title>

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
                    <a href="../../index.php" class="site_title"><i class="fa fa-plus-square"></i> <span>Control Médico</span></a>
                </div>

                <div class="clearfix"></div>

                <!-- menu profile quick info -->
                <div class="profile">
                    <div class="profile_pic">
                        <img src="../../../admin/imagenesperfiles/<?php echo $oUser->getPersonal()->getImagen();?>" alt="..."  class="img-circle profile_img">
                    </div>
                    <div class="profile_info">
                        <span>Bienvenido</span>
                        <h2><?php echo $sNombre; ?></h2>
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
                                    <li><a href="../../index.php">Principal</a></li>
                                </ul>
                            </li>
                            <?php
                            if($arrMenus != null){
                                foreach ($arrMenus as $vRow){
                                    ?>
                                    <li><a><i class="fa fa-square-o"></i> <?php echo $vRow->getDescrip(); ?><span class="fa fa-chevron-down"></span></a>
                                        <ul class="nav child_menu">
                                            <?php
                                            foreach ($vRow->getArrFunciones() as $sub){
                                                ?>
                                                <?php
                                                ?>
                                                <li><a href="../../<?php echo $sub->getRutaPag(); ?>"><?php echo $sub->getDescripcion();?></a></li>
                                                <?php
                                            }
                                            ?>
                                        </ul>
                                    </li>
                                    <?php
                                }
                            }
                            ?>
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
                                <img src="../../images/img.png" alt=""><?php echo $oUser->getEmail(); ?>
                                <span class=" fa fa-angle-down"></span>
                            </a>
                            <ul class="dropdown-menu dropdown-usermenu pull-right">

                                <li><a href="../../Controllers/logout.php"><i class="fa fa-sign-out pull-right"></i>Salir de la Sesión</a></li>
                            </ul>
                        </li>
                    </ul>
                </nav>
            </div>
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
                                    <li role="presentation" class="active"><a href="#tab_content1" id="AntFam" role="tab" data-toggle="tab" aria-expanded="true">Antecentes Familiares</a>
                                    </li>
                                    <li role="presentation" class=""><a href="#tab_content2" role="tab" id="AntPat" data-toggle="tab" aria-expanded="false">Antecedentes Patológicos</a>
                                    </li>
                                    <li role="presentation" class=""><a href="#tab_content3" role="tab" id="AntNPat" data-toggle="tab" aria-expanded="false">Antecedentes No patológicos</a>
                                    </li>
                                    <li role="presentation" class=""><a href="#tab_content4" role="tab" id="AntGin"  data-toggle="tab" aria-expanded="false" >Antecentes ginecoobstetricos</a>
                                    </li>
                                </ul>
                                <div id="myTabContent" class="tab-content">
                                    <div role="tabpanel" class="tab-pane fade active in" id="tab_content1" aria-labelledby="home-tab">

                                        <form class="form-horizontal" role="form" method="post" action="../../Controllers/ctrlAntFam.php">
                                         <input type="hidden" name="nExpediente" value="<?php echo $Expediente;?>">

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
                                                            <button type="submit" class="btn btn-success" > Guardar
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
                                            <input type="hidden" name="nExpediente" value="<?php echo $Expediente;?>">

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
                                                        <div class="col-xs-5">
                                                            <input class="form-control input-sm" type="text" name="cardiopatia" >
                                                        </div>
                                                    </div>
                                                    <div class="form-group">
                                                        <label class="control-label col-xs-7">Ha recibido transfusiones
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

                                                                <option value="No">No</option>
                                                                <option value="Tipo1">Tipo 1</option>
                                                                <option value="Tipo2">Tipo 2</option>
                                                                <option value="Gestacion">Durante gestación</option>

                                                            </select>
                                                        </div>

                                                    </div>


                                                    <label class="control-label col-xs-7">Describa sus alergías</label>
                                                    <div class="col-xs-5">
                                                        <input class="form-control input-sm" type="text" name ="alergias">
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

                                        <form class="form-horizontal" role="form" method="post" action="../../Controllers/ctrlAntNoPat.php">
                                            <input type="hidden" name="nExpediente" value="<?php echo $Expediente;?>">

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
                                                        <label class="control-label col-xs-7">Cuenta con servicio de
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
                                                        <label class="control-label col-xs-7">Cuenta con servicios sanitarios (baño, regadera)</label>
                                                        <div class="col-xs-2">
                                                            <label class="radio-inline">
                                                                <input type="radio" name="water" value="si"> si
                                                            </label>
                                                        </div>
                                                        <div class="col-xs-2">
                                                            <label class="radio-inline">
                                                                <input type="radio" name="water" value="no"> no
                                                            </label>
                                                        </div>
                                                    </div>

                                                    <div class="form-group">
                                                        <label class="control-label col-xs-7">Cual es su mayor Grado de
                                                            estudios</label>
                                                        <div class="col-xs-5">
                                                            <select class="form-control input-sm" name="estudios">
                                                                <option value="sin_estudio">sin estudios</option>
                                                                <option value="primaria_completa">primaria completa</option>
                                                                <option value="primaria_trunca">primaria incompleta</option>
                                                                <option value="secundaria_completa">secundaria completa</option>
                                                                <option value="secundaria_trunca">secundaria incompleta</option>
                                                                <option value="preparatoria_completa">preparatoria completa</option>
                                                                <option value="preparatoria_trunca">preparatoria incompleta</option>
                                                                <option value="universidad_completa">universidad completa</option>
                                                                <option value="universidad_trunca">universidad incompleta</option>
                                                                <option value="maestria">maestría</option>
                                                                <option value="doctorado">doctorado</option>
                                                            </select>
                                                        </div>

                                                    </div>
                                                    <div class="form-group">
                                                        <label class="control-label col-xs-7">Cual es su
                                                            religión</label>
                                                        <div class="col-xs-5">
                                                            <select class="form-control input-sm" name="religion">
                                                                <option value="ateo">ateo</option>
                                                                <option value="catolico">católico</option>
                                                                <option value="cristiano">cristiano</option>
                                                                <option value="TestigoJehova">Testigo de jehová</option>
                                                                <option value="musulman">musulman</option>
                                                                <option value="budista">budista</option>
                                                                <option value="luzMundo">Luz del mundo</option>
                                                                <option value="anglicano">Anglicano</option>
                                                                <option value="ortodoxo">Ortodoxo</option>
                                                                <option value="judio">Judío</option>
                                                                <option value="evangelista">Evangelista</option>
                                                                <option value="mormon">Mormón</option>
                                                            </select>
                                                        </div>
                                                    </div>

                                                    <div class="form-group">
                                                        <label class="control-label col-xs-7">Cúal es su
                                                            ocupación</label>
                                                        <div class="col-xs-5">
                                                            <input class="form-control input-sm" type="text" name="ocupacion">

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

                                    <div role="tabpanel" class="tab-pane fade" id="tab_content4" aria-labelledby="home-tab" >

                                        <form class="form-horizontal" role="form" method="post" action="../../Controllers/ctrlAntGin.php">
                                            <input type="hidden" name="nExpediente" value="<?php echo $Expediente;?>">

                                            <div class="form-group ">
                                                <div class="col-md-4 col-md-offset-4">
                                                    <div class="form-group">
                                                        <label class="control-label col-xs-7">¿Cuantas gestaciones ha
                                                            tenido?</label>
                                                        <div class="col-xs-5">
                                                            <input class="form-control input-sm" type="number"
                                                                   id="gestaciones" name="gestaciones">
                                                        </div>
                                                    </div>

                                                    <div class="form-group">
                                                        <label class="control-label col-xs-7">¿Cuantas partos ha
                                                            tenido?</label>
                                                        <div class="col-xs-5">
                                                            <input class="form-control input-sm" type="number" id="partos" name="partos">
                                                        </div>
                                                    </div>

                                                    <div class="form-group">
                                                        <label class="control-label col-xs-7">¿Cuantas abortos ha
                                                            tenido?</label>
                                                        <div class="col-xs-5">
                                                            <input class="form-control input-sm" type="number" id="abortos" name="abortos">
                                                        </div>
                                                    </div>

                                                    <div class="form-group">
                                                        <label class="control-label col-xs-7">¿A que edad comenzó su vida
                                                            sexual activa?</label>
                                                        <div class="col-xs-5">
                                                            <input class="form-control input-sm" type="number" id="ivsa" name="ivsa">
                                                        </div>
                                                    </div>

                                                    <div class="form-group">
                                                        <label class="control-label col-xs-7">¿Cuantas parejas sexuales ha
                                                            tenido?</label>
                                                        <div class="col-xs-5">
                                                            <input class="form-control input-sm" type="number" id="parejas" name="parejas">
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
                                                                   id="cesareas" name="cesareas">
                                                        </div>
                                                    </div>


                                                    <div class="form-group">
                                                        <label class="control-label col-xs-7">Fecha de último
                                                            papanicolau </span>
                                                        </label>
                                                        <div class=" col-xs-5">
                                                            <input id="birthday"
                                                                   class="date-picker form-control col-md-7 col-xs-12 active"
                                                                   required="required" type="date" name="papanicolau">
                                                        </div>
                                                    </div>
                                                    <div class="form-group">
                                                        <label class="control-label col-xs-7">Método anticonceptivo que
                                                            utiliza</label>
                                                        <div class="col-xs-5">
                                                            <select class="form-control input-sm" id="anticonceptivo" name="anticonceptivo">
                                                                <?php
                                                                if($arrAnticon != null){
                                                                    foreach($arrAnticon as $vRol){
                                                                        ?>
                                                                        <option value="<?php echo $vRol-> getClaveAnticonceptivo();?>"><?php echo $vRol->getDescripcion();?></option>
                                                                        <?php
                                                                    }
                                                                }
                                                                ?>

                                                            </select>
                                                        </div>
                                                        <div class="form-group">
                                                            <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
                                                                <button type="submit" class="btn btn-success" > Guardar
                                                                </button>
                                                            </div>
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

        <!-- /page content -->

    <footer>
        <div class="pull-right">
            <h1> </h1>
        </div>
        <div class="clearfix"></div>
    </footer>
    <!-- /footer content -->
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
<!-- jquery.inputmask -->
<script src="../../../vendors/jquery.inputmask/dist/min/jquery.inputmask.bundle.min.js"></script>
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

<!-- validator -->
<script src="../../../vendors/validator/validator.js"></script>

<script language="JavaScript" type="text/javascript">
    $(document).ready(function(){
        if($("#txtOp").val()=='a'){
            $(".contenido").hide();
            $("#rol").change(function(){
                if($("#rol").val() == '2'){
                    $("#txtCedula").attr({
                        required : true
                    });
                    $("#dCedula").attr({
                        required : true
                    });
                    $("#txtCedEsp").attr({
                        required : true
                    });
                    $("#dCedulaEsp").attr({
                        required : true
                    });
                    $("#txtEspecialidad").attr({
                        required : true
                    });
                    $(".contenido").show();
                }else{
                    $("#txtCedula").attr({
                        required : false
                    });
                    $("#dCedula").attr({
                        required : false
                    });
                    $("#txtCedEsp").attr({
                        required : false
                    });
                    $("#dCedulaEsp").attr({
                        required : false
                    });
                    $("#txtEspecialidad").attr({
                        required : false
                    });
                    $(".contenido").hide();
                }
            });
        }else if($("#txtOp").val()=='e'){
            $("#rol").attr('disabled','disabled');
            $(".contenido").hide();
        }else if($("#txtRolActual").val() == 'MEDICO'  && $("#txtOp").val()=='m'){
            $(".contenido").show();
        }else if($("#txtRolActual").val() != 'MEDICO' && $("#txtOp").val() == 'm'){
            $(".contenido").hide();
        }
    });
</script>

<!-- jquery.inputmask -->
<script>
    $(document).ready(function() {
        $(":input").inputmask();
    });
</script>
<!-- /jquery.inputmask -->

<!-- validator -->
<script>
    // initialize the validator function
    //validator.message.date = 'not a real date';

    // validate a field on "blur" event, a 'select' on 'change' event & a '.reuired' classed multifield on 'keyup':
    $('form')
        .on('blur', 'input[required], input.optional, select.required', validator.checkField)
        .on('change', 'select.required', validator.checkField)
        .on('keypress', 'input[required][pattern]', validator.keypress);

    $('.multi.required').on('keyup blur', 'input', function() {
        validator.checkField.apply($(this).siblings().last()[0]);
    });

    $('form').submit(function(e) {
        e.preventDefault();
        var submit = true;

        // evaluate the form using generic validaing
        if (!validator.checkAll($(this))) {
            submit = false;
        }

        if (submit)
            this.submit();

        return false;
    });
</script>
<!-- /validator -->
</body>
</html>
