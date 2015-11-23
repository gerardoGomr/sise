(function($, window, document) {
	$(function() {
		// variables iniciales
		var _token = $('#_token').val();

		// opciones para búsquedas ajax
		var datos = {
			anio:  '2015',
			_token: _token
		};

		// graficar 1a vez
		graficarProgramados(datos);
		graficarEvaluaciones(datos);

		/**************************** PROGRAMADOS **************************************/
		setInterval(graficarProgramados, 8000, datos);
		/*****************************************************************************/

		/**************************** EVALUADOS **************************************/
		setInterval(graficarEvaluaciones, 8000, datos);
		/*****************************************************************************/

		setInterval(totalProgramados, 8000, datos);

		setInterval(totalEvaluacionesProceso, 8000, datos);

		setInterval(totalEvaluaciones, 8000, datos);
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

			graficaMixta('dvGraficaProgramadosMensual', 'Programados - Mensual', 'Meses', 'Total', resultado);
		})
		.fail(function(XMLHttpRequest, textStatus, errorThrown) {
			console.log(errorThrown);
			bootbox.alert('Imposible realizar la operación solicitada');
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

			grafica('dvGraficaEvaluadosMensual', 'line', 'Evaluaciones - Mensual', 'Meses', 'Total', resultado);
		})
		.fail(function(XMLHttpRequest, textStatus, errorThrown) {
			console.log(errorThrown);
			bootbox.alert('Imposible realizar la operación solicitada');
		});
	}
}(window.jQuery, window, document));