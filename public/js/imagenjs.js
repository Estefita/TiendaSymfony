
    $(document).ready(function(){
        inicializarMultimedia();
    });

    function inicializarMultimedia(){
        EventosMultimedia();
    }

    function EventosMultimedia(){
         $('#btnAdd').on("click", function(){
             $('.nuevoinput').append(
                 `<div class="form-group">
                    <div class="input-group mb-2">
                        <input type="file" class="form-control" name="nombre[]" aria-describedby="nombre" placeholder="Imagen">
                        <button type="button" onclick="QuitarUpload(this);">Quitar</button>
                    </div>
                </div>
                `);
        });
    }

    function QuitarUpload(obj){
        $(obj).parent('div').remove();
    }

    function QuitarUploadAjax(obj, id){
    var url = "/imagen/borrar";
    $.ajax({
        method: "POST",
        url: url,
        dataType: 'json',
        data: { id: id }
      })
        .done(function( result ) {
          alert( "Data Saved: " + result.msg );
          QuitarUpload(obj)
        });
    }