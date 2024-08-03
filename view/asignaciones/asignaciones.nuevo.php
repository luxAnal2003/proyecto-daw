<!-- nuevo.php -->
<?php require_once HEADER; ?>

<div class="container">
    <h2><?php echo $titulo; ?></h2>
    <div class="card card-body">
        <form action="index.php?c=Asignaciones&f=new" method="POST">
            <div class="form-group">
                <label for="proyecto">Proyecto</label>
                <select class="form-control" id="proyecto" name="proyecto" onchange="cargarTareas()">
                    <option value="">Seleccione un proyecto</option>
                    <?php foreach ($proyectos as $proyecto) { ?>
                        <option value="<?php echo $proyecto->id; ?>"><?php echo $proyecto->nombre; ?></option>
                    <?php } ?>
                </select>
            </div>

            <div class="form-group">
                <label for="tarea">Tarea</label>
                <select class="form-control" id="tarea" name="tarea">
                    <option value="">Seleccione una tarea</option>
                    <!-- Las opciones se llenarán dinámicamente -->
                </select>
            </div>

            <div class="form-group">
                <label for="usuario">Usuario</label>
                <select class="form-control" id="usuario" name="usuario">
                    <option value="">Seleccione un usuario</option>
                    <?php foreach ($usuarios as $usuario) { ?>
                        <option value="<?php echo $usuario->id; ?>"><?php echo $usuario->nombre; ?></option>
                    <?php } ?>
                </select>
            </div>

            <button type="submit" class="btn btn-primary">Guardar</button>
            <a href="index.php?c=Asignaciones&f=index" class="btn btn-secondary">Cancelar</a>
        </form>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        var form = document.querySelector('form');
        form.addEventListener('submit', function (event) {
            var proyecto = document.getElementById('proyecto').value;
            var tarea = document.getElementById('tarea').value;
            var usuario = document.getElementById('usuario').value;

            if (!proyecto) {
                alert('Debe seleccionar un proyecto.');
                event.preventDefault(); // Evita que el formulario se envíe
                return;
            }

            if (!tarea) {
                alert('Debe seleccionar una tarea.');
                event.preventDefault(); // Evita que el formulario se envíe
                return;
            }

            if (!usuario) {
                alert('Debe seleccionar un usuario.');
                event.preventDefault(); // Evita que el formulario se envíe
                return;
            }
        });
    });
    function cargarTareas() {
        var proyectoId = document.getElementById('proyecto').value;
        var tareaSelect = document.getElementById('tarea');

        // Limpiar las tareas actuales
        tareaSelect.innerHTML = '<option value="">Seleccione una tarea</option>';

        if (proyectoId) {
            var xhr = new XMLHttpRequest();
            xhr.open('POST', 'index.php?c=Asignaciones&f=getTareasPorProyecto', true);
            xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
            xhr.onload = function () {
                if (xhr.status === 200) {
                    var tareas = JSON.parse(xhr.responseText);
                    tareas.forEach(function (tarea) {
                        var option = document.createElement('option');
                        option.value = tarea.id;
                        option.textContent = tarea.nombre;
                        tareaSelect.appendChild(option);
                    });
                }
            };
            xhr.send('proyecto_id=' + proyectoId);
        }
    }
</script>

<?php require_once FOOTER; ?>
