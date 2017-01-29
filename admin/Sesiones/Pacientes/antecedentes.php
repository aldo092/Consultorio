<?php
error_reporting(E_ALL);
include_once ("../../Class/Usuarios.php");
require_once ("../../Class/Menu.php");
require_once ("../../Class/Paciente.php");
require_once ("../../Class/Personal.php");
require_once ("../../Class/MetodoAnticonceptivo.php");
require_once ("../../Class/AntecFamiliares.php");
require_once ("../../Class/AntePatologicos.php");
require_once ("../../Class/AntecNoPatologicos.php");
require_once ("../../Class/AntecGinecobstetricos.php");

session_start();
$oUser = new Usuarios();
$sErr = "";
$arrMenus = null;
$Expediente ="";
$oPersonal = new Personal();
$sNombre = "";
$oAnticonceptivo= new MetodoAnticonceptivo();
$arrAnticon=null;
$oAntFam=new AntecFamiliares();
$oAntPat=new AntePatologicos();
$oAntNPat=new AntecNoPatologicos();
$oAntGin=new AntecGinecobstetricos();
$ArrAntFam=null;
$OantGin="";
$AntFam="";
$AntPat="";
$AntNpat="";
$antGin="";
$antFam="";
$antPat="";
$antNoPat="";
$AntGin="";
$divFam="";
$divPat="";
$divNoPat="";
$divGin="";
$todos="";
$mensaje="";

if(isset($_SESSION['sUser']) && !empty($_SESSION['sUser'])) {
    if (isset($_POST["txtExpediente"]) && !empty($_POST["txtExpediente"])) {
        $Expediente = $_POST['txtExpediente'];
        $Sexo = $_POST['txtSexo'];
        $AntFam = $oAntFam->ExisteAntFam($Expediente);
        $AntPat = $oAntPat->ExisteAntPat($Expediente);
        $AntNpat = $oAntNPat->ExisteAntNoPat($Expediente);
        $AntGin = $oAntGin->ExisteAntGin($Expediente);


       /* si solo exiten ant familiares y es hombre */
        if ($Sexo == "M" and $AntFam == true and $AntPat == false and $AntNpat == false) {
            $antGin = "hidden";
            $antFam = "hidden";
            $divPat = "active in";
        } else {
            /* si existen ant familiares y patologicos y eshombre */
            if ($Sexo == "M" and $AntFam == true and $AntPat == true and $AntNpat == false) {
                $antGin = "hidden";
                $antFam = "hidden";
                $antPat = "hidden";
                $divNoPat = "active in";
            } else {
                /* si es hombre y tiene todos los antecedentes registrados*/
                if ($Sexo == "M" and $AntFam == true and $AntPat == true and $AntNpat == true) {
                   $todos= "hidden";
                    $mensaje = "Se han registrado todos los antecedentes de este paciente";
                } else {
                    /*si es hombre y le faltan antecedentes patologicos */
                    if ($Sexo == "M" and $AntFam == true and $AntPat == false and $AntNpat == true) {
                        $antGin = "hidden";
                        $antFam = "hidden";
                        $antNoPat = "hidden";
                        $divPat = "active in";
                    } else {
                        /*si es hombre y le faltan todos los antecedentes*/
                        if ($Sexo == "M" and $AntFam == false and $AntPat == false and $AntNpat == false) {
                            $antGin= "hidden";
                            $divFam= "active in";

                        } else {
                            /*si es hombre y tiene antecedentes patologicos */
                            if ($Sexo == "M" and $AntFam == false and $AntPat == true and $AntNpat == false) {
                                $antPat = "hidden";
                                $divFam = "active in";
                                $antGin = "hidden";
                            }else{
                                if($Sexo == "M" and $AntFam == false and $AntPat == false and $AntNpat == true){
                                    $antGin="hidden";
                                    $antNoPat="hidden";
                                    $divFam="active in";
                                }else{
                                    if($Sexo=="F" and $AntFam==false and $AntPat==false and $AntNpat==false and $AntGin==false){
                                        $divFam="active in";
                                    }else{
                                        if($Sexo=="F" and $AntFam==true and $AntPat==true and $AntNpat==true and $AntGin==true){
                                            $todos= "hidden";
                                            $mensaje = "Se han registrado todos los antecedentes de este paciente";
                                        }else{
                                            if($Sexo=="F" and $AntFam==true and $AntPat==false and $AntNpat==false and $AntGin==false){
                                                $antFam="hidden";
                                                $divPat="active in";
                                            }else{
                                                if($Sexo=="F" and $AntFam==true and $AntPat==true and $AntNpat==false and $AntGin==false){
                                                    $antFam="hidden";
                                                    $antPat="hidden";
                                                    $divNoPat="active in";
                                                }else{
                                                    if($Sexo=="F" and $AntFam==true and $AntPat==true and $AntNpat==true and $AntGin==false){
                                                        $antFam="hidden";
                                                        $antPat="hidden";
                                                        $antNoPat="hidden";
                                                        $divGin="active in";
                                                    }
                                                    else{
                                                        if($Sexo=="F" and $AntFam==false and $AntPat==true and $AntNpat==false and $AntGin==false){
                                                            $antPat="hidden";
                                                            $divFam="active in";
                                                        }else{
                                                            if($Sexo=="F" and $AntFam==false and $AntPat==false and $AntNpat==true and $AntGin==false){
                                                                $antNoPat="hidden";
                                                                $divFam="active in";
                                                            }else{
                                                                if($Sexo=="F" and $AntFam==false and $AntPat==false and $AntNpat==false and $AntGin==true){
                                                                    $antGin="hidden";
                                                                    $divFam="active in";

                                                                }else{
                                                                    if($Sexo=="F" and $AntFam==true and $AntPat==false and $AntNpat==false and $AntGin==true){
                                                                        $antGin="hidden";
                                                                        $antFam="hidden";
                                                                        $divPat="active in";
                                                                    }else{
                                                                        if($Sexo=="F" and $AntFam==true and $AntPat==true and $AntNpat==false and $AntGin==true){
                                                                            $antFam="hidden";
                                                                            $antPat="hidden";
                                                                            $antGin="hidden";
                                                                            $divNoPat="active in";
                                                                        }else{
                                                                            if($Sexo=="F" and $AntFam==true and $AntPat==false and $AntNpat==true and $AntGin==false){
                                                                                $antFam="hidden";
                                                                                $antNoPat="hidden";
                                                                                $divPat="active in";
                                                                            }else{
                                                                                if($Sexo=="F" and $AntFam==false and $AntPat==true and $AntNpat==true and $AntGin==false){
                                                                                    $antNoPat="hidden";
                                                                                    $antPat="hidden";
                                                                                    $divFam="active in";
                                                                                }else{
                                                                                    if($Sexo=="F" and $AntFam==false and $AntPat==false and $AntNpat==true and $AntGin==true){
                                                                                        $antNoPat="hidden";
                                                                                        $antGin="hidden";
                                                                                        $divFam="active in";

                                                                                }else{
                                                                                        if($Sexo=="F" and $AntFam==false and $AntPat==true and $AntNpat==true and $AntGin==true){
                                                                                            $antGin="hidden";
                                                                                            $antPat="hidden";
                                                                                            $antNoPat="hidden";
                                                                                            $divFam= "active in";
                                                                                        }else{
                                                                                            if($Sexo=="F" and $AntFam==false and $AntPat==true and $AntNpat==false and $AntGin==true){
                                                                                                $divFam="active in";
                                                                                                $antPat="hidden";
                                                                                                $antGin="hidden";
                                                                                            }else{
                                                                                                if($Sexo=="F" and $AntFam==true and $AntPat==false and $AntNpat==true and $AntGin==true){
                                                                                                    $antFam="hidden";
                                                                                                    $antNoPat="hidden";
                                                                                                    $antGin="hidden";
                                                                                                    $divPat="active in";
                                                                                                }else{
                                                                                                    if ($Sexo == "M" and $AntFam ==false and $AntPat == true and $AntNpat == true) {
                                                                                                        $antGin="hidden";
                                                                                                        $antPat="hidden";
                                                                                                        $antNoPat="hidden";
                                                                                                        $divFam="active in";
                                                                                                    }

                                                                                                    }

                                                                                                }

                                                                                            }

                                                                                        }


                                                                                    }

                                                                                }


                                                                            }

                                                                        }


                                                                    }

                                                                }

                                                            }

                                                        }

                                                    }

                                                }

                                            }
                                    }
                                }
                            }
                        }
                    }
                }
            }
        }



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
<html lang="es" xmlns="http://www.w3.org/1999/html">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <!-- Meta, title, CSS, favicons, etc. -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Consultorio Médico - Registro de antedecentes </title>

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
                        <h3>Registro de Antecedentes de Pacientes </h3>
                        <h2> <?php echo $mensaje?></h2>
                    </div>


                </div>
                <div class="clearfix"></div>
                <div class="row <?php echo $todos ?> ">
                    <div class="col-md-12 col-sm-12 col-xs-12">
                        <div class="x_panel">
                            <div class="x_title">
                                <h2>favor de capturar todos los campos</h2>

                                <div class="clearfix"></div>
                            </div>
                            <div class="x_content">
                                <br>
                                <ul id="myTab" class="nav nav-tabs bar_tabs" role="tablist" >
                                    <li role="presentation" class="<?php echo $antFam;?>"><a href="#tab_content1" id="AntFam" role="tab" data-toggle="tab" aria-expanded="true">Antecentes Familiares</a>
                                    </li>
                                    <li role="presentation" class="<?php echo $antPat?>"><a href="#tab_content2" role="tab" id="AntPat" data-toggle="tab" aria-expanded="false">Antecedentes Patológicos</a>
                                    </li>
                                    <li role="presentation" class="<?php echo $antNoPat;?>"><a href="#tab_content3" role="tab" id="AntNPat" data-toggle="tab" aria-expanded="false">Antecedentes No patológicos</a>
                                    </li>
                                    <li role="presentation" class="<?php echo $antGin;?>"><a href="#tab_content4" role="tab" id="AntGin"  data-toggle="tab" aria-expanded="false" >Antecentes ginecoobstetricos</a>
                                    </li>

                                </ul>
                                <div id="myTabContent" class="tab-content">
                                    <div role="tabpanel" class="tab-pane fade <?php echo $divFam;?> " id="tab_content1" aria-labelledby="home-tab">

                                        <form class="form-horizontal" role="form" method="post" action="../../Controllers/ctrlAntFam.php">
                                         <input type="hidden" name="nExpediente" value="<?php echo $Expediente;?>">

                                            <div class="form-group ">
                                                <div class="col-md-4 col-md-offset-4">

                                                    <div class="form-group">
                                                        <label class="control-label col-xs-7 ">¿Existen familiares con
                                                            alcoholismo?</label>
                                                        <div class="col-xs-2">
                                                            <label class="radio-inline">
                                                                <input type="radio" name="alcoholismo" value="si" required="required"> si
                                                            </label>
                                                        </div>
                                                        <div class="col-xs-2">
                                                            <label class="radio-inline">
                                                                <input type="radio" name="alcoholismo" value="no"> no
                                                            </label>
                                                        </div>
                                                    </div>
                                                    <div class="form-group">
                                                        <label class="control-label col-xs-7">¿Existen familiares con
                                                            tabaquismo?</label>
                                                        <div class="col-xs-2">
                                                            <label class="radio-inline">
                                                                <input type="radio" name="tabaquismo" value="si" required="required"> si
                                                            </label>
                                                        </div>
                                                        <div class="col-xs-2">
                                                            <label class="radio-inline">
                                                                <input type="radio" name="tabaquismo" value="no" > no
                                                            </label>
                                                        </div>
                                                    </div>


                                                    <div class="form-group">
                                                        <label class="control-label col-xs-7">¿Existen familiares con
                                                            problemas de drogadicción?</label>
                                                        <div class="col-xs-2">
                                                            <label class="radio-inline">
                                                                <input type="radio" name="drogas" value="si" required="required"> si
                                                            </label>
                                                        </div>
                                                        <div class="col-xs-2">
                                                            <label class="radio-inline">
                                                                <input type="radio" name="drogas" value="no"> no
                                                            </label>
                                                        </div>
                                                    </div>
                                                    <div class="form-group">
                                                        <label class="control-label col-xs-7">¿Existen familiares con
                                                            asma?</label>
                                                        <div class="col-xs-2">
                                                            <label class="radio-inline">
                                                                <input type="radio" name="asma" value="si" required="required"> si
                                                            </label>
                                                        </div>
                                                        <div class="col-xs-2">
                                                            <label class="radio-inline">
                                                                <input type="radio" name="asma" value="no"> no
                                                            </label>
                                                        </div>
                                                    </div>
                                                    <div class="form-group">
                                                        <label class="control-label col-xs-7">¿Existen familiares con
                                                            diabetes?</label>
                                                        <div class="col-xs-2">
                                                            <label class="radio-inline">
                                                                <input type="radio" name="diabetes" value="si" required="required"> si
                                                            </label>
                                                        </div>
                                                        <div class="col-xs-2">
                                                            <label class="radio-inline">
                                                                <input type="radio" name="diabetes" value="no" > no
                                                            </label>
                                                        </div>
                                                    </div>
                                                    <div class="form-group">
                                                        <label class="control-label col-xs-7">¿Existen familiares con
                                                            hipertensión?</label>
                                                        <div class="col-xs-2">
                                                            <label class="radio-inline">
                                                                <input type="radio" name="hipertension" value="si" required="required"> si
                                                            </label>
                                                        </div>
                                                        <div class="col-xs-2">
                                                            <label class="radio-inline">
                                                                <input type="radio" name="hipertension" value="no" > no
                                                            </label>
                                                        </div>
                                                    </div>
                                                    <div class="form-group">
                                                        <label class="control-label col-xs-7">¿Existen familiares con
                                                            alergias?</label>
                                                        <div class="col-xs-2">
                                                            <label class="radio-inline">
                                                                <input type="radio" name="alergias" value="si" required="required"> si
                                                            </label>
                                                        </div>
                                                        <div class="col-xs-2">
                                                            <label class="radio-inline">
                                                                <input type="radio" name="alergias" value="no"> no
                                                            </label>
                                                        </div>
                                                    </div>
                                                    <div class="form-group">
                                                        <label class="control-label col-xs-7">¿Existen familiares que
                                                            presenten convulsiones?</label>
                                                        <div class="col-xs-2">
                                                            <label class="radio-inline">
                                                                <input type="radio" name="convulsiones" value="si" required="required"> si
                                                            </label>
                                                        </div>
                                                        <div class="col-xs-2">
                                                            <label class="radio-inline">
                                                                <input type="radio" name="convulsiones" value="no"> no
                                                            </label>
                                                        </div>
                                                    </div>
                                                    <div class="form-group">
                                                        <label class="control-label col-xs-7">¿Existen familiares con
                                                            defectos congenitos?</label>
                                                        <div class="col-xs-2">
                                                            <label class="radio-inline">
                                                                <input type="radio" name="congenitos" value="si" required="required"> si
                                                            </label>
                                                        </div>
                                                        <div class="col-xs-2">
                                                            <label class="radio-inline">
                                                                <input type="radio" name="congenitos" value="no" > no
                                                            </label>
                                                        </div>
                                                    </div>
                                                    <div class="form-group">
                                                        <label class="control-label col-xs-7">¿Existen familiares con
                                                            cáncer?</label>
                                                        <div class="col-xs-2">
                                                            <label class="radio-inline">
                                                                <input type="radio" name="cancer" value="si" required="required"> si
                                                            </label>
                                                        </div>
                                                        <div class="col-xs-2">
                                                            <label class="radio-inline">
                                                                <input type="radio" name="cancer" value="no"> no
                                                            </label>
                                                        </div>
                                                    </div>
                                                    <div class="form-group">
                                                        <label class="control-label col-xs-7">¿Existen familiares con
                                                            Cardiopatias?</label>
                                                        <div class="col-xs-2">
                                                            <label class="radio-inline">
                                                                <input type="radio" name="cardiopatias" value="si" required="required"> si
                                                            </label>
                                                        </div>
                                                        <div class="col-xs-2">
                                                            <label class="radio-inline">
                                                                <input type="radio" name="cardiopatias" value="no"> no
                                                            </label>
                                                        </div>
                                                    </div>
                                                    <div class="form-group">
                                                        <label class="control-label col-xs-7">¿Existen familiares con
                                                            tuberculosis?</label>
                                                        <div class="col-xs-2">
                                                            <label class="radio-inline">
                                                                <input type="radio" name="tb" value="si" required="required"> si
                                                            </label>
                                                        </div>
                                                        <div class="col-xs-2">
                                                            <label class="radio-inline">
                                                                <input type="radio" name="tb" value="no"> no
                                                            </label>
                                                        </div>
                                                    </div>
                                                    <div class="form-group">
                                                        <label class="control-label col-xs-7">¿Existen familiares con
                                                            epilepsia?</label>
                                                        <div class="col-xs-2">
                                                            <label class="radio-inline">
                                                                <input type="radio" name="epilepsia" value="si" required="required"> si
                                                            </label>
                                                        </div>
                                                        <div class="col-xs-2">
                                                            <label class="radio-inline">
                                                                <input type="radio" name="epilepsia" value="no"> no
                                                            </label>
                                                        </div>
                                                    </div>
                                                    <div class="form-group">
                                                        <label class="control-label col-xs-7">¿Existen familiares con
                                                            insuficiencia renal?</label>
                                                        <div class="col-xs-2">
                                                            <label class="radio-inline">
                                                                <input type="radio" name="insren" value="si" required="required"> si
                                                            </label>
                                                        </div>
                                                        <div class="col-xs-2">
                                                            <label class="radio-inline">
                                                                <input type="radio" name="insren" value="no"> no
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

                                    <div role="tabpanel" class="tab-pane fade <?php echo $divPat;?> " id="tab_content2"  aria-labelledby="home-tab">
                                        <form class="form-horizontal" role="form" method="post" action="../../Controllers/ctrlAntPat.php">
                                            <input type="hidden" name="nExpediente" value="<?php echo $Expediente;?>">

                                            <div class="form-group ">
                                                <div class="col-md-4 col-md-offset-4">

                                                    <div class="form-group">
                                                        <label class="control-label col-xs-7 ">Tiene problemas
                                                            Cardiavasculares</label>
                                                        <div class="col-xs-2">
                                                            <label class="radio-inline">
                                                                <input type="radio" name="cardiovascular" value="si" required="required"> si
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
                                                                <input type="radio" name="hiper" value="si" required="required"> si
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
                                                            <input class="form-control input-sm" type="text" name="cardiopatia" required="required" >
                                                        </div>
                                                    </div>
                                                    <div class="form-group">
                                                        <label class="control-label col-xs-7">Ha recibido transfusiones
                                                            de sangre</label>
                                                        <div class="col-xs-2">
                                                            <label class="radio-inline">
                                                                <input type="radio" name="transfusiones" value="si" required="required"> si
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
                                                            <select class="form-control input-sm"name="diabetes" required="required">

                                                                <option value="No">No</option>
                                                                <option value="Tipo1">Tipo 1</option>
                                                                <option value="Tipo2">Tipo 2</option>
                                                                <option value="Gestacion">Durante gestación</option>

                                                            </select>
                                                        </div>

                                                    </div>


                                                    <label class="control-label col-xs-7">Describa sus alergías</label>
                                                    <div class="col-xs-5">
                                                        <input class="form-control input-sm" type="text" name ="alergias" required="required">
                                                    </div>

                                                    <div class="form-group">
                                                        <label class="control-label col-xs-7">¿Ha tenido fracturas?
                                                            </label>
                                                        <div class="col-xs-2">
                                                            <label class="radio-inline">
                                                                <input type="radio" name="fracturas" value="si" required="required"> si
                                                            </label>
                                                        </div>
                                                        <div class="col-xs-2">
                                                            <label class="radio-inline">
                                                                <input type="radio" name="fracturas" value="no"> no
                                                            </label>
                                                        </div>
                                                    </div>
                                                    <div class="form-group">
                                                        <label class="control-label col-xs-7">¿Tiene o tuvó enfermedades reumáticas?</label>
                                                        <div class="col-xs-2">
                                                            <label class="radio-inline">
                                                                <input type="radio" name="reumaticas" value="si" required="required"> si
                                                            </label>
                                                        </div>
                                                        <div class="col-xs-2">
                                                            <label class="radio-inline">
                                                                <input type="radio" name="reumaticas" value="no"> no
                                                            </label>
                                                        </div>
                                                    </div>
                                                    <div class="form-group">
                                                        <label class="control-label col-xs-7">¿Tiene o tuvo Rinits?</label>
                                                        <div class="col-xs-2">
                                                            <label class="radio-inline">
                                                                <input type="radio" name="rinitis" value="si" required="required"> si
                                                            </label>
                                                        </div>
                                                        <div class="col-xs-2">
                                                            <label class="radio-inline">
                                                                <input type="radio" name="rinitis" value="no"> no
                                                            </label>
                                                        </div>
                                                    </div>
                                                    <div class="form-group">
                                                        <label class="control-label col-xs-7">¿Tiene Asma?</label>
                                                        <div class="col-xs-2">
                                                            <label class="radio-inline">
                                                                <input type="radio" name="asma" value="si" required="required"> si
                                                            </label>
                                                        </div>
                                                        <div class="col-xs-2">
                                                            <label class="radio-inline">
                                                                <input type="radio" name="asma" value="no"> no
                                                            </label>
                                                        </div>
                                                    </div>
                                                    <div class="form-group">
                                                        <label class="control-label col-xs-7">¿Sufre de convulsiones?</label>
                                                        <div class="col-xs-2">
                                                            <label class="radio-inline">
                                                                <input type="radio" name="convulsiones" value="si" required="required"> si
                                                            </label>
                                                        </div>
                                                        <div class="col-xs-2">
                                                            <label class="radio-inline">
                                                                <input type="radio" name="convulsiones" value="no"> no
                                                            </label>
                                                        </div>
                                                    </div>
                                                    <div class="form-group">
                                                        <label class="control-label col-xs-7">¿Presenta migrañas regularmente?</label>
                                                        <div class="col-xs-2">
                                                            <label class="radio-inline">
                                                                <input type="radio" name="migrañas" value="si" required="required"> si
                                                            </label>
                                                        </div>
                                                        <div class="col-xs-2">
                                                            <label class="radio-inline">
                                                                <input type="radio" name="migrañas" value="no"> no
                                                            </label>
                                                        </div>
                                                    </div>
                                                    <div class="form-group">
                                                        <label class="control-label col-xs-7">¿Tiene problemas psiquiátricos?</label>
                                                        <div class="col-xs-2">
                                                            <label class="radio-inline">
                                                                <input type="radio" name="psiquiatricos" value="si" required="required"> si
                                                            </label>
                                                        </div>
                                                        <div class="col-xs-2">
                                                            <label class="radio-inline">
                                                                <input type="radio" name="psiquiatricos" value="no"> no
                                                            </label>
                                                        </div>
                                                    </div>
                                                    <div class="form-group">
                                                        <label class="control-label col-xs-7">¿Tuberculosis?</label>
                                                        <div class="col-xs-2">
                                                            <label class="radio-inline">
                                                                <input type="radio" name="tb" value="si" required="required"> si
                                                            </label>
                                                        </div>
                                                        <div class="col-xs-2">
                                                            <label class="radio-inline">
                                                                <input type="radio" name="tb" value="no"> no
                                                            </label>
                                                        </div>
                                                    </div>
                                                    <div class="form-group">
                                                        <label class="control-label col-xs-7">¿Presenta enfermedades vascular cerebral?</label>
                                                        <div class="col-xs-2">
                                                            <label class="radio-inline">
                                                                <input type="radio" name="evc" value="si" required="required"> si
                                                            </label>
                                                        </div>
                                                        <div class="col-xs-2">
                                                            <label class="radio-inline">
                                                                <input type="radio" name="evc" value="no"> no
                                                            </label>
                                                        </div>
                                                    </div>
                                                    <div class="form-group">
                                                        <label class="control-label col-xs-7">¿Tiene problemas de la piel?</label>
                                                        <div class="col-xs-2">
                                                            <label class="radio-inline">
                                                                <input type="radio" name="dermatosis" value="si" required="required"> si
                                                            </label>
                                                        </div>
                                                        <div class="col-xs-2">
                                                            <label class="radio-inline">
                                                                <input type="radio" name="dermatosis" value="no"> no
                                                            </label>
                                                        </div>
                                                    </div>
                                                    <div class="form-group">
                                                        <label class="control-label col-xs-7">¿Tiene problemas de audición?</label>
                                                        <div class="col-xs-2">
                                                            <label class="radio-inline">
                                                                <input type="radio" name="audicion" value="si" required="required"> si
                                                            </label>
                                                        </div>
                                                        <div class="col-xs-2">
                                                            <label class="radio-inline">
                                                                <input type="radio" name="audicion" value="no"> no
                                                            </label>
                                                        </div>
                                                    </div>
                                                    <div class="form-group">
                                                        <label class="control-label col-xs-7">¿Tiene problemas de la vista?</label>
                                                        <div class="col-xs-2">
                                                            <label class="radio-inline">
                                                                <input type="radio" name="vision" value="si" required="required"> si
                                                            </label>
                                                        </div>
                                                        <div class="col-xs-2">
                                                            <label class="radio-inline">
                                                                <input type="radio" name="vision" value="no"> no
                                                            </label>
                                                        </div>
                                                    </div>
                                                    <div class="form-group">
                                                        <label class="control-label col-xs-7">¿Tiene enfermedades arteriales?</label>
                                                        <div class="col-xs-2">
                                                            <label class="radio-inline">
                                                                <input type="radio" name="enfart" value="si" required="required"> si
                                                            </label>
                                                        </div>
                                                        <div class="col-xs-2">
                                                            <label class="radio-inline">
                                                                <input type="radio" name="enfart" value="no"> no
                                                            </label>
                                                        </div>
                                                    </div>
                                                    <div class="form-group">
                                                        <label class="control-label col-xs-7">¿Tiene problemas de varices?</label>
                                                        <div class="col-xs-2">
                                                            <label class="radio-inline">
                                                                <input type="radio" name="varices" value="si" required="required"> si
                                                            </label>
                                                        </div>
                                                        <div class="col-xs-2">
                                                            <label class="radio-inline">
                                                                <input type="radio" name="varices" value="no"> no
                                                            </label>
                                                        </div>
                                                    </div>
                                                    <div class="form-group">
                                                        <label class="control-label col-xs-7">¿Tiene o tuvo úlceras?</label>
                                                        <div class="col-xs-2">
                                                            <label class="radio-inline">
                                                                <input type="radio" name="ulceras" value="si" required="required"> si
                                                            </label>
                                                        </div>
                                                        <div class="col-xs-2">
                                                            <label class="radio-inline">
                                                                <input type="radio" name="ulceras" value="no"> no
                                                            </label>
                                                        </div>
                                                    </div>
                                                    <div class="form-group">
                                                        <label class="control-label col-xs-7">¿Tiene o tuvo apendicitis?</label>
                                                        <div class="col-xs-2">
                                                            <label class="radio-inline">
                                                                <input type="radio" name="apendicitis" value="si" required="required"> si
                                                            </label>
                                                        </div>
                                                        <div class="col-xs-2">
                                                            <label class="radio-inline">
                                                                <input type="radio" name="apendicitis" value="no"> no
                                                            </label>
                                                        </div>
                                                    </div>
                                                    <div class="form-group">
                                                        <label class="control-label col-xs-7">¿Tiene o tuvo problemas de la prostata?</label>
                                                        <div class="col-xs-2">
                                                            <label class="radio-inline">
                                                                <input type="radio" name="prostata" value="si" required="required"> si
                                                            </label>
                                                        </div>
                                                        <div class="col-xs-2">
                                                            <label class="radio-inline">
                                                                <input type="radio" name="prostata" value="no"> no
                                                            </label>
                                                        </div>
                                                    </div>
                                                    <div class="form-group">
                                                        <label class="control-label col-xs-7">¿Tiene o tuvo enfermedades urinarias y/o venereas?</label>
                                                        <div class="col-xs-2">
                                                            <label class="radio-inline">
                                                                <input type="radio" name="urinarias" value="si" required="required"> si
                                                            </label>
                                                        </div>
                                                        <div class="col-xs-2">
                                                            <label class="radio-inline">
                                                                <input type="radio" name="urinarias" value="no"> no
                                                            </label>
                                                        </div>
                                                    </div>
                                                    <div class="form-group">
                                                        <label class="control-label col-xs-7">¿Tiene o tuvo enfermedades ácido pépticas?</label>
                                                        <div class="col-xs-2">
                                                            <label class="radio-inline">
                                                                <input type="radio" name="acipep" value="si" required="required"> si
                                                            </label>
                                                        </div>
                                                        <div class="col-xs-2">
                                                            <label class="radio-inline">
                                                                <input type="radio" name="acipep" value="no"> no
                                                            </label>
                                                        </div>
                                                    </div>
                                                    <div class="form-group">
                                                        <label class="control-label col-xs-7">¿Tiene o tuvo sangrado digestivo?</label>
                                                        <div class="col-xs-2">
                                                            <label class="radio-inline">
                                                                <input type="radio" name="sandig" value="si" required="required"> si
                                                            </label>
                                                        </div>
                                                        <div class="col-xs-2">
                                                            <label class="radio-inline">
                                                                <input type="radio" name="sandig" value="no"> no
                                                            </label>
                                                        </div>
                                                    </div>
                                                    <div class="form-group">
                                                        <label class="control-label col-xs-7">¿Tiene o tuvo hepatitis?</label>
                                                        <div class="col-xs-2">
                                                            <label class="radio-inline">
                                                                <input type="radio" name="hepatitis" value="si" required="required"> si
                                                            </label>
                                                        </div>
                                                        <div class="col-xs-2">
                                                            <label class="radio-inline">
                                                                <input type="radio" name="hepatitis" value="no"> no
                                                            </label>
                                                        </div>
                                                    </div>
                                                    <div class="form-group">
                                                        <label class="control-label col-xs-7">¿Tiene o tuvo hernias?</label>
                                                        <div class="col-xs-2">
                                                            <label class="radio-inline">
                                                                <input type="radio" name="hernias" value="si" required="required"> si
                                                            </label>
                                                        </div>
                                                        <div class="col-xs-2">
                                                            <label class="radio-inline">
                                                                <input type="radio" name="hernias" value="no"> no
                                                            </label>
                                                        </div>
                                                    </div>
                                                    <div class="form-group">
                                                        <label class="control-label col-xs-7">¿sufre de colitis?</label>
                                                        <div class="col-xs-2">
                                                            <label class="radio-inline">
                                                                <input type="radio" name="colitis" value="si" required="required"> si
                                                            </label>
                                                        </div>
                                                        <div class="col-xs-2">
                                                            <label class="radio-inline">
                                                                <input type="radio" name="colitis" value="no"> no
                                                            </label>
                                                        </div>
                                                    </div>

                                                    <div class="form-group">
                                                        <label class="control-label col-xs-7">¿Tiene  o tuvo problemas de colecistitis?</label>
                                                        <div class="col-xs-2">
                                                            <label class="radio-inline">
                                                                <input type="radio" name="colecis" value="si" required="required"> si
                                                            </label>
                                                        </div>
                                                        <div class="col-xs-2">
                                                            <label class="radio-inline">
                                                                <input type="radio" name="colecis" value="no"> no
                                                            </label>
                                                        </div>
                                                    </div>
                                                    <div class="form-group">
                                                        <label class="control-label col-xs-7">¿Presenta problemas de patología anal?</label>
                                                        <div class="col-xs-2">
                                                            <label class="radio-inline">
                                                                <input type="radio" name="patanal" value="si" required="required"> si
                                                            </label>
                                                        </div>
                                                        <div class="col-xs-2">
                                                            <label class="radio-inline">
                                                                <input type="radio" name="patanal" value="no"> no
                                                            </label>
                                                        </div>
                                                    </div>

                                                    <div class="form-group">
                                                        <label class="control-label col-xs-7">¿Ha sido internado?</label>
                                                        <div class="col-xs-2">
                                                            <label class="radio-inline">
                                                                <input type="radio" name="internamientos" value="si" required="required"> si
                                                            </label>
                                                        </div>
                                                        <div class="col-xs-2">
                                                            <label class="radio-inline">
                                                                <input type="radio" name="internamientos" value="no"> no
                                                            </label>
                                                        </div>
                                                    </div>
                                                    <div class="form-group">
                                                        <label class="control-label col-xs-7">¿Se ha sometido a alguna cirujía?</label>
                                                        <div class="col-xs-2">
                                                            <label class="radio-inline">
                                                                <input type="radio" name="cirujias" value="si" required="required"> si
                                                            </label>
                                                        </div>
                                                        <div class="col-xs-2">
                                                            <label class="radio-inline">
                                                                <input type="radio" name="cirujias" value="no"> no
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

                                    <div role="tabpanel" class="tab-pane fade <?php echo $divNoPat;?>" id="tab_content3" aria-labelledby="home-tab">

                                        <form class="form-horizontal" role="form" method="post" action="../../Controllers/ctrlAntNoPat.php">
                                            <input type="hidden" name="nExpediente" value="<?php echo $Expediente;?>">

                                            <div class="form-group ">
                                                <div class="col-md-4 col-md-offset-4">

                                                    <div class="form-group">
                                                        <label class="control-label col-xs-7 ">Padece
                                                            alcoholismo</label>
                                                        <div class="col-xs-2">
                                                            <label class="radio-inline">
                                                                <input type="radio" name="alcoholismo" value="si" required="required"> si
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
                                                                <input type="radio" name="tabaquismo" value="si" required="required"> si
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
                                                                <input type="radio" name="drogas" value="si" required="required"> si
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
                                                                <input type="radio" name="luz" value="si" required="required"> si
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
                                                                <input type="radio" name="aguapotable" value="si" required="required"> si
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
                                                                <input type="radio" name="drenaje" value="si" required="required"> si
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
                                                                <input type="radio" name="water" value="si" required="required"> si
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
                                                            <select class="form-control input-sm" name="estudios" required="required">
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
                                                            <select class="form-control input-sm" name="religion" required="required">
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
                                                            <input class="form-control input-sm" type="text" name="ocupacion" required="required">

                                                        </div>
                                                    </div>
                                                    <div class="form-group">
                                                        <label class="control-label col-xs-7">¿Cuenta con la vacuna BCG?</label>
                                                        <div class="col-xs-2">
                                                            <label class="radio-inline">
                                                                <input type="radio" name="bcg" value="si" required="required"> si
                                                            </label>
                                                        </div>
                                                        <div class="col-xs-2">
                                                            <label class="radio-inline">
                                                                <input type="radio" name=bcg value="no"> no
                                                            </label>
                                                        </div>
                                                    </div>
                                                    <div class="form-group">
                                                        <label class="control-label col-xs-7">¿Está vacunado contra la Polio?</label>
                                                        <div class="col-xs-2">
                                                            <label class="radio-inline">
                                                                <input type="radio" name="polio" value="si" required="required"> si
                                                            </label>
                                                        </div>
                                                        <div class="col-xs-2">
                                                            <label class="radio-inline">
                                                                <input type="radio" name="polio" value="no"> no
                                                            </label>
                                                        </div>
                                                    </div>
                                                    <div class="form-group">
                                                        <label class="control-label col-xs-7">¿Cuenta con la vacuna pentavalente?</label>
                                                        <div class="col-xs-2">
                                                            <label class="radio-inline">
                                                                <input type="radio" name="penta" value="si" required="required"> si
                                                            </label>
                                                        </div>
                                                        <div class="col-xs-2">
                                                            <label class="radio-inline">
                                                                <input type="radio" name="penta" value="no"> no
                                                            </label>
                                                        </div>
                                                    </div>
                                                    <div class="form-group">
                                                        <label class="control-label col-xs-7">¿Está vacunado contra influenza?</label>
                                                        <div class="col-xs-2">
                                                            <label class="radio-inline">
                                                                <input type="radio" name="influenza" value="si" required="required"> si
                                                            </label>
                                                        </div>
                                                        <div class="col-xs-2">
                                                            <label class="radio-inline">
                                                                <input type="radio" name="influenza" value="no"> no
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

                                    <div role="tabpanel" class="tab-pane fade<?php echo $divGin;?> " id="tab_content4" aria-labelledby="home-tab" >

                                        <form class="form-horizontal" role="form" method="post" action="../../Controllers/ctrlAntGin.php">

                                            <input type="hidden" name="nExpediente" id="nExpediente" value="<?php echo $Expediente;?>">

                                            <div class="form-group ">
                                                <div class="col-md-4 col-md-offset-4">

                                                    <div class="form-group">
                                                        <label class="control-label col-xs-7">¿Cuantas gestaciones ha tenido?</label>
                                                        <div class="col-xs-5">
                                                            <input class="form-control input-sm" type="number" id="gestaciones" name="gestaciones" required="required">
                                                        </div>
                                                    </div>

                                                    <div class="form-group">
                                                        <label class="control-label col-xs-7">¿Cuantas partos ha tenido?</label>
                                                        <div class="col-xs-5">
                                                            <input class="form-control input-sm" type="number" id="partos" name="partos" required="required">
                                                        </div>
                                                    </div>

                                                    <div class="form-group">
                                                        <label class="control-label col-xs-7">¿Cuantas abortos ha tenido?</label>
                                                        <div class="col-xs-5">
                                                            <input class="form-control input-sm" type="number" id="abortos" name="abortos" required="required">
                                                        </div>
                                                    </div>

                                                    <div class="form-group">
                                                        <label class="control-label col-xs-7">¿A que edad comenzó su vida sexual activa?</label>
                                                        <div class="col-xs-5">
                                                            <input class="form-control input-sm" type="number" id="ivsa" name="ivsa" required="required">
                                                        </div>
                                                    </div>

                                                    <div class="form-group">
                                                        <label class="control-label col-xs-7">¿Cuantas parejas sexuales ha tenido?</label>
                                                        <div class="col-xs-5">
                                                            <input class="form-control input-sm" type="number" id="parejas" name="parejas" required="required">
                                                        </div>
                                                    </div>

                                                    <div class="form-group">
                                                        <label class="control-label col-xs-7">Última ETS presentada</label>
                                                        <div class="col-xs-5">
                                                            <input class="form-control input-sm" type="text" id="ets" name="ets" required="required">
                                                        </div>
                                                    </div>

                                                    <div class="form-group">
                                                        <label class="control-label col-xs-7">¿Cuantas cesareas ha tenido?</label>
                                                        <div class="col-xs-5">
                                                            <input class="form-control input-sm" type="number" id="cesareas" name="cesareas" required="required">
                                                        </div>
                                                    </div>

                                                    <div class="form-group">
                                                        <label for="papanicolau" class="control-label col-xs-7">Fecha de último papanicolau</label>
                                                        <div class=" col-xs-5">
                                                            <input id="papanicolau" class="date-picker form-control col-md-7 col-xs-12 active" type="date" name="papanicolau" required="required"">
                                                        </div>
                                                    </div>
                                                    <div class="form-group">
                                                        <label class="control-label col-xs-7">Método anticonceptivo que utiliza</label>
                                                        <div class="col-xs-5">
                                                            <select class="form-control input-sm" id="anticonceptivo" name="anticonceptivo" required="required">
                                                                <option value="0">Seleccione</option>
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
                                                        </div>
                                                    <div class="form-group">

                                                        <div class="form-group">
                                                            <label for="fup" class="control-label col-xs-7">Fecha del último parto</label>
                                                            <div class=" col-xs-5">
                                                                <input id="fup" class="date-picker form-control col-md-7 col-xs-12 active" type="date" name="fup" required="required"">
                                                            </div>
                                                        </div>

                                                        <div class="form-group">
                                                            <label for="fum" class="control-label col-xs-7">Fecha de la última menstruación</label>
                                                            <div class=" col-xs-5">
                                                                <input id="fum" class="date-picker form-control col-md-7 col-xs-12 active" type="date" name="fum" required="required"">
                                                            </div>
                                                        </div>


                                                    <div class="form-group">
                                                        <label class="control-label col-xs-7">Edad de su menarca</label>
                                                        <div class="col-xs-5">
                                                            <input class="form-control input-sm" type="number" id="menarca" name="menarca" required="required">
                                                        </div>
                                                    </div>

                                                    <div class="form-group">
                                                        <label class="control-label col-xs-7">Observaciones del médico</label>
                                                        <div class="col-xs-5">
                                                            <input class="form-control input-sm" type="text" name="observaciones" required="required">

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
                                </div>
                            </div>
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
