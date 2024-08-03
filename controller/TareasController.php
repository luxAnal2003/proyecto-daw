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
        // Cuando la solicitud es por POST
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            // Considerar verificaciones
            if (empty($_POST['nombre'])) { 
                header('Location: index.php?c=tareas&f=index');
            }
            
            $tareas = new Tareas(); // DTO
            
            // Lectura de parámetros
            $tareas->setNombre(htmlentities($_POST['nombre']));
            $tareas->setDescripcion(htmlentities($_POST['descripcion']));
            
            $estado = (isset($_POST['estado'])) ? 1 : 0; // Ejemplo de dato no obligatorio
            $tareas->setEstado($estado);
    
            $tareas->setPrioridad(htmlentities($_POST['prioridad']));
            $tareas->setTiempoEstimado(htmlentities($_POST['tiempo']));
    
            // Comunicar con el modelo
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
    
            // Llamar a la vista
            header('Location: index.php?c=tareas&f=index');
        }
    }
    
    public function delete() {
        // Leer parámetros
        $tareas = new Tareas();
        $id = htmlentities($_REQUEST['id']);
        $tareas->setId($id);
    
        // Comunicando con el modelo
        $exito = $this->model->delete($tareas);
        $msj = 'Tarea eliminada exitosamente';
        $color = 'primary';
        if (!$exito) {
            $msj = "No se pudo eliminar la tarea";
            $color = "danger";
        }
        if (!isset($_SESSION)) { session_start(); };
        $_SESSION['mensaje'] = $msj;
        $_SESSION['color'] = $color;
        // Llamar a la vista
        header('Location: index.php?c=tareas&f=index');
    }

     // muestra el formulario de editar producto
    public function view_edit(){
        //leer parametro
        $id= $_GET['id']; // verificar, limpiar
        //comunicarse con el modelo de productos
        $tareas = $this->model->selectOne($id);
    
        // comunicarse con la vista
        $titulo="Editar Tarea";
        require_once VTAREAS.'edit.php';
    }
  
    public function edit(){
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            // Leer parámetros
            $tareas = new tareas();
            $tareas->setId(htmlentities($_POST['id']));
            $tareas->setNombre(htmlentities($_POST['nombre']));
            $tareas->setDescripcion(htmlentities($_POST['descripcion']));
            
            $estado = (isset($_POST['estado'])) ? 1 : 0; 
            $tareas->setEstado($estado);
    
            $tareas->setPrioridad(htmlentities($_POST['prioridad']));
            $tareas->setEstimado(htmlentities($_POST['estimado']));
    
            // Llamar al modelo
            $exito = $this->model->update($tareas);
            
            $msj = 'Tarea actualizada exitosamente';
            $color = 'primary';
            if (!$exito) {
                $msj = "No se pudo realizar la actualización";
                $color = "danger";
            }
            if(!isset($_SESSION)){ session_start();};
            $_SESSION['mensaje'] = $msj;
            $_SESSION['color'] = $color;
    
            // Redirigir a la vista
            header('Location:index.php?c=tareas&f=index');
        } 
    }
}
  