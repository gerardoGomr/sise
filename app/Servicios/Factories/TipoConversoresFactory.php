<?php
namespace Sise\Servicios\Factories;

use Sise\Servicios\Custodia\ConversorObservacionesAnalistasHighcharts;
use Sise\Servicios\Custodia\ConversorObservacionesHighcharts;

/**
 * Class TipoConversoresFactory
 * @package Sise\Servicios\Factories
 * @author  Gerardo Adrián Gómez Ruiz
 */
class TipoConversoresFactory
{
    /**
     * obtener una instancia de tipo de conversor
     * @param string $tipo
     * @return ConversorObservacionesAnalistasHighcharts|ConversorObservacionesHighcharts
     */
    public static function obtenerConversor($tipo)
    {
        switch ($tipo) {
            case 'observaciones_general':
                return new ConversorObservacionesHighcharts();
                break;

            case 'observaciones_analistas':
                return new ConversorObservacionesAnalistasHighcharts();
                break;

            default:
                throw new \InvalidArgumentException('Tipo no válido');
                break;
        }
    }
}