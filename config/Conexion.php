<?php
class Conexion {
    public static function getConexion() {
        $dsn = 'mysql:host=sql203.infinityfree.com;dbname='.DBNAME;
        $conexion = null;
        try {
            $conexion = new PDO($dsn, DBUSER, DBPASSWORD);
             $conexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (Exception $e) {
            echo $e;
            die("error " . $e->getMessage());
        }      
        return $conexion;
    }
}
