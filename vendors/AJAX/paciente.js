/**
 * Created by Aldo on 26/09/2016.
 */
/**
 * Created by Aldo on 23/09/2016.
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



var Selects=new Array();
Selects[0]="consultorio";
Selects[1]="paciente";


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



function cargarPaciente(idOrigen)
{
    // Obtengo la posicion que ocupa el select que debe ser cargado en el array declarado mas arriba
    var posSelectDestino=buscarEnArray(Selects, idOrigen)+1;
    // Obtengo el select que el usuario modifico
    var selectOr=document.getElementById(idOrigen);
    // Obtengo la opcion que el usuario selecciono
    var Seleccionada=selectOr.options[selectOr.selectedIndex].value;

    if(Seleccionada==0)
    {
        var x=posSelectDestino, selectActual=null;
        while(Selects[x])
        {
            selectActual=document.getElementById(Selects[x]);
            selectActual.length=0;

            var nuevaOpcion=document.createElement("option"); nuevaOpcion.value=0; nuevaOpcion.innerHTML="Selecciona Opción...";
            selectActual.appendChild(nuevaOpcion);	selectActual.disabled=true;
            x++;
        }
    }
    // Compruebo que el select modificado no sea el ultimo de la cadena
    else if(idOrigen!=Selects[Selects.length-1])
    {
        // Obtengo el elemento del select que debo cargar
        var idSelectDest=Selects[posSelectDestino];
        var selectDest=document.getElementById(idSelectDest);
        // Creo el nuevo objeto AJAX y envio al servidor el ID del select a cargar y la opcion seleccionada del select origen
        var ajax=nuevoAjax();
        ajax.open("GET", "../../../vendors/AJAX/paciente.php?select="+idSelectDest+"&opcion="+Seleccionada, true);

        ajax.onreadystatechange=function()
        {
            if (ajax.readyState==1)
            {
                // Mientras carga elimino la opcion "Selecciona Opcion..." y pongo una que dice "Cargando..."
                selectDest.length=0;

                var nuevaOpcion=document.createElement("option"); nuevaOpcion.value=0; nuevaOpcion.innerHTML="Cargando...";

                selectDes.appendChild(nuevaOpcion); selectDest.disabled=true;

            }
            if (ajax.readyState==4)
            {
                selectDest.parentNode.innerHTML=ajax.responseText;
            }
        }
        ajax.send(null);
    }
}
