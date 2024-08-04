<?php
require_once 'config/Conexion.php';

class ProyectosDAO {
    private $con;

    public function __construct() {
        $this->con = Conexion::getConexion();
    }

    // Selecciona todos los proyectos, opcionalmente filtrados por un parámetro
    public function selectAll($parametro = '') {
        $sql = "SELECT id, nombre FROM proyectos";
        if (!empty($parametro)) {
            $sql .= " WHERE nombre LIKE :param";
        }
        $stmt = $this->con->prepare($sql);
        if (!empty($parametro)) {
            $stmt->bindValue(':param', '%' . $parametro . '%');
        }
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_OBJ);
    }

    // Selecciona un proyecto específico por su ID
    public function selectOne($id) {
        $sql = "SELECT nombre FROM proyectos WHERE id = :id";
        $stmt = $this->con->prepare($sql);
        $stmt->bindValue(':id', $id);
        $stmt->execute();
        $resultado = $stmt->fetch(PDO::FETCH_ASSOC);
        if ($resultado) {
            return $resultado;
        } else {
            return array('nombre' => '');
        }
    }

    // Inserta un nuevo proyecto
    public function insert($proyecto) {
        $sql = "INSERT INTO proyectos (nombre) VALUES (:nombre)";
        $stmt = $this->con->prepare($sql);
        $data = [
            'nombre' => $proyecto->getNombre()
        ];
        return $stmt->execute($data);
    }

    // Actualiza un proyecto existente
    public function update($proyecto) {
        $sql = "UPDATE proyectos SET nombre = :nombre WHERE id = :id";
        $stmt = $this->con->prepare($sql);
        $data = [
            'nombre' => $proyecto->getNombre(),
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
