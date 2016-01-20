<?php
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