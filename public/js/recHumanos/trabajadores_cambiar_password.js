(function($, window, document) {
	$(function() {
		// variables a utilizar
		var $formPassword  = $('#formPassword');

		// inicializar validaciones
		init();

		// validate
		$formPassword.validate();

		// validacion de formulario
		agregaValidacionesElementos($formPassword);

		// evento para guardar el formulario de captura
		$('#btnGuardar').on('click', function(event) {

			if($formPassword.valid() === true) {

				var respuesta = ajax($formPassword.attr('action'), 'post', 'html', $formPassword.serialize(), 'guardar', '', '');

				respuesta.done(function(resultado) {
					console.log(resultado);

					if(resultado === '0') {
						bootbox.alert('Ocurrió un error al realizar la operación solicitada. Intente de nuevo.');
						return false;
					}
					bootbox.alert('Operación realizada con éxito', function() {
						window.parent.$.fancybox.close();
					});
				})
				.fail(function(XMLHttpRequest, textStatus, errorThrown) {
					console.log(errorThrown);
					bootbox.alert('Imposible realizar la operación solicitada');
				});
			}
		});
	});
}(window.jQuery, window, document));