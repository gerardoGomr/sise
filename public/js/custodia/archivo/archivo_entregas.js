(function($, window, document) {
    $(function() {
        var $txtSerial    = $('#txtSerial'),
            $formBusqueda = $('#formBusqueda');

        // evento on change
        $txtSerial.on('input', function(event){
            // prevenir submit normal
            $formBusqueda.on('submit', function(event){
               event.preventDefault();
            });

            if ($txtSerial.val().length < 10) {
                return false;
            }

            var respuesta = ajax($formBusqueda.attr('action'), 'post', 'json', $formBusqueda.serialize(), 'guardar');

            respuesta.done(function (resultado) {
                if (resultado.html === '0') {
                    bootbox.alert(resultado.mensaje, function() {
                        $txtSerial.val('');
                    });
                    return false;
                }

                $('#dvLista').html(resultado.html);
                if ($('#area').text().length === 0) {
                    $('#area').text(resultado.area);
                }

                $('#total').text(resultado.total);
                $txtSerial.val('');
            })
            .fail(function (XMLHttpRequest, textStatus, errorThrown) {
                console.log(errorThrown);
            });

            setTimeout(function(){
                $txtSerial.attr('disabled', false);
            }, 1500);
        });

        // setear focus
        setTimeout(function(){
            $txtSerial.focus();
        }, 1000);
    });
}(window.jQuery, window, document));