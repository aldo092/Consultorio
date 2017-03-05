<?php
/**
 * Created by PhpStorm.
 * User: Pablo
 * Date: 26/09/2016
 * Time: 04:39 PM
 */
include_once ("../../Class/Usuarios.php");
require_once ("../../Class/Menu.php");
require_once ("../../Class/Funcion.php");
require_once ("../../Class/Paciente.php");
require_once ("../../Class/Estudios.php");
session_start();
$sErr = "";
$sExpediente = "";
$oEstudios = new Estudios();
$oUsuarios = new Usuarios();
$oPaciente = new Paciente();
$oMenu = new Menu();
$oFuncion = new Funcion();
$arrMenus = null;
$arrAnes = null;
$arrEst = null;
$dFec = new DateTime();
$sOp = "";

if(isset($_SESSION['sUser']) && !empty($_SESSION['sUser'])){
    if(isset($_POST['txtExpediente']) && !empty($_POST['txtExpediente'])){
        $sExpediente = $_POST['txtExpediente'];
        $sOp = $_POST['txtOp'];
            $oPaciente->setExpediente(new Expediente());
            $oPaciente->getExpediente()->setNumero($sExpediente);

            $oUser = $_SESSION['sUser'];
            $oMenu = new Menu();
            $oMenu->setUsuario($oUser);
            $arrMenus = $oMenu->buscarMenuUsuario();
            $arrEst = $oEstudios->buscarEstudiosPorEspecialidad($oUser->getEmail());
            if ($oUser->buscarDatosBasicos()) {
                $sNombre = $oUser->getPersonal()->getNombres() . " " . $oUser->getPersonal()->getApPaterno() . " " . $oUser->getPersonal()->getApMaterno();
            } else {
                $sErr = "Error, datos no encontrados";
            }

            try{
                if(!$oPaciente->busscarDatosPaciente()){
                    $sErr = "Paciente no registrado o no es atendido por el médico actual";
                }
            }catch(Exception $e){
                error_log($e->getFile() . " " . $e->getLine() . " " . $e->getMessage(),0);
                $sErr2 = "Error en base de datos, comunicarse con el administrador";
            }

    }else{
        $sErr = "Faltan datos";
    }
}else{
    $sErr = "Error, inicie sesión para continuar";
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
                        <h2>Información General del Paciente</h2>
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
                                <input type="hidden" name="txtExpediente" value="<?php echo $sExpediente;?>">
                                <input type="hidden" name="txtOp" value="a">
                                <div class="form-group">
                                    <label class="control-label col-md-1 col-sm-3 col-xs-12" for="txtNombre">Nombre
                                    </label>
                                    <div class="col-md-3 col-sm-6 col-xs-12">
                                        <input type="text" id="txtNombre" name="txtNombre" class="form-control col-md-7 col-xs-12"
                                               value="<?php echo $oPaciente->getNombre()." ".$oPaciente->getApPaterno()." ".$oPaciente->getApMaterno();?>" disabled>
                                    </div>
                                    <label class="control-label col-md-1 col-sm-3 col-xs-12" for="txtSexo">Sexo
                                    </label>
                                    <div class="col-md-3 col-sm-6 col-xs-12">
                                        <input type="text" id="txtSexo" name="txtSexo" class="form-control col-md-7 col-xs-12"
                                               value="<?php echo ($oPaciente->getSexo() == 'M' ? 'Masculino':'Femenino');?>" disabled >
                                    </div>
                                    <label class="control-label col-md-1 col-sm-3 col-xs-12" for="txtEdad">Edad
                                    </label>
                                    <div class="col-md-3 col-sm-6 col-xs-12">
                                        <input type="text" id="txtEdad" name="txtEdad" class="form-control col-md-7 col-xs-12"
                                               value="<?php echo $oPaciente->getEdad(). " años";?>" disabled >
                                    </div>
                                </div>
                                <br/><br/>
                                <div class="form-group">
                                    <label class="control-label col-md-1 col-sm-3 col-xs-12" for="txtEdad">No. Expediente
                                    </label>
                                    <div class="col-md-3 col-sm-6 col-xs-12">
                                        <input type="text" id="txtEdad" name="txtEdad" class="form-control col-md-7 col-xs-12"
                                               value="<?php echo $sExpediente;?>" disabled >
                                    </div>
                                </div>
                        </div>
                    </div>
                </div>
            </div>
            <br/><br/>
            <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                    <div class="x_title">
                        <h2>Información de la Nota Médica (Fecha de hoy: <?php echo $dFec->format("Y-m-d");?>)</h2>
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
                            <form id="frmNota" action="../../Controllers/altaNota.php" method="post" enctype="multipart/form-data">
                                <input type="hidden" value="<?php echo $sExpediente;?>" name="txtExpe" />
                                <input type="hidden" value="<?php echo $dFec->format("Y-m-d");?>" name="txtFecha" />
                                <div class="x_content">
                                    <div class="clearfix"></div>
                                    <br/>
                                    <div class="form-group">
                                        <label class="control-label col-md-2 col-sm-3 col-xs-12">Nivel de Urgencia</label>
                                        <div class="col-md-3 col-sm-9 col-xs-12">
                                            <select class="form-control" name="urgencia" id="urgencia">
                                                <option value="">Seleccione</option>
                                                <option value="URGENTE">URGENTE</option>
                                                <option value="ORDINARIO">ORDINARIO</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="clearfix"></div>
                                    <br/>
                                    <div class="form-group">
                                        <label class="control-label col-md-2 col-sm-3 col-xs-12">Estudio a realizar</label>
                                        <div class="col-md-5 col-sm-9 col-xs-12">
                                            <select class="form-control" name="estudios" id="estudios">
                                                <option value="">Seleccione</option>
                                                <?php
                                                if($arrEst != null){
                                                    foreach ($arrEst as $vEst){
                                                        ?>
                                                        <option value="<?php echo $vEst->getClaveInterna(); ?>"><?php echo $vEst->getDescripcion();?></option>
                                                        <?php
                                                    }
                                                }
                                                ?>
                                            </select>
                                        </div>
                                    </div>
                                    <br/><br/>
                                    <div class="form-group">
                                        <label class="control-label col-md-2 col-sm-3 col-xs-12" for="txtDxIng">Diagnóstico de Ingreso
                                        </label>
                                        <div class="col-md-10 col-sm-6 col-xs-12">
                                            <input type="text" id="txtDxIng" name="txtDxIng" class="form-control col-md-7 col-xs-12" required>
                                        </div>
                                    </div>
                                    <br/><br/>
                                    <div class="form-group">
                                        <label class="control-label col-md-2 col-sm-3 col-xs-12" for="txtResumen">Resumen Clínico
                                        </label>
                                        <div class="col-md-10 col-sm-6 col-xs-12">
                                            <textarea rows="6" id="txtResumen" name="txtResumen" class="form-control col-md-7 col-xs-12"></textarea>
                                        </div>
                                    </div>
                                    <br/><br/><br/><br/><br/><br/><br/><br/>
                                    <div class="form-group">
                                        <label class="control-label col-md-2 col-sm-3 col-xs-12" for="txtPresion">Presión Arterial
                                        </label>
                                        <div class="col-md-2 col-sm-6 col-xs-12">
                                            <input type="text" id="txtPresion" name="txtPresion" class="form-control col-md-7 col-xs-12">
                                        </div>
                                        <label class="control-label col-md-2 col-sm-3 col-xs-12" for="txtSignos">Signos Vitales
                                        </label>
                                        <div class="col-md-2 col-sm-6 col-xs-12">
                                            <input type="text" id="txtSignos" name="txtSignos" class="form-control col-md-7 col-xs-12">
                                        </div>
                                        <label class="control-label col-md-2 col-sm-3 col-xs-12" for="txtTemp">Temperatura °C
                                        </label>
                                        <div class="col-md-2 col-sm-6 col-xs-12">
                                            <input type="text" id="txtTemp" name="txtTemp" class="form-control col-md-7 col-xs-12">
                                        </div>
                                    </div>
                                </div>
                                <br/><br/>
                                <div class="x_panel">
                                    <div class="x_content">
                                        <div class="" role="tabpanel" data-example-id="togglable-tabs">
                                            <ul id="myTab" class="nav nav-tabs bar_tabs" role="tablist">
                                                <li role="presentation" class="active"><a href="#tab_content1" id="home-tab" role="tab" data-toggle="tab" aria-expanded="true">Estudios de Imagenología</a>
                                                </li>
                                                <li role="presentation" class=""><a href="#tab_content2" role="tab" id="profile-tab" data-toggle="tab" aria-expanded="false">Estudios de Laboratorio</a>
                                                </li>
                                            </ul>
                                            <div id="myTabContent" class="tab-content">
                                                <div role="tabpanel" class="tab-pane fade active in" id="tab_content1" aria-labelledby="home-tab">
                                                    <div class="form-group">
                                                        <label class="control-label col-md-2 col-sm-3 col-xs-12" for="txtTemp">Seleccione los estudios que solicitará de Imagenología
                                                        </label>
                                                        <div class="col-md-4 col-sm-9 col-xs-12">
                                                            <div class="checkbox">
                                                                <label>
                                                                    <input type="checkbox" class="flat" name="estImagen[]" value="CRANEO"> CRANEO
                                                                </label>
                                                            </div>
                                                            <div class="checkbox">
                                                                <label>
                                                                    <input type="checkbox" class="flat" name="estImagen[]" value="SENOS PARANASALES"> SENOS PARANASALES
                                                                </label>
                                                            </div>
                                                            <div class="checkbox">
                                                                <label>
                                                                    <input type="checkbox" class="flat" name="estImagen[]" value="ABDOMEN SIMPLE"> ABDOMEN SIMPLE
                                                                </label>
                                                            </div>
                                                            <div class="checkbox">
                                                                <label>
                                                                    <input type="checkbox" class="flat" name="estImagen[]" value="ESOFAGO ESTOMAGO DUODENO"> ESOFAGO ESTOMAGO DUODENO
                                                                </label>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-3 col-sm-9 col-xs-12">
                                                            <div class="checkbox">
                                                                <label>
                                                                    <input type="checkbox" class="flat" name="estImagen[]" value="COLECISTOGRAFIA"> COLECISTOGRAFIA
                                                                </label>
                                                            </div>
                                                            <div class="checkbox">
                                                                <label>
                                                                    <input type="checkbox" class="flat" name="estImagen[]" value="COLON POR ENEMA"> COLON POR ENEMA
                                                                </label>
                                                            </div>
                                                            <div class="checkbox">
                                                                <label>
                                                                    <input type="checkbox" class="flat" name="estImagen[]" value="TORAX P.A."> TORAX P.A.
                                                                </label>
                                                            </div>
                                                            <div class="checkbox">
                                                                <label>
                                                                    <input type="checkbox" class="flat" name="estImagen[]" value="UROGRAFIA EXCRETORA"> UROGRAFIA EXCRETORA
                                                                </label>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-3 col-sm-9 col-xs-12">
                                                            <div class="checkbox">
                                                                <label>
                                                                    <input type="checkbox" class="flat" name="estImagen[]" value="COLUMNA VERTEBRAL"> COLUMNA VERTEBRAL
                                                                </label>
                                                            </div>
                                                            <div class="checkbox">
                                                                <label>
                                                                    <input type="checkbox" class="flat" name="estImagen[]" value="HUESOS"> HUESOS
                                                                </label>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="clearfix"></div>
                                                    <div class="form-group">
                                                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="txtOtrosEst">Otros Estudios
                                                        </label>
                                                        <div class="col-md-6 col-sm-6 col-xs-12">
                                                            <input type="text" id="txtOtrosEst" name="txtOtrosEst" class="form-control col-md-7 col-xs-12">
                                                        </div>
                                                    </div>
                                                    <div class="clearfix"></div>
                                                    <br/>
                                                    <div class="form-group">
                                                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="txtRegion">Región Solicitada
                                                        </label>
                                                        <div class="col-md-6 col-sm-6 col-xs-12">
                                                            <input type="text" id="txtRegion" name="txtRegion" class="form-control col-md-7 col-xs-12">
                                                        </div>
                                                    </div>
                                                </div>
                                                <div role="tabpanel" class="tab-pane fade" id="tab_content2" aria-labelledby="profile-tab">
                                                    <div class="form-group">
                                                        <label class="control-label col-md-2 col-sm-3 col-xs-12" for="txtEstSolLab">Estudios Solicitados
                                                        </label>
                                                        <div class="col-md-10 col-sm-6 col-xs-12">
                                                            <textarea rows="6" id="txtEstSolLab" name="txtEstSolLab" class="form-control col-md-7 col-xs-12"></textarea>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="control-label col-md-4 col-sm-3 col-xs-12" for="txtEstSolLab">Seleccione el archivo a subir (4Mb Máximo)
                                    </label>
                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                        <input type="file" name="imagen" accept="application/pdf">
                                    </div>
                                </div>
                                <div class="clearfix"></div>
                                <br/><br/>
                                <div class="form-group">
                                    <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
                                        <input type="submit" class="btn btn-lg btn-success" value="Guardar" />
                                    </div>
                                </div>
                            </form>
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

<script language="javascript" type="text/javascript">
    $(document).ready(function(){
       $("#estudios").attr({
           required : true
       });
        $("#urgencia").attr({
            required : true
        });
    });
</script>
</body>
</html>

