<?php require_once HEADER; ?>
<style>
    .container {
        font-family: 'Arial', sans-serif;
        margin-top: 30px;
        margin-bottom: 30px;
    }
        #sectionDerecha {
        display: flex;
        flex-direction: column;
        background-color: #E7ECEF;
        margin-left: 1%;
        width: 50%;
        padding: 20px;
        border-radius: 5px;
        }

        #sectionDerecha h2 {
            font-size: 24px;
            margin-bottom: 10px;
        }

        #sectionDerecha h3 {
            font-size: 20px;
            margin-bottom: 10px;
        }

        #sectionDerecha p {
            font-size: 16px;
            margin-bottom: 20px;
        }

        #fondo1 {
            background-image: url("img/imagenFondo1.jpg");
        }

        #fondo2 {
            background-image: url("img/imagenFondo2.jpg");
        }

        #fondo3 {
            background-image: url("img/imagenFondo3.jpg");
        }
        
        .plantillas {
            display: flex;
            gap: 10px;
        }

        .plantilla {
            background-color:#6096BA;
            width: 350px;
            height: 150px;
            display: flex;
            align-items: center;
            justify-content: center;
            border-radius: 5px;
            font-size: 16px;
            color: white;
            background-position: center top;
            background-size: cover;
        }
        .plantilla:hover {
            background-color: #A3CEF1;
            transition: 0.1s;
        }

        .plantillaDeshabilitada {
            background-color: #ccc;
            width: 350px;
            height: 150px;
            display: flex;
            align-items: center;
            justify-content: center;
            border-radius: 5px;
            font-size: 16px;
            color: white;
        }

        .plantillaDeshabilitada:hover {
            background-color: #8B8B89;
            transition: 0.1s;
        }
    </style>
<div class="container">
    <h2>Tablero</h2>
    <h3>Tableros más populares</h3>
    <form id="formPlantilla" style="margin-bottom: 15px;">
        <label>Empezar más rápido con una <i>plantilla de la comunidad</i>  o</label>
        <select name="categoria" id="categoria">
            <option value="0">Seleccione..</option>
            <option value="diseño">Diseño</option>
            <option value="educacion">Educación</option>
            <option value="ingenieria_informatica">Ingeniería informática</option>
        </select>
        <button id="buscar"><img src="assets/img/lupa.png" alt="buscar" style="width: 10px;height: 10px;" onclick="crearPlantilla()"> Buscar</button>
    </form>
    <div class="plantillas" id="fondoSeleccionar">
        <div class="plantilla" id="fondo1">Gestion de Proyectos</div>
        <div class="plantilla" id="fondo2">Plantilla kanban</div>
        <div class="plantilla" id="fondo3">Tablero de Proyecto Simple</div>
    </div>
    <div>
        <h3>Proyectos que gestiona</h3>//colocar todos los proyectos que maneja
        <div class="plantillas">
            <div class="plantilla">Mi primer tablero</div>
            <div class="plantilla">Educacion en casa</div>
            <div class="plantillaDeshabilitada"><a href="tableros.html">Crear nuevo tablero</a></div>
        </div>
    </div>
    <div>
        <h3>Tareas asignadas</h3>
        <div class="plantillas">
            <div class= "plantillaDeshabilitada"><a href="index.php?c=Tareas&f=view_new" class="">Añadir una tarea a un proyecto</a></div>
        </div>
    </div>        
</div>
<?php require_once FOOTER; ?>
