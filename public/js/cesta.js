  $(document).ready(function(){
        inicializarCesta();
    });

    function inicializarCesta(){
        EventosCesta();
    }

    function EventosCesta(){
         $('.cesta').on("click", function(){
            var id = $(this).attr("idp");
            addCesta(id);
         });   
    }


    function addCesta(id){
    var url = "/cesta/add";
    $.ajax({
        method: "POST",
        url: url,
        dataType: 'json',
        data: { idp: id, cnt: 1 }
      })
        .done(function( result ) {
          var cantidad = result.cantidad;
          $('#cesta').html(cantidad);
          localStorage.setItem('cesta',cantidad);
        });
    }