/**
 * Created by Aldo on 04/09/2016.
 */


function nuevoAjax(){
    /* Crea el objeto AJAX. Esta funcion es generica para cualquier utilidad de este tipo, por
     lo que se puede copiar tal como esta aqui */
    var xmlhttp=false;
    try{
        // Creacion del objeto AJAX para navegadores no IE
        xmlhttp=new ActiveXObject("Msxml2.XMLHTTP");
    }
    catch(e){
        try{
            // Creacion del objet AJAX para IE
            xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
        }
        catch(E){
            if (!xmlhttp && typeof XMLHttpRequest!='undefined') xmlhttp=new XMLHttpRequest();
        }
    }
    return xmlhttp;
}

function cargaMunicipios(idSelectOrigen){
    // Obtengo el select que el usuario modifico
    var selectOrigen=document.getElementById(idSelectOrigen);
    // Obtengo la opcion que el usuario selecciono
    var opcionSeleccionada=selectOrigen.options[selectOrigen.selectedIndex].value;
    // Si el usuario eligio la opcion "Elige", no voy al servidor y pongo los selects siguientes en estado "Selecciona estado..."
    if(opcionSeleccionada==0)
    {
        var selectActual=null;
        if(idSelectOrigen == "estado")
            selectActual=document.getElementById("municipio");
        selectActual.length=0;
        var nuevaOpcion=document.createElement("option");
        nuevaOpcion.value=0;
        nuevaOpcion.innerHTML="Seleccione Estado";
        selectActual.appendChild(nuevaOpcion);
        selectActual.disabled=true;
    }
    // Compruebo que el select modificado no sea el ultimo de la cadena
    else{
        if(idSelectOrigen == "estado")
            var selectDestino=document.getElementById("municipio");
        // Creo el nuevo objeto AJAX y envio al servidor la opcion seleccionada del select origen
        var ajax=nuevoAjax();
        ajax.open("GET", "../proc.php?opcion="+opcionSeleccionada+"&select="+idSelectOrigen, true);
        ajax.onreadystatechange=function()
        {
            if (ajax.readyState==1)
            {
                // Mientras carga elimino la opcion "Selecciona Opcion..." y pongo una que dice "Cargando..."
                selectDestino.length=0;
                var nuevaOpcion=document.createElement("option");
                nuevaOpcion.value=0;
                nuevaOpcion.innerHTML="Cargando...";
                selectDestino.appendChild(nuevaOpcion);
                selectDestino.disabled=true;
            }
            if (ajax.readyState==4)
            {
                selectDestino.parentNode.innerHTML=ajax.responseText;
            }
        }
        ajax.send(null);
    }
}