<?php
    namespace Sise\Dominio\Dependencias;

    /**
     * Class Dependencia
     * @author  Gerardo Adrián Gómez Ruiz
     * @package Sise\Dominio\Dependencias
     */
    class Dependencia
    {
        /**
         * @var int
         */
        private $id;

        /**
         * @var string
         */
        private $nombre;

        /**
         * Dependencia constructor.
         * @param int    $id
         * @param string $nombre
         */
        public function __construct($id = null, $nombre = null)
        {
            $this->id     = $id;
            $this->nombre = $nombre;
        }

        /**
         * @return int
         */
        public function getId()
        {
            return $this->id;
        }

        /**
         * @param int $id
         */
        public function setId($id)
        {
            $this->id = $id;
        }

        /**
         * @return string
         */
        public function getNombre()
        {
            return $this->nombre;
        }

        /**
         * @param string $nombre
         */
        public function setNombre($nombre)
        {
            $this->nombre = $nombre;
        }
    }