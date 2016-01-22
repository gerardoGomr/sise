<?php
// rutas para módulos de custodia
Route::get('custodia/estadisticas/analistas/observaciones', 'Custodia\Estadisticas\LaravelCustodiaObservacionesController@index');

// grafica de observaciones general - mensual
Route::post('custodia/estadisticas/analistas/grafica/observaciones/general', 'Custodia\Estadisticas\LaravelCustodiaObservacionesController@graficaMensual');

// gráfica de observaciones por analista
Route::post('custodia/estadisticas/analistas/grafica/observaciones/detalle', 'Custodia\Estadisticas\LaravelCustodiaObservacionesController@graficaAnalista');