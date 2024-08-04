<?php
require_once 'ProyectosController.php';
require_once 'TareasController.php';
require_once 'AsignacionesController.php';
class IndexController {  

    public function index(){
        session_start();
        if(!empty($_GET['p'])){
            $page =  $_GET['p']; // limpiar datos
            // flujo de ventanas
            require_once HEADER;
            require_once 'view/estaticas/'.$page.'.php';
            require_once FOOTER;
        }else{
            // Verificar si el usuario está logueado y es un gestor (rol_id = 2)
            if(isset($_SESSION['usuario_rol'])){
                if ($_SESSION['usuario_rol'] == 2){//si es gestor
                    // flujo de ventanas
                    $proyectosController = new ProyectosController();
                    $resultados = $proyectosController->home();

                    $tareasController = new TareasController();
                    $tareas = $tareasController->home();
                    require_once 'view/homeViewGestor.php';
                } else if($_SESSION['usuario_rol'] == 1){//si es admin
                    require_once 'view/homeViewAdministrador.php';
                }else if($_SESSION['usuario_rol'] == 3){//si es empleado
                    $asignacionesController = new AsignacionesController();
                    $asignaciones = $asignacionesController->tareasPorUsuario();
                    require_once 'view/homeViewEmpleado.php';
                }else{
                    require_once 'view/homeView.php';
                }
            } else {
                // Si no esta logueado
                require_once 'view/homeView.php'; 
            }
        }
    }
    
    public function logout() {
        session_start();
        session_destroy();
        unset($_SESSION['usuario_nombre']);
        unset($_SESSION['usuario_rol']);
        header('Location: index.php');
        exit;
    }
    
}
?>

