<?php
/**
 * Created by PhpStorm.
 * User: Aldo
 * Date: 23/09/2016
 * Time: 04:16 PM
 */

include_once ("../../admin/Class/AccesoDatos.php");
include_once ("../../admin/Class/Horarios.php");

$OH =new Horarios();

$selectDestino=$_GET["select"];
$opcionSeleccionada=$_GET["opcion"];
$fecha=$_GET["fecha"];
$Dia= $OH->get_nombre_dia($fecha);

$arrHor =$OH->buscarHorarios($opcionSeleccionada,$fecha,$Dia);
    if($arrHor != null){
        echo "<select name='".$selectDestino."' id='".$selectDestino."' onChange='cargaContenido(this.id)'' class='form-control' 'required='required''>";
        echo "<option value='0'>selecciona una opcion</option>";
           // Comienzo a imprimir el select
        foreach($arrHor as $vRol){
            ?>
            <option value="<?php echo $vRol->getConsultorio();?>">
                <?php echo $vRol->getHorarioInicio();?>
                <?php echo $vRol->getHorarioFin();?>
                 </option>
            <?php
        }
        echo "</select>";
    }
    else {

        echo "<select name='" . $selectDestino . "' id='" . $selectDestino . "' onChange='cargaContenido(this.id)'' class='form-control' 'required='required''>";
        echo "<option value='0'>No se encontraron horarios disponibles</option>";

    }




?>