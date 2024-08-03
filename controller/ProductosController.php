<?php
require_once 'model/dao/ProductosDAO.php';
require_once 'model/dao/CategoriasDAO.php';
require_once 'model/dto/Producto.php';

class ProductosController {
    private $model;
    
    public function __construct() {// constructor
        $this->model = new ProductosDAO();
    }

    // funciones del controlador
    public function index() { 
      //comunica con el modelo (enviar datos u obtener datos)
      $resultados = $this->model->selectAll("");
      // comunicarnos a la vista
      $titulo="Buscar productos";
      require_once VPRODUCTOS.'list.php';  
    }

    public function search(){
        
      // lectura de parametros enviados
      $parametro = (!empty($_POST["b"]))?htmlentities($_POST["b"]):"";
     //comunica con el modelo (enviar datos o obtener datos)
      $resultados = $this->model->selectAll($parametro);
     // comunicarnos a la vista
     $titulo="Buscar productos";
     require_once VPRODUCTOS.'list.php';
    }

    // muestra el formulario de nuevo producto
    public function view_new(){
          //comunicarse con el modelo
         $modeloCat = new CategoriasDAO();
       $categorias = $modeloCat->selectAll();

          // comunicarse con la vista
          $titulo="Nuevo producto";
          require_once VPRODUCTOS.'nuevo.php';

    }

    // lee datos del formulario de nuevo producto y lo inserta en la bdd (llamando al modelo)
    public function new() {
      //cuando la solicitud es por post
      if ($_SERVER['REQUEST_METHOD'] == 'POST') {// insertar el producto
          // considerar verificaciones
          if(empty($_POST['nombre'])){   
            $_SESSION["mensaje"]="Datos del formulario incompletos";
            header('Location:index.php?c=Productos&f=index'); 
          }
          $prod = new Producto(); // dto
          // lectura de parametros
          $prod->setNombre(htmlentities($_POST['nombre']));
          $prod->setDescripcion(htmlentities($_POST['descripcion']));
          $prod->setPrecio(htmlentities($_POST['precio']));
          $prod->setIdCategoria(htmlentities($_POST['categoria']));
          $estado = (isset($_POST['estado'])) ? 1 : 0; // ejemplo de dato no obligatorio
          $prod->setEstado($estado);
          $prod->setUsuario('usuario'); //$_SESSION['usuario'];
          $fechaActual = new DateTime('NOW');
          $prod->setFechaActualizacion($fechaActual->format('Y-m-d H:i:s'));
        

          //comunicar con el modelo
          $exito = $this->model->insert($prod);

          $msj = 'Producto guardado exitosamente';
          $color = 'primary';
          if (!$exito) {
              $msj = "No se pudo realizar el guardado";
              $color = "danger";
          }
          if (!isset($_SESSION)) {
              session_start();
          };
          $_SESSION['mensaje'] = $msj;
          $_SESSION['color'] = $color;
          //llamar a la vista
         header('Location:index.php?c=Productos&f=index');// redireccionamiento


      } 
  }
  
  public function delete(){
    //verificar datos---- si es que viene el parametro id
      //leeer parametros
     $prod = new Producto();
     $prod->setId(htmlentities($_REQUEST['id']));
     $prod->setUsuario('usuario'); //$_SESSION['usuario'];
     $fechaActual = new DateTime('NOW');
     $prod->setFechaActualizacion($fechaActual->format('Y-m-d H:i:s'));
           
         //comunicando con el modelo
         $exito = $this->model->delete($prod);
        $msj = 'Producto eliminado exitosamente';
            $color = 'primary';
            if (!$exito) {
                $msj = "No se pudo eliminar la actualizacion";
                $color = "danger";
            }
             if(!isset($_SESSION)){ session_start();};
            $_SESSION['mensaje'] = $msj;
            $_SESSION['color'] = $color;
        //llamar a la vista
          header('Location:index.php?c=productos&f=index');
  }


   // muestra el formulario de editar producto
   public function view_edit(){
     //leer parametro
     $id= $_GET['id']; // verificar, limpiar
     //comunicarse con el modelo de productos
    $prod = $this->model->selectOne($id);
    //comunicarse con el modelo de categorias
    $modeloCat = new CategoriasDAO();
    $categorias = $modeloCat->selectAll();

    // comunicarse con la vista
    $titulo="Editar producto";
    require_once VPRODUCTOS.'edit.php';

  }

   // lee datos del formulario de editar producto y lo actualiza en la bdd (llamando al modelo)
   public function edit(){
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {// actualizar
      // verificaciones
             //if(!isset($_POST['codigo'])){ header('');}
          // leer parametros
          $prod = new Producto();
          $prod->setId(htmlentities($_POST['id']));
          $prod->setNombre(htmlentities($_POST['nombre']));
          $prod->setNombre(htmlentities($_POST['descripcion']));
          $prod->setPrecio(htmlentities($_POST['precio']));
          $prod->setIdCategoria(htmlentities($_POST['categoria']));
          $estado = (isset($_POST['estado'])) ? 1 : 0; // un dato no requerido
          $prod->setEstado($estado);
          $prod->setUsuario('usuario'); //$_SESSION['usuario'];
          $fechaActual = new DateTime('NOW');
          $prod->setFechaActualizacion($fechaActual->format('Y-m-d H:i:s'));
        
          //llamar al modelo
          $exito = $this->model->update($prod);
          
          $msj = 'Producto actualizado exitosamente';
          $color = 'primary';
          if (!$exito) {
              $msj = "No se pudo realizar la actualizacion";
              $color = "danger";
          }
           if(!isset($_SESSION)){ session_start();};
          $_SESSION['mensaje'] = $msj;
          $_SESSION['color'] = $color;
      //llamar a la vista
     header('Location:index.php?c=productos&f=index');
         
      } 
   }
}
