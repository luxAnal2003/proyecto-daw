    <?php
        require_once 'config/config.php';
        // leer parametros
        //con request se obtiene todo de get o post--ojo
        $controlador = (!empty($_REQUEST['c']))?htmlentities($_REQUEST['c']):CONTROLADOR_PRINCIPAL;
        // index
        //la primera letra la transforma en mayuscula
        //primero todo lo pone en minus y luego en mayuscula la primera letra
        $controlador = ucwords(strtolower($controlador))."Controller";
        //IndexController
        $funcion = (!empty($_REQUEST['f']))?htmlentities($_REQUEST['f']):FUNCION_PRINCIPAL;
        //f= index
        
        require_once 'controller/' . $controlador . '.php';
     
        if (isset($_GET['p']) && $_GET['p'] == 'logout') {
            $indexController = new IndexController();
            $indexController->logout();
        }
        
        $cont = new  $controlador();// creacion del objeto controlador 
        $cont->$funcion();// llamada a la funcion del controlador

?>