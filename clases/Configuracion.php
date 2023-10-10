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

    public function getId() { return $this->id; }
    public function setId($id) { $this->id = $id; }
    public function getDescripcion() { return $this->descripcion; }
    public function getCantidad() { return $this->cantidad; }
    public function getUnidadMedida() { return $this->unidadMedida; }
    public function getPrecio() { return $this->precio; }
}
