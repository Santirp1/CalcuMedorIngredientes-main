<?php
require_once 'envPUBLICO.php';
require_once 'Usuario.php';

class RepositorioUsuario
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
                $credenciales['base_de_datos']
            );
            if (self::$conexion->connect_error) {
                $error = 'Error de conexión: ' . self::$conexion->connect_error;
                self::$conexion = null;
                die($error);
            }
            self::$conexion->set_charset('utf8');
        }
   }

   public function login($nombre_usuario, $clave)
   {
       $q = "SELECT usuario, clave, nombre, apellido, id, email FROM usuarios WHERE usuario = ?";
       $query = self::$conexion->prepare($q);
       $query->bind_param("s", $nombre_usuario);

       if ($query->execute()) {
           $query->bind_result($usuario, $clave_encriptada, $nombre, $apellido, $id, $email);
           if( $query->fetch() ) {
               if ( password_verify($clave, $clave_encriptada) ) {
                   return new Usuario($nombre_usuario, $nombre, $apellido, $id, $email);
               }
           }
       }
       return false;
    }

    public function save(Usuario $usuario, $clave)
    {
       $q = "INSERT INTO usuarios (usuario, clave, nombre, apellido, email) ";
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
           $clave_encriptada,
           $nombre,
           $apellido,
           $email
       );
       if ($query->execute()) {
           return self::$conexion->insert_id;
       } else {
           var_dump($query->error);die();
           return false;
       }
    }

    public function update($nombre_usuario, $nombre, $apellido, $email)
    {
       session_start();
       $usuario = unserialize($_SESSION['usuario']);
       $nombre_usuario = $nombre_usuario;
       $nombre = $nombre;
       $apellido = $apellido;
       $email = $email;
       $q = " UPDATE usuarios SET usuario = ?, nombre = ?, apellido = ?, email = ? WHERE usuario='".$usuario->getUsuario()."'";
       $query = self::$conexion->prepare($q);
       $query->bind_param(
           "ssss",
           $nombre_usuario,
           $nombre,
           $apellido,
           $email
       );

       if ($query->execute() > 0) {
        $q = " SELECT * FROM usuarios WHERE usuario='".$nombre_usuario."'";
        return true;      
       }else {
        return false;
       }
    }

    
}
