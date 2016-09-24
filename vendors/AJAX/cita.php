<?php
/**
 * Created by PhpStorm.
 * User: Aldo
 * Date: 23/09/2016
 * Time: 04:16 PM
 */

include_once ("../../admin/Class/AccesoDatos.php");
include_once ("../../admin/Class/Horarios.php");
include_once ("../../admin/Class/Paciente.php");

$OH =new Horarios();
$oP = new Paciente();

$selectDestino=$_GET["select"];
$opcionSeleccionada=$_GET["opcion"];
$fecha=$_GET["fecha"];
$Dia= $OH->get_nombre_dia($fecha);

$selectPaciente="paciente";
$arrHor =$OH->buscarHorarios($opcionSeleccionada,$fecha,$Dia);
$arrPaciente =$oP->buscarPacientesDoctor($opcionSeleccionada);
    // Comienzo a imprimir el select
    if($arrHor != null){
        echo "<select name='".$selectDestino."' id='".$selectDestino."' onChange='cargaContenido(this.id)'' class='form-control' 'required='required''>";
        echo "<option value='0'>selecciona una opcion</option>";
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

if($arrPaciente != null){
    echo "<select name='".$selectPaciente."' id='".$selectPaciente."' onChange='cargaContenido(this.id)'' class='form-control' 'required='required''>";
    echo "<option value='0'>selecciona una opcion</option>";
    foreach($arrHor as $vRol){
        ?>
        <option value="<?php echo $vRol->getExpediente();?>">
            <?php echo $vRol->getApPaterno();?>
            <?php echo $vRol->getApMaterno();?>
            <?php echo $vRol->getNombre();?>

        </option>
        <?php
    }
    echo "</select>";



}







?>