<!-- incluimos  Encabezado -->
<?php require_once HEADER; ?>
<style>
    .container {
        font-family: 'Arial', sans-serif;
    }

    h2 {
        color: #343a40;
    }

    .card-body {
        background-color: #f8f9fa;
        border-radius: 10px;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        padding: 20px;
    }

    .form-group label {
        font-weight: bold;
        color: #495057;
    }

    .form-control {
        border-radius: 5px;
        border: 1px solid #ced4da;
    }

    .form-check-label {
        margin-left: 10px;
        color: #495057;
    }

    .btn-primary {
        background-color: #274C77;
        border: none;
    }

    .btn-primary:hover {
        background-color: #6096BA;
    }

    .btn-secondary {
        background-color: #6c757d;
        border: none;
    }

    .btn-secondary:hover {
        background-color: #5a6268;
    }

    .text-center {
        text-align: center;
    }

    .me-2 {
        margin-right: 8px;
    }

    .mensajeError{
        color:rgb(255, 0, 0);
        font-size: 9px;
        }

</style>

<div class="container mt-4 mb-4">
    <h2 class="mb-4 text-center"><?php echo $titulo; ?></h2>
    <div class="card card-body">
        <form action="index.php?c=tareas&f=new" method="POST" name="formTareaNuevo" id="formTareaNuevo">
            <div class="form-group">
                <label for="proyecto">Proyecto</label>
                <select class="form-control" id="proyecto" name="proyecto_id">
                    <option value="">Seleccione un proyecto</option>
                    <?php foreach ($proyectos as $proyecto) { ?>
                        <option value="<?php echo $proyecto->id; ?>"><?php echo $proyecto->nombre; ?></option>
                    <?php } ?>
                </select>
            </div>
            <div class="form-group mb-3">
                <label for="nombre">Nombre</label>
                <input type="text" name="nombre" id="nombre" class="form-control" placeholder="Nombre de la tarea" required>
            </div>
            <div class="form-group mb-3">
                <label for="descripcion">Descripción</label>
                <input type="text" name="descripcion" id="descripcion" class="form-control" placeholder="Descripción de la tarea" required>
            </div>
            <div class="form-group mb-3">
                <label for="prioridad">Prioridad</label>
                <select name="prioridad" id="prioridad" class="form-control" required>
                    <option value="Baja">Baja</option>
                    <option value="Media">Media</option>
                    <option value="Alta">Alta</option>
                </select>
            </div>
            <div class="form-group mb-3">
                <label for="tiempo">Tiempo Estimado</label>
                <input type="text" name="tiempo_estimado" id="tiempo_estimado" class="form-control" placeholder="Tiempo Estimado" required>
            </div>
            <div class="form-group mb-3">
                <div class="form-check">
                    <input type="checkbox" class="form-check-input" id="estado" name="estado" value="1">
                    <label for="estado" class="form-check-label">Activo</label>
                </div>
            </div>
            <div class="form-group text-center mt-4">
                <button type="submit" class="btn btn-primary">Guardar</button>
                <a href="index.php?c=tareas&f=index" class="btn btn-secondary">Cancelar</a>
            </div>
        </form>
    </div>
</div>



<script>
    let form = document.getElementById("formTareaNuevo");
    form.addEventListener("submit", validar);

    function validar(event) {
        event.preventDefault();
        limpiarMensajes();
        
        var letra = /^[a-z ,.'-]+$/i;
        let txtNombre = form.nombre.value;
        let txtDescripcion = form.descripcion.value;
        let selectPrioridad = form.prioridad.value;
        let txtTiempo = form.tiempo_estimado.value;
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
            Mensaje("*Debe ingresar un tiempo estimado válido (ej: 1 hora, 2 días)", form.tiempo_estimado);
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




<!-- incluimos  pie de pagina -->
<?php require_once FOOTER; ?>