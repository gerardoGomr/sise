<?php
namespace Sise\Dominio\Usuarios;

/**
 * @author Gerardo Adrián Gómez Ruiz
 */
abstract class Usuario
{
    /**
     * nombre de usuario
     * @var string
     */
    protected $username;

    /**
     * contraseña, encriptada
     * @var string
     */
    protected $passwd;

    /**
     * estatus activo/inactivo
     * @var int
     */
    protected $activo;

    /**
     * constructor
     * @param string $username
     */
    public function __construct($username = '', $passwd = '')
    {
        $this->username = $username;
        $this->passwd   = $passwd;
    }

    /**
     * Gets the nombre de usuario.
     *
     * @return string
     */
    public function getUsername()
    {
        return $this->username;
    }

    /**
     * Sets the nombre de usuario.
     *
     * @param string $username the username
     */
    public function setUsername($username)
    {
        $this->username = $username;
    }

    /**
     * Gets the contraseña, encriptada.
     *
     * @return string
     */
    public function getPasswd()
    {
        return $this->passwd;
    }

    /**
     * Sets the contraseña, encriptada.
     *
     * @param string $passwd the passwd
     */
    public function setPasswd($passwd)
    {
        $this->passwd = $passwd;
    }

    /**
     * verifica que la contraseña del usuario coincida con el parametro
     * proporcionado
     * @param  string $passwd
     * @return bool
     */
    public function verificarContrasenia($passwd)
    {
        if(!password_verify($passwd, $this->passwd)) {
            return false;
        }
        // if($this->passwd !== $passwd) {
        //     return false;
        // }

        return true;
    }

    /**
     * verificar si el usuario esta o no activo
     * @return bool
     */
    public function activo()
    {
        if($this->activo === false) {
            return false;
        }

        return true;
    }

    /**
     * setear si es o no activo
     * @param mixed $activo
     */
    public function setActivo($activo)
    {
        if(is_string($activo)) {
            if($activo === '1') {
                $this->activo = true;

            } else {
                $this->activo = false;
            }

        } else {
            $this->activo = $activo;
        }
    }

    /**
     * encriptar la contraseña proporcionada
     * @param  string $passwordSinHash
     * @return string
     */
    public static function encryptaPassword($passwordSinHash)
    {
        return password_hash($passwordSinHash, PASSWORD_DEFAULT);
    }
}