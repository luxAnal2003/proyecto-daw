
<?php require_once '../templates/header.php' ?>

    <style>
        /* Estilos por Eliud Robalino */
        .sectionDerecha {
            display: flex;
            flex-direction: column; 
            margin-left: 5%;
            width: 45%;
            align-items: center;
            padding: 10px; 
        }
        .categoriasDestacadas {
            background-color: #E7ECEF; 
            padding: 20px;
        }
        .contenidoCategoriaDestacadas {
            display: flex;
            justify-content: center; 
            align-items: center; 
        }
        .categoriasDestacadas figure {
            margin: 0 21px; 
            text-align: center; 
        }
        .categoriasDestacadas img {
            width: 40px;
            height: auto;
            cursor: pointer;
        }
        .Educacion {
            background-color: #E7ECEF;
            margin-top: 10px;
        }
        .Educacion h2 {
            padding-left: 20px;
        }
        .contenidoEducacion {
            display: flex;
            justify-content: space-between; 
        }
        .contenidoEducacion figure {
            text-align: center; 
            width: 200px; 
            margin: 5px; 
        }
        .contenidoEducacion img {
            width: 150px;
            height: 150px;
            cursor: pointer;
        }
        .contenidoEducacion p {
            font-style: italic;
            text-align: left;
            font-size: 12px;
            text-align: center;
        }
        .contenidoEducacion div {
            padding: 15px;
        }
        .contenidoEducacion figcaption {
            font-weight: bold;
        }
    </style>
    <script>
        function PlantillaLibros_encendido(enlace) {
            let img = document.querySelector("#LibrosapiladosEducacion");  
            img.src = "img/Plantilla_libro_funcion.png";
        }
        function PlantillaLibros_apagado(enlace) {
            let img = document.querySelector("#LibrosapiladosEducacion");
            img.src = "img/eduacionlibrosaplidados.jpg";
            img.style.border = "none";
        }
        function PlantillaMedicina_encendido(enlace) {
            let img = document.querySelector("#Medicina");  
            img.src = "img/Plantilla_Medicina_funcion.jpg";
        }
        function PlantillaMedicina_apagado(enlace) {
            let img = document.querySelector("#Medicina");
            img.src = "img/Educacionmedicina.jpg";
            img.style.border = "none";
        }
        function PlantillaPlantas_encendido(enlace) {
            let img = document.querySelector("#Plantas");  
            img.src = "img/Plantilla_Plantas_funcion.jpg";
        }
        function PlantillaPlantas_apagado(enlace) {
            let img = document.querySelector("#Plantas");
            img.src = "img/Educacionplantasflores.webp";
            img.style.border = "none";
        }
    </script>
</head>
<body>
    <main>
        <div id="contenedorPrincipal">
            <div id="sectionIzquierda">
                <div class="itemsSection">
                    <img src="img/imgTableros.png" alt="imagen tablero">
                    <a href="tableros.html"><b>Tableros</b></a>
                </div>
                <div class="itemsSection">
                    <img src="img/imgPlantillas.png" alt="imagen tablero">
                    <a href="plantillas.html"><b>Plantillas</b></a>
                </div>
                <div class="itemsSection">
                    <img src="img/imgInicio.png" alt="imagen tablero">
                    <a href="index.html"><b>Inicio</b></a>
                </div>
                <div class="lineaDivisoria"></div>
                <p>Espacios de Trabajo</p>
                <div class="itemsSection">
                    <img src="img/imgMiembros.png" alt="imagen tablero">
                    <a href="board.html"><b>Board</b></a>
                </div>
                <p>Personalizar Plantillas</p>
                <div class="itemsSection">
                    <img src="img/imgMiembros.png" alt="imagen tablero">
                    <a href="formPlantilla.html"><b>Personalizar</b></a>
                </div>
            </div>
            <section class="sectionDerecha">
                <div class="categoriasDestacadas">
                    <h2 class="titulo">Categorías Destacadas</h2>
                    <div class="contenidoCategoriaDestacadas">
                        <figure>
                            <img id="Negocio" src="/mvc/assets/images/icononegocio.png" alt="imagen Negocio">
                            <figcaption>Negocio</figcaption>
                        </figure>
                        <figure>
                            <img class="Diseño" src="img/iconodiseño.png" alt="imagen Diseño">
                            <figcaption>Diseño</figcaption>
                        </figure>
                        <figure>
                            <img class="Educacion" src="img/iconoeducacion.png" alt="imagen Educacion">
                            <figcaption>Educacion</figcaption>
                        </figure>
                        <figure>
                            <img class="Marketing" src="img/iconomarketing.png" alt="imagen Marketing">
                            <figcaption>Marketing</figcaption>
                        </figure>
                        <figure>
                            <img class="Remote work" src="img/iconotrabajoremoto.png" alt="imagen Remote work">
                            <figcaption>Trabajo Remoto</figcaption>
                        </figure>
                    </div>
                </div>
                <div class="Educacion">
                    <h2>Educacion</h2> 
                    <div class="contenidoEducacion">
                        <div>
                            <figure>
                                <img id="LibrosapiladosEducacion" src="img/eduacionlibrosaplidados.jpg" onmouseenter="PlantillaLibros_encendido(this)" onmouseout="PlantillaLibros_apagado(this)" alt="LibrosapiladosEducacion">
                                <figcaption>PLantilla Libros</figcaption>
                            </figure>
                            <p>Por Kelly Theisen, profesora asistente de química Manténgase organizado en un entorno de aprendizaje</p>    
                        </div>
                        <div>
                            <figure>
                                <img id="Medicina" src="img/Educacionmedicina.jpg" onmouseenter="PlantillaMedicina_encendido(this)" onmouseout="PlantillaMedicina_apagado(this)" alt="Medicina">
                                <figcaption>PLantilla Medicina</figcaption>
                            </figure>
                            <p>Por lisiis, profesora asistente de química Manténgase organizado en un entorno de aprendizaje remoto</p>    
                        </div>
                        <div>
                            <figure>
                                <img id="Plantas" src="img/Educacionplantasflores.webp" onmouseenter="PlantillaPlantas_encendido(this)" onmouseout="PlantillaPlantas_apagado(this)" alt="Plantas">
                                <figcaption>PLantilla Plantas</figcaption>
                            </figure>
                            <p>Por ass, profesora asistente de química Manténgase organizado en un entorno de aprendizaje remoto</p>    
                        </div>
                    </div>
                </div>
            </section>
        </div>
    </main>
</body>

