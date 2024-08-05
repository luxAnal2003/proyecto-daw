<?php
require_once 'C:/xampp/htdocs/MVC/model/dao/ListaDAO.php';
require_once 'C:/xampp/htdocs/MVC/model/dto/Lista.php';

class ListaController {
    private $model;
    
    public function __construct() {
        $this->model = new ListaDAO();
    }

    public function index() {
        $listas = Lista::all();
        require __DIR__ . '/../view/listas/tablero.php';
    }

    public function create() {
        require '../view/listas/lista.create.php';
    }
    
    public function store() {
        // Validar y sanitizar datos del formulario
        $nombre = $_POST['nombre'];
        $descripcion = $_POST['descripcion'];
        $tipo = $_POST['tipo'];
        $prioridad = $_POST['prioridad'];
        $estado = $_POST['estado'];

        // Crear nueva lista
        Lista::create($nombre, $descripcion, $tipo, $prioridad, $estado);

        // Redirigir al listado
        header('Location: tablero.php?action=index');
        exit();
    }

    public function edit($id) {
        $lista = Lista::find($id);
        require '../view/listas/lista.edit.php';
    }

    public function update($id) {
        $nombre = $_POST['nombre'];
        $descripcion = $_POST['descripcion'];
        $tipo = $_POST['tipo'];
        $prioridad = $_POST['prioridad'];
        $estado = $_POST['estado'];

        $lista = new Lista($id, $nombre, $descripcion, $tipo, $prioridad, $estado);
        Lista::update($lista);

        header('Location: /tablero.php');
    }

    public function destroy($id) {
        Lista::delete($id);
        header('Location: /tablero.php');
    }
}
