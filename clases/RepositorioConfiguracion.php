<?php
require_once '.envPUBLICO.php';
require_once 'configuracion.php';

class RepositorioConfiguracion
{
    public static $conexion = null;

    public function __construct()
    {
        if (is_null(self::$conexion)) {
            $credenciales = credenciales();
            if ($credenciales) {
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
            } else {
                die("No se pudieron obtener las credenciales.");
            }
        }
    }

    // Resto del código...
}
?>
