(function($, window, document) {
	$(function() {
		// variables iniciales
		var $txtDependencia      = $('#txtDependencia'),
			$formBusqueda        = $('#formBusqueda'),
			$ulListaDependencias = $('#ulListaDependencias');

		// evitar submit normal mediante evento enter
		$txtDependencia.on('keypress', function(event){
			if(event === 13 || event.which === 13) {
				return false;
			}
		});

		// buscar mediante evento enter
		$txtDependencia.on('keyup', function(event){
			if(event === 13 || event.which === 13) {
				ajax($formBusqueda.attr('action'), 'post', 'html', $formBusqueda.serialize(), 'cargar', 'spBusquedaDependencia', 'ulListaDependencias');
			}
		});

		// ver detalle de evaluado
		$ulListaDependencias.on('click', 'a.dependencia', function(event) {
			var datos = {
				idDependencia:   $(this).siblings('input[name="idDependencia"]').val(),
				_token:          $formBusqueda.find('input[name="_token"]').val()

			};

			ajax($('#urlPerfilDependencia').val(), 'post', 'html', datos, 'cargar', 'spPerfilDependencia', 'dvPerfilDependencia');
		});

		// agregar evento para recargar evaluaciones
		$('#dvPerfilDependencia').on('click', 'a.evaluacion', function(event) {
			event.preventDefault();

			var datos = {
				idEvaluacion:   $(this).next('input[name="idEvaluacion"]').val(),
				_token:         $formBusqueda.find('input[name="_token"]').val()

			};

			ajax($(this).attr('href'), 'post', 'html', datos, 'cargar', 'spPerfilDependencia', 'dvPerfilDependencia');

		});
	});
}(window.jQuery, window, document));