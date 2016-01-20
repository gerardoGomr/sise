(function($, window, document) {
	$(function() {
		// variables iniciales
		var _token = $('#_token').val(),
			// opciones para búsquedas ajax
			datos = {
				fecha1:  $('#fecha1').val(),
				fecha2:  $('#fecha2').val(),
				_token: _token
			};

		$('input.fecha').datepicker({
			format:    'dd/mm/yyyy',
			language:  'es',
			autoclose: true
		});

		$('#btnBuscar').on('click', function(event) {
			graficarProductividad(datos)
		});
	});

	function graficarProductividad(datos)
	{
		var busqueda = ajax($('#urlGraficaEvaluadosProductividad').val(), 'post', 'json', datos, 'guardar');
		busqueda.done(function(resultado) {
			console.log('exito');

			grafica('dvGraficaEvaluadosProductividad', 'column', null, 350, 'Evaluaciones', 'Valores', 'Total', resultado.series, null);
		})
		.fail(function(XMLHttpRequest, textStatus, errorThrown) {
			console.log(errorThrown);
		});
	}
}(window.jQuery, window, document));