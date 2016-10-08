<?php
/**
 * Created by PhpStorm.
 * User: Aldo
 * Date: 26/09/2016
 * Time: 09:57 PM
 */



include_once ("../../admin/Class/AccesoDatos.php");
include_once ("../../admin/Class/Paciente.php");

$oP = new Paciente();

$selectDestino=$_GET["select"];
$opcionSeleccionada=$_GET["opcion"];
;

$arrPaciente =$oP->buscarPacientesDoctor($opcionSeleccionada);
    // Comienzo a imprimir el select



if($arrPaciente != null){
    echo "<select name='".$selectDestino."' id='".$selectDestino."' onChange='cargarPaciente(this.id)'' class='form-control' 'required='required''>";
    echo "<option value='0'>selecciona una opcion</option>";
    foreach($arrPaciente as $vRol){
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