<?php
require_once 'config/Conexion.php';
//dao: data access object
class CategoriasDAO {
     private $con;

    public function __construct() {
        $this->con = Conexion::getConexion();
    }
     public function selectAll() {
        // sql de la sentencia
        $sql = "select * from categoria where cat_estado=1";
        //preparacion de la sentencia
        $stmt = $this->con->prepare($sql);
        //ejecucion de la sentencia
        $stmt->execute();
        //recuperacion de resultados
        $resultados = $stmt->fetchAll(PDO::FETCH_OBJ);
        // retorna cada fila como un objeto de una clase anonima
        // cuyos nombres de atributos son iguales a los nombres de las columnas retornadas
        // retorna datos para el controlador
        return $resultados;
    }
    
    public function selectAllxParam($parametro) {


    }

    public function insert($cat){


    }
    public function update($cat){


    }

}
