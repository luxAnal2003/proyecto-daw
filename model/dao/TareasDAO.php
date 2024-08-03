<?php
require_once 'config/Conexion.php';

class TareasDAO {
    private $con;

    public function __construct() {
        $this->con = Conexion::getConexion();
    }
   
   
    public function selectAll($proyecto_id = '') {
        $sql = "SELECT id, nombre FROM tareas";
        if (!empty($proyecto_id)) {
            $sql .= " WHERE proyecto_id = :proyecto_id";
        }
        $stmt = $this->con->prepare($sql);
        if (!empty($proyecto_id)) {
            $stmt->bindValue(':proyecto_id', $proyecto_id);
        }
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_OBJ);
    }


    public function selectByProyecto($proyectoId) {
        $sql = "SELECT id, nombre FROM tareas WHERE proyecto_id = :proyecto_id";
        $stmt = $this->con->prepare($sql);
        $stmt->bindValue(':proyecto_id', $proyectoId);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_OBJ);
    }

    public function selectOne($id) {
        $sql = "SELECT * FROM tareas WHERE id = :id";
        $stmt = $this->con->prepare($sql);
        $data = ['id' => $id];
        $stmt->execute($data);
        $tareas = $stmt->fetch(PDO::FETCH_ASSOC);
        return $tareas;
    }

    public function insert(Tareas $tarea) {
        try {
            $this->con->beginTransaction();

            $sql = "INSERT INTO tareas (nombre, descripcion, tiempo_estimado, prioridad, fecha_creacion, proyecto_id, estado) 
                    VALUES (:nombre, :descripcion, :tiempo_estimado, :prioridad, CURRENT_TIMESTAMP, :proyecto_id, :estado)";
            $stmt = $this->con->prepare($sql);
            $data = [
                'nombre' => $tarea->getNombre(),
                'descripcion' => $tarea->getDescripcion(),
                'tiempo_estimado' => $tarea->getTiempoEstimado(),
                'prioridad' => $tarea->getPrioridad(),
                'proyecto_id' => $tarea->getProyectoId(),
                'estado' => $tarea->getEstado()
            ];
            $stmt->execute($data);
            
            $this->con->commit();
            return true;
        } catch (Exception $e) {
            $this->con->rollBack();
            throw $e;
        }
    }

    public function update(Tareas $tarea) {
        try {
            $this->con->beginTransaction();

            $sql = "UPDATE tareas SET nombre=:nombre, descripcion=:descripcion, tiempo_estimado=:tiempo_estimado, prioridad=:prioridad, proyecto_id=:proyecto_id, estado=:estado WHERE id=:id";
            $stmt = $this->con->prepare($sql);
            $data = [
                'nombre' => $tarea->getNombre(),
                'descripcion' => $tarea->getDescripcion(),
                'tiempo_estimado' => $tarea->getTiempoEstimado(),
                'prioridad' => $tarea->getPrioridad(),
                'proyecto_id' => $tarea->getProyectoId(),
                'estado' => $tarea->getEstado(),
                'id' => $tarea->getId()
            ];
            $stmt->execute($data);
            
            $this->con->commit();
            return true;
        } catch (Exception $e) {
            $this->con->rollBack();
            throw $e;
        }
    }

    public function delete($id) {
        try {
            $this->con->beginTransaction();

            $sql = "DELETE FROM tareas WHERE id=:id";
            $stmt = $this->con->prepare($sql);
            $data = ['id' => $id];
            $stmt->execute($data);

            $this->con->commit();
            return true;
        } catch (Exception $e) {
            $this->con->rollBack();
            throw $e;
        }
    }
}
?>
