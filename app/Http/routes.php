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

	########################################################## rHumanos ##########################################################
	// principal
	Route::get('/rHumanos', 'RHumanos\LaravelRHumanosController@index');

	// busqueda en form busqueda
	Route::post('/rHumanos/buscarTrabajador', 'RHumanos\LaravelRHumanosController@buscarTrabajador');

	// click en detalle
	Route::post('/rHumanos/detalle', 'RHumanos\LaravelRHumanosController@detalleTrabajador');

	// alta de nuevo usuario
	Route::get('/rHumanos/captura', 'RHumanos\LaravelRHumanosController@captura');

	// editar usuario
	Route::get('/rHumanos/edicion/{id}', 'RHumanos\LaravelRHumanosController@edicion');

	// guardar usuario
	Route::post('/rHumanos/guardarTrabajador', 'RHumanos\LaravelRHumanosController@guardarTrabajador');

	// guardar foto
	Route::post('/rHumanos/subirFoto', 'RHumanos\LaravelRHumanosController@subirFoto');

	// recortar foto
	Route::post('/rHumanos/recortarFoto', 'RHumanos\LaravelRHumanosController@recortarFoto');

	// cambiar password
	Route::get('/rHumanos/password/{id}', 'RHumanos\LaravelRHumanosController@password');

	// cambiar password
	Route::post('/rHumanos/password', 'RHumanos\LaravelRHumanosController@cambiarPassword');

	// desactivar usuario
	Route::post('/rHumanos/desactivar', 'RHumanos\LaravelRHumanosController@desactivar');

	// activar usuario
	Route::post('/rHumanos/activar', 'RHumanos\LaravelRHumanosController@activar');
	####################################################################################################################
});

############################# Dirección General
Route::get('/dirGeneral', 'DirGeneral\LaravelDirGeneralController@index');
// grafica programados
Route::post('/dirGeneral/graficaProgramadosMensual', 'DirGeneral\LaravelDirGeneralController@graficaProgramadosMensual');
// grafica evaluaciones
Route::post('/dirGeneral/graficaEvaluadosMensual', 'DirGeneral\LaravelDirGeneralController@graficaEvaluacionesConcluidasMensual');
// total programados
Route::post('/dirGeneral/totalProgramados', 'DirGeneral\LaravelDirGeneralController@totalProgramados');
// total evaluaciones
Route::post('/dirGeneral/totalEvaluaciones', 'DirGeneral\LaravelDirGeneralController@totalEvaluacionesConcluidas');
// total evaluaciones en proceso
Route::post('/dirGeneral/totalEvaluacionesProceso', 'DirGeneral\LaravelDirGeneralController@totalEvaluacionesProceso');
############################# Login
Route::get('/login', 'LaravelLoginController@index');
Route::post('/login', 'LaravelLoginController@login');
Route::get('/logout', 'LaravelLoginController@logout');
