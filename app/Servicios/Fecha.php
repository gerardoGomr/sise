<?php
namespace Sise\Servicios;

/**
 * Class Fecha
 * @package Sise\Servicios
 * @author  Gerardo Adrián Gómez Ruiz
 */
class Fecha
{
    public static function fechaDeHoy($fecha)
    {
        $fechaActual = explode('/', $fecha);

        if (count($fechaActual) > 0) {

            return $fechaActual[0] . ' de ' . Mes::nombreMes($fechaActual[1]) . ' de ' . $fechaActual[2];
        }

        $fechaActual = explode('-', $fecha);

        if (count($fechaActual) > 0) {
            return $fechaActual[0] . ' de ' . Mes::nombreMes($fechaActual[1]) . ' de ' . $fechaActual[2];
        }

        throw new \InvalidArgumentException("El formato del parámetro $fecha es inválido");
    }
}