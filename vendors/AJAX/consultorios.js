/**
 * Created by Aldo on 13/02/2017.
 */


function nuevoAjax()
{
    /* Crea el objeto AJAX. Esta funcion es generica para cualquier utilidad de este tipo, por
     lo que se puede copiar tal como esta aqui */
    var xmlhttp=false;
    try
    {
        // Creacion del objeto AJAX para navegadores no IE
        xmlhttp=new ActiveXObject("Msxml2.XMLHTTP");
    }
    catch(e)
    {
        try
        {
            // Creacion del objet AJAX para IE
            xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
        }
        catch(E)
        {
            if (!xmlhttp && typeof XMLHttpRequest!='undefined') xmlhttp=new XMLHttpRequest();
        }
    }
    return xmlhttp;
}

// Declaro los selects que componen el documento HTML. Su atributo ID debe figurar aqui.
var listadoSelects2=new Array();
listadoSelects2[0]="medico";
listadoSelects2[1]="consultorio";

function buscarEnArray(array, dato)
{
    // Retorna el indice de la posicion donde se encuentra el elemento en el array o null si no se encuentra
    var x=0;
    while(array[x])
    {
        if(array[x]==dato) return x;
        x++;
    }
    return null;
}

function cargaconsultorio(idSelectOrigen2)
{
    // Obtengo la posicion que ocupa el select que debe ser cargado en el array declarado mas arriba
    var posicionSelectDestino2=buscarEnArray(listadoSelects, idSelectOrigen2)+1;
    // Obtengo el select que el usuario modifico
    var selectOrigen2=document.getElementById(idSelectOrigen2);
    // Obtengo la opcion que el usuario selecciono
    var opcionSeleccionada2=selectOrigen2.options[selectOrigen2.selectedIndex].value;
    // Si el usuario eligio la opcion "Elige", no voy al servidor y pongo los selects siguientes en estado "Selecciona opcion..."
    if(opcionSeleccionada2==0)
    {
        var x=posicionSelectDestino2, selectActual=null;
        // Busco todos los selects siguientes al que inicio el evento onChange y les cambio el estado y deshabilito
        while(listadoSelects[x])
        {
            selectActual2=document.getElementById(listadoSelects[x]);
            selectActual2.length=0;

            var nuevaOpcion2=document.createElement("option"); nuevaOpcion2.value=0; nuevaOpcion2.innerHTML="Selecciona Opción...";
            selectActual2.appendChild(nuevaOpcion2);	selectActual2.disabled=true;
            x++;
        }
    }
    // Compruebo que el select modificado no sea el ultimo de la cadena
    else if(idSelectOrigen2!=listadoSelects2[listadoSelects2.length-1])
    {
        // Obtengo el elemento del select que debo cargar
        var idSelectDestino2=listadoSelects2[posicionSelectDestino2];
        var selectDestino2=document.getElementById(idSelectDestino2);
        // Creo el nuevo objeto AJAX y envio al servidor el ID del select a cargar y la opcion seleccionada del select origen
        var ajax=nuevoAjax();
        ajax.open("GET", "../../../vendors/AJAX/buscon.php?select="+idSelectDestino2+"&opcion="+opcionSeleccionada2, true);
        ajax.onreadystatechange=function()
        {
            if (ajax.readyState==1)
            {
                // Mientras carga elimino la opcion "Selecciona Opcion..." y pongo una que dice "Cargando..."
                selectDestino.length=0;
                var nuevaOpcion2=document.createElement("option"); nuevaOpcion2.value=0; nuevaOpcion2.innerHTML="Cargando...";
                selectDestino2.appendChild(nuevaOpcion); selectDestino2.disabled=true;
            }
            if (ajax.readyState==4)
            {
                selectDestino2.parentNode.innerHTML=ajax.responseText;
            }
        }
        ajax.send(null);
    }
}
