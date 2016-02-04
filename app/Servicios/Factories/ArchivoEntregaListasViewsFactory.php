<?php
namespace Sise\Servicios\Factories;

use Sise\Dominio\Evaluaciones\MemoEntrega;

/**
 * Class ArchivoEntregaListasViewsFactory
 * @package Sise\Servicios\Factories
 * @author  Gerardo Adrián Gómez Ruiz
 */
class ArchivoEntregaListasViewsFactory
{
    /**
     * devolver la vista indicada dependiendo del área que entrega
     * 4 = Poligrafía, se da trato especial por que puede tener más de una reeexaminación
     * @param MemoEntrega $memoEntrega
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public static function crear(MemoEntrega $memoEntrega)
    {
        $nombreVista = '';
        switch ($memoEntrega->getSerial()->getArea()->getId())
        {
            case 1:
            case 2:
            case 3:
            case 5:
                $nombreVista = 'custodia.archivo.archivo_entregas_lista';
                break;

            case 4:
                $nombreVista = 'custodia.archivo.archivo_entregas_lista_poligrafia';
                break;
        }
        return view($nombreVista, compact('memoEntrega'))->render();
    }
}