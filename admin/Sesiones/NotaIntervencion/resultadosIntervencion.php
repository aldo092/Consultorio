<?php
/**
 * Created by PhpStorm.
 * User: Pablo
 * Date: 01/10/2016
 * Time: 12:33 PM
 */
require_once ("../../Class/Menu.php");
require_once ("../../Class/Usuarios.php");
require_once ("../../Class/Paciente.php");
require_once ("../../Class/Funcion.php");
require_once ("../../Class/NotaIntervencion.php");
require_once ("../../Class/Personal.php");
require_once ("../../Class/Anestesia.php");
require_once ("../../Class/ClasificacionHeridas.php");
require_once ("../../Class/ManejoHeridas.php");
require_once ("../../Class/Antibioticos.php");
session_start();
$oMenu = new Menu();
$oUser = new Usuarios();
$oPaciente = new Paciente();
$oFuncion = new Funcion();
$oNota = new NotaIntervencion();
$oPersonal = new Personal();
$oAnestesia = new Anestesia();
$oHeridas = new ClasificacionHeridas();
$oManejo = new ManejoHeridas();
$oAnti = new Antibioticos();
$sErr = "";
$sClave = "";
$arrMenus = null;
$arrAnes = null;
$arrHerida = null;
$arrManejo = null;
$arrAnti = null;
$dFec = new DateTime();

if(isset($_SESSION['sUser']) && !empty($_SESSION['sUser'])){
    if(isset($_POST['txtExpediente']) && !empty($_POST['txtExpediente'])){
        $sClave = $_POST['txtExpediente'];

        $oPaciente->setExpediente(new Expediente());
        $oPaciente->getExpediente()->setNumero($sClave);

        $oUser = $_SESSION['sUser'];
        $oMenu = new Menu();
        $oMenu->setUsuario($oUser);
        $arrMenus = $oMenu->buscarMenuUsuario();
        if ($oUser->buscarDatosBasicos()) {
            $sNombre = $oUser->getPersonal()->getNombres() . " " . $oUser->getPersonal()->getApPaterno() . " " . $oUser->getPersonal()->getApMaterno();
        } else {
            $sErr = "Error, datos no encontrados";
        }

        try{
            if(!$oPaciente->busscarDatosPaciente()){
                $sErr = "Paciente no registrado o no es atendido por el médico actual";
            }else{
                $arrAnes = $oAnestesia->buscarTodos();
                $arrHerida = $oHeridas->buscarTodos();
                $arrManejo = $oManejo->buscarTodos();
                $arrAnti = $oAnti->buscarTodos();
            }
        }catch(Exception $e){
            error_log($e->getFile() . " " . $e->getLine() . " " . $e->getMessage(),0);
            $sErr2 = "Error en base de datos, comunicarse con el administrador";
        }

    }else{
        $sErr = "Faltan datos";
    }
}else{
    $sErr = "Acceso denegado, inicie sesión";
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

    <title>Consultorio Médico - Registro de Nota de Intervención</title>

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
                                <img src="../../../admin/imagenesperfiles/<?php echo $oUser->getPersonal()->getImagen();?>" alt=""><?php echo $oUser->getEmail(); ?>
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
            <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                    <div class="x_title">
                        <h2>Ingrese los resultados del procedimiento</h2>
                        <ul class="nav navbar-right panel_toolbox">
                            <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                            </li>
                            <li class="dropdown">
                                <ul class="dropdown-menu" role="menu">
                                </ul>
                            </li>
                            <li></a>
                            </li>
                        </ul>
                        <div class="clearfix"></div>
                    </div>
                    <div class="row">
                        <div class="x_content">
                            <form action="../../Controllers/controlNotaInt.php" method="post" class="form-horizontal form-label-left">
                                <input type="hidden" name="txtExpediente" value="<?php echo $sClave;?>">
                                <input type="hidden" name="txtOp" value="r">
                                <div class="form-group">
                                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="txtNombre">Nombre
                                    </label>
                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                        <input type="text" id="txtNombre" name="txtNombre" class="form-control col-md-7 col-xs-12"
                                               value="<?php echo $oPaciente->getNombre()." ".$oPaciente->getApPaterno()." ".$oPaciente->getApMaterno();?>" disabled>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="txtDxPos">Diagnóstico Posoperatorio <span class="required">*</span>
                                    </label>
                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                        <textarea type="text" id="txtDxPos" name="txtDxPos" class="form-control col-md-7 col-xs-12" required></textarea>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="txtOpeReal">Operación realizada <span class="required">*</span>
                                    </label>
                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                        <input type="text" id="txtOpeReal" name="txtOpeReal" class="form-control col-md-7 col-xs-12" required>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="txtMedCir">Médico Cirujano <span class="required">*</span>
                                    </label>
                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                        <input type="text" id="txtMedCir" name="txtMedCir" class="form-control col-md-7 col-xs-12" required>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="txtCedMedCir">No. Cédula del Médico Cirujano
                                    </label>
                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                        <input type="text" id="txtCedMedCir" name="txtCedMedCir" class="form-control col-md-7 col-xs-12">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="txtMedAnes">Médico Anestesiólogo <span class="required">*</span>
                                    </label>
                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                        <input type="text" id="txtMedAnes" name="txtMedAnes" class="form-control col-md-7 col-xs-12" required>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="txtCedMedAnes">No. Cédula del Médico Anestesiólogo
                                    </label>
                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                        <input type="text" id="txtCedMedAnes" name="txtCedMedAnes" class="form-control col-md-7 col-xs-12">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="txtExaH1">Examen Histopatológico Transoperatorio Solicitado
                                    </label>
                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                        <input type="text" id="txtExaH1" name="txtExaH1" class="form-control col-md-7 col-xs-12">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="txtOtrosEst">Otros estudios transoperatorios solicitados
                                    </label>
                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                        <input type="text" id="txtOtrosEst" name="txtOtrosEst" class="form-control col-md-7 col-xs-12">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="anestesia">Anestesia administrada <span class="required">*</span>
                                    </label>
                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                        <select id="anestesia" name="anestesia" class="form-control" required>
                                            <option value="">Seleccione</option>
                                            <?php
                                            if($arrAnes != null){
                                                foreach($arrAnes as $anest){
                                                    ?>
                                                    <option value="<?php echo $anest->getIdAnestesia();?>"><?php echo $anest->getDescripcion();?></option>
                                                    <?php
                                                }
                                            }
                                            ?>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="dFechaReal">Fecha de realización <span class="required">*</span>
                                    </label>
                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                        <input type="date" id="dFechaReal" name="dFechaReal" min="<?php echo $dFec->format('Y-m-d');?>" class="form-control col-md-7 col-xs-12" required>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="control-label col-md-3 col-sm-3 col-xs-3">Hora de realización <span class="required">*</span></label>
                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                        <input type="text" id="hora" name="hora" class="form-control" data-inputmask="'mask': '99:99'" onblur="valida(this.value);" required>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="txtDesTec">Descripción Técnica
                                    </label>
                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                        <textarea type="text" id="txtDesTec" name="txtDesTec" class="form-control col-md-7 col-xs-12"></textarea>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="txtHallazgo">Hallazgo Transoperatorio
                                    </label>
                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                        <textarea type="text" id="txtHallazgo" name="txtHallazgo" class="form-control col-md-7 col-xs-12"></textarea>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="txtIncidentes">Incidentes
                                    </label>
                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                        <textarea type="text" id="txtIncidentes" name="txtIncidentes" class="form-control col-md-7 col-xs-12"></textarea>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="txtAccidentes">Accidentes
                                    </label>
                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                        <textarea type="text" id="txtAccidentes" name="txtAccidentes" class="form-control col-md-7 col-xs-12"></textarea>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="txtComplicaciones">Complicaciones Transoperatorias
                                    </label>
                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                        <textarea type="text" id="txtComplicaciones" name="txtComplicaciones" class="form-control col-md-7 col-xs-12"></textarea>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="txtObservaciones">Observaciones
                                    </label>
                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                        <textarea type="text" id="txtObservaciones" name="txtObservaciones" class="form-control col-md-7 col-xs-12"></textarea>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="txtCompliPosope">Probables complicaciones posoperatorias
                                    </label>
                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                        <textarea type="text" id="txtCompliPosope" name="txtCompliPosope" class="form-control col-md-7 col-xs-12"></textarea>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="txtEstadoPos">Estado postoperatorio inmediato
                                    </label>
                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                        <textarea type="text" id="txtEstadoPos" name="txtEstadoPos" class="form-control col-md-7 col-xs-12"></textarea>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="txtPlanManejo">Plan de manejo postoperatorio inmediato
                                    </label>
                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                        <textarea type="text" id="txtPlanManejo" name="txtPlanManejo" class="form-control col-md-7 col-xs-12"></textarea>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="txtPronostico">Pronostico
                                    </label>
                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                        <textarea type="text" id="txtPronostico" name="txtPronostico" class="form-control col-md-7 col-xs-12"></textarea>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="cherida">Clasificación de la herida <span class="required">*</span>
                                    </label>
                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                        <select id="cherida" name="cherida" class="form-control" required>
                                            <option value="">Seleccione</option>
                                            <?php
                                            if($arrHerida != null){
                                                foreach($arrHerida as $herida){
                                                    ?>
                                                    <option value="<?php echo $herida->getIdClasificacion();?>"><?php echo $herida->getDescripcion();?></option>
                                                    <?php
                                                }
                                            }
                                            ?>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="implante">Implante <span class="required">*</span>
                                    </label>
                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                        <select id="implante" name="implante" class="form-control" required>
                                            <option value="">Seleccione</option>
                                            <option value="SI">SI</option>
                                            <option value="NO">NO</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="txtImplante">Tipo de Implante
                                    </label>
                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                        <input type="text" id="txtImplante" name="txtImplante" class="form-control col-md-7 col-xs-12">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="mherida">Manejo de la herida <span class="required">*</span>
                                    </label>
                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                        <select id="mherida" name="mherida" class="form-control" required>
                                            <option value="">Seleccione</option>
                                            <?php
                                            if($arrManejo != null){
                                                foreach($arrManejo as $manejo){
                                                    ?>
                                                    <option value="<?php echo $manejo->getIdManejo();?>"><?php echo $manejo->getDescripcion();?></option>
                                                    <?php
                                                }
                                            }
                                            ?>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="osteomias">Osteomías <span class="required">*</span>
                                    </label>
                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                        <select id="osteomias" name="osteomias" class="form-control" required>
                                            <option value="">Seleccione</option>
                                            <option value="SI">SI</option>
                                            <option value="NO">NO</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="txtTipoOs">Tipo de Osteomía
                                    </label>
                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                        <input type="text" id="txtTipoOs" name="txtTipoOs" class="form-control col-md-7 col-xs-12">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="txtLocOs">Localización de la Osteomía
                                    </label>
                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                        <input type="text" id="txtLocOs" name="txtLocOs" class="form-control col-md-7 col-xs-12">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="drenaje">Colocación de Drenaje <span class="required">*</span>
                                    </label>
                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                        <select id="drenaje" name="drenaje" class="form-control" required>
                                            <option value="">Seleccione</option>
                                            <option value="SI">SI</option>
                                            <option value="NO">NO</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="drenajetipo">Estado de la colocación
                                    </label>
                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                        <select id="drenajetipo" name="drenajetipo" class="form-control">
                                            <option value="">Seleccione</option>
                                            <option value="A">Abierto</option>
                                            <option value="C">Cerrado</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="antibiotico">Antibiótico <span class="required">*</span>
                                    </label>
                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                        <select id="antibiotico" name="antibiotico" class="form-control" required>
                                            <option value="">Seleccione</option>
                                            <option value="SI">SI</option>
                                            <option value="NO">NO</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="tantibiotico">Tipo de antibiótico</span>
                                    </label>
                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                        <select id="tantibiotico" name="tantibiotico" class="form-control">
                                            <option value="">Seleccione</option>
                                            <?php
                                            if($arrAnti != null){
                                                foreach($arrAnti as $anti){
                                                    ?>
                                                    <option value="<?php echo $anti->getIdAntibiotico();?>"><?php echo $anti->getDescripcion();?></option>
                                                    <?php
                                                }
                                            }
                                            ?>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="dFechaApl">Fecha de aplicación del Antibiótico
                                    </label>
                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                        <input type="date" id="dFechaApl" name="dFechaApl" min="<?php echo $dFec->format('Y-m-d');?>" class="form-control col-md-7 col-xs-12">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="control-label col-md-3 col-sm-3 col-xs-3">Hora de inicio de aplicación</label>
                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                        <input type="text" id="horainicio" name="horainicio" class="form-control" data-inputmask="'mask': '99:99'" onblur="valida2(this.value);" required>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
                                        <button type="submit" class="btn btn-success">Guardar Nota de Intervención</button>
                                    </div>
                                </div>

                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- /page content -->

    <!-- footer content -->
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

<script type="text/javascript">
    $(document).ready(function(){
        $("#txtImplante").prop("disabled",true);
        $("#implante").change(function(){
            if($("#implante").val() == 'SI'){
                $("#txtImplante").prop("disabled",false);
                $("#txtImplante").attr({
                    required : true
                });
            }else if($("#implante").val() == 'NO'){
                $("#txtImplante").prop("disabled",true);
            }
        });
    });
</script>

<script type="text/javascript">
    $(document).ready(function(){
        $("#tantibiotico").prop("disabled",true);
        $("#dFechaApl").prop("disabled",true);
        $("#horainicio").prop("disabled",true);
        $("#antibiotico").change(function(){
            if($("#antibiotico").val() == 'SI'){
                $("#tantibiotico").prop("disabled",false);
                $("#tantibiotico").attr({
                    required : true
                });
                $("#dFechaApl").prop("disabled",false);
                $("#dFechaApl").attr({
                    required : true
                });
                $("#horainicio").prop("disabled",false);
                $("#horainicio").attr({
                    required : true
                });
            }else if($("#antibiotico").val() == 'NO'){
                $("#tantibiotico").prop("disabled",true);
                $("#dFechaApl").prop("disabled",true);
                $("#horainicio").prop("disabled",true);
            }
        });
    });
</script>

<script type="text/javascript">
    $(document).ready(function(){
        $("#drenajetipo").prop("disabled",true);
        $("#drenaje").change(function(){
            if($("#drenaje").val() == 'SI'){
                $("#drenajetipo").prop("disabled",false);
                $("#drenajetipo").attr({
                    required : true
                });
            }else if($("#drenaje").val() == 'NO'){
                $("#drenajetipo").prop("disabled",true);
            }
        });
    });
</script>

<script type="text/javascript">
    $(document).ready(function(){
        $("#txtTipoOs").prop("disabled",true);
        $("#txtLocOs").prop("disabled",true);
        $("#osteomias").change(function(){
            if($("#osteomias").val() == 'SI'){
                $("#txtTipoOs").prop("disabled",false);
                $("#txtTipoOs").attr({
                    required : true
                });
                $("#txtLocOs").prop("disabled", false);
                $("#txtLocOs").attr({
                    required : true
                });
            }else if($("#osteomias").val() == 'NO'){
                $("#txtTipoOs").prop("disabled",true);
                $("#txtLocOs").prop("disabled",true);
            }
        });
    });
</script>

<script type="text/javascript">
    function valida(valor)
    {
        //que no existan elementos sin escribir
        if(valor.indexOf("_") == -1)
        {
            var hora = valor.split(":")[0];
            var min = valor.split(":")[1];
            if(parseInt(hora) > 23 || parseInt(min) > 59)
            {
                alert("Hora no válida");
                $("#hora").val("");
            }
        }
    }
    function valida2(valor)
    {
        //que no existan elementos sin escribir
        if(valor.indexOf("_") == -1)
        {
            var hora = valor.split(":")[0];
            var min = valor.split(":")[1];
            if(parseInt(hora) > 23 || parseInt(min) > 59)
            {
                alert("Hora no válida");
                $("#horainicio").val("");
            }
        }
    }
</script>

<!-- Custom Theme Scripts -->
<script src="../../../build/js/custom.min.js"></script>

<!-- validator -->
<script src="../../../vendors/validator/validator.js"></script>

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
