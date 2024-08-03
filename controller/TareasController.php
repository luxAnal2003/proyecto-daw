<?php

require_once 'model/dao/TareasDAO.php';
require_once 'model/dto/Tareas.php';

class TareasController {
    private $model;
    
    public function __construct() {
        $this->model = new TareasDAO();
    }

    public function index() { 
        $resultados = $this->model->selectAll("");
        $titulo = "Buscar Tareas";
        require_once VTAREAS.'list.php';  
    }

    public function search(){
        $parametro = (!empty($_POST["b"])) ? htmlentities($_POST["b"]) : "";
        $resultados = $this->model->selectAll($parametro);
        $titulo = "Buscar Tareas";
        require_once VTAREAS.'list.php';
    }

    public function view_new(){
        $titulo = "Nueva Tarea";
        require_once VTAREAS.'nuevo.php';
    }

    public function new() {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            if (empty($_POST['nombre'])) { 
                header('Location: index.php?c=tareas&f=index');
            }
            
            $tareas = new Tareas();
            $tareas->setNombre(htmlentities($_POST['nombre']));
            $tareas->setDescripcion(htmlentities($_POST['descripcion']));
            $tareas->setTiempoEstimado(htmlentities($_POST['tiempo_estimado']));
            $tareas->setPrioridad(htmlentities($_POST['prioridad']));
            $tareas->setProyectoId(htmlentities($_POST['proyecto_id']));
            $estado = (isset($_POST['estado'])) ? 'completada' : 'pendiente';
            $tareas->setEstado($estado);
    
            $exito = $this->model->insert($tareas);
    
            $msj = 'Tarea guardada exitosamente';
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
    
            header('Location: index.php?c=tareas&f=index');
        }
    }

    public function delete() {
        $tareas = new Tareas();
        $id = htmlentities($_REQUEST['id']);
        $tareas->setId($id);
  
        $exito = $this->model->delete($tareas);
        $msj = 'Tarea eliminada exitosamente';
        $color = 'primary';
        if (!$exito) {
            $msj = "No se pudo eliminar la tarea";
            $color = "danger";
        }
        if (!isset($_SESSION)) {
            session_start();
        }
        $_SESSION['mensaje'] = $msj;
        $_SESSION['color'] = $color;
        header('Location: index.php?c=tareas&f=index');
    }

    public function view_edit() {
        $id = htmlentities($_GET['id']);
        $tareasDAO = new TareasDAO();
        $tareas = $tareasDAO->selectAll(''); // Pasa un parámetro vacío si no tienes un parámetro específico
        $titulo = "Editar Tarea";
        require_once VTAREAS . 'edit.php';
    }
    
    public function edit() {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $tareas = new Tareas();
            $tareas->setId(htmlentities($_POST['id']));
            $tareas->setNombre(htmlentities($_POST['nombre']));
            $tareas->setDescripcion(htmlentities($_POST['descripcion']));
            $tareas->setTiempoEstimado(htmlentities($_POST['tiempo_estimado']));
            $tareas->setPrioridad(htmlentities($_POST['prioridad']));
            $tareas->setProyectoId(htmlentities($_POST['proyecto_id']));
            $estado = (isset($_POST['estado'])) ? 1 : 0;
            $tareas->setEstado($estado);
    
            $exito = $this->model->update($tareas);
            $msj = 'Tarea actualizada exitosamente';
            $color = 'primary';
            if (!$exito) {
                $msj = "No se pudo realizar la actualización";
                $color = "danger";
            }
            if (!isset($_SESSION)) {
                session_start();
            }
            $_SESSION['mensaje'] = $msj;
            $_SESSION['color'] = $color;
            header('Location: index.php?c=tareas&f=index');
        }
    }
}
?>
