<?php
//autor: Ramírez Avilés Sebastián Emilio
require_once 'model/dao/ListaDAO.php';
require_once 'model/dto/Lista.php';

class ListaController {
    private $model;
    
    public function __construct() {
        $this->model = new ListaDAO();
    }

    public function index() {
        $listas = $this->model->all("");
        $titulo="Buscar listas";
        require  VLISTAS.'list.php';
    }

    public function create() {
        $titulo="Crear una nueva lista";
        require  VLISTAS.'create.php';
    }
    
    public function store() {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') { // Insertar la lista
            // Validar datos del formulario
            if (empty($_POST['nombre']) || empty($_POST['descripcion']) || empty($_POST['tipo']) || empty($_POST['prioridad']) || empty($_POST['estado'])) {
                $_SESSION["mensaje"] = "Datos del formulario incompletos";
                header('Location:index.php?c=Lista&f=index');
                exit();
            }
    
            $lista = new Lista(); // DTO
            // Lectura de parámetros
            $lista->setNombre(htmlentities($_POST['nombre']));
            $lista->setDescripcion(htmlentities($_POST['descripcion']));
            $lista->setTipo(htmlentities($_POST['tipo']));
            $lista->setPrioridad(htmlentities($_POST['prioridad']));
            $estadosPermitidos = ['Nuevo', 'En Progreso', 'Completo'];
            $estado = htmlentities($_POST['estado']);

            if (!in_array($estado, $estadosPermitidos)) {
                $_SESSION["mensaje"] = "Estado inválido";
                header('Location:tablero.php?action=index');
                exit();
            }

            $lista->setEstado($estado);
    
            // Comunicar con el modelo
            $exito = $this->model->insert($lista);
    
            $msj = 'Lista guardada exitosamente';
            $color = 'primary';
            if (!$exito) {
                $msj = "No se pudo realizar el guardado";
                $color = "danger";
            }
            if (!isset($_SESSION)) {
                session_start();
            }
            $_SESSION['mensaje'] = $msj;
            $_SESSION['color'] = $color;
            // Llamar a la vista
            header('Location: index.php?c=Lista&f=index'); // Redireccionamiento
            exit();
        }
    }

    public function search() {
        // Leer el parámetro de búsqueda enviado por el formulario
        $parametro = (!empty($_POST["b"])) ? htmlentities($_POST["b"]) : "";
        
        // Comunicar con el modelo
        $listas = $this->model->selectOne($parametro);
        
        // Llamar a la vista con los resultados
        $titulo = "Buscar listas";
        require_once VLISTAS . 'list.php';
    }

    public function destroy($id) {
        Lista::delete($id);
        header('Location: /tablero.php');
    }
    
    public function view_edit() {
        $id = $_GET['id'];
        $lista = $this->model->selectOne($id);
        if ($lista) {
            $_SESSION['mensaje'] = "Lista no encontrada";
            $_SESSION['color'] = "danger";
            var_dump ($lista);
            //header('Location:index.php?c=lista&f=index');
            exit();
        }
        $titulo = "Editar Lista";
        require_once VLISTAS.'edit.php';
    }
    
    public function edit() {
        $id = $_POST['id'];
        $nombre = $_POST['nombre'];
        $descripcion = $_POST['descripcion'];
        $tipo = $_POST['tipo'];
        $prioridad = $_POST['prioridad'];
        $estado = $_POST['estado'];
    
        $lista = new Lista();
        $lista->setId($id);
        $lista->setNombre($nombre);
        $lista->setDescripcion($descripcion);
        $lista->setTipo($tipo);
        $lista->setPrioridad($prioridad);
        $lista->setEstado($estado);
    
        $resultado = $this->model->update($lista);
    
        if ($resultado) {
            $msj = 'Lista actualizada exitosamente';
            $color = 'primary';
            header('Location:index.php?c=Lista&f=index');
        } else {
            $msj = "No se pudo realizar la actualización";
            $color = "danger";
        }
        exit();
    }


}
