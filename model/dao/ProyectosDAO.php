<?php
//autor: Espinoza Vergara Miguel Ángel 
require_once 'config/Conexion.php';

class ProyectosDAO {
    private $con;

    public function __construct() {
        $this->con = Conexion::getConexion();
    }

    // Selecciona todos los proyectos, opcionalmente filtrados por un parámetro
    public function selectAll($parametro = '') {
        $sql = "SELECT p.id, p.nombre, p.descripcion, u.nombre as usuario_creacion 
                FROM proyectos p 
                INNER JOIN usuarios u ON p.usuario_creacion = u.id";
        if (!empty($parametro)) {
            $sql .= " WHERE p.nombre LIKE :param";
        }
        $stmt = $this->con->prepare($sql);
        if (!empty($parametro)) {
            $stmt->bindValue(':param', '%' . $parametro . '%');
        }
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_OBJ);
    }

    public function selectAllHome(){
        $sql = "SELECT * FROM proyectos";
        $stmt = $this->con->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_OBJ);
    }
    
    // Selecciona un proyecto específico por su ID
    public function selectOne($id) {
        $sql = "SELECT id, nombre, descripcion FROM proyectos WHERE id = :id";
        $stmt = $this->con->prepare($sql);
        $stmt->bindValue(':id', $id);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_OBJ);
    }
    
    // Inserta un nuevo proyecto
    public function insert($proyecto) {
        session_start();

        $sql = "INSERT INTO proyectos (nombre, descripcion, usuario_creacion) 
                VALUES (:nombre, :descripcion, :usuario_creacion)";
        $stmt = $this->con->prepare($sql);
        $data = [
            'nombre' => $proyecto->getNombre(),
            'descripcion' => $proyecto->getDescripcion(),
            'usuario_creacion' => $_SESSION['usuario_id'] 
        ];
        return $stmt->execute($data);
    }

    // Actualiza un proyecto existente
    public function update($proyecto) {
        $sql = "UPDATE proyectos SET nombre = :nombre, descripcion = :descripcion WHERE id = :id";
        $stmt = $this->con->prepare($sql);
        $data = [
            'nombre' => $proyecto->getNombre(),
            'descripcion' => $proyecto->getDescripcion(),
            'id' => $proyecto->getId()
        ];
        return $stmt->execute($data);
    }
    

    // Elimina un proyecto existente por su ID
    public function delete($id) {
        $sql = "DELETE FROM proyectos WHERE id = :id";
        $stmt = $this->con->prepare($sql);
        $stmt->bindValue(':id', $id);
        return $stmt->execute();
    }
}
?>
