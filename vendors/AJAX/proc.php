<?php
include_once ("../../admin/Class/AccesoDatos.php");
include_once ("../../admin/Class/Estados.php");

$selectDestino=$_GET["select"];
$opcionSeleccionada=$_GET["opcion"];
$OE =new Estados();
$arrMun =$OE->buscarMunicipios($opcionSeleccionada);

    // Comienzo a imprimir el select
    if($arrMun != null){
        echo "<select name='".$selectDestino."' id='".$selectDestino."' onChange='cargaContenido(this.id)'' class='form-control' 'required='required''>";
        echo "<option value='0'>Elige</option>";
        foreach($arrMun as $vRol){
            ?>
            <option value="<?php echo $vRol->getIDMunicipio();?>"><?php echo $vRol->getNombreMun();?></option>
            <?php
        }
        echo "</select>";
    }


?>