<?php
require_once 'envPUBLICO.php';

class RepositorioRecetas
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

   public function recuperarReceta($id)
   {
    $arrDatos = array();
    $resultado = self::$conexion->query("SELECT * FROM recetas where id = $id");
    if ($resultado) {
        while ($row = $resultado->fetch_assoc()) {
            $arrDatos[] = $row;
        }
        return [$arrDatos, ""];
    }else{
        return [$arrDatos, '<script>LlamarAlerta(1)</script>'];
    }
    }

    public function recuperarRecetas()
   {
    $arrDatos = array();
    $resultado = self::$conexion->query("SELECT DISTINCT id, nombre FROM recetas");
    if ($resultado) {
        while ($row = $resultado->fetch_assoc()) {
            $arrDatos[] = $row;
        }
        return [$arrDatos, ""];
    }else{
        return [$arrDatos, '<script>LlamarAlerta(1)</script>'];
    }
       }


    public function GrabarReceta($id, $nombre, $descripcion, $ingrediente, $cantidad, $unidadDeMedida, $precio, $icono)
   {
    $q = 'INSERT INTO `recetas`(`id`, `nombre`, `descripcion`, `ingrediente`, `cantidad`, `unidadDeMedida`, `precio`, `icono`) VALUES (?,?,?,?,?,?,?,?)';
    $query = self::$conexion->prepare($q);
    $query->bind_param(
        "ssssssss",
        $id,
        $nombre,
        $descripcion,
        $ingrediente,
        $cantidad,
        $unidadDeMedida,
        $precio, 
        $icono
    );
    if ($query->execute() > 0) {
        return '<script>LlamarAlerta(1)</script>';      
       }else {
        return false;
       }
}

public function RecuperarUltimoID()
{
 $result = self::$conexion->query('SELECT id FROM recetas ORDER by ID DESC LIMIT 1');
 return $result->fetch_assoc();
}
}
    



    // $arrDatos = array();
    // $resultado = self::$conexion->query("INSERT INTO recetas ");
    // if ($resultado) {
    //     while ($row = $resultado->fetch_assoc()) {
    //         $arrDatos[] = $row;
    //     }
    //     return [$arrDatos, ""];
    // }else{
    //     return [$arrDatos, '<script>LlamarAlerta(1)</script>'];
    // }
    //    }

    // GrabarReceta($value['nombre'], $value['ingrediente'],
    //  $value['cantidad'], $value['unidadDeMedida'], $value['precio'], $value['icono'])
?>