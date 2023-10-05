<?php

require_once 'RepositorioUsuario.php';
require_once 'Usuario.php';

class ControladorSesion
{
    protected $usuario = null;

    public function login($nombre_usuario, $clave)
    {   
        $retorno = [];
        $repo = new RepositorioUsuario();
        $usuario = $repo->login($nombre_usuario, $clave);

        if ($usuario === false) {
            $retorno = [ false, "Error en el usuario o la contrasena" ];
        } else {
            session_start();
            $_SESSION['usuario'] = serialize($usuario);
            $retorno = [ true, "Usuario correctamente autenticado"];
        }
        return $retorno;
    }

    public function create($nombre_usuario, $clave, $nombre, $apellido, $email)
    {
        $repo = new RepositorioUsuario();
        $usuario = new Usuario($nombre_usuario, $nombre, $apellido, $Id=null, $email);
        $id = $repo->save($usuario, $clave);
        if ( $id === false) {
            return [false, "Error al crear el usuario"];
        } else {
            $usuario->setId($id);
            session_start();
            $_SESSION['usuario'] = serialize($usuario);
            return [true, "Usuario creado correctamente"];
        }
    }

    public function update($nombre_usuario, $nombre, $apellido, $email){
        $repo = new RepositorioUsuario();
        $id = $repo->update($nombre_usuario, $nombre, $apellido, $email);
        if ($id === false) {
            return [ false, "Error Modificando Datos" ];;      
           }else {
           return [ true, "Datos Modificados Correctamente"];
           }
    }

    
}
