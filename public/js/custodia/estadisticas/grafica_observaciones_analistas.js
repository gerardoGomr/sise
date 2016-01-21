(function($, window, document) {
	$(function() {
		// variables iniciales
		var _token = $('#_token').val(),
			datos  = {
				anio:   $('#anioActual').text(),
				_token: $('#_token').val()
			};

		// graficar 1a vez
		graficarObservacionesMensuales(datos);

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

		/*setTimeout(function(){
			$('#sparkline').sparkline('html', {
			    type:       'bar',
			    height:     '70',
			    barWidth:   10,
			    barSpacing: 8,
			    colorMap:   $('#sparkline').data('colors').split(",")
			});
		}, 600);*/
	});

	/**
	 * actualizar total programados
	 * @param  object datos
	 * @return
	 */
	/*function totalProgramados(datos)
	{
		var busqueda = ajax($('#urlTotalProgramados').val(), 'post', 'html', datos, 'cargar', '', 'totalProgramados');
	}

	function totalEvaluacionesProceso(datos)
	{
		var busqueda = ajax($('#urlTotalEvaluacionesProceso').val(), 'post', 'html', datos, 'cargar', '', 'totalEvaluacionesProceso');
	}

	function totalEvaluaciones(datos)
	{
		var busqueda = ajax($('#urlTotalEvaluaciones').val(), 'post', 'html', datos, 'cargar', '', 'totalEvaluaciones');
	}

	function resultadosIntegrales(datos)
	{
		var busqueda = ajax($('#urlResultadosIntegrales').val(), 'post', 'html', datos, 'cargar', '', 'dvResultadosIntegrales');

		setTimeout(function(){
			$('#sparkline').sparkline('html', {
			    type:       'bar',
			    height:     '70',
			    barWidth:   10,
			    barSpacing: 8,
			    colorMap:   $('#sparkline').data('colors').split(",")
			});
		}, 1000);
	}*/

	/**
	 * graficar programados
	 * @param  object datos
	 * @return
	 */
	function graficarObservacionesMensuales(datos)
	{
		var busqueda = ajax($('#urlGraficaObservaciones').val(), 'post', 'json', datos, 'guardar');

		busqueda.done(function(resultado) {
			console.log('exito');

			grafica('dvGraficaObservacionesGeneral', 'column', null, 350, 'Observaciones de redacción - Mensual', 'Meses', 'Total', resultado.series, resultado.drilldown);
		})
		.fail(function(XMLHttpRequest, textStatus, errorThrown) {
			console.log(errorThrown);
		});
	}
}(window.jQuery, window, document));