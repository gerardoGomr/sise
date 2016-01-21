<?php
namespace Sise\Servicios;

/**
 * Interface Conversor
 * @package Sise\Servicios
 * @author  Gerardo Adrián Gómez Ruiz
 */
interface Conversor
{
    /**
     * convertir un arreglo en otro con cierto formato
     * @param array $lista
     * @return mixed
     */
    public function convertir($lista);
}