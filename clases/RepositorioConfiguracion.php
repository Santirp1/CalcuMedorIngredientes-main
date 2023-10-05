<?php
require_once '.envPUBLICO.php';
require_once 'configuracion.php';

class RepositorioConfiguracion
{
    Public static $conexion = null;

    public function __construct()
    {
        if (is_null(self::$conexion)) {
            $credenciales = credenciales();
            self::$conexion = new mysqli(
                $credenciales['servidor'],
                $credenciales['usuario'],
                $credenciales['clave'],
                $credenciales['base_de_datos'],
            );
            if (self::$conexion->connect_error) {
                $error = 'Error de conexión: ' . self::$conexion->connect_error;
                self::$conexion = null;
                die($error);
            }
            self::$conexion->set_charset('utf8');
        }
   }

   public function save(Usuario $usuario, $clave)
    {
       $q = "INSERT INTO usuarios (usuario, nombre, apellido, email, clave) ";
       $q.= "VALUES (?, ?, ?, ?, ?)";
       $query = self::$conexion->prepare($q);
       $nombre_usuario = $usuario->getUsuario();
       $nombre = $usuario->getNombre();
       $apellido = $usuario->getApellido();
       $clave_encriptada = password_hash($clave, PASSWORD_DEFAULT);
       $email = $usuario->getEmail();
       $query->bind_param(
           "sssss",
           $nombre_usuario,
           $nombre,
           $apellido,
           $email,
           $clave_encriptada
       );
       if ($query->execute()) {
           // Se guardó bien, retornamos el id del usuario
           return self::$conexion->insert_id;
       } else {
           // No se guardó bien, retornamos false
           var_dump($query->error);die();
           return false;
       }
    }





  }
   ?>