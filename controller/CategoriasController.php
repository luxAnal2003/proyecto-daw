<?php
require_once 'model/dao/CategoriasDAO.php';
require_once 'model/dto/Categoria.php';

class CategoriasController {

    private $model;
    
    public function __construct() {// constructor
        $this->model = new CategoriasDAO();
    }

    // funciones del controlador
    public function index() {
        echo "completar aqui";
        // comunicar con mode lo

        // comunicar con vista
          
    }


}