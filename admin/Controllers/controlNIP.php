<?php
$sErr = "";
$sEmail = "";
$nNum = 1;
    if(isset($_COOKIE['cUser']) && !empty($_COOKIE['cUser'])){
        $sEmail = $_COOKIE['cUser'];
        $sInt = $_COOKIE['cIntentos'];
    }else{
        $sErr = "Aún no ha ingresado datos de inicio de sesión";
    }
    if($sErr != "")
        header("Location:../error.php?sError=".$sErr);
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <!-- Meta, title, CSS, favicons, etc. -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">

    <title>Login </title>

    <!-- Bootstrap -->
    <link href="../../vendors/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link href="../../vendors/font-awesome/css/font-awesome.min.css" rel="stylesheet">
    <!-- NProgress -->
    <link href="../../vendors/nprogress/nprogress.css" rel="stylesheet">
    <!-- Animate.css -->
    <link href="https://colorlib.com/polygon/gentelella/css/animate.min.css" rel="stylesheet">

    <!-- Custom Theme Style -->
    <link href="../../build/css/custom.min.css" rel="stylesheet">
</head>

<body class="login">
<div>
    <a class="hiddenanchor" id="signup"></a>
    <a class="hiddenanchor" id="signin"></a>

    <div class="login_wrapper">
        <div class="animate form login_form">
            <section class="login_content">
                <form id="frm" role="form" action="validateNIP.php" method="post">
                    <h1>Ingrese su NIP </h1>
                    <h6><?php echo ($sInt > 0 && $sInt <=3 ? 'NIP INCORRECTO' : ''); ?></h6>
                    <div>
                        <input type="password" name="txtNum" min="0" pattern="^[0-9]{4}$" maxlength="4" class="form-control" placeholder="NIP" required=""/>
                    </div>
                    <div>
                        <input type="submit" value="Validar" class="btn btn-default" />

                    </div>
                    <br/>
                    <div>
                        <h5>Número de intentos <?php echo $_COOKIE['cIntentos']; ?></h5>
                    </div>

                    <div class="clearfix"></div>

                    <div class="separator">


                        <div class="clearfix"></div>
                        <br />

                        <div>
                            <h1><i class="fa fa-user-md"></i> uro-ginecologia</h1>
                            <p>©2016 Todos los derechos reservados</p>
                        </div>
                    </div>
                </form>
            </section>
        </div>


    </div>
</div>
</body>
</html>