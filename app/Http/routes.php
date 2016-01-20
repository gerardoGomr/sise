<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/
// rutas del sistema

Route::group([
		'prefix'     => '/',
		'middleware' => 'usuarioLogueado'
	],  function() {

	// pantalla principal
	Route::get('/', 'PrincipalController@index');

	############################# psicologia
	Route::get('/psicologia', 'Psicologia\PsicologiaController@index');

	########################################################## recHumanos ##########################################################
	// principal
	Route::get('recHumanos', 'RecHumanos\LaravelRecHumanosController@index');

	// busqueda en form busqueda
	Route::post('recHumanos/buscarTrabajador', 'RecHumanos\LaravelRecHumanosController@buscarTrabajador');

	// click en detalle
	Route::post('recHumanos/detalle', 'RecHumanos\LaravelRecHumanosController@detalleTrabajador');

	// alta de nuevo usuario
	Route::get('recHumanos/captura', 'RecHumanos\LaravelRecHumanosController@captura');

	// editar usuario
	Route::get('recHumanos/edicion/{id}', 'RecHumanos\LaravelRecHumanosController@edicion');

	// guardar usuario
	Route::post('recHumanos/guardarTrabajador', 'RecHumanos\LaravelRecHumanosController@guardarTrabajador');

	// guardar foto
	Route::post('recHumanos/subirFoto', 'RecHumanos\LaravelRecHumanosController@subirFoto');

	// recortar foto
	Route::post('recHumanos/recortarFoto', 'RecHumanos\LaravelRecHumanosController@recortarFoto');

	// cambiar password
	Route::get('recHumanos/password/{id}', 'RecHumanos\LaravelRecHumanosController@password');

	// cambiar password
	Route::post('recHumanos/password', 'RecHumanos\LaravelRecHumanosController@cambiarPassword');

	// desactivar usuario
	Route::post('recHumanos/desactivar', 'RecHumanos\LaravelRecHumanosController@desactivar');

	// activar usuario
	Route::post('recHumanos/activar', 'RecHumanos\LaravelRecHumanosController@activar');
	####################################################################################################################
});

Route::group([
		'prefix'     => '/',
		'middleware' => 'ip'
	],  function() {
	############################# Dirección General
	Route::get('dirGeneral', 'DirGeneral\LaravelDirGeneralController@index');

	// grafica programados
	Route::post('dirGeneral/graficaProgramadosMensual', 'DirGeneral\LaravelDirGeneralController@graficaProgramadosMensual');

	// grafica evaluaciones
	Route::post('dirGeneral/graficaEvaluadosMensual', 'DirGeneral\LaravelDirGeneralController@graficaEvaluacionesConcluidasMensual');

	// total programados
	Route::post('dirGeneral/totalProgramados', 'DirGeneral\LaravelDirGeneralController@totalProgramados');

	// total evaluaciones
	Route::post('dirGeneral/totalEvaluaciones', 'DirGeneral\LaravelDirGeneralController@totalEvaluacionesConcluidas');

	// total evaluaciones en proceso
	Route::post('dirGeneral/totalEvaluacionesProceso', 'DirGeneral\LaravelDirGeneralController@totalEvaluacionesProceso');

	// resultados integrales
	Route::post('dirGeneral/resultados', 'DirGeneral\LaravelDirGeneralController@resultadosIntegrales');

	// búsqueda de evaluaciones
	Route::get('dirGeneral/evaluados/{curp?}', 'DirGeneral\LaravelDirGeneralController@evaluados');

	// buscar evaluados
	Route::post('dirGeneral/buscarEvaluado', 'DirGeneral\LaravelDirGeneralController@buscarEvaluado');

	// ver el perfil del evaluado seleccionado
	Route::post('dirGeneral/evaluado/perfil', 'DirGeneral\LaravelDirGeneralController@perfilEvaluado');

	// PDF
	Route::get('dirGeneral/evaluado/perfil/pdf/{id}', 'DirGeneral\LaravelDirGeneralController@perfilEvaluadoPdf');

	// busqueda de dependencias
	Route::get('dirGeneral/dependencias', 'DirGeneral\LaravelDirGeneralController@dependencias');

	// buscar dependencia
	Route::post('dirGeneral/buscarDependencia', 'DirGeneral\LaravelDirGeneralController@buscarDependencia');

	// ver perfil de la dependencia seleccionada
	Route::post('dirGeneral/dependencia/perfil', 'DirGeneral\LaravelDirGeneralController@perfilDependencia');

	// grafica de evaluaciones pendientes por áreas
	Route::post('dirGeneral/graficaEvaluacionesPendientes', 'DirGeneral\LaravelDirGeneralController@graficaEvaluacionesPendientes');

	// ver pantalla anexa de dashboard
	Route::get('dirGeneral/1', 'DirGeneral\LaravelDirGeneralAnexoController@index');

	// grafica productividad
	Route::post('dirGeneral/1/graficaEvaluadosProductividad', 'DirGeneral\LaravelDirGeneralAnexoController@graficaProductividad');
});

// expedientes por entregar a custodia
Route::get('/archivo/{anio?}', 'Archivo\LaravelArchivoController@index');
Route::post('/archivo/expedientesCustodia', 'Archivo\LaravelArchivoController@expedientesCustodia');
Route::post('/archivo/getDatosTotales', 'Archivo\LaravelArchivoController@getDatosTotales');

//reporte de faltantes en archivo por area
Route::get('/archivo/reporte/reporte-no-entregados/{anio?}', 'Archivo\LaravelArchivoController@reporteNoEntregadosIndex');
Route::get('/archivo/reporte/reporte-no-entregados-pdf', 'Archivo\LaravelArchivoController@getReporteNoEntregados');
Route::post('/archivo/reporte/getDatosReporte', 'Archivo\LaravelArchivoController@getDatosReporteNoEntregados');
Route::post('/archivo/reporte/getDatosGraficaNoEntregados', 'Archivo\LaravelArchivoController@getDatosGraficaNoEntregados');

//reporte de expedientes que ya estan en archivo
Route::get('/archivo/reporte/reporte-en-archivo/{anio?}', 'Archivo\LaravelArchivoController@reporteEnArchivoIndex');
Route::get('/archivo/reporte/reporte-en-archivo-pdf', 'Archivo\LaravelArchivoController@getReporteEnArchivo');
Route::post('/archivo/reporte/getDatosReporteEnArchivo', 'Archivo\LaravelArchivoController@getDatosReporteEnArchivo');
Route::post('/archivo/reporte/getDatosGraficaEnArchivo', 'Archivo\LaravelArchivoController@getDaTosGraficaEnArchivo');

//reporte de expedientes que ya estan en proceso
Route::get('/archivo/reporte/reporte-en-proceso/{anio?}', 'Archivo\LaravelArchivoController@reporteEnProcesoIndex');
Route::get('/archivo/reporte/reporte-en-proceso-pdf', 'Archivo\LaravelArchivoController@getReporteEnProceso');
Route::post('/archivo/reporte/getDatosReporteEnProceso', 'Archivo\LaravelArchivoController@getDatosReporteEnProceso');
Route::post('/archivo/reporte/getDatosGraficaEnProceso', 'Archivo\LaravelArchivoController@getDaTosGraficaEnProceso');

############################# Login
Route::get('/login', 'Usuarios\LaravelLoginController@index');
Route::post('/login', 'Usuarios\LaravelLoginController@login');
Route::get('/logout', 'Usuarios\LaravelLoginController@logout');