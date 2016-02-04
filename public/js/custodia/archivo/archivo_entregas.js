(function($, window, document) {
    $(function() {
        var $txtSerialMemo  = $('#txtSerialMemo'),
            $txtSerialExp   = $('#txtSerialExp'),
            $formBusqueda   = $('#formBusqueda'),
            $formExpediente = $('#formExpediente');

        // evento on change
        $txtSerialMemo.on('input', function(event){
            // prevenir submit normal
            $formBusqueda.on('submit', function(event){
               event.preventDefault();
            });

            if ($txtSerialMemo.val().length < 23) {
                return false;
            }

            var respuesta = ajax($formBusqueda.attr('action'), 'post', 'json', $formBusqueda.serialize(), 'guardar');

            respuesta.done(function (resultado) {
                if (resultado.html === '0') {
                    bootbox.alert(resultado.mensaje, function() {
                        $txtSerialMemo.val('');
                    });
                    return false;
                }

                $('#area').text(resultado.area)
                $('#dvLista').html(resultado.html);
                generarDatatables('listaExpedientes');
                $txtSerialExp.attr('disabled', false);
                $txtSerialExp.focus();
                $txtSerialMemo.val('');
            })
            .fail(function (XMLHttpRequest, textStatus, errorThrown) {
                console.log(errorThrown);
            });
        });

        // leer serial de expedientes
        $txtSerialExp.on('input', function(event) {
            // prevenir submit normal
            $formExpediente.on('submit', function(event){
                event.preventDefault();
            });

            if ($txtSerialExp.val().length < 9) {
                return false;
            }

            var respuesta = ajax($formExpediente.attr('action'), 'post', 'json', $formExpediente.serialize(), 'guardar');

            respuesta.done(function (resultado) {
                if (resultado.html === '0') {
                    bootbox.alert(resultado.mensaje, function() {
                        $txtSerialExp.val('');
                    });
                    return false;
                }

                $('#dvLista').html(resultado.html);
                generarDatatables('listaExpedientes');
                $txtSerialExp.focus();
                $txtSerialExp.val('');
            })
            .fail(function (XMLHttpRequest, textStatus, errorThrown) {
                console.log(errorThrown);
            });
        });

        // persistir la entrega
        $('#dvLista').on('click', 'a.marcarEntrega', function (event) {
            event.preventDefault();

            var datos = {
                    _token: $formBusqueda.find('input[name="_token"]').val()
                },
                respuesta = ajax($(this).attr('href'), 'post', 'html', datos, 'guardar');

            respuesta.done(function (resultado) {
                console.log(resultado);
                if (resultado === '0') {
                    bootbox.alert('Error al marcar la entrega de expedientes');
                    return false;
                }

                bootbox.alert('Se marcaron los expedientes como entregados', function() {
                    // reload
                    window.location.reload(true);
                });
            })
            .fail(function (XMLHttpRequest, textStatus, errorThrown) {
                console.log(errorThrown);
            });
        });
    });
}(window.jQuery, window, document));