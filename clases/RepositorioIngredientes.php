<?php
require_once 'envPUBLICO.php';

class RepositorioIngredientes
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

   public function RecuperarIngredientes()
   {
       $arrDatos = array();
       $resultado = self::$conexion->query("SELECT * FROM ingredientes");
       while ($row = $resultado->fetch_assoc()) {
        $arrDatos[] = $row;
    }
    return $arrDatos;
    }
    
   public function RecuperarIngrediente($id) {
    $q = 'SELECT IF( EXISTS(SELECT id FROM ingredientes WHERE id =  ?), 1, 0)';
    $query = self::$conexion->prepare($q);
    $query->bind_param(
        "s",
        $id
    );
    return $query->execute();
   }

   public function RecuperarIngredienteIndividual($id)
   {
       $arrDatos = array();
       $resultado = self::$conexion->query("SELECT * FROM ingredientes WHERE id = $id ");
       while ($row = $resultado->fetch_assoc()) {
        $arrDatos[] = $row;
    }
    return $arrDatos;
    }

   public function InsertarIngrediente($nombre, $unidadDeMedida, $precio, $icono, $ID_Usuario) {
    $q = 'INSERT INTO `ingredientes`(`nombre`, `unidadDeMedida`, `precio`, `icono`, `id_usuario`, `ultimaModificacion`) VALUES (?,?,?,?,?,?)';
    $query = self::$conexion->prepare($q);
    $query->bind_param(
        "ssssss",
        $nombre,
        $unidadDeMedida,
        $precio,
        $icono,
        $ID_Usuario,
        date('d-m-y h:m:s')
    );
    if ($query->execute() > 0) {
        return true;      
       }else {
        return false;
       }
   }
   
   public function ActualizarIngrediente($unidadDeMedida, $precio, $nombre, $id, $ID_Usuario) {
    $q = " UPDATE ingredientes SET unidadDeMedida = ?, precio = ?, nombre= ?, id_usuario= ?, ultimaModificacion= ? WHERE id= ? ";
    $query = self::$conexion->prepare($q);
    $query->bind_param(
        "ssssss",
        $unidadDeMedida,
        $precio,
        $nombre,
        $ID_Usuario,
        date('d-m-y h:m:s'),
        $id
        
    );
    if ($query->execute() > 0) {
     return true;      
    }else {
     return false;
    }
 }

    public function EliminarIngrediente($id) {
        $q = " DELETE FROM ingredientes WHERE id= ? ";
        $query = self::$conexion->prepare($q);
        $query->bind_param(
            "s",
            $id
        );
        if ($query->execute() > 0) {
         return true;      
        }else {
         return false;
        }
     }

     public function RecuperarIngredienteBarato()
   {
        $result = self::$conexion->query("SELECT nombre FROM ingredientes ORDER by precio asc LIMIT 1");
        return $result->fetch_assoc();
       }

       public function RecuperarIngredienteCaro()
   {
       $result = self::$conexion->query("SELECT nombre FROM ingredientes ORDER by precio desc LIMIT 1");
       return $result->fetch_assoc();
       }

       public function RecuperarIngredientesTotal()
   {
        $result = self::$conexion->query("SELECT SUM(precio) FROM ingredientes");
        return $result->fetch_assoc();
       }
     
   }

   



?>