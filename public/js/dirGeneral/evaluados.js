(function($, window, document) {
	$(function() {
		// variables iniciales
		var $txtEvaluadoDato  = $('#txtEvaluadoDato'),
			$formBusqueda     = $('#formBusqueda'),
			$ulListaEvaluados = $('#ulListaEvaluados');

		// evitar submit normal mediante evento enter
		$txtEvaluadoDato.on('keypress', function(event){
			if(event === 13 || event.which === 13) {
				return false;
			}
		});

		// buscar mediante evento enter
		$txtEvaluadoDato.on('keyup', function(event){
			if(event === 13 || event.which === 13) {
				ajax($formBusqueda.attr('action'), 'post', 'html', $formBusqueda.serialize(), 'cargar', 'spBusquedaEvaluado', 'ulListaEvaluados');
			}
		});

		// ver detalle de evaluado
		$ulListaEvaluados.on('click', 'a.evaluado', function(event) {
			var datos = {
				curp:   $(this).parent('h5').siblings('input[name="curp"]').val(),
				_token: $formBusqueda.find('input[name="_token"]').val()

			};

			ajax($('#urlPerfilEvaluado').val(), 'post', 'html', datos, 'cargar', 'spPerfilEvaluado', 'dvPerfilEvaluado');
		});

		// agregar evento para recargar evaluaciones
		$('#dvPerfilEvaluado').on('click', 'a.evaluacion', function(event) {
			event.preventDefault();

			var datos = {
				idEvaluacion:   $(this).next('input[name="idEvaluacion"]').val(),
				_token:         $formBusqueda.find('input[name="_token"]').val()

			};

			ajax($(this).attr('href'), 'post', 'html', datos, 'cargar', 'spPerfilEvaluado', 'dvPerfilEvaluado');

		});
	});
}(window.jQuery, window, document));