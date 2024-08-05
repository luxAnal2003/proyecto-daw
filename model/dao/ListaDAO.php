<?php 
require_once __DIR__ . '/../../config.php';
require_once __DIR__ . '/../dto/Lista.php';

class Lista{
    private $con;

    public function __construct() {
        $this->con = Conexion::getConexion();
    }

    public static function all(){
        global $pdo;
        $stmt = $pdo->query("SELECT * FROM listas");
        $listas=[];
        while($row=$stmt->fetch(PDO::FETCH_ASSOC)){
            $listas[]=new Lista(
                $row['id'],
                $row['nombre'],
                $row['descripcion'],
                $row['tipo'],
                $row['prioridad'],
                $row['estado'],
                $row['fecha_creacion']
            );
        }
        return $listas;
    }

    public static function find($id){
       global $pdo;
       $stmt = $pdo->prepare("SELECT * FROM listas WHERE id = ?");
       $stmt->execute([$id]);
       $row = $stmt->fetch(PDO::FETCH_ASSOC);
       if($row){
        return new Lista(
            $row['id'],
            $row['nombre'],
            $row['descripcion'],
            $row['tipo'],
            $row['prioridad'],
            $row['estado'],
            $row['fecha_creacion']
        );
       }
       return null;
    }

    public static function create($nombre, $descripcion, $tipo, $prioridad, $estado){
        global $pdo;
        $stmt= $pdo->prepare("INSERT INTO listas (nombre, descripcion, tipo, prioridad, estado) VALUES (?, ?, ?, ?, ?)");
        $stmt->execute([$nombre, $descripcion, $tipo, $prioridad, $estado]);

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