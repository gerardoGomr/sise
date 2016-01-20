<?php
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