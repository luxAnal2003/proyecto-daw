<!-- autor: Eliud -->
<?php require_once HEADER; 
    // Verificar si el usuario tiene permiso para ver esta página
    if (isset($_SESSION['usuario_id'])) {
        if ($_SESSION['usuario_rol'] != 2) {
            $_SESSION['mensaje'] = 'No tienes permiso para acceder a esta página.';
            $_SESSION['color'] = 'danger';
            header("Location: index.php?c=Index&f=index");
            exit();
        }
    } else {
        // Redirigir a la página de inicio si no hay usuario en sesión
        $_SESSION['mensaje'] = 'Debes iniciar sesión para acceder a esta página.';
        $_SESSION['color'] = 'danger';
        header("Location: index.php?c=Index&f=index");
        exit();
    }
?>

<style>
    .container {
        font-family: 'Arial', sans-serif;
    }

    .centro{
        text-align: center;
    }

    h2 {
        color: #343a40;
    }

    .btn-secondary {
        background-color: #274C77;
        border: none;
    }

    .btn-secondary:hover {
        background-color: #6096BA;
    }

    .btn-warning {
        background-color: #ffc107;
        border: none;
    }

    .btn-warning:hover {
        background-color: #e0a800;
    }

    .btn-danger {
        background-color: #dc3545;
        border: none;
    }

    .btn-danger:hover {
        background-color: #c82333;
    }

    .table-dark th {
        background-color: #274C77;
        color: white;
    }

</style>
<div class="container mt-4">
    <h2 class="mb-4"><?php echo $titulo; ?></h2>
    <div class="row">
        <div class="col-sm-6">
            <form action="index.php?c=tareas&f=search" method="POST" class="input-group">
                <input type="text" name="b" id="busqueda" placeholder="Buscar..." class="form-control"/>
                <button type="submit" class="btn btn-secondary"><i class="fas fa-search"></i> Buscar</button>
            </form>       
        </div>
        <div class="col-sm-6 text-end">
            <a href="index.php?c=tareas&f=view_new">
                <button type="button" class="btn btn-secondary">
                    <i class="fas fa-plus"></i> 
                        Nuevo
                </button>
            </a>
        </div>
    </div>
        <table class="table mt-4">
            <thead class="table-dark">
                <tr>
                    <th>Nombre</th>
                    <th>Descripción</th>
                    <th>Estado</th>
                    <th>Prioridad</th>
                    <th>Tiempo</th>
                    <th class="centro">Acciones</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($resultados as $fila) { ?>
                <tr>
                    <td><?php echo $fila['nombre']; ?></td>
                    <td><?php echo $fila['descripcion']; ?></td>
                    <td><?php echo $fila['estado']; ?></td>
                    <td><?php echo $fila['prioridad']; ?></td>
                    <td><?php echo $fila['tiempo_estimado']; ?></td>
                    <td class="centro">
                        <a class="btn btn-warning btn-sm me-2" href="index.php?c=tareas&f=view_edit&id=<?php echo $fila['id']; ?>">
                            <i class="fas fa-edit"></i>Editar
                        </a>
                        <a class="btn btn-danger btn-sm" onclick="return confirm('¿Está seguro de eliminar la tarea?');" href="index.php?c=tareas&f=delete&id=<?php echo $fila['id']; ?>">
                            <i class="fas fa-trash-alt"></i>Eliminar
                        </a>
                    </td>
                </tr>
                <?php } ?>
            </tbody>
        </table>
</div>

<?php require_once FOOTER; ?>

