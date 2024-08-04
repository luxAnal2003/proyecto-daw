<?php
//autor: Sanchez Albarracin Luccy

class Asignaciones {
    private $id;
    private $tarea_id;
    private $usuario_id;
    private $gestor_id;
    private $proyecto_id; 
    private $fecha_asignacion;
    private $estado;

    function __construct() {
        
    }

    // Getters y Setters

    public function getId() {
        return $this->id;
    }

    public function setId($id) {
        $this->id = $id;
    }

    public function getTareaId() {
        return $this->tarea_id;
    }

    public function setTareaId($tarea_id) {
        $this->tarea_id = $tarea_id;
    }

    public function getUsuarioId() {
        return $this->usuario_id;
    }

    public function setUsuarioId($usuario_id) {
        $this->usuario_id = $usuario_id;
    }

    public function getGestorId() {
        return $this->gestor_id;
    }

    public function setGestorId($gestor_id) {
        $this->gestor_id = $gestor_id;
    }

    public function getProyectoId() {
        return $this->proyecto_id;
    }

    public function setProyectoId($proyecto_id) {
        $this->proyecto_id = $proyecto_id;
    }

    public function getFechaAsignacion() {
        return $this->fecha_asignacion;
    }

    public function setFechaAsignacion($fecha_asignacion) {
        $this->fecha_asignacion = $fecha_asignacion;
    }

    public function getEstado() {
        return $this->estado;
    }

    public function setEstado($estado) {
        $this->estado = $estado;
    }
}

?>
