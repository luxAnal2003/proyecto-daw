<?php
require_once 'model/dao/AsignacionesDAO.php';
require_once 'model/dto/Asignaciones.php';
require_once 'model/dao/TareasDAO.php';
require_once 'model/dao/UsuariosDAO.php';
require_once 'model/dao/ProyectosDAO.php';
date_default_timezone_set('America/Guayaquil');


class AsignacionesController {
    private $model;
    
    public function __construct() {
        $this->model = new AsignacionesDAO();
    }

    // funciones del controlador
    public function index() { 
      //comunica con el modelo (enviar datos u obtener datos)
      $resultados = $this->model->selectAll("");
      // comunicarnos a la vista
      $titulo="Buscar asignaciones";
      require_once VASIGNACIONES.'list.php';
    }

    public function search() {
        // lectura de parámetros enviados
        $parametro = (!empty($_POST["b"])) ? htmlentities($_POST["b"]) : "";
        // comunica con el modelo (enviar datos o obtener datos)
        $resultados = $this->model->selectAll($parametro);
        // comunicarnos a la vista
        $titulo = "Buscar asignaciones";
        require_once VASIGNACIONES.'list.php';
    }

    // muestra el formulario de nueva asignación
    public function view_new() {
        $modeloProyectos = new ProyectosDAO();
        $proyectos = $modeloProyectos->selectAll("");
    
        $modeloTareas = new TareasDAO();
        $modeloUsuarios = new UsuariosDAO();
        
        $proyecto_id = isset($_POST['proyecto']) ? $_POST['proyecto'] : '';
    
        if (!empty($proyecto_id)) {
            $tareas = $modeloTareas->selectAll($proyecto_id);
        } else {
            $tareas = [];
        }
    
        $usuarios = $modeloUsuarios->selectEmpleados("");
        
        $titulo = "Nueva asignación";
        require_once VASIGNACIONES.'nuevo.php';
    }

    public function getTareasPorProyecto() {
        $proyectoId = isset($_POST['proyecto_id']) ? intval($_POST['proyecto_id']) : 0;
        if ($proyectoId > 0) {
            $modeloTareas = new TareasDAO();
            $tareas = $modeloTareas->selectByProyecto($proyectoId); // Obtener tareas por proyecto

            // Devuelve las tareas como JSON
            echo json_encode($tareas);
        } else {
            echo json_encode([]);
        }
    }

    // lee datos del formulario de nueva asignación y lo inserta en la BDD (llamando al modelo)
    public function new() {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') { // Insertar la asignación
            // Considerar verificaciones
            if (empty($_POST['tarea']) || empty($_POST['usuario']) || empty($_POST['proyecto'])) {
                $_SESSION["mensaje"] = "Datos del formulario incompletos";
                header('Location:index.php?c=Asignaciones&f=index');
                exit();
            }
    
            $asignacion = new Asignaciones(); // DTO
            // Lectura de parámetros
            $asignacion->setTareaId(htmlentities($_POST['tarea']));
            $asignacion->setUsuarioId(htmlentities($_POST['usuario']));
            $asignacion->setProyectoId(htmlentities($_POST['proyecto']));
            $asignacion->setGestorId($_SESSION['usuario_id']); // Asegúrate de que el ID del gestor esté en la sesión
            $estado = (isset($_POST['estado'])) ? htmlentities($_POST['estado']) : 'pendiente';
            $asignacion->setEstado($estado);
            $fechaActual = new DateTime('NOW');
            $asignacion->setFechaAsignacion($fechaActual->format('Y-m-d H:i:s'));
    
            // Comunicar con el modelo
            $exito = $this->model->insert($asignacion);
    
            $msj = 'Asignación guardada exitosamente';
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
            header('Location:index.php?c=Asignaciones&f=index'); // Redireccionamiento
            exit();
        }
    }
    


    public function delete() {
        // verificar datos -- si es que viene el parámetro id
        // leer parámetros
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
        // llamar a la vista
        header('Location:index.php?c=Asignaciones&f=index');
    }
    

    // muestra el formulario de editar asignación
    public function view_edit() {
        $id = $_GET['id']; // Verificar y limpiar
        $asignacion = $this->model->selectOne($id);

        // Verifica que la asignación existe
        if (!$asignacion) {
            $_SESSION['mensaje'] = "Asignación no encontrada";
            $_SESSION['color'] = "danger";
            header('Location:index.php?c=asignaciones&f=index');
            exit();
        }
        // Obtener usuarios para el select
        $usuariosDAO = new UsuariosDAO();
        $usuarios = $usuariosDAO->selectEmpleados();

        $titulo = "Editar Asignación";
        require_once VASIGNACIONES.'edit.php';
    }
    
    // lee datos del formulario de editar asignación y lo actualiza en la BDD (llamando al modelo)
    public function edit() {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $asignacion = new Asignaciones();
            $asignacion->setId(htmlentities($_POST['id']));
            $asignacion->setTareaId(htmlentities($_POST['tarea_id']));
            $asignacion->setUsuarioId(htmlentities($_POST['usuario_id']));

            $exito = $this->model->update($asignacion);
            
            $msj = 'Asignación actualizada exitosamente';
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
            
            header('Location:index.php?c=asignaciones&f=index');
        }
    }
}