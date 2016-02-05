(function($, window, document) {
	$(function() {
		// variables iniciales
		var _token = $('#_token').val(),
			datos  = {
				anio:   $('#anioActual').text(),
				_token: $('#_token').val()
			};

		// componente datepicker
		$('#formAnalistas').find('input.fecha').datepicker({
			format:    'dd/mm/yyyy',
			autoclose: true,
			language:  'es'
		});

		// graficar 1a vez
		graficarObservacionesMensuales(datos);
		// graficar analistas
		graficarObservacionesAnalistas(datos);

		// evento change de select
		$('#anio').on('change', function() {
			// setear el nuevo año
			datos.anio = $(this).val();
			// cambiar leyenda de año
			$('#anioActual').text($(this).val());
			$('.fecha').text($(this).val());

			// cargar
			graficarObservacionesMensuales(datos);
		});

		// buscar datos de usuario
		$('#btnBuscar').on('click', function(event) {
			graficarObservacionesAnalistas($('#formAnalistas').serialize());
		});

		// ver detalle de analista
		$('#btnVerHistorial').on('click', function(event) {
			event.preventDefault();

			// abrir fancybox
			$.fancybox.open([{
				fitToView:   false,
				width:       '40%',
				maxHeight:   '70%',
				openEffect:  'fade',
				closeEffect: 'fade',
				type:        'iframe',
				href:        $(this).attr('href') + '/' + btoa($('#anioBusqueda').val()) + '/' + btoa($('#analistas').val()) + '/' + btoa($('#fecha1').val()) + '/' + btoa($('#fecha2').val())
			}]);
		});
	});

	/**
	 * graficar observaciones de manera mensual
	 * @param  object datos
	 * @return
	 */
	function graficarObservacionesMensuales(datos)
	{
		var busqueda = ajax($('#urlGraficaObservaciones').val(), 'post', 'json', datos, 'guardar');

		busqueda.done(function(resultado) {
			console.log('exito');

			grafica('dvGraficaObservacionesGeneral', 'column', null, 350, 'Observaciones de redacción - Mensual', 'Meses', 'Total', resultado.series, resultado.drilldown);

			$('#totalObservaciones').text(resultado.totalObservaciones);
			$('#observacionMasRecurrente').text(resultado.observacionMasRecurrente);
		})
		.fail(function(XMLHttpRequest, textStatus, errorThrown) {
			console.log(errorThrown);
		});
	}

	/**
	 * graficar observaciones por analista
	 * @param object datos
     */
	function graficarObservacionesAnalistas(datos)
	{
		var busqueda = ajax($('#formAnalistas').attr('action'), 'post', 'json', datos, 'guardar');

		busqueda.done(function(resultado) {
			console.log('exito');

			// verificar que un valor del combo se haya seleccionado para mostrar botón
			if ($('#analistas').val() !== '') {
				$('#btnVerHistorial').show(300);
			} else {
				$('#btnVerHistorial').hide(300);
			}

			grafica('dvGraficaAnalistas', 'column', null, 350, 'Observaciones de redacción', 'Analistas', 'Total', resultado.series, resultado.drilldown);
		})
		.fail(function(XMLHttpRequest, textStatus, errorThrown) {
			console.log(errorThrown);
		});
	}
}(window.jQuery, window, document));