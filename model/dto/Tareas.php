<?php
//autor: Robalino Aguilar Eliud Issac 
class Tareas {
    //properties
    private $id;
    private $nombre;
    private $descripcion;
    private $tiempo_estimado;
    private $prioridad;
    private $fecha_creacion;
    private $proyecto_id;
    private $estado;

    function __construct() {

    }

    // Getters
    function getId() {
        return $this->id;
    }

    function getNombre() {
        return $this->nombre;
    }

    function getDescripcion() {
        return $this->descripcion;
    }

    function getTiempoEstimado() {
        return $this->tiempo_estimado;
    }

    function getPrioridad() {
        return $this->prioridad;
    }

    function getFechaCreacion() {
        return $this->fecha_creacion;
    }

    function getProyectoId() {
        return $this->proyecto_id;
    }

    function getEstado() {
        return $this->estado;
    }

    // Setters
    function setId($id) {
        $this->id = $id;
    }

    function setNombre($nombre) {
        $this->nombre = $nombre;
    }

    function setDescripcion($descripcion) {
        $this->descripcion = $descripcion;
    }

    function setTiempoEstimado($tiempo_estimado) {
        $this->tiempo_estimado = $tiempo_estimado;
    }

    function setPrioridad($prioridad) {
        $this->prioridad = $prioridad;
    }

    function setFechaCreacion($fecha_creacion) {
        $this->fecha_creacion = $fecha_creacion;
    }

    function setProyectoId($proyecto_id) {
        $this->proyecto_id = $proyecto_id;
    }

    function setEstado($estado) {
        $this->estado = $estado;
    }
}
?>
