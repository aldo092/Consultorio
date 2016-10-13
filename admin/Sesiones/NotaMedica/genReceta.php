<?php
/**
 * Created by PhpStorm.
 * User: Aldo
 * Date: 05/10/2016
 * Time: 09:27 PM
 */


error_reporting(E_ALL);
include_once ("../../Class/Usuarios.php");
require_once ("../../Class/Menu.php");
require_once ("../../Class/Personal.php");
require_once ("../../Class/Paciente.php");



session_start();
$oUser = new Usuarios();
$sErr = "";
$arrMenus = null;
$sNombre = "";
$arrPersonal=null;
$oPersonal= new Personal();
$oPaciente= new Paciente();
$arrPaciente=null;


if(isset($_SESSION['sUser']) && !empty($_SESSION['sUser'])){
    $oUser = $_SESSION['sUser'];
    $oMenu = new Menu();
    $oMenu->setUsuario($oUser);
    $arrMenus = $oMenu->buscarMenuUsuario();
    $arrPaciente= $oPaciente->PacientesMedico($oUser->getEmail());

    if($oUser->buscarDatosBasicos()){
        $sNombre = $oUser->getPersonal()->getNombres()." ".$oUser->getPersonal()->getApPaterno()." ".$oUser->getPersonal()->getApMaterno();
    }else{
        $sErr = "Error, datos no encontrados";
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

    <title>Generar Receta Medica</title>

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
                        <img src="../../../admin/imagenesperfiles/<?php echo $oUser->getPersonal()->getImagen();?>" alt=""  class="img-circle profile_img">
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
                                    <li><a><i class="fa fa-square"></i> <?php echo $vRow->getDescrip(); ?><span class="fa fa-chevron-down"></span></a>
                                        <ul class="nav child_menu">
                                            <?php
                                            foreach ($vRow->getArrFunciones() as $sub){
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
                                <img src="../../../admin/imagenesperfiles/<?php echo $oUser->getPersonal()->getImagen();?>"  alt=""><?php echo $oUser->getEmail(); ?>
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


        <!-- /top navigation -->

        <!-- page content -->
        <div class="right_col" role="main">
            <div class="">
                <div class="page-title">
                    <div class="title_left">
                        <h3> Generar Recete Medica</h3 >
                    </div>

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
                            <form action="../../Controllers/ctrlReceta.php" method="post"  data-parsley-validate class="form-horizontal form-label-left" >
                                <input type="hidden" name="medico">
                                <input type="hidden" name="nombre">

                                <div class="form-group">
                                    <label  class="control-label col-md-3 col-sm-3 col-xs-12" for="paciente">Paciente:</label>
                                    <div class="col-md-4 col-sm-4 col-xs-12">
                                        <select id="paciente" class="form-control" name="paciente" required="required">
                                            <option value="">Seleccione</option>
                                            <?php
                                            if($arrPaciente!= null){
                                                foreach($arrPaciente as $vRol){
                                                    ?>
                                                    <option value="<?php echo $vRol-> getExpediente()->getNumero();?>"><?php echo $vRol->getNombre();?> <?php echo $vRol->getApPaterno();?> <?php echo $vRol->getApMaterno();?> </option>
                                                    <?php
                                                }
                                            }
                                            ?>
                                        </select>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="control-label colo-md-3 col-sm-3 col-xs-12" for="receta">Receta:</label>

                                <div class="col-md-4 col-sm-4 col-xs-12">
                                    <textarea  id="receta" name="receta" class="form-control" rows="5" required="required" ></textarea>
                                </div>

                                </div>
                                </div>

                                <div class="ln_solid"></div>
                                <div class="form-group">
                                    <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
                                        <button type="submit" class="btn btn-success"onClick="nombre.value=document.getElementById('paciente').options[document.getElementById('paciente').selectedIndex].text;
                                         medico.value='<?php echo $vRol->getsMedico();?>'" >Guardar</button>
                                    </div>
                                </div>

                            </form>
                        </div>
                    </div>
                </div>
            </div>

        </div>
        <!-- /page content -->
<!-- jQuery -->
<script src="../../../vendors/jquery/dist/jquery.min.js"></script>
<!-- Bootstrap -->
<script src="../../../vendors/bootstrap/dist/js/bootstrap.min.js"></script>
<!-- Custom Theme Scripts -->
<script src="../../../build/js/custom.min.js"></script>
<!-- validator -->
<script src="../../../vendors/validator/validator.js"></script>
<!-- validator -->

</body>
</html>

