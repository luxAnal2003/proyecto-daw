<?php
require_once 'ProyectosController.php';
require_once 'TareasController.php';
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
                if($_SESSION['usuario_rol'] == 2){
                    // flujo de ventanas
                    $proyectosController = new ProyectosController();
                    $resultados = $proyectosController->home();

                    $tareasController = new TareasController();
                    $tareas = $tareasController->home();
                    require_once 'view/homeViewGestor.php'; //mostrando la vista de home de la aplicacion
                }
            } else {
                // Si no es un gestor
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

