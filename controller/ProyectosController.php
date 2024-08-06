<?php
//autor: Espinoza Vergara Miguel Ángel 
require_once 'model/dao/ProyectosDAO.php';
require_once 'model/dto/Proyectos.php';

class ProyectosController {
    private $model;

    public function __construct() {
        $this->model = new ProyectosDAO();
    }

    // Muestra la lista de proyectos
    public function index() {
        $resultados = $this->model->selectAll("");
        $titulo = "Lista de Proyectos";
        require_once VPROYECTOS.'list.php';
    }

    public function home(){
        $resultados = $this->model->selectAllHome();
        return $resultados;
    }

    public function search(){
        $parametro = (!empty($_POST["b"])) ? htmlentities($_POST["b"]) : "";
        $resultados = $this->model->selectAll($parametro);
        $titulo = "Buscar Proyectos";
        require_once VPROYECTOS.'list.php';
    }

    // Muestra el formulario para crear un nuevo proyecto
    public function view_new() {
        $titulo = "Nuevo Proyecto";
        require_once VPROYECTOS.'nuevo.php';
    }

    // Crea un nuevo proyecto
    public function new() {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            if (empty($_POST['nombre'])) {
                $_SESSION["mensaje"] = "Nombre del proyecto es requerido";
                header('Location:index.php?c=Proyectos&f=index');
                exit();
            }
            $proyecto = new Proyecto();
            $proyecto->setNombre(htmlentities($_POST['nombre']));
            $proyecto->setDescripcion(htmlentities($_POST['descripcion'])); // Agregar descripción
            $proyecto->setUsuarioCreacion($_SESSION['usuario_id']); // Agregar ID de usuario de la sesión

            $exito = $this->model->insert($proyecto);

            $msj = $exito ? 'Proyecto creado exitosamente' : 'No se pudo crear el proyecto';
            $color = $exito ? 'primary' : 'danger';
            $_SESSION['mensaje'] = $msj;
            $_SESSION['color'] = $color;
            header('Location:index.php?c=Proyectos&f=index');
        }
    }

    // Muestra el formulario para editar un proyecto
    public function view_edit() {
        $id = isset($_GET['id']) ? $_GET['id'] : 0;
        if ($id <= 0) {
            $_SESSION['mensaje'] = 'ID inválido para editar el proyecto.';
            $_SESSION['color'] = 'danger';
            header('Location:index.php?c=Proyectos&f=index');
            exit();
        }
        $proyecto = $this->model->selectOne($id);
        if (!$proyecto) {
            $_SESSION['mensaje'] = 'Proyecto no encontrado.';
            $_SESSION['color'] = 'danger';
            header('Location:index.php?c=Proyectos&f=index');
            exit();
        }
        $titulo = "Editar Proyecto";
        require_once VPROYECTOS.'edit.php';
    }

    // Actualiza un proyecto existente
    public function edit() {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            if (!isset($_POST['id']) || empty($_POST['nombre'])) {
                header('Location:index.php?c=Proyectos&f=index');
                exit();
            }
            $proyecto = new Proyecto();
            $proyecto->setId(htmlentities($_POST['id']));
            $proyecto->setNombre(htmlentities($_POST['nombre']));
            $proyecto->setDescripcion(htmlentities($_POST['descripcion']));

            $exito = $this->model->update($proyecto);

            $msj = $exito ? 'Proyecto actualizado exitosamente' : 'No se pudo actualizar el proyecto';
            $color = $exito ? 'primary' : 'danger';
            $_SESSION['mensaje'] = $msj;
            $_SESSION['color'] = $color;
            header('Location:index.php?c=Proyectos&f=index');
        }
    }

    // Elimina un proyecto
    public function delete() {
        $id = htmlentities($_REQUEST['id']);
    
        // comunicando con el modelo
        $exito = $this->model->delete($id);
        $msj = 'Asignación eliminada exitosamente';
        $color = 'primary';
        if (!$exito) {
            $msj = "No se pudo eliminar la asignación";
            $color = "danger";
        }
        if (!isset($_SESSION)) {
            session_start();
        };
        $_SESSION['mensaje'] = $msj;
        $_SESSION['color'] = $color;
        header('Location:index.php?c=Proyectos&f=index');
    }
}
?>
