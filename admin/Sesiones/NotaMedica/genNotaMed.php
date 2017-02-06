<?php
error_reporting(E_ALL);
include_once ("../../Class/Usuarios.php");
require_once ("../../Class/Menu.php");
require_once ("../../Class/Personal.php");
require_once ("../../Class/Paciente.php");
require_once ("../../Class/Funcion.php");
require_once ("../../Class/NotaIntervencion.php");
session_start();
$oUser = new Usuarios();
$sErr = "";
$arrMenus = null;
$sNombre = "";

$oPaciente= new Paciente();
$oFuncion = new Funcion();
$arrPaciente= null;
$url="".$_SERVER['REQUEST_URI'];
if(isset($_SESSION['sUser']) && !empty($_SESSION['sUser'])){
    $oUser = $_SESSION['sUser'];
    $oMenu = new Menu();
    $oMenu->setUsuario($oUser);
    $arrMenus = $oMenu->buscarMenuUsuario();
    $arrPaciente= $oPaciente->buscarPacientesPorMedicoProce($oUser->getEmail());
    //var_dump($oPaciente);
    if($oUser->buscarDatosBasicos() and $oFuncion->checkRoot($oUser->getEmail(), substr($url, 19))){
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

    <title>Lista de Pacientes</title>

    <!-- Bootstrap -->
    <link href="../../../vendors/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link href="../../../vendors/font-awesome/css/font-awesome.min.css" rel="stylesheet">

    <!-- Datatables -->
    <link href="../../../vendors/datatables.net-bs/css/dataTables.bootstrap.min.css" rel="stylesheet">
    <link href="../../../vendors/datatables.net-buttons-bs/css/buttons.bootstrap.min.css" rel="stylesheet">
    <link href="../../../vendors/datatables.net-fixedheader-bs/css/fixedHeader.bootstrap.min.css" rel="stylesheet">
    <link href="../../../vendors/datatables.net-responsive-bs/css/responsive.bootstrap.min.css" rel="stylesheet">
    <link href="../../../vendors/datatables.net-scroller-bs/css/scroller.bootstrap.min.css" rel="stylesheet">

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
                        * <h2><?php echo $sNombre; ?></h2>
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
    </div>


    <!-- /top navigation -->

    <!-- page content -->
    <div class="right_col" role="main">
        <div class="">
            <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">

                    <div class="x_title">
                        <h2>Lista de Pacientes asignados a su consultorio</h2>

                        <div class="clearfix"></div>
                    </div>

                    <div class="x_content">
                        <form id="frmExpediente" action="../../Sesiones/NotaIntervencion/registroNotaInt.php" method="post">
                            <input type="hidden" name="txtExpediente">
                            <input type="hidden" name="txtOp">
                            <p class="text-muted font-13 m-b-30">
                            </p>

                            <table id="datatable-responsive" class="table table-striped table-bordered dt-responsive nowrap" cellspacing="0" width="100%">
                                <thead>
                                <tr>
                                    <th>Expediente</th>
                                    <th>Nombre</th>
                                    <th>Accion</th>


                                </tr>
                                </thead>
                                <tbody>
                                <?php
                                if($arrPaciente != null){
                                    foreach($arrPaciente as $vRT){
                                        ?>
                                        <tr>
                                            <td><?php echo $vRT->getExpediente()->getNumero();?></td>
                                            <td><?php echo $vRT->getApPaterno()." ".$vRT->getApMaterno()." ".$vRT->getNombre(); ?></td>
                                            <td>
                                                <input type="submit" value="Registrar Nota Médica" class=" btn btn-primary" onClick="txtExpediente.value='<?php echo $vRT->getExpediente()->getNumero();?>';" >
                                            </td>

                                        </tr>
                                        <?php
                                    }
                                }else{
                                    ?>
                                    <tr>
                                        <td>
                                            <p>No se encontraron registros</p>
                                        </td>
                                    </tr>
                                    <?php
                                }
                                ?>
                                </tbody>
                            </table>
                        </form>
                    </div>

                </div>
            </div>
        </div>
    </div>

    <!-- /page content -->

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

<!-- Datatables -->
<script src="../../../vendors/datatables.net/js/jquery.dataTables.min.js"></script>
<script src="../../../vendors/datatables.net-bs/js/dataTables.bootstrap.min.js"></script>
<script src="../../../vendors/datatables.net-buttons/js/dataTables.buttons.min.js"></script>
<script src="../../../vendors/datatables.net-buttons-bs/js/buttons.bootstrap.min.js"></script>
<script src="../../../vendors/datatables.net-buttons/js/buttons.flash.min.js"></script>
<script src="../../../vendors/datatables.net-buttons/js/buttons.html5.min.js"></script>
<script src="../../../vendors/datatables.net-buttons/js/buttons.print.min.js"></script>
<script src="../../../vendors/datatables.net-fixedheader/js/dataTables.fixedHeader.min.js"></script>
<script src="../../../vendors/datatables.net-keytable/js/dataTables.keyTable.min.js"></script>
<script src="../../../vendors/datatables.net-responsive/js/dataTables.responsive.min.js"></script>
<script src="../../../vendors/datatables.net-responsive-bs/js/responsive.bootstrap.js"></script>
<script src="../../../vendors/datatables.net-scroller/js/datatables.scroller.min.js"></script>
<script src="../../../vendors/jszip/dist/jszip.min.js"></script>
<script src="../../../vendors/pdfmake/build/pdfmake.min.js"></script>
<script src="../../../vendors/pdfmake/build/vfs_fonts.js"></script>

<!-- Custom Theme Scripts -->
<script src="../../../build/js/custom.min.js"></script>

<!-- Datatables -->
<script>
    $(document).ready(function() {
        var handleDataTableButtons = function() {
            if ($("#datatable-buttons").length) {
                $("#datatable-buttons").DataTable({
                    dom: "Bfrtip",
                    buttons: [
                        {
                            extend: "copy",
                            className: "btn-sm"
                        },
                        {
                            extend: "csv",
                            className: "btn-sm"
                        },
                        {
                            extend: "excel",
                            className: "btn-sm"
                        },
                        {
                            extend: "pdfHtml5",
                            className: "btn-sm"
                        },
                        {
                            extend: "print",
                            className: "btn-sm"
                        },
                    ],
                    responsive: true
                });
            }
        };

        TableManageButtons = function() {
            "use strict";
            return {
                init: function() {
                    handleDataTableButtons();
                }
            };
        }();

        $('#datatable').dataTable();

        $('#datatable-keytable').DataTable({
            keys: true
        });

        $('#datatable-responsive').DataTable();

        $('#datatable-scroller').DataTable({
            ajax: "js/datatables/json/scroller-demo.json",
            deferRender: true,
            scrollY: 380,
            scrollCollapse: true,
            scroller: true
        });

        $('#datatable-fixed-header').DataTable({
            fixedHeader: true
        });

        var $datatable = $('#datatable-checkbox');

        $datatable.dataTable({
            'order': [[ 1, 'asc' ]],
            'columnDefs': [
                { orderable: false, targets: [0] }
            ]
        });
        $datatable.on('draw.dt', function() {
            $('input').iCheck({
                checkboxClass: 'icheckbox_flat-green'
            });
        });

        TableManageButtons.init();
    });
</script>
<!-- /Datatables -->

</body>
</html>
