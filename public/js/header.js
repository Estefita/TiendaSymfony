$(document).ready(function(){
    inicializarHeader();
});

function inicializarHeader(){
    ObtenerCesta();
}

function ObtenerCesta(){
    var cantidad = localStorage.getItem('cesta');
    $('#cesta').html(cantidad);  
}