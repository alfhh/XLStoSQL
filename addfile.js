/**
 * Created by enriqueohernandez on 5/2/15.
 */
function addFile(){

    // window.alert("agregar Renglon");
    var url="agregar.php";
    var req =  new XMLHttpRequest();
    req.onload = handler2;
    req.open("GET", url, true);
    req.send();

}
function handler2(){
    document.getElementById("result").innerHTML();
}


function consultar(){
    var dia=document.getElementById("dia").value;
    var mes=document.getElementById("mes").value;
    var url="horoscopo.php?dia="+dia+"&mes="+mes;
    var req =  new XMLHttpRequest();
    req.onload = handler;
    req.open("GET", url, true);
    req.send();

}

function handler(){
    var panel = document.getElementById("resultado");
    respuesta=this.responseText.trim();
    if(respuesta!="fecha invalida") {
        signo = respuesta.split("|")[0].trim();
        prediccion = respuesta.split("|")[1];
        panel.innerHTML = "<h2> Tu signo es " + signo + "  <img src='signos/" + signo + ".gif'></h2>" + prediccion;
    }
    else
        panel.innerHTML= "<h2> La fecha no es valida</h2>";
}