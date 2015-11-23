(function($, window, document) {
	$(function() {



		// variables a utilizar
		var $formTrabajadores  = $('#formTrabajadores'),
			$formSubirImagen   = $('#formSubirImagen'),
			$adjuntarFoto      = $('#adjuntarFoto'),
			$btnRecortarImagen = $('#btnRecortarImagen'),
			$btnAceptarRecorte = $('#btnAceptarRecorte'),
			$fotografia		   = $('#fotografia'),
			modo		       = $('#modo').val() === '1' ? 'guardar' : 'editar',
			jcrop;

		// inicializar validaciones
		init();

		// validate
		$formTrabajadores.validate();
		$formSubirImagen.validate();

		// objeto para subir el form $formSubirImagen via ajax
		var opciones = {
			url:        $formSubirImagen.attr('action'),
			type:       'post',
			beforeSend: function() {
				if($formSubirImagen.valid() === false) {
					return false;
				}
			},
			success: function(foto, statusText, xhr, $form){
				$('#fotografia').html(foto);
				$('#capturada').val('1');
				// asignar la url de la foto capturada / adjuntada al elemento del form usuario
				$('#foto').val($('#urlFoto').val());
			},
			error:   function(XMLHttpRequest, textStatus, errorThrown){
				console.log(errorThrown);
				bootbox.alert("Imposible realizar la operación solicitada.");
			}
		};

		// validacion de formulario
		agregaValidacionesElementos($formTrabajadores);
		agregaValidacionesElementos($formSubirImagen);

		// form ajax
		$formSubirImagen.ajaxForm(opciones);

		// evento para guardar el formulario de captura
		$('#btnGuardar').on('click', function(event) {

			if($formTrabajadores.valid() === true) {

				var respuesta = ajax($formTrabajadores.attr('action'), 'post', 'html', $formTrabajadores.serialize(), 'guardar', '', '');

				respuesta.done(function(resultado) {
					console.log(resultado);

					if(resultado === '0') {
						bootbox.alert('Ocurrió un error al realizar la operación solicitada. Intente de nuevo.');
						return false;
					}
					bootbox.alert('Operación realizada con éxito', function() {

						if(modo === 'editar') {
							window.location.href = '/privilegios';
						}

						window.location.href = '/rHumanos';
					});
				})
				.fail(function(XMLHttpRequest, textStatus, errorThrown) {
					console.log(errorThrown);
					bootbox.alert('Imposible realizar la operación solicitada');
				});
			}
		});

		// click para mostrar captura de usuario y contraseña
		$('#usuarioSise').on('click', function(event) {

			if($(this).is(':checked')) {
				// mostrar campos y agregar validación
				agregaValidacionAElemento('txtUsername', 'required');
				agregaValidacionAElemento('txtPassword', 'required');
				$('#capturaUsuario').show();

			} else {
				// ocultar campos y quitar validación
				quitarValidacionesAElemento('txtUsername');
				quitarValidacionesAElemento('txtPassword');
				$('#txtUsername').val('');
				$('#txtPassword').val('');
				$('#capturaUsuario').hide();
			}
		});

		// botón subida de archivos
		$('#subirFoto').on('click', function(event) {
			$adjuntarFoto.click();
		});

		//adjuntar imagen
		$adjuntarFoto.on('change', function(event) {
			//subir el archivo via ajax
			// if($formSubirImagen.valid() === true) {
				$formSubirImagen.submit();
				//eliminar el contenido del input file
				$adjuntarFoto.replaceWith($adjuntarFoto.val('').clone(true));
			// }
		});

		// botón recortar imagen
		$fotografia.on('click', 'a.recortar', function(event) {
			$(this).siblings('a.aceptarRecorte').show();
			$(this).siblings('a.cancelarRecorte').show();
			$(this).hide();

			jcrop = $.Jcrop("#fotoCapturada", {
		    	bgOpacity: 0.4,
				onSelect:  actualizaCoordenadas
			});
		});

		// botón cancelar recorte
		$fotografia.on('click', 'a.cancelarRecorte', function(event) {
			jcrop.destroy();
			$(this).hide();
			$(this).siblings('a.aceptarRecorte').hide();
			$(this).siblings('a.recortar').show();
		});

		// boton aceptar recorte de imagen
		$fotografia.on('click', 'a.aceptarRecorte', function(event) {
			var datos = {
				x: 		 $("#x").val(),
				y: 		 $("#y").val(),
				w: 		 $("#w").val(),
				h: 		 $("#h").val(),
				urlFoto: $('#urlFoto').val(),
				_token:  $formSubirImagen.find('input[name="_token"]').val()
			};

			var respuesta = ajax($('#urlFotoRecortada').val(), 'post', 'html', datos, 'guardar', '', '');

			respuesta.done(function(resultado) {
				console.log(resultado);

				if(resultado === '0') {
					bootbox.alert('Ocurrió un error al realizar la operación solicitada. Intente de nuevo.');
					return false;
				}
				bootbox.alert('Operación realizada con éxito', function() {
					jcrop.destroy();
					$('#fotografia').html(resultado);
				});
			})
			.fail(function(XMLHttpRequest, textStatus, errorThrown) {
				console.log(errorThrown);
				bootbox.alert('Imposible realizar la operación solicitada');
			});
		});

		// botón cancelar
		$('#btnCancelar').on('click', function(event) {
			bootbox.confirm('¿Desea cancelar la captura del nuevo usuario?', function(r) {
				if(r === true) {
					window.location.href = '/';
				}
			});
		});


	});

	/**
	 * actualizar coordenadas obtenidas de jCrop
	 * @param  object c
	 * @return
	 */
	function actualizaCoordenadas(c)
	{
		$('#x').val(c.x);
		$('#y').val(c.y);
		$('#w').val(c.w);
		$('#h').val(c.h);
	}
}(window.jQuery, window, document));