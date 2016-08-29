<?php
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <!-- Meta, title, CSS, favicons, etc. -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">

    <title>ADVERTENCIA</title>

    <!-- Bootstrap -->
    <link href="../vendors/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link href="../vendors/font-awesome/css/font-awesome.min.css" rel="stylesheet">
    <!-- NProgress -->
    <link href="../vendors/nprogress/nprogress.css" rel="stylesheet">
    <!-- Animate.css -->
    <link href="https://colorlib.com/polygon/gentelella/css/animate.min.css" rel="stylesheet">

    <!-- Custom Theme Style -->
    <link href="../build/css/custom.min.css" rel="stylesheet">
</head>

<body class="login">
<div>
    <a class="hiddenanchor" id="signup"></a>
    <a class="hiddenanchor" id="signin"></a>

    <div class="login_wrapper">
        <div class="animate form login_form">
            <section class="login_content">
                <h1>Error</h1>
                <h4><?php echo $_REQUEST["sError"]; ?></h4>
                <a href="../../Sesiones/Personal/controlPersonal.php">Regresar al panel de administración</a>
                <div class="clearfix"></div>

                <div class="separator">

                    <div class="clearfix"></div>
                    <br />

                    <div>
                        <h1><i class="fa fa-user-md"></i> uro-ginecologia</h1>
                        <p>©2016 Todos los derechos reservados</p>
                    </div>
                </div>
            </section>
        </div>


    </div>
</div>
</body>
</html>