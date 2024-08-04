<!-- incluimos  Encabezado -->
<?php require_once HEADER; ?>

<style>
    .btn-gris {
        background-color: #6c757d;
        border-color: #6c757d;
        color: white;
    }
    .btn-gris:hover {
        background-color: #5a6268;
        border-color: #545b62;
    }
    .container {
        max-width: 800px; 
        margin: 0 auto;
        padding: 0 15px; 
    }
    .cuerpo {
        padding: 20px;
        background-color: #f8f9fa;
        border-radius: 5px;
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
    }
    .mt-5 {
        margin-top: 3rem !important;
    }
    .mb-5 {
        margin-bottom: 3rem !important;
    }

    .mensajeError{
        color:rgb(255, 0, 0);
        font-size: 9px;
        }

</style>


<div class="container mt-5 mb-5">
    <h2><?php echo $titulo ?></h2>
    <div class="card cuerpo">
        <form action="index.php?c=tareas&f=edit" method="POST" name="formProdNuevo" id="formProdNuevo">
            <input type="hidden" name="id" id="id" value="<?php echo $tareas['id']; ?>"/>
            <div class="form-group">
                <label for="nombre">Nombre</label>
                <input type="text" name="nombre" id="nombre" value="<?php echo $tareas['nombre']; ?>" class="form-control" placeholder="Nombre de la tarea" required>
            </div>
            <div class="form-group">
                <label for="descripcion">Descripción</label>
                <input type="text" name="descripcion" id="descripcion" value="<?php echo $tareas['descripcion']; ?>" class="form-control" placeholder="Descripción de la tarea" required>
            </div>
            
            <div class="form-group">
                <label for="prioridad">Prioridad</label>
                <select name="prioridad" id="prioridad" class="form-control" required>
                    <option value="alta" <?php echo ($tareas['prioridad'] == 'alta') ? 'selected' : ''; ?>>Alta</option>
                    <option value="media" <?php echo ($tareas['prioridad'] == 'media') ? 'selected' : ''; ?>>Media</option>
                    <option value="baja" <?php echo ($tareas['prioridad'] == 'baja') ? 'selected' : ''; ?>>Baja</option>
                </select>
            </div>

            <div class="form-group">
                <label for="estimado">Tiempo estimado</label>
                <input type="text" name="estimado" id="estimado" value="<?php echo $tareas['tiempo_estimado']; ?>" class="form-control" placeholder="Tiempo estimado" required>
            </div>

            <div class="form-group form-check">
                <input type="checkbox" id="estado" name="estado" value="1" class="form-check-input" <?php echo ($tareas['estado'] == 1) ? 'checked' : ''; ?>>
                <label for="estado" class="form-check-label">Activo</label>
            </div>

            <div class="form-group text-center">
                <button type="submit" class="btn btn-gris" onclick="if (!confirm('¿Está seguro de modificar la tarea?')) return false;">Guardar</button>
                <a href="index.php?c=tareas&f=index" class="btn btn-gris">Cancelar</a>
            </div>
        </form>
    </div>
</div>

<script>
    let form = document.getElementById("formProdNuevo");
    form.addEventListener("submit", validar);

    function validar(event) {
        event.preventDefault();
        limpiarMensajes();
        
        let letra = /^[a-z ,.'-]+$/i;
        let txtNombre = form.nombre.value;
        let txtDescripcion = form.descripcion.value;
        let selectPrioridad = form.prioridad.value;
        let txtTiempo = form.estimado.value;
        let chkEstado = form.estado.checked;

        let valido = true;

        // Validación del nombre
        if (txtNombre === "") {
            valido = false;
            Mensaje("*Debe ingresar datos", form.nombre);
        }

        // Validación de la descripción
        if (txtDescripcion === "") {
            valido = false;
            Mensaje("*La descripción no puede estar vacía", form.descripcion);
        } else if (txtDescripcion.length > 100) {
            valido = false;
            Mensaje("*Descripción máximo 100 caracteres", form.descripcion);
        }

        // Validación de la prioridad
        if (selectPrioridad === "") {
            valido = false;
            Mensaje("*Debe seleccionar la prioridad", form.prioridad);
        }

        // Validación del tiempo estimado
        if (txtTiempo === "") {
            valido = false;
            Mensaje("*Debe ingresar un tiempo estimado válido (ej: 1 hora, 2 días)", form.estimado);
        }

        // Validación del checkbox de estado
        if (!chkEstado) {
            valido = false;
            Mensaje("*Debe marcar el estado como activo", form.estado);
        }

        if (valido) {
            form.submit();
        }
    }

    function Mensaje(cadenaMensaje, elemento) {
        let nodoMensaje = document.createElement("span");
        nodoMensaje.textContent = cadenaMensaje;
        nodoMensaje.className = "mensajeError";
        elemento.parentNode.appendChild(nodoMensaje);
    }   

    function limpiarMensajes() {
        let mensajes = document.querySelectorAll(".mensajeError"); 
        for (let i = 0; i < mensajes.length; i++) {
            mensajes[i].remove(); 
        }
    }
</script>

<!-- incluimos  pie de pagina -->
<?php require_once FOOTER; ?>
