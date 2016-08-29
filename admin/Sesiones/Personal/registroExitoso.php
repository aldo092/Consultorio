<?php
/**
 * Created by PhpStorm.
 * User: Pablo
 * Date: 28/08/2016
 * Time: 03:03 AM
 */
session_start();
$sErr = "";
$sMen = "";
if(isset($_SESSION['sUser']) && !empty($_SESSION['sUser'])){
    $sMen = "Usuario válido";
}else{
    $sErr = "Faltan datos de usuario, inicie sesión";
}

if($sErr != ""){
    header("Location: error.php?sError=".$sErr);
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <!-- Meta, title, CSS, favicons, etc. -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Sistema de Expediente Electrónico</title>

    <!-- Bootstrap -->
    <link href="../vendors/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link href="../vendors/font-awesome/css/font-awesome.min.css" rel="stylesheet">
    <!-- NProgress -->
    <link href="../vendors/nprogress/nprogress.css" rel="stylesheet">

    <!-- Custom Theme Style -->
    <link href="../build/css/custom.min.css" rel="stylesheet">
</head>

<body class="nav-md">
<div class="container body">
    <div class="main_container">
        <!-- page content -->
        <div class="col-md-12">
            <div class="col-middle">
                <div class="text-center">
                    <h1 class="error-number">REGISTRO EXITOSO</h1>
                    <h2></h2>
                    <p>Los datos del usuario se guardaron exitosamente, para verificar su código de acceso o NIP, vaya a su bandeja de correo 
                    </p>
                    <a href="../../Sesiones/Personal/controlPersonal.php">Regresar al panel de administración del equipo de trabajo</a>

                </div>
            </div>
        </div>
        <!-- /page content -->
    </div>
</div>

<!-- jQuery -->
<script src="../vendors/jquery/dist/jquery.min.js"></script>
<!-- Bootstrap -->
<script src="../vendors/bootstrap/dist/js/bootstrap.min.js"></script>
<!-- FastClick -->
<script src="../vendors/fastclick/lib/fastclick.js"></script>
<!-- NProgress -->
<script src="../vendors/nprogress/nprogress.js"></script>

<!-- Custom Theme Scripts -->
<script src="../build/js/custom.min.js"></script>
</body>
</html>
