<?php

class Configuracion
{
    protected $id;
    protected $descripcion;
    protected $cantidad;
    protected $unidadMedida;
    protected $precio;

    public function __construct($descripcion, $cantidad, $unidadMedida, $precio, $id = null)
    {
        $this->id = $id;
        $this->descripcion = $descripcion;
        $this->cantidad = $cantidad;
        $this->unidadMedida = $unidadMedida;
        $this->precio = $precio;
        
    }
    public function getId() {return $this->id;}
    public function setId($id) {$this->id = $id;}
    public function getUsuario() {return $this->descripcion;}
    public function getNombre() {return $this->cantidad;}
    public function getApellido() {return $this->unidadMedida;}
    public function getNombreApellido() {return "$this->nombre $this->apellido";}
    public function getEmail() {return $this->email;}
}
