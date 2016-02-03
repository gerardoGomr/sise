(function($, window, document) {
    $(function() {
        var $txtSerialMemo = $('#txtSerialMemo'),
            $txtSerialExp  = $('#txtSerialExp'),
            $formBusqueda  = $('#formBusqueda');

        // evento on change
        $txtSerialMemo.on('input', function(event){
            // prevenir submit normal
            $formBusqueda.on('submit', function(event){
               event.preventDefault();
            });

            if ($txtSerialMemo.val().length < 18) {
                return false;
            }

            setTimeout(function(){
                var respuesta = ajax($formBusqueda.attr('action'), 'post', 'json', $formBusqueda.serialize(), 'guardar');

                respuesta.done(function (resultado) {
                    if (resultado.html === '0') {
                        bootbox.alert(resultado.mensaje, function() {
                            $txtSerialMemo.val('');
                        });
                        return false;
                    }

                    $('#dvLista').html(resultado.html);
                    $txtSerialExp.attr('disabled', false);
                    $txtSerialExp.focus();

                    $txtSerialMemo.val('');

                    reiniciarDatatable('listaExpedientes', '', 'Expedientes en Memorandum', 'Expedientes en archivo');
                })
                .fail(function (XMLHttpRequest, textStatus, errorThrown) {
                    console.log(errorThrown);
                });

                setTimeout(function(){
                    $txtSerialMemo.attr('disabled', false);
                }, 1500);
            }, 1500);
        });

        // setear focus
        setTimeout(function(){
            $txtSerialMemo.focus();
        }, 1000);
    });
}(window.jQuery, window, document));