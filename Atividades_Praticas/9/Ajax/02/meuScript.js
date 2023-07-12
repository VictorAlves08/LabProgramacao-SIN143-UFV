$(document).ready(function(){
    setInterval(function() {
        $.ajax({
            url: 'getDados.php',
            success: function(data) {
                $('#minhaDiv').html(data);
            }
        });
    }, 5000); // Atualiza a cada 5 segundos
});
