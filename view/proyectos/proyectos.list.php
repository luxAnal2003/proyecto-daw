<!--autor: Sanchez Albarracin Luccy-->
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

    .btn-secondary {
        background-color: #274C77;
        border: none;
    }

    .btn-secondary:hover {
        background-color: #6096BA;
    }

    .centro{
        text-align: center;
    }

    h2 {
        color: #343a40;
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
            <form action="index.php?c=Proyectos&f=search" method="POST" class="input-group">
                <input type="text" name="b" id="busqueda" placeholder="Buscar..." class="form-control"/>
                <button type="submit" class="btn btn-secondary"><i class="fas fa-search"></i> Buscar</button>
            </form>     
        </div>
        <div class="col-sm-6 text-end">
            <a href="index.php?c=Proyectos&f=view_new"> 
                <button type="button" class="btn btn-secondary">
                    <i class="fas fa-plus"></i> 
                        Nuevo Proyecto
                </button>
            </a>
        </div>
    </div>
    <table class="table mt-4">
        <thead class="table-dark">
            <tr>
                <th>Nombre</th>
                <th>Descripción</th>
                <th>Gestor</th>
                <th class="centro">Acciones</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($resultados as $proyecto) { ?>
                <tr>
                    <td><?= $proyecto->nombre ?></td>
                    <td><?= $proyecto->descripcion ?></td>
                    <td><?= $proyecto->usuario_creacion ?></td>
                    <td class="centro">
                        <a class="btn btn-warning btn-sm me-2" 
                           href="index.php?c=Proyectos&f=view_edit&id=<?= $proyecto->id ?>">
                            <i class="fas fa-edit"></i> Editar
                        </a>
                        <a class="btn btn-danger btn-sm" 
                           onclick="if(!confirm('¿Está seguro de eliminar la asignación?')) return false;" 
                           href="index.php?c=Proyectos&f=delete&id=<?= $proyecto->id ?>">
                           <i class="fas fa-trash-alt"></i> Eliminar
                        </a>
                    </td>
                </tr>
            <?php } ?>
        </tbody>
    </table>
</div>

<?php require_once FOOTER; ?>
