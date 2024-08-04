<?php
require_once 'config/Conexion.php';

class TareasDAO {
    private $con;

    public function __construct() {
        $this->con = Conexion::getConexion();
    }
   
   
    public function selectAll($parametro) {
        // SQL de la sentencia
        $sql = "SELECT * FROM tareas WHERE nombre LIKE :b1";
        $stmt = $this->con->prepare($sql);
        // Preparar la sentencia
        $conlike = '%' . $parametro . '%';
        $data = array('b1' => $conlike);
        // Ejecutar la sentencia
        $stmt->execute($data);
        // Recuperar resultados
        $resultados = $stmt->fetchAll(PDO::FETCH_ASSOC);
        // Retornar resultados
        return $resultados;
    }

    public function selectAllHome(){
        $sql = "SELECT * FROM tareas";
        $stmt = $this->con->prepare($sql);
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
        $sql = "select * from tareas where ".
        "id =:id";
        // preparar la sentencia
        $stmt = $this->con->prepare($sql);
        $data = ['id' => $id];
        // ejecutar la sentencia
        $stmt->execute($data);
        // recuperar los datos (en caso de select)
        $tareas = $stmt->fetch(PDO::FETCH_ASSOC);// fetch retorna el primer registro
        // retornar resultados
        return $tareas;
    }

    public function insert(Tareas $tarea) {
        try {
            $this->con->beginTransaction();

            $sql = "INSERT INTO tareas (nombre, descripcion, tiempo_estimado, prioridad, fecha_creacion, proyecto_id, estado) 
                    VALUES (:nombre, :descripcion, :tiempo_estimado, :prioridad, CURRENT_TIMESTAMP, :proyecto_id, :estado)";
            $stmt = $this->con->prepare($sql);
            $data = array(
                'nombre' => $tarea->getNombre(),
                'descripcion' => $tarea->getDescripcion(),
                'tiempo_estimado' => $tarea->getTiempoEstimado(),
                'prioridad' => $tarea->getPrioridad(),
                'proyecto_id' => $tarea->getProyectoId(),
                'estado' => $tarea->getEstado()
            );
            $stmt->execute($data);
            
            $this->con->commit();
            if ($stmt->rowCount() <= 0) {
                echo "Error al insertar tarea: " . $stmt->errorInfo()[2];
                return false;
            }
        } catch (Exception $e) {
            echo $e->getMessage();
            return false;
        }
        return true;
    }

    public function update(Tareas $tarea) {
        try {
            $this->con->beginTransaction();
    
            $sql = "UPDATE tareas SET nombre=:nombre, descripcion=:descripcion, tiempo_estimado=:tiempo_estimado, prioridad=:prioridad, estado=:estado WHERE id=:id";
            $stmt = $this->con->prepare($sql);
            $data = [
                'nombre' => $tarea->getNombre(),
                'descripcion' => $tarea->getDescripcion(),
                'tiempo_estimado' => $tarea->getTiempoEstimado(),
                'prioridad' => $tarea->getPrioridad(),
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
        // Eliminar asignaciones asociadas con la tarea
        $sql = "DELETE FROM asignaciones WHERE tarea_id = :id";
        $stmt = $this->con->prepare($sql);
        $stmt->bindValue(':id', $id, PDO::PARAM_INT);
        $stmt->execute();
    
        // Eliminar la tarea
        $sql = "DELETE FROM tareas WHERE id = :id";
        $stmt = $this->con->prepare($sql);
        $stmt->bindValue(':id', $id, PDO::PARAM_INT);
        return $stmt->execute();
    }
    
}
?>