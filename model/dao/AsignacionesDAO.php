<?php
//autor: Sanchez Albarracin Luccy
require_once 'config/Conexion.php';
date_default_timezone_set('America/Guayaquil');

class AsignacionesDAO {
    private $con;

    public function __construct() {
        $this->con = Conexion::getConexion();
    }

    // Selecciona todas las asignaciones, opcionalmente filtradas por un parámetro
    public function selectAll($parametro = '') {
        $sql = "SELECT a.id, t.nombre AS tarea_nombre, u.nombre AS usuario_nombre, g.nombre AS gestor_nombre, a.fecha_asignacion, a.estado
                FROM Asignaciones a
                JOIN Tareas t ON a.tarea_id = t.id
                JOIN Usuarios u ON a.usuario_id = u.id
                JOIN Usuarios g ON a.gestor_id = g.id AND g.rol_id = 2";
        if (!empty($parametro)) {
            $sql .= " WHERE LOWER(t.nombre) LIKE LOWER(:param)";
        }
        
        $stmt = $this->con->prepare($sql);
        if (!empty($parametro)) {
            $stmt->bindValue(':param', '%' . strtolower(trim($parametro)) . '%');
        }
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_OBJ);
    }
  
    // Selecciona una asignación específica por su ID
    public function selectOne($id) {
        $sql = "SELECT a.id, t.id AS tarea_id, t.nombre AS tarea_nombre, u.id AS usuario_id, a.estado
                FROM Asignaciones a
                JOIN Tareas t ON a.tarea_id = t.id
                JOIN Usuarios u ON a.usuario_id = u.id
                WHERE a.id = :id";
        $stmt = $this->con->prepare($sql);
        $stmt->bindValue(':id', $id);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_OBJ);
    }
    
    public function selectTask($parametro){
        $usuario_id = $_SESSION['usuario_id']; // Obtener el ID del usuario logueado
        $sql = "SELECT t.* FROM asignaciones a 
                JOIN tareas t ON a.tarea_id = t.id 
                WHERE a.usuario_id = :usuario_id";
        $stmt = $this->con->prepare($sql);
        $data = array('usuario_id' => $usuario_id);
        $stmt->execute($data);
        $resultados = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $resultados;
    }

    // Inserta una nueva asignación
    public function insert($asignacion) {
        session_start();
        $gestor_id = $_SESSION['usuario_id']; 
        
        $sql = "INSERT INTO asignaciones (tarea_id, usuario_id, gestor_id, proyecto_id, fecha_asignacion, estado) 
                VALUES (:tarea_id, :usuario_id, :gestor_id, :proyecto_id, :fecha_asignacion, :estado)";
        $stmt = $this->con->prepare($sql);
        $data = [
            'tarea_id' => $asignacion->getTareaId(),
            'usuario_id' => $asignacion->getUsuarioId(),
            'gestor_id' => $gestor_id,
            'proyecto_id' => $asignacion->getProyectoId(),
            'fecha_asignacion' => $asignacion->getFechaAsignacion(),
            'estado' => $asignacion->getEstado()
        ];
        return $stmt->execute($data);
    }
    
    // Actualiza una asignación existente
    public function update($asignacion) {
        $sql = "UPDATE asignaciones SET 
                tarea_id = :tarea_id, 
                usuario_id = :usuario_id, 
                fecha_asignacion = :fecha_asignacion, 
                estado = :estado
                WHERE id = :id";
        $stmt = $this->con->prepare($sql);
        $data = [
            'tarea_id' => $asignacion->getTareaId(),
            'usuario_id' => $asignacion->getUsuarioId(),
            'fecha_asignacion' => $asignacion->getFechaAsignacion(),
            'estado' => $asignacion->getEstado(),
            'id' => $asignacion->getId()
        ];
        return $stmt->execute($data);
    }
    
    public function actualizarEstado($id, $estado) {
        $sql = "UPDATE tareas SET estado = :estado WHERE id = :id";
        $stmt = $this->con->prepare($sql);
        $stmt->bindParam(':id', $id);
        $stmt->bindParam(':estado', $estado);
        $stmt->execute();
    }
    // Elimina una asignación existente por su ID
    public function delete($id) {
        $sql = "DELETE FROM asignaciones WHERE id = :id";
        $stmt = $this->con->prepare($sql);
        $stmt->bindValue(':id', $id, PDO::PARAM_INT); 
        return $stmt->execute();
    }
    
}
?>
