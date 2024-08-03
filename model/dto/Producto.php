<?php
// dto data transfer object
class Producto {
    //properties
    private $id, $nombre, $descripcion, $estado, $precio, 
    $idCategoria, $usuario, $fechaActualizacion;

    function __construct() {
        
    }

   function getId() {
        return $this->id;
    }

   
    function getNombre() {
        return $this->nombre;
    }

    function getDescripcion(){
        return $this->descripcion;
    }

    function getEstado() {
        return $this->estado;
    }

    function getPrecio() {
        return $this->precio;
    }

    function getIdCategoria() {
        return $this->idCategoria;
    }

    function getUsuario() {
        return $this->usuario;
    }

    function getFechaActualizacion() {
        return $this->fechaActualizacion;
    }

    function setId($id) {
        $this->id = $id;
    }


    function setNombre($nombre) {
        $this->nombre = $nombre;
    }

    function setDescripcion($descripcion) {
        $this->descripcion = $descripcion;
    }
  
    function setEstado($estado) {
        $this->estado = $estado;
    }

    function setPrecio($precio) {
        $this->precio = $precio;
    }

    function setIdCategoria($idCategoria) {
        $this->idCategoria = $idCategoria;
    }

    function setUsuario($usuario) {
        $this->usuario = $usuario;
    }

    function setFechaActualizacion($fechaActualizacion) {
        $this->fechaActualizacion = $fechaActualizacion;
    }
    

    // Methods get y set parametrizados
    public function __set($nombre, $valor) {
        // Verifica que la propiedad exista
        if (property_exists('Producto', $nombre)) {
            $this->$nombre = $valor;
        } else {
            echo $nombre . " No existe.";
        }
    }

    public function __get($nombre) {
      // Verifica que exista la propiedad
        if (property_exists('Producto', $nombre)) {
            return $this->$nombre;
        }
// Retorna null si no existe
        return NULL;
    }

    
    
}
