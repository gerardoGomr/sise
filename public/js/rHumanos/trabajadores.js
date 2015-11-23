(function($, window, document) {
	$(function() {
		// variables a utilizar
		var $formTrabajadores  = $('#formTrabajadores'),
			$listaTrabajadores = $('#listaTrabajadores'),
			$dvDatosTrabajador = $('#dvDatosTrabajador'),
			_token             = $formTrabajadores.find('input[name="_token"]').val();

		// evento enter en campo de busqueda
		// prevenir submit del browser
		$formTrabajadores.on('keypress', '#txtDato', function(event) {
			if(event === 13 || event.which === 13) {
				return false;
			}
		});

		// evento enter en campo de busqueda
		// realizar busqueda
		$formTrabajadores.on('keyup', '#txtDato', function(event) {
			if(event === 13 || event.which === 13) {
				var datos = {txtDato: $(this).val(), _token: _token};

				ajax($formTrabajadores.attr('action'), 'post', 'html', datos, 'cargar', 'busquedaTrabajadores', 'listaTrabajadores');
			}
		});

		// evento click para ver detalle, sobre un elemento de la lista de usuarios
		$listaTrabajadores.on('click', 'a.trabajador', function(event) {
			var datos = {idTrabajador: $(this).siblings('input[class="idTrabajador"]').val(), _token: _token};

			ajax($('#urlClickTrabajador').val(), 'post', 'html', datos, 'cargar', 'resultadoTrabajadores', 'dvDatosTrabajador');
		});

		// evento click para abrir formulario de cambio de contraseña
		$dvDatosTrabajador.on('click', 'a.cambiarPassword', function(event) {
			event.preventDefault();
			$.fancybox.open([{
		        fitToView:   false,
		        width:       '40%',
				maxHeight:   '40%',
		        openEffect:  'fade',
		        closeEffect: 'fade',
		        type:        'iframe',
		        href:        $(this).attr('href')
		    }]);
		});

		// evento click para desactivar al usuario
		$dvDatosTrabajador.on('click', 'a.desactivar', function(event) {
			event.preventDefault();

			var url          = $(this).attr('href'),
			    idTrabajador = $(this).siblings('input[name="idTrabajador"]').val();

			bootbox.confirm('¿Desea desactivar a este usuario?', function(r) {
				if(r === true) {
					var datos = {
						_token:       _token,
						idTrabajador: idTrabajador
					};

					var respuesta = ajax(url, 'post', 'html', datos, 'guardar', '', '');

					respuesta.done(function(resultado) {
						console.log(resultado);

						if(resultado === '0') {
							bootbox.alert('Ocurrió un error al realizar la operación solicitada. Intente de nuevo.');
							return false;
						}
						bootbox.alert('Operación realizada con éxito', function() {
							refrescarDetalleTrabajador(datos);
						});
					})
					.fail(function(XMLHttpRequest, textStatus, errorThrown) {
						console.log(errorThrown);
						bootbox.alert('Imposible realizar la operación solicitada');
					});
				}
			});
		});

		// evento click para activar al usuario
		$dvDatosTrabajador.on('click', 'a.activar', function(event) {
			event.preventDefault();

			var url          = $(this).attr('href'),
			    idTrabajador = $(this).siblings('input[name="idTrabajador"]').val();

			bootbox.confirm('¿Desea activar a este usuario?', function(r) {
				if(r === true) {
					var datos = {
						_token:       _token,
						idTrabajador: idTrabajador
					};

					var respuesta = ajax(url, 'post', 'html', datos, 'guardar', '', '');

					respuesta.done(function(resultado) {
						console.log(resultado);

						if(resultado === '0') {
							bootbox.alert('Ocurrió un error al realizar la operación solicitada. Intente de nuevo.');
							return false;
						}
						bootbox.alert('Operación realizada con éxito', function() {
							refrescarDetalleTrabajador(datos);
						});
					})
					.fail(function(XMLHttpRequest, textStatus, errorThrown) {
						console.log(errorThrown);
						bootbox.alert('Imposible realizar la operación solicitada');
					});
				}
			});
		});

		function refrescarDetalleTrabajador(datos)
		{
			ajax($('#urlClickTrabajador').val(), 'post', 'html', datos, 'cargar', 'resultadoTrabajadores', 'dvDatosTrabajador');
		}
	});
}(window.jQuery, window, document));