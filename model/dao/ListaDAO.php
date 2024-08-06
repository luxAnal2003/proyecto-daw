<?php 
//autor: Ramírez Avilés Sebastián Emilio 
require_once 'config/Conexion.php';
require_once 'model/dto/Lista.php';

class ListaDAO{
    private $con;

    public function __construct() {
        $this->con = Conexion::getConexion();
    }

    public function all() {
        // SQL de la sentencia
        $sql = "SELECT * FROM listas";
        $stmt = $this->con->prepare($sql);
        // Ejecutar la sentencia
        $stmt->execute();
        // Recuperar resultados
        $lista = $stmt->fetchAll(PDO::FETCH_ASSOC);
        // Retornar resultados
        return $lista;
    }

    public function selectOne($parametro) {
        $sql = "SELECT * FROM listas 
                WHERE nombre LIKE :parametro 
                OR descripcion LIKE :parametro 
                OR tipo LIKE :parametro 
                OR prioridad LIKE :parametro 
                OR estado LIKE :parametro";
        $stmt = $this->con->prepare($sql);
        $parametro = "%$parametro%";
        $stmt->bindParam(":parametro", $parametro);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // Inserta una nueva lista
    public function insert($lista) {
        $sql = "INSERT INTO listas (nombre, descripcion, tipo, prioridad, estado) 
                VALUES (:nombre, :descripcion, :tipo, :prioridad, :estado)";
        $stmt = $this->con->prepare($sql);
        $data = [
            'nombre' => $lista->getNombre(),
            'descripcion' => $lista->getDescripcion(),
            'tipo' => $lista->getTipo(),
            'prioridad' => $lista->getPrioridad(),
            'estado' => $_POST['estado']
        ];
        return $stmt->execute($data);
    }

    public static function update(Lista $lista){
        global $pdo;
        $stmt = $pdo->prepare("UPDATE listas SET nombre = ?, descripcion = ?, prioridad = ?, estado = ? WHERE id = ?");
        $stmt->execute([
            $lista->getNombre(), 
            $lista->getDescripcion(),
            $lista->getTipo(), 
            $lista->getPrioridad(), 
            $lista->getEstado(), 
            $lista->getId()
        ]);
    }

    public static function delete($id){
      global $pdo;
      $stmt = $pdo->prepare("DELETE FROM listas WHERE id = ?");
      $stmt->execute([$id]);
    }
}