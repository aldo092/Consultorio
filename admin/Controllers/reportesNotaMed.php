<?php
/**
 * Created by PhpStorm.
 * User: Pablo
 * Date: 08/03/2017
 * Time: 12:55 AM
 */
require_once ("../Class/EstudioRealizado.php");

session_start();
$oEstReal = new EstudioRealizado();
$nIdEst = 0;
$sErr = "";
$sOp = $_POST['txtOpera'];
if(isset($_SESSION['sUser']) && !empty($_SESSION['sUser'])){
    if($_REQUEST['txtOp'] == 'descargar') {

        $nIdEst = $_REQUEST['nIdEstReal'];
        $oEstReal->setIdEstReal($nIdEst);
        if ($oEstReal->buscarArchivoEstReal()) {
            $sNombre = $oEstReal->getRutaArchivo();
            $sCad = substr($sNombre,12);
            if (is_file($sNombre)) {
                header('Content-Type: application/pdf');
                header('Content-Disposition: attachment; filename=' . $sCad);
                header('Content-Transfer-Enconding:binary');
                readfile($sNombre);
            } else {
                exit();
            }
        }
    }
}
?>