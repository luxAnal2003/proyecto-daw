<?php
class IndexController {  

    public function index(){
        if(!empty($_GET['p'])){
            $page =  $_GET['p']; // limpiar datos
            // flujo de ventanas
            require_once HEADER;
            require_once 'view/estaticas/'.$page.'.php';
            require_once FOOTER;
        }else{
              // flujo de ventanas
          require_once 'view/homeView.php'; //mostrando la vista de home de la aplicacion
         
        }
    }
 
    
}
?>

