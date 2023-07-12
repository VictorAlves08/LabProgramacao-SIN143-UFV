$(document).ready(function(){
    $('#meuFormulario').submit(
    function(e) {
        e.preventDefault();
        var meunome = $("#nome").val();
        
        $.ajax({
            type: "POST",
            url: "processar.php",
            data: {nome: meunome},
            success: function(data) {
                $("#resultado").html(data);
            }
        });
    });
});