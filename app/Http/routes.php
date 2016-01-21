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

// restringir rutas que son accesadas mediante el login
Route::group([
		'prefix'     => '/',
		'middleware' => 'usuarioLogueado'
	],  function() {

	// incluir archivo de rutas de recursos humanos
	include app_path() . '\Http\Routes\routes_recHumanos.php';

	// pantalla principal
	Route::get('/', 'PrincipalController@index');
});

// restringir rutas que son accesadas mediante ciertas IP
Route::group([
		'prefix'     => '/',
		'middleware' => 'ip'
	],  function() {

	// incluír rutas de dirección general
	include app_path() . '\Http\Routes\routes_dirGeneral.php';
});

// rutas custodia
include app_path() . '\Http\Routes\routes_custodia.php';

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