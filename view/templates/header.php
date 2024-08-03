<?php  
if (!isset($_SESSION))  session_start();
        
if(empty($_SESSION['user'])){ //simulacion manejo de variables de sesion
     // redireccionar al login
}
?>
<!-- parte inicial del documento-->
<!DOCTYPE html>
<html>
    <head>
        <!-- Required meta tags -->
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <!-- Bootstrap CSS -->  
        <link href="assets/css/bootstrap.min.css" rel="stylesheet">
        <link href="assets/css/styles.css" rel="stylesheet">       
        <!-- FONT AWESOME -->
        <link rel="stylesheet" 
        href="https://use.fontawesome.com/releases/v5.6.3/css/all.css" 
        integrity="sha384-UHRtZLI+pbxtHCWp1t77Bi1L4ZtiqrqD80Kn4Z8NTSRyMA2Fd33n5dQ8lWUE00s/" 
        crossorigin="anonymous">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Fira+Code:wght@300..700&display=swap" rel="stylesheet">


        <title>Product</title>
    </head> 
    <body>
        <nav class="barraNavegacion navbar navbar-expand-md navbar-dark fixed-top">
            <a class="navbar-brand" href="index.php">Mis tareas y proyectos</a>
            <ul class="navbar-nav mr-auto">
                <!--crear enlaces segùn perfil de usuario-->
                <li class="nav-item"><a class="nav-link" href="index.php">Home</a></li>
                <li class="nav-item"><a class="nav-link" href="index.php?c=index&f=index&p=nosotros">Nosotros</a></li>
                <li class="nav-item"><a class="nav-link" href="index.php?c=Tareas&f=index">Tareas</a></li>
                <li class="nav-item"><a class="nav-link" href="index.php?p=contacto">Contacto</a></li>
                <a class="nav-link" href="/mvc/view/plantillas/plantillas.php">Plantillas</a></li>
               
               <?php
                 if($_SESSION['usuario_rol']=2 ){ //si el rol es gestor, podra ver esta seccion?>
                    <li class="nav-item"><a class="nav-link" href="index.php?c=Asignaciones&f=index">Asignaciones</a></li>
                    <?php
                 }
                ?>
            </ul>  
            <ul class="navbar-nav ml-auto">
                <li class="nav-item my-auto"><span style="color:white">Usuario </span></li>
                <li class="nav-item"><a class="nav-link" href="index.php?c=index&f=index&p=login">Login</a></li>
            </ul>
        </nav>
        <h1 class="jumbotron text-center titNivel1">
            <i class="fab fa-shopify"></i>
            Gestor de Proyectos </h1>

        <?php
       
        if (!empty($_SESSION['mensaje'])) {
            ?>
            <div class="mt-2 alert alert-<?php echo $_SESSION['color']; ?>
             alert-dismissible fade show" role="alert">
                <?php echo $_SESSION['mensaje']; ?>  
            </div>
            <?php
            unset($_SESSION['mensaje']);
            unset($_SESSION['color']);
        }//end if 
        ?>
        