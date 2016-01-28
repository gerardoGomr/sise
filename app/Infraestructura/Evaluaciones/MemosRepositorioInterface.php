<?php
namespace Sise\Infraestructura\Evaluaciones;

use Sise\Dominio\Evaluaciones\Serial;

/**
 * Interface MemosRepositorioInterface
 * @package Sise\Infraestructura\Evaluaciones
 * @author  Gerardo Adrián Gómez Ruiz
 */
interface MemosRepositorioInterface
{
    public function obtenerMemoPorSerial(Serial $serial);
}