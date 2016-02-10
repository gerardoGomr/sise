<?php
namespace Sise\Servicios\Factories;

use Sise\Dominio\Evaluaciones\SerialExpediente;
use Sise\Dominio\Evaluaciones\SerialExpedientePoligrafia;
use Sise\Dominio\Evaluaciones\TipoSerial;

/**
 * Class SerialesFactory
 * @package Sise\Servicios\Factories
 * @author  Gerardo Adrián Gómez Ruiz
 */
class SerialesFactory
{
    /**
     * @param string $txtSerial
     * @return SerialExpediente|SerialExpedientePoligrafia
     */
    public static function crear($txtSerial)
    {
        $longitud = strlen($txtSerial);dd($longitud);
        if ($longitud === 10) {
            return new SerialExpediente($txtSerial);
        }

        if ($longitud === 11) {
            return new SerialExpedientePoligrafia($txtSerial);
        }
    }
}