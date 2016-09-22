<?php

error_reporting(E_ALL);
include_once ("../../Class/Usuarios.php");
require_once ("../../Class/Menu.php");
require_once ("../../Class/Personal.php");
require_once ("../../Class/Estados.php");
require_once ("../../Class/Aseguradora.php");


session_start();
$oUser = new Usuarios();
$sErr = "";
$arrMenus = null;
$sNombre = "";
$oEstados=new Estados();
$oASeguradora= new Aseguradora();
$arrEdo=null;
$arrAseguradora=null;
$arrPersonal=null;
$oPersonal= new Personal();

if(isset($_SESSION['sUser']) && !empty($_SESSION['sUser'])){
    $oUser = $_SESSION['sUser'];
    $oMenu = new Menu();
    $oMenu->setUsuario($oUser);
    $arrMenus = $oMenu->buscarMenuUsuario();
    $arrEdo=$oEstados->buscarEstados();
    $arrAseguradora=$oASeguradora->buscarTodos();
    $arrPersonal=$oPersonal->buscarMedicos();
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

    <title>Consultorio Médico - Control de Personal</title>

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

    <!-- Datatables -->
    <link href="../../../vendors/datatables.net-bs/css/dataTables.bootstrap.min.css" rel="stylesheet">
    <link href="../../../vendors/datatables.net-buttons-bs/css/buttons.bootstrap.min.css" rel="stylesheet">
    <link href="../../../vendors/datatables.net-fixedheader-bs/css/fixedHeader.bootstrap.min.css" rel="stylesheet">
    <link href="../../../vendors/datatables.net-responsive-bs/css/responsive.bootstrap.min.css" rel="stylesheet">
    <link href="../../../vendors/datatables.net-scroller-bs/css/scroller.bootstrap.min.css" rel="stylesheet">

    <script type="text/javascript" src="../../../vendors/AJAX/estados.js"></script>

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
                <div class="page-title">
                    <div class="title_left">
                        <h3>Registro de Pacientes Nuevos  </h3>
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
                            <form action="../../Controllers/ctrlpaciente.php" method="post" id="demo-form2" data-parsley-validate class="form-horizontal form-label-left" >

                                <div class="form-group">
                                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="nombre">Nombre <span class="required">*</span>
                                    </label>
                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                        <input type="text" id="nombre" name="nombre" required="required" class="form-control col-md-7 col-xs-12">
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="ApPat">Apellido Paterno <span class="required">*</span>
                                    </label>
                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                        <input type="text" id="ApPat" name="ApPat" required="required" class="form-control col-md-7 col-xs-12">
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="ApMat">Apellido Materno <span class="required">*</span> </label>
                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                        <input type="text" id="ApMat" name="ApMat" required="required" class="form-control col-md-7 col-xs-12">
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="curp" class="control-label col-md-3 col-sm-3 col-xs-12">CURP<span class="required">*</span> </label>
                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                        <input id="curp" class="form-control col-md-7 col-xs-12" type="text" name="curp" required="required" >
                                    </div>
                                    <a target="_blank" href="https://consultas.curp.gob.mx/CurpSP/">consultar CURP</a>
                                </div>

                                <div class="form-group">
                                    <label for="rfc" class="control-label col-md-3 col-sm-3 col-xs-12">RFC<span class="required">*</span> </label>
                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                        <input id="rfc" class="form-control col-md-7 col-xs-12" type="text" name="rfc" required="required">
                                    </div>
                                    <a target="_blank" href="http://www.rfc-sat.com.mx/consulta-rfc-homoclave">consultar RFC con homoclave</a>
                                </div>


                                <div class="form-group">
                                    <label class="control-label col-md-3 col-sm-3 col-xs-12">Sexo</label>
                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                        <div id="sexo" class="btn-group" data-toggle="buttons">
                                            <label class="btn btn-default" data-toggle-class="btn-primary" data-toggle-passive-class="btn-default">
                                                <input type="radio" name="sexo" value="M" data-parsley-multiple="sexo"required="required"> &nbsp; Masculino&nbsp;
                                            </label>
                                            <label class="btn btn-primary" data-toggle-class="btn-primary" data-toggle-passive-class="btn-default">
                                                <input type="radio" name="sexo" value="F" data-parsley-multiple="sexo"required="required"> Femenino
                                            </label>
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="birthday" class="control-label col-md-3 col-sm-3 col-xs-12">Fecha de Nacimiento <span class="required">*</span>
                                    </label>
                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                        <input id="birthday" class="date-picker form-control col-md-7 col-xs-12 active" required="required" type="date" name="birthday">
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="telefono" class="control-label col-md-3 col-sm-3 col-xs-12">Telefono</label>
                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                        <input id="telefono" class="form-control col-md-7 col-xs-12" type="text" name="telefono"required="required">
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="direccion" class="control-label col-md-3 col-sm-3 col-xs-12">Dirección</label>
                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                        <input id="direccion" class="form-control col-md-7 col-xs-12" type="text" name="direccion"required="required">
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="localidad" class="control-label col-md-3 col-sm-3 col-xs-12">Localidad</label>
                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                        <input id="localidad" class="form-control col-md-7 col-xs-12" type="text" name="localidad"required="required">
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="municipio" class="control-label col-md-3 col-sm-3 col-xs-12">Municipio</label>
                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                        <select disabled="disabled" name="municipio" id="municipio" class="form-control"required="required">
                                            <option value="0">Seleccione</option>
                                        </select>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="estado" class="control-label col-md-3 col-sm-3 col-xs-12">Estado </label>
                                    <div class="col-md-6 col-sm-6 col-xs-12" id="ajax">
                                        <select id="estado" class="form-control" required="required" name="estado" onchange="cargaContenido(this.id)" >
                                            <option value="">Seleccione</option>

                                            <?php
                                            if($arrEdo != null){
                                                foreach($arrEdo as $vRol){
                                                    ?>
                                                    <option value="<?php echo $vRol->getIDEstado();?>"><?php echo $vRol->getNombreEdo();?></option>
                                                    <?php
                                                }
                                            }
                                            ?>
                                        </select>
                                    </div>
                                </div>


                                <div class="form-group">
                                    <label for="curp" class="control-label col-md-3 col-sm-3 col-xs-12">Código Postal</label>
                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                        <input id="cp" class="form-control col-md-7 col-xs-12" type="text" required="required" name="cp">
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="email" class="control-label col-md-3 col-sm-3 col-xs-12">Correo Electrónico</label>
                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                        <input id="email" class="form-control col-md-7 col-xs-12" type="text" name="email"required="required">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="edocivil" class="control-label col-md-3 col-sm-3 col-xs-12">Estado Civil</label>
                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                        <select id="edocivil" class="form-control" name="edocivil"required="required">
                                            <option value="">Selecciona..</option>
                                            <option value="Soltero">Soltero(a)</option>
                                            <option value="Casado">Casado(a)</option>
                                            <option value="Viudo">Viudo (a)</option>
                                            <option value="union_libre">Unión Libre</option>

                                        </select>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label  class="control-label col-md-3 col-sm-3 col-xs-12" for="medico">Seleccione su médico:</label>
                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                        <select id="medico" class="form-control" name="medico"required="required">
                                            <option value="">Seleccione</option>
                                            <?php
                                            if($arrPersonal!= null){
                                                foreach($arrPersonal as $vRol){
                                                    ?>
                                                    <option value="<?php echo $vRol-> getIdPersonal();?>"><?php echo $vRol->getNombres();?> <?php echo $vRol->getApPaterno();?> <?php echo $vRol->getApMaterno();?> </option>
                                                    <?php
                                                }
                                            }
                                            ?>
                                        </select>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label  class="control-label col-md-3 col-sm-3 col-xs-12" for="asegurado">¿Cuenta con seguro ?</label>
                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                        <select id="asegurado" class="form-control" name="asegurado"required="required">
                                            <option value="">Seleccione</option>
                                            <option value="Si">Si</option>
                                            <option value="No">No</option>


                                        </select>
                                    </div>
                                </div>

                                <div class="DatosSeg" >
                                    <div class="form-group">
                                        <label for="aseguradora" class="control-label col-md-3 col-sm-3 col-xs-12">Aseguradora </label>
                                        <div class="col-md-6 col-sm-6 col-xs-12" >
                                            <select id="aseguradora" class="form-control" required="required" name="aseguradora" >
                                                <option value="">Seleccione</option>

                                                <?php
                                                if($arrAseguradora!= null){
                                                    foreach($arrAseguradora as $vRol){
                                                        ?>
                                                        <option value="<?php echo $vRol-> getIdAseguradora();?>"><?php echo $vRol->getNombre();?></option>
                                                        <?php
                                                    }
                                                }
                                                ?>
                                            </select>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label for="poliza" class="control-label col-md-3 col-sm-3 col-xs-12">No. de poliza del seguro</label>
                                        <div class="col-md-6 col-sm-6 col-xs-12">
                                            <input id="poliza" class="form-control col-md-7 col-xs-12" type="text" name="poliza"required="required" >
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label for="vigencia" class="control-label col-md-3 col-sm-3 col-xs-12">Vigencia del seguro<span class="required">*</span>
                                        </label>
                                        <div class="col-md-6 col-sm-6 col-xs-12">
                                            <input id="vigencia" class="date-picker form-control col-md-7 col-xs-12 active" required="required" type="date" name="vigencia" >
                                        </div>
                                    </div>
                                </div>

                                <div class="ln_solid"></div>
                                <div class="form-group">
                                    <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
                                        <button type="submit" class="btn btn-success">Guardar</button>
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

<script src="../../../build/js/custom.min.js"></script>

    <script src="../../../vendors/validator/validator.js"></script>

    <script language="JavaScript" type="text/javascript">
        $(document).ready(function () {
            $(".DatosSeg").hide();

            $("#asegurado").change(function(){
                if ($("#asegurado").val() == 'Si') {
                $("#aseguradora").attr({
                    required: true
                });
                $("#poliza").attr({
                    required: true
                });
                $("#vigencia").attr({
                    required: true
                });
                $(".DatosSeg").show();
            }
            else {
                $("#aseguradora").attr({
                    required: false
                });
                $("#poliza").attr({
                    required: false
                });
                $("#vigencia").attr({
                    required: false
                });
                $(".DatosSeg").hide();

            }
        });
            });
    </script>





</body>
</html>
