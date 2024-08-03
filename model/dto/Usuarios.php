<?php
// DTO de Usuario
class Usuarios {
    // Atributos de la clase
    private $id, $nombre, $email, $contrasena, $rol_id;

    function __construct($id = null, $nombre = null, $email = null, $contrasena = null, $rol_id = null) {
        $this->id = $id;
        $this->nombre = $nombre;
        $this->email = $email;
        $this->contrasena = $contrasena;
        $this->rol_id = $rol_id;
    }

    // Getters y setters para cada atributo
    public function getId() {
        return $this->id;
    }

    public function setId($id) {
        $this->id = $id;
    }

    public function getNombre() {
        return $this->nombre;
    }

    public function setNombre($nombre) {
        $this->nombre = $nombre;
    }

    public function getEmail() {
        return $this->email;
    }

    public function setEmail($email) {
        $this->email = $email;
    }

    public function getContrasena() {
        return $this->contrasena;
    }

    public function setContrasena($contrasena) {
        $this->contrasena = $contrasena;
    }

    public function getRolId() {
        return $this->rol_id;
    }

    public function setRolId($rol_id) {
        $this->rol_id = $rol_id;
    }

    public function getFechaCreacion() {
        return $this->fecha_creacion;
    }

    public function setFechaCreacion($fecha_creacion) {
        $this->fecha_creacion = $fecha_creacion;
    }

    public function getFechaModificacion() {
        return $this->fecha_modificacion;
    }

    public function setFechaModificacion($fecha_modificacion) {
        $this->fecha_modificacion = $fecha_modificacion;
    }

}
?>
