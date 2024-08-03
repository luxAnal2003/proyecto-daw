<?php
class Conexion {
    public static function getConexion() {
         $dsn = 'mysql:host=localhost;port=3307;dbname=' . DBNAME;
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
