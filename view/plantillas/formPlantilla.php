
    <style>
        /* Estilos por Eliud Robalino*/
         #contenedorPrincipalForm {
            background: #ffffff;
            width: 80%;
            max-width: 800px;
            margin: 20px auto;
            padding: 30px;
            box-shadow: 0 0 20px rgba(0, 0, 0, 0.1);
            border-radius: 10px;
        }

        #encabezado h2 {
            text-align: center;
            margin-bottom: 20px;
        }

        label {
            margin-bottom: 5px;
            font-weight: bold;
        }

        main {
            background-color: #E7ECEF;
            background-size: cover;
            background-position: center;
            background-repeat: no-repeat;
            min-height: 75vh;
            display: flex;
            justify-content: center;
            align-items: center;
            width: 100%;
        }

        #formularios input,textarea,select {
            width: 100%;
            padding: 10px;
            margin-bottom: 10px;
            margin-top: 10px;
            border: 1px solid #e0e0e0;
            border-radius: 5px;
            box-sizing: border-box;
            font-size: 14px;
        }

        .mensajeError{
        color:rgb(255, 0, 0);
        font-size: 9px;
        }

        input[type="button"],input[type="submit"] {
            margin-top: 10px;
            background-color: #A3CEF1;
            color: white;
            border: none;
            padding: 10px 20px;
            text-align: center;
            font-size: 14px;
            border-radius: 5px;
            cursor: pointer;

        }

        input[type="button"]:hover, input[type="submit"]:hover {
            background-color: #274C77;
        }
        
    </style>
</head>

    <main>
        
        <div id="contenedorPrincipalForm">
            <div id="encabezado">
                <header>
                    <h2>Creacion de Plantilla</h2>
                </header>
            </div>
            <div id="contenedorContenido">
                <hr>
    
                <div class="formularios">
                    <form id="formCreacion" name="formCreacion">
                        <div>
                            <label>Creado por:</label><br>
                            <input type="text" name="nombre" id="nombre">
                        </div>
                        <div>
                            <label>Nombre del Proyecto:</label><br>
                            <input type="text" name="proyecto" id="proyecto">
                        </div>
                        <div>
                            <label>Descripcion de la Plantilla</label> <br>
                            <textarea class="form-control formItem" id="texto" rows="4" cols="50"></textarea>
                        </div>
                        <div>
                            <label>Visibilidad:</label><br>
                            <input class="Visibilidad" id="Priv" type="radio" name="Visibilidad" value="Privado">Privado
                            <input class="Visibilidad" id="Publi" type="radio" name="Visibilidad" value="Publico">Publico
                        </div>
                        <div>
                            <label>Categorias:</label><br>
                            <select name="Categoria" id="Categoria" class="formItem">
                                <option value="0">Seleccione..</option>
                                <option value="1">Negocio</option>
                                <option value="2">Diseño</option>
                                <option value="3">Educacion</option>
                                <option value="4">Marketing</option>
                                <option value="5">Trabajo Remoto</option>
                                <option value="6">Otro</option>
                            </select>
                        </div>
                        <div>
                            <input type="checkbox" name="Terminos" value="1" id="Terminos" class="formItem sus"> 
                            <label>Acepto los términos y condiciones</label> 
                        </div> 

                        <input type="button" value="Volver" onclick="Volver()">
                        <input type="submit" value="Crear">
                    </form>
                </div>
    
            </div>
        </div>
    </main>

    <script>
        let form = document.getElementById("formCreacion"); 
        form.addEventListener("submit", validar);

        function validar(event) {
            event.preventDefault();
            limpiarMensajes();
            
            var letra = /^[a-z ,.'-]+$/i;
            let txtNombre = form.nombre.value;
            let txtProyecto = form.proyecto.value;
            let radiosVisibilidad = document.querySelectorAll('input[name="Visibilidad"]');
            let SelectCategoria = form.Categoria.value; 
            let Terminos = form.Terminos.checked;

            let valido = true;

            if (txtNombre === "" || !letra.test(txtNombre)) {
                valido = false;
                Mensaje("*Debe ingresar su nombre correctamente", form.nombre);
            } else if (txtNombre.length > 20) {
                valido = false;
                Mensaje("*Nombre máximo 20 caracteres", form.nombre);
            } 

            if (txtProyecto === "") {
                valido = false;
                Mensaje("*El Nombre del proyecto no puede estar vacío", form.proyecto);
            } else if (txtProyecto.length > 20) {
                valido = false;
                Mensaje("*Nombre del proyecto máximo 20 caracteres", form.proyecto);
            }

            // validación de botones de radio
            let visibilidadSeleccionada = false;
            for (let i = 0; i < radiosVisibilidad.length; i++) {
                if (radiosVisibilidad[i].checked) {
                    visibilidadSeleccionada = true;
                    break;
                }
            }
            if (!visibilidadSeleccionada) {
                valido = false;
                Mensaje("*Debe seleccionar la visibilidad", radiosVisibilidad[0]);
            }

            // validación de select
            if (SelectCategoria === null || SelectCategoria === '0') { 
                valido = false;
                Mensaje("*Debe seleccionar la categoría", form.Categoria);
            }

            // validación de checkbox de términos y condiciones
            if (!Terminos) {
                valido = false;
                Mensaje("*Debe aceptar los términos y condiciones", form.Terminos);
            }

            if (valido) {
                form.submit();
            }
        }

        function Volver() {
            window.location.href = 'plantillas.php'; 
        }
        
        function Mensaje(cadenaMensaje, elemento) {
            var nodoMensaje = document.createElement("span");
            nodoMensaje.textContent = cadenaMensaje;
            nodoMensaje.className = "mensajeError";
            elemento.parentNode.appendChild(nodoMensaje);
        }   

        function limpiarMensajes() {
            var mensajes = document.querySelectorAll(".mensajeError"); 
            for (let i = 0; i < mensajes.length; i++) {
                mensajes[i].remove(); 
            }
        }
    </script>

</body>
</html>
