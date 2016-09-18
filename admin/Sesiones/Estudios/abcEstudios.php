<?php
/**
 * Created by PhpStorm.
 * User: Pablo
 * Date: 04/09/2016
 * Time: 01:20 PM
 */
error_reporting(E_ALL);
include_once ("../../Class/Usuarios.php");
require_once ("../../Class/Menu.php");
require_once ("../../Class/Funcion.php");
require_once ("../../Class/Estudios.php");
session_start();
$oUser = new Usuarios();
$oEstudios = new Estudios();
$oFuncion = new Funcion();
$sErr = "";
$arrMenus = null;
$nCve = 0;
$sOp = "";
$bCampo = false;
$bLlave = false;
$sNombreAct = "";
$sNombre = "";
$url ="".$_SERVER['REQUEST_URI'];
if(isset($_SESSION['sUser']) && !empty($_SESSION['sUser'])){
    if(isset($_POST['txtIdEstudio']) && !empty($_POST['txtIdEstudio']) &&
        isset($_POST['txtOp']) && !empty($_POST['txtOp'])){
        $nCve = $_POST['txtIdEstudio'];
        $sOp = $_POST['txtOp'];

        $oUser = $_SESSION['sUser'];
        $oMenu = new Menu();
        $oMenu->setUsuario($oUser);
        $arrMenus = $oMenu->buscarMenuUsuario();
        if($oUser->buscarDatosBasicos()){
            $sNombre = $oUser->getPersonal()->getNombres() . " " . $oUser->getPersonal()->getApPaterno() . " " . $oUser->getPersonal()->getApMaterno();
        } else {
            $sErr = "Error, datos no encontrados";
        }

        if($sOp != 'a'){
            $oEstudios->setClaveInterna($nCve);
            try{
                if(!$oEstudios->buscarDatosEstudio())
                    $sErr2 = "Estudio no registrado";
            }catch (Exception $e) {
                error_log($e->getFile() . " " . $e->getLine() . " " . $e->getMessage(),0);
                $sErr2 = "Error en base de datos, comunicarse con el administrador";
            }
        }

        if($sOp == 'a'){
            $bCampo = true;
            $bLlave = true;
            $sNombreAct = "Agregar";
        }else if($sOp == 'm'){
            $bCampo = true;
            $sNombreAct = "Modificar";
        }

    }else{
        $sErr2 = "Faltan datos";
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
                            <form action="../../Controllers/altaEstudios.php" method="post" class="form-horizontal form-label-left">
                                <input type="hidden" name="txtClave" value="<?php echo ($sOp == 'a' ? '' : $oEstudios->getClaveInterna()); ?>">
                                <input type="hidden" id="txtOp" name="txtOp" value="<?php echo $sOp;?>">
                                <div class="form-group">
                                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="txtNombreEst">Nombre(s) <span class="required">*</span>
                                    </label>
                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                        <input type="text" id="txtNombreEst" name="txtNombreEst" required="required" class="form-control col-md-7 col-xs-12"
                                               value="<?php echo ($bLlave==true ?'':$oEstudios->getDescripcion());?>" <?php echo ($bCampo==true?'':' disabled '); ?>>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="txtiva">I.V.A. <span class="required">*</span>
                                    </label>
                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                        <input type="number" id="txtiva" min="0" step=".01" name="txtiva" required="required" class="form-control col-md-7 col-xs-12"
                                               value="<?php echo ($bLlave==true ?'': $oEstudios->getIVA());?>" <?php echo ($bCampo==true?'':' disabled '); ?>>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="txtCosto1">Costo normal<span class="required">*</span>
                                    </label>
                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                        <input type="number" id="txtCosto1" min="0.0" step="1" name="txtCosto1" required="required" class="form-control col-md-7 col-xs-12"
                                               value="<?php echo ($bLlave==true ?'':$oEstudios->getCostoNormal());?>" <?php echo ($bCampo==true?'':' disabled '); ?>>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="txtCosto2">Costo para aseguradoras <span class="required">*</span>
                                    </label>
                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                        <input type="number" id="txtCosto2" min="0.0" step="1" name="txtCosto2" required="required" class="form-control col-md-7 col-xs-12"
                                               value="<?php echo ($bLlave==true ?'':$oEstudios->getCostoAseg());?>" <?php echo ($bCampo==true?'':' disabled '); ?>>
                                    </div>
                                </div>
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
<script language="JavaScript" type="text/javascript">
    $(document).ready(function(){
        if($("#txtOp").val() == 'a'){
            $("#dCedulaEsp").attr({
                disabled : true
            });
            $("#dCedula").change(function(){
                $("#dCedulaEsp").attr({
                    disabled : false
                });
                $("#dCedulaEsp").attr({
                    min : $("#dCedula").val()
                });
            });
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

