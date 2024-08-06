<?php
//autor: Ramírez Avilés Sebastián Emilio 
class Lista {
    private $id;
    private $nombre;
    private $descripcion;
    private $tipo;
    private $prioridad;
    private $estado;
    private $fechaCreacion;

    public function __construct($id = null, $nombre = '', $descripcion = '', $tipo = '', $prioridad = '', $estado = '', $fechaCreacion = null){
        $this->id = $id;
        $this->nombre = $nombre;
        $this->descripcion = $descripcion;
        $this->tipo = $tipo;
        $this->prioridad = $prioridad;
        $this->estado = $estado;
        $this->fechaCreacion = $fechaCreacion;
    }

    public function getId(){
        return $this->id;
    }

    public function getNombre(){
        return $this->nombre;
    }

    public function getDescripcion(){
        return $this->descripcion;
    }

    public function getTipo(){
        return $this->tipo;
    }
    
    public function getEstado(){
        return $this->prioridad;
    }

    public function getFechaCreacion(){
        return $this->fechaCreacion;
    }

    public function getPrioridad(){
        return $this->prioridad;
    }

    public function setId($id){
        $this->id=$id;
    }

    public function setNombre($nombre){
        $this->nombre=$nombre;
    }

    public function setDescripcion($descripcion){
        $this->descripcion=$descripcion;
    }

    public function setTipo($tipo){
        $this->tipo=$tipo;
    }

    public function setPrioridad($prioridad){
        $this->prioridad = $prioridad;
    }
    
    public function setEstado($estado){
        $this->estado=$estado;
    }

    public function setFechaCreacion($fechaCreacion){
        $this->fechaCreacion=$fechaCreacion;
    }

    public function __set($nombre, $valor){
       if(property_exists($this, $nombre)){
        $this->$nombre=$valor;
       } else{
        echo $nombre . "No existe.";
       }
    }

    public function __get($nombre){
       if(property_exists($this, $nombre)){
        return $this->$nombre;
       }
       return null;
    }
}