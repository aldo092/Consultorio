<?php
/**
 * Created by PhpStorm.
 * User: Aldo
 * Date: 13/02/2017
 * Time: 04:38 PM
 */

include_once ("../../admin/Class/AccesoDatos.php");
include_once ("../../admin/Class/Consultorio.php");

$selectDestino=$_GET["select"];
$opcionSeleccionada=$_GET["opcion"];
$OC =new Medico();
$arrCon =$OC->buscarConsultorios($opcionSeleccionada);

// Comienzo a imprimir el select
if($arrCon != null){
    echo "<select name='".$selectDestino."' id='".$selectDestino."' onChange='cargaconsultorio(this.id)'' class='form-control' 'required='required''>";
    echo "<option value='0'>Elige</option>";
    foreach($arrCon as $vRol){
        ?>
        <option value="<?php echo $vRol->getNIDconsultorio();?>"><?php echo $vRol->getNombre();?></option>
        <?php
    }
    echo "</select>";
}


?>