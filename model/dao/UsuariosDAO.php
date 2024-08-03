<?php
require_once 'config/Conexion.php';

class UsuariosDAO {
    private $con;

    public function __construct() {
        $this->con = Conexion::getConexion();
    }

    public function authenticate($email, $password) {
        $sql = "SELECT id, nombre, rol_id FROM usuarios WHERE email = :email AND contrasena = :password";
        $stmt = $this->con->prepare($sql);
        $stmt->bindValue(':email', $email);
        $stmt->bindValue(':password', $password); // Considera usar un hash para la contraseña
        $stmt->execute();

        return $stmt->fetch(PDO::FETCH_OBJ);
    }
    
    // Método para seleccionar todos los usuarios, opcionalmente filtrando por parámetro
    public function selectAll($parametro = '') {
        $sql = "SELECT id, nombre FROM usuarios";
        $stmt = $this->con->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_OBJ);
    }

    // Método para seleccionar un usuario por ID
    public function selectOne($id) {
        $sql = "SELECT a.id, t.nombre AS tarea_nombre, u.nombre AS usuario_nombre, u.id AS usuario_id, g.nombre AS gestor_nombre, a.fecha_asignacion, a.estado
                FROM Asignaciones a
                JOIN Tareas t ON a.tarea_id = t.id
                JOIN Usuarios u ON a.usuario_id = u.id
                JOIN Usuarios g ON a.gestor_id = g.id AND g.rol_id = 2
                WHERE a.id = :id";
        $stmt = $this->con->prepare($sql);
        $stmt->bindValue(':id', $id);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_OBJ);
    }

    // Selecciona todos los usuarios, excepto los gestores y administradores
    public function selectEmpleados() {
        $sql = "SELECT id, nombre FROM usuarios WHERE rol_id NOT IN (1, 2)";
        $stmt = $this->con->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_OBJ);
    }
   
    // Método para insertar un nuevo usuario en la base de datos
    public function insert(Usuarios $usuario) {
        try {
            $this->con->beginTransaction();

            $sql = "INSERT INTO Usuarios (nombre, email, contrasena, rol_id) 
                    VALUES (:nombre, :email, :contrasena, :rol_id)";
            $stmt = $this->con->prepare($sql);
            $data = [
                'nombre' => $usuario->getNombre(),
                'email' => $usuario->getEmail(),
                'contrasena' => password_hash($usuario->getContrasena(), PASSWORD_BCRYPT), // Encriptar la contraseña
                'rol_id' => $usuario->getRolId()
            ];
            $stmt->execute($data);

            $this->con->commit();
            return true;
        } catch (Exception $e) {
            $this->con->rollBack();
            throw $e;
        }
    }

    // Método para actualizar un usuario existente
    public function update(Usuarios $usuario) {
        try {
            $this->con->beginTransaction();

            $sql = "UPDATE Usuarios SET nombre = :nombre, email = :email, contrasena = :contrasena, rol_id = :rol_id 
                    WHERE id = :id";
            $stmt = $this->con->prepare($sql);
            $data = [
                'nombre' => $usuario->getNombre(),
                'email' => $usuario->getEmail(),
                'contrasena' => password_hash($usuario->getContrasena(), PASSWORD_BCRYPT), // Encriptar la contraseña
                'rol_id' => $usuario->getRolId(),
                'id' => $usuario->getId()
            ];
            $stmt->execute($data);

            $this->con->commit();
            return true;
        } catch (Exception $e) {
            $this->con->rollBack();
            throw $e;
        }
    }

    // Método para eliminar un usuario por ID
    public function delete($id) {
        try {
            $this->con->beginTransaction();

            $sql = "DELETE FROM Usuarios WHERE id = :id";
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
