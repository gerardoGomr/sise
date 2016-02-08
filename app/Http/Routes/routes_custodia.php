<?php
// rutas para módulos de custodia
Route::get('custodia/estadisticas/analistas/observaciones', 'Custodia\Estadisticas\LaravelCustodiaObservacionesController@index');

// grafica de observaciones general - mensual
Route::post('custodia/estadisticas/analistas/grafica/observaciones/general', 'Custodia\Estadisticas\LaravelCustodiaObservacionesController@graficaMensual');

// gráfica de observaciones por analista
Route::post('custodia/estadisticas/analistas/grafica/observaciones/detalle', 'Custodia\Estadisticas\LaravelCustodiaObservacionesController@graficaAnalistas');

// ruta para visualizar el historial de observaciones de un analista
Route::get('custodia/estadisticas/analistas/observaciones/detalle/{anio}/{analista}/{fecha1?}/{fecha2?}', 'Custodia\Estadisticas\LaravelCustodiaObservacionesController@detalle');

// ruta para generar reporte general de custodia observaciones
Route::post('custodia/estadisticas/analistas/observaciones/reporte', 'Custodia\Estadisticas\LaravelCustodiaObservacionesController@reporteGeneral');

// ruta para entrega - recepcion archivo
Route::get('custodia/archivo/entregas', 'Custodia\Archivo\LaravelArchivoController@index');

// ruta para entrega - recepción, buscar memo
Route::post('custodia/archivo/entregas', 'Custodia\Archivo\LaravelArchivoController@buscarMemo');

// ruta para entrega -recepcion, agregar evaluacion
Route::post('custodia/archivo/entregas/expediente', 'Custodia\Archivo\LaravelArchivoController@marcarExpediente');

// ruta para entrega - recepción, actualizar
Route::post('custodia/archivo/entregas/marcar', 'Custodia\Archivo\LaravelArchivoController@marcarEntrega');