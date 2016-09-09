<?php
/**
 * Created by PhpStorm.
 * User: Pablo
 * Date: 20/08/2016
 * Time: 04:39 PM
 */
error_reporting(E_ALL);
include_once ("../../Class/Usuarios.php");
require_once ("../../Class/Menu.php");
require_once ("../../Class/Personal.php");
require_once ("../../Class/Roles.php");
require_once ("../../Class/Funcion.php");
session_start();
$oUser = new Usuarios();
$oPersonal = new Personal();
$oRol = new Roles();
$oPersonal->setRol(new Roles());
$oFuncion = new Funcion();
$sErr = "";
$sErr2 = "";
$arrMenus = null;
$arrRol = null;
$nCve = 0;
$sOp = "";
$sNombre = "";
$dFec1= new DateTime();
$dFec2 = new DateTime();
$sRolDesc = "";
$bCampo = false;
$bLlave = false;
$bLlave2 = false;
$url="".$_SERVER['REQUEST_URI'];
if(isset($_SESSION['sUser']) && !empty($_SESSION['sUser'])){
    if(isset($_POST["txtIdPersona"]) && !empty($_POST["txtIdPersona"]) &&
        isset($_POST["txtOp"]) && !empty($_POST["txtOp"])){
        $nCve = $_POST['txtIdPersona'];
        $sOp = $_POST['txtOp'];
        $sRolDesc = $_POST['txtRol'];

        $oUser = $_SESSION['sUser'];
        $oMenu = new Menu();
        $oMenu->setUsuario($oUser);
        $arrMenus = $oMenu->buscarMenuUsuario();
        if ($oUser->buscarDatosBasicos()) {
            $sNombre = $oUser->getPersonal()->getNombres() . " " . $oUser->getPersonal()->getApPaterno() . " " . $oUser->getPersonal()->getApMaterno();
        } else {
            $sErr = "Error, datos no encontrados";
        }

        if ($sOp != 'a') {
            $oPersonal->setIdPersonal($nCve);
            try {
                if (!$oPersonal->buscarDatosPorPersona())
                    $sErr2 = "Colaborador no registrado";
            } catch (Exception $e) {
                error_log($e->getFile() . " " . $e->getLine() . " " . $e->getMessage(),0);
                $sErr2 = "Error en base de datos, comunicarse con el administrador";
            }
        }

        if($sOp == 'a'){
            $arrRol = $oRol->buscarTodos();
            $bCampo = true;
            $bLlave = true;
            $sNombreAct = "Agregar";
        }else if($sOp == 'm'){
            $arrRol = $oRol->buscarTodos();
            $bCampo = true;
            $sNombreAct = "Modificar";
        }else if($sOp = 'e'){
            $sNombreAct = "Eliminar";
        }

    }else{
        $sErr2 = "Faltan datos";
    }
}else{
    $sErr = "Acceso denegado, inicie sesión";
}

if($sErr != ""){
    header("Location: error.php?sError=".$sErr);
}else if($sErr2 != ""){
    header("Location: error2.php?sError=".$sErr2);
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
            <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                    <div class="x_title">
                        <h2>Panel de información</h2>
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
                            <form action="../../Controllers/altaPersonal.php" enctype="multipart/form-data"  method="post" class="form-horizontal form-label-left">
                                <input type="hidden" name="txtRol" value="<?php echo $sRolDesc;?>">
                                <input type="hidden" name="txtClave" value="<?php echo ($sOp == 'a' ? '' : $oPersonal->getIdPersonal()); ?>">
                                <input type="hidden" id="txtOp" name="txtOp" value="<?php echo $sOp;?>">
                                <input type="hidden" id="miRol" name="miRol" value="<?php echo $oPersonal->getRol()->getIdRol();?>">
                                <?php
                                    if($sOp != 'a'){
                                        ?>
                                        <div class="col-md-3 col-sm-3 col-xs-12 profile_left">
                                            <div class="profile_img">
                                                <div id="crop-avatar">
                                                    <!-- Current avatar -->
                                                    <img src="../../imagenesperfiles/<?php echo $oPersonal->getImagen();?>" width="150" height="150" >
                                                </div>
                                            </div>
                                        </div>
                                        <br/><br/><br/><br/><br/><br/><br/><br/>
                                        <?php
                                    }
                                ?>

                                    <div class="form-group">
                                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="txtNombre">Nombre(s) <span class="required">*</span>
                                        </label>
                                        <div class="col-md-6 col-sm-6 col-xs-12">
                                            <input type="text" id="txtNombre" name="txtNombre" required="required" class="form-control col-md-7 col-xs-12"
                                                   value="<?php echo ($bLlave==true ?'':$oPersonal->getNombres());?>" <?php echo ($bCampo==true?'':' disabled '); ?>>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="txtApPat">Apellido Paterno <span class="required">*</span>
                                        </label>
                                        <div class="col-md-6 col-sm-6 col-xs-12">
                                            <input type="text" id="txtApPat" name="txtApPat" required="required" class="form-control col-md-7 col-xs-12"
                                            value="<?php echo ($bLlave == true ? '' : $oPersonal->getApPaterno());?>" <?php echo ($bCampo==true?'':' disabled '); ?>>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="txtApMat">Apellido Materno<span class="required">*</span>
                                        </label>
                                        <div class="col-md-6 col-sm-6 col-xs-12">
                                            <input type="text" id="txtApMat" name="txtApMat" required="required" class="form-control col-md-7 col-xs-12"
                                            value="<?php echo ($bLlave == true ? '' : $oPersonal->getApMaterno());?>" <?php echo ($bCampo==true?'':' disabled '); ?>>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="control-label col-md-3 col-sm-3 col-xs-3">No. Telefono</label>
                                        <div class="col-md-4 col-sm-4 col-xs-9">
                                            <input type="text" name="txtTel1"  class="form-control" data-inputmask="'mask' : '(999) 999-9999'"
                                                   value="<?php echo ($bLlave == true ? '' : $oPersonal->getTelefono());?>" <?php echo ($bCampo==true?'':' disabled '); ?>>
                                            <span aria-hidden="true"></span>
                                        </div>
                                    </div>
                                <?php
                                    if($sOp == 'a'){
                                     ?>
                                        <div class="form-group">
                                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="sexo">Sexo <span class="required">*</span>
                                            </label>
                                            <div class="col-md-6 col-sm-6 col-xs-12">
                                                <select id="sexo" name="sexo" class="form-control" required>
                                                    <option value="">Seleccione</option>
                                                    <option value="M">Masculino</option>
                                                    <option value="F">Femenino</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="form-group " >
                                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="curp">CURP <span class="required">*</span>
                                            </label>
                                            <div class="col-md-6 col-sm-6 col-xs-12">
                                                <input type="text" id="curp" name="curp" pattern="[A-Z]{1}[AEIOU]{1}[A-Z]{2}[0-9]{2}(0[1-9]|1[0-2])(0[1-9]|1[0-9]|2[0-9]|3[0-1])[HM]{1}(AS|BC|BS|CC|CS|CH|CL|CM|DF|DG|GT|GR|HG|JC|MC|MN|MS|NT|NL|OC|PL|QT|QR|SP|SL|SR|TC|TS|TL|VZ|YN|ZS|NE)[B-DF-HJ-NP-TV-Z]{3}[0-9A-Z]{1}[0-9]{1}"
                                                       required="required" class="form-control col-md-7 col-xs-12"><br/>
                                                <p>Si no conoce su CURP vaya al siguiente link para obtenerla: <a href="https://consultas.curp.gob.mx/CurpSP/" target="_blank">OBTENER CURP</a></p>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="txtEmail">Email <span class="required">*</span>
                                            </label>
                                            <div class="col-md-6 col-sm-6 col-xs-12">
                                                <input type="email" id="txtEmail" name="txtEmail" required="required" class="form-control col-md-7 col-xs-12">
                                            </div>
                                        </div>
                                        <div class="item form-group">
                                            <label for="password" class="control-label col-md-3">Password</label>
                                            <div class="col-md-6 col-sm-6 col-xs-12">
                                                <input id="password" type="password" name="password" data-validate-length="6,8"  required="required" class="form-control col-md-7 col-xs-12" >
                                                <p>Se requiere de un mínimo de 8 caracteres</p>
                                            </div>
                                        </div>
                                        <div class="item form-group">
                                            <label for="password2" class="control-label col-md-3 col-sm-3 col-xs-12">Confirmar Password</label>
                                            <div class="col-md-6 col-sm-6 col-xs-12">
                                                <input id="password2" type="password" name="password2" data-validate-linked="password" class="form-control col-md-7 col-xs-12" required="required">
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="rol">Rol o Función que desempeña <span class="required">*</span>
                                            </label>
                                            <div class="col-md-6 col-sm-6 col-xs-12">
                                                <select id="rol" name="rol" class="form-control" required>
                                                    <option value="">Seleccione</option>
                                                    <?php
                                                    if($arrRol != null){
                                                        foreach($arrRol as $vRol){
                                                            ?>
                                                            <option value="<?php echo $vRol->getIdRol();?>"><?php echo $vRol->getDescripcion();?></option>
                                                            <?php
                                                        }
                                                    }
                                                    ?>

                                                </select>
                                            </div>
                                        </div>
                                      <?php
                                    }else if($sOp == 'm' or $sOp == 'e'){
                                        ?>
                                        <div class="form-group">
                                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="sex">Sexo</span>
                                            </label>
                                            <div class="col-md-6 col-sm-6 col-xs-12">
                                                <input type="text" id="txtSex" name="txtSex" class="form-control col-md-7 col-xs-12"
                                                       value="<?php echo ( $oPersonal->getSexo() == 'M' ? 'MASCULINO' : 'FEMENINO');?>" disabled >
                                            </div>
                                        </div>
                                        <div class="form-group " >
                                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="curp">CURP </span>
                                            </label>
                                            <div class="col-md-6 col-sm-6 col-xs-12">
                                                <input type="text" id="curp" name="curp" pattern="[A-Z]{1}[AEIOU]{1}[A-Z]{2}[0-9]{2}(0[1-9]|1[0-2])(0[1-9]|1[0-9]|2[0-9]|3[0-1])[HM]{1}(AS|BC|BS|CC|CS|CH|CL|CM|DF|DG|GT|GR|HG|JC|MC|MN|MS|NT|NL|OC|PL|QT|QR|SP|SL|SR|TC|TS|TL|VZ|YN|ZS|NE)[B-DF-HJ-NP-TV-Z]{3}[0-9A-Z]{1}[0-9]{1}"
                                                       value="<?php echo $oPersonal->getCURP();?>" disabled required="required" class="form-control col-md-7 col-xs-12"><br/>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="txtEmail">Email</span>
                                            </label>
                                            <div class="col-md-6 col-sm-6 col-xs-12">
                                                <input type="email" id="txtEmail" name="txtEmail" disabled class="form-control col-md-7 col-xs-12" value="<?php echo $oPersonal->getEmail();?>">
                                            </div>
                                        </div>
                                        <div class="item form-group">
                                            <label for="password" class="control-label col-md-3">Password</label>
                                            <div class="col-md-6 col-sm-6 col-xs-12">
                                                <input id="password" type="password" name="password" data-validate-length="6,8" class="form-control col-md-7 col-xs-12" <?php echo ($bCampo==true?'':' disabled '); ?>>
                                                <p>Se requiere de un mínimo de 8 caracteres</p>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="txtRolActual">Rol/Función actual</span>
                                            </label>
                                            <div class="col-md-6 col-sm-6 col-xs-12">
                                                <input type="text" id="txtRolActual" name="txtRolActual" required="required" class="form-control col-md-7 col-xs-12"
                                                       value="<?php echo ($bLlave == true ? '' : $oPersonal->getRol()->getDescripcion());?>" disabled>
                                            </div>
                                        </div>
                                <?php
                                    }
                                ?>

                                    <div class="contenido" >
                                        <div class="form-group">
                                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="txtCedula">No. Cédula <span class="required">*</span>
                                            </label>
                                            <div id="ced" class="col-md-6 col-sm-6 col-xs-12">
                                                <input type="text" id="txtCedula" name="txtCedula" class="form-control col-md-7 col-xs-12"
                                                       value="<?php echo ($bLlave == true ? '' : $oPersonal->getMedico()->getNumCedula());?>">
                                            </div>
                                        </div>
                                        <?php
                                        if($sOp == 'a'){
                                            ?>
                                            <div class="form-group">
                                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="dCedula">Fecha de Expedición de la Cédula <span class="required">*</span>
                                                </label>
                                                <div class="col-md-6 col-sm-6 col-xs-12">
                                                    <input type="date" id="dCedula" name="dCedula" max="<?php echo $dFec1->format('Y-m-d');?>" >
                                                </div>
                                            </div>
                                            <?php
                                        }else{
                                            ?>
                                            <div class="form-group">
                                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="txtFec">Fecha de Expedición de Cédula </span>
                                                </label>
                                                <div id="ced" class="col-md-6 col-sm-6 col-xs-12">
                                                    <input type="text" id="txtFec" name="txtFec" class="form-control col-md-7 col-xs-12"
                                                           value="<?php echo ($bLlave == true ? '' : $oPersonal->getMedico()->getFechaExpedicionCed());?>" disabled>
                                                </div>
                                            </div>
                                        <?php
                                        }
                                        ?>

                                        <div class="form-group">
                                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="txtCedEsp">No. Cédula de Especialidad<span class="required">*</span>
                                            </label>
                                            <div class="col-md-6 col-sm-6 col-xs-12">
                                                <input type="text" id="txtCedEsp" name="txtCedEsp" class="form-control col-md-7 col-xs-12"
                                                       value="<?php echo ($bLlave == true ? '': $oPersonal->getMedico()->getNumCedEsp());?>" <?php echo ($bCampo == true ? '':'disabled');?>>
                                            </div>
                                        </div>
                                        <?php
                                            if($sOp == 'a'){
                                                ?>
                                                <div class="form-group">
                                                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="dCedulaEsp">Fecha de Expedición de la Cédula de Especialidad <span class="required">*</span>
                                                    </label>
                                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                                        <input type="date" id="dCedulaEsp" name="dCedulaEsp" max="<?php echo $dFec2->format('Y-m-d');?>">
                                                    </div>
                                                </div>
                                        <?php
                                            }else{
                                                ?>
                                                <div class="form-group">
                                                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="txtFecEsp">Fecha de Expedición de Cédula </span>
                                                    </label>
                                                    <div id="ced" class="col-md-6 col-sm-6 col-xs-12">
                                                        <input type="text" id="txtFecEsp" name="txtFecEsp" class="form-control col-md-7 col-xs-12"
                                                               value="<?php echo ($bLlave == true ? '' : $oPersonal->getMedico()->getFecExpedCedEsp());?>" disabled>
                                                    </div>
                                                </div>
                                        <?php
                                            }
                                        ?>
                                        <div class="form-group">
                                            <label class="control-label col-md-3 col-sm-3 col-xs-3">No. Telefono (Opcional)</label>
                                            <div class="col-md-4 col-sm-4 col-xs-9">
                                                <input type="text" name="txtTel2"  class="form-control" data-inputmask="'mask' : '(999) 999-9999'"
                                                value="<?php echo ($bLlave == true ? '': $oPersonal->getMedico()->getNumTelefono1());?>" <?php echo ($bCampo == true ? '':'disabled');?>>
                                                <span class="fa fa-user form-control-feedback right" aria-hidden="true"></span>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="txtEspecialidad">Especialidad<span class="required">*</span>
                                            </label>
                                            <div class="col-md-6 col-sm-6 col-xs-12">
                                                <input type="text" id="txtEspecialidad" name="txtEspecialidad" class="form-control col-md-7 col-xs-12"
                                                       value="<?php echo ($bLlave == true ? '': $oPersonal->getMedico()->getEspecialidad());?>" <?php echo ($bCampo == true ? '':'disabled');?>>
                                            </div>
                                        </div>
                                    </div>
                                <?php
                                    if($sOp == 'm'){
                                        ?>
                                        <div class="form-group">
                                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="txtEstAct">Estatus Actual</span>
                                            </label>
                                            <div class="col-md-6 col-sm-6 col-xs-12">
                                                <input type="text" id="txtEstAct" name="txtEstAct" class="form-control col-md-7 col-xs-12"
                                                       value="<?php echo ($oPersonal->getEstatus() == 1 ? 'Activo':'Inactivo');?>" readonly="true">
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="estatus">Estatus</span>
                                            </label>
                                            <div class="col-md-6 col-sm-6 col-xs-12">
                                                <select id="estatus" name="estatus" class="form-control">
                                                    <option value="">Seleccione</option>
                                                    <option value="1">Activo</option>
                                                    <option value="0">Inactivo</option>
                                                </select>
                                            </div>
                                        </div>
                                <?php
                                    }
                                ?>
                                <?php
                                    if($sOp == 'a'){
                                        ?>
                                        <div class="form-group">
                                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="imagen">Imagen de perfil<span class="required">*</span>
                                            </label>
                                            <div class="col-md-6 col-sm-6 col-xs-12">
                                                <input type="file" id="imagen" name="imagen" accept="image/jpeg" required >
                                            </div>
                                        </div>
                                <?php
                                    }
                                ?>
                                    <div class="ln_solid"></div>
                                    <div class="form-group">
                                        <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
                                            <button type="submit" class="btn btn-primary">Cancelar</button>
                                            <button type="submit" class="btn btn-success"><?php echo $sNombreAct;?></button>
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
