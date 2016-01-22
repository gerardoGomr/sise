<?php
namespace Sise\Infraestructura\Usuarios;

use DB;

/**
 * Class UsuariosRepositorioInterface
 * @package Sise\Infraestructura\Usuarios
 * @author  Gerardo Adrián Gómez Ruiz
 */
class UsuariosRepositorioLaravelSQLServer implements UsuariosRepositorioInterface
{
    /**
     * @return array
     */
    public function obtenerAnalistas()
    {
        $listaAnalistas = array();

        try {

            $analistas = DB::connection('Integral')
                ->table('tUsuarios')
                ->where('departamento', 1)
                ->where(function($where){
                    $where->where('nivel', 1)
                        ->orWhere('Nivel_Analisis', 1);
                })
                ->where('usuario', '<>', 'SQLSERVER')
                ->where('activo', 1)
                ->orderBy('nombre')
                ->get();

            $totalAnalistas = count($analistas);

            if ($totalAnalistas > 0) {
                foreach ( $analistas as $analistas ) {
                    $listaAnalistas[] = [
                        'usuario' => $analistas->usuario,
                        'nombre'  => $analistas->nombre
                    ];
                }

                return $listaAnalistas;
            }

            return null;

        } catch (\PDOException $e) {
            echo $e->getMessage();
            return null;
        }
    }
}