(function($, window, document) {
	$(function() {
		// variables iniciales
		var _token = $('#_token').val();

		// opciones para búsquedas ajax
		var datos = {
			anio:  $('#anioActual').text(),
			_token: _token
		};

		// graficar 1a vez
		graficarProgramados(datos);
		graficarEvaluaciones(datos);
		graficarEvaluacionesPendientes(datos);

		/**************************** PROGRAMADOS **************************************/
		// setInterval(graficarProgramados, 16000, datos);
		// /*****************************************************************************/

		// /**************************** EVALUADOS **************************************/
		// setInterval(graficarEvaluaciones, 16000, datos);
		// /*****************************************************************************/

		// setInterval(totalProgramados, 16000, datos);

		// setInterval(totalEvaluacionesProceso, 16000, datos);

		// setInterval(totalEvaluaciones, 16000, datos);

		// setInterval(resultadosIntegrales, 16000, datos);

		// evento change de select
		$('#anio').on('change', function() {
			// setear el nuevo año
			datos.anio = $(this).val();
			// cambiar leyenda de año
			$('#anioActual').text($(this).val());
			$('.fecha').text($(this).val());

			// cargar
			graficarProgramados(datos);
			graficarEvaluaciones(datos);
			totalProgramados(datos);
			totalEvaluacionesProceso(datos);
			totalEvaluaciones(datos);
			resultadosIntegrales(datos);
			graficarEvaluacionesPendientes(datos);
		});

		setTimeout(function(){
			$('#sparkline').sparkline('html', {
			    type:       'bar',
			    height:     '70',
			    barWidth:   10,
			    barSpacing: 8,
			    colorMap:   $('#sparkline').data('colors').split(",")
			});
		}, 600);
	});

	/**
	 * actualizar total programados
	 * @param  object datos
	 * @return
	 */
	function totalProgramados(datos)
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
	}

	/**
	 * graficar programados
	 * @param  object datos
	 * @return
	 */
	function graficarProgramados(datos)
	{
		var busqueda = ajax($('#urlGraficaProgramadosMensual').val(), 'post', 'json', datos, 'guardar');

		busqueda.done(function(resultado) {
			console.log('exito');

			graficaMixta('dvGraficaProgramadosMensual', null, 350, 'Programados - Mensual', 'Meses', 'Total', resultado.series, resultado.drilldown);
		})
		.fail(function(XMLHttpRequest, textStatus, errorThrown) {
			console.log(errorThrown);
		});
	}

	/**
	 * graficar evaluaciones
	 * @param  object datos
	 * @return
	 */
	function graficarEvaluaciones(datos)
	{
		var busquedaProgr = ajax($('#urlGraficaEvaluadosMensual').val(), 'post', 'json', datos, 'guardar');

		busquedaProgr.done(function(resultado) {
			console.log('exito');

			grafica('dvGraficaEvaluadosMensual', 'area', null, 350, 'Evaluaciones - Mensual', 'Meses', 'Total', resultado, null);
		})
		.fail(function(XMLHttpRequest, textStatus, errorThrown) {
			console.log(errorThrown);
		});
	}

	/**
	 * graficar las evaluaciones pendientes por area
	 * @param  object datos
	 * @return
	 */
	function graficarEvaluacionesPendientes(datos)
	{
		var busquedaEval = ajax($('#urlGraficaEvaluacionesPendientes').val(), 'post', 'json', datos, 'guardar');

		busquedaEval.done(function(resultado) {
			console.log('exito');

			grafica('dvGraficaEvaluacionesPendientes', 'column', null, null, 'Evaluaciones pendientes por área', 'Áreas', 'Total', resultado.series, resultado.drilldown);
		})
		.fail(function(XMLHttpRequest, textStatus, errorThrown) {
			console.log(errorThrown);
		});
	}
}(window.jQuery, window, document));