<!--autor: Sanchez Albarracin Luccy-->
<?php require_once HEADER; ?>
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

    .table-striped tbody tr:nth-of-type(odd) {
        background-color: #f8f9fa;
    }

    .table-hover tbody tr:hover {
        background-color: #e9ecef;
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
            <form action="index.php?c=asignaciones&f=search" method="POST" class="input-group">
                <input type="text" name="b" id="busqueda" placeholder="Buscar..." class="form-control"/>
                <button type="submit" class="btn btn-secondary"><i class="fas fa-search"></i> Buscar</button>
            </form>     
        </div>
        <div class="col-sm-6 text-end">
            <a href="index.php?c=Asignaciones&f=view_new"> 
                <button type="button" class="btn btn-secondary">
                    <i class="fas fa-plus"></i> 
                        Nuevo
                </button>
            </a>
        </div>
    </div>
    <div class="table-responsive mt-2">
        <table class="table table-striped table-hover">
            <thead class="table-dark">
                <tr>
                    <th>Tarea</th>
                    <th>Empleado</th>
                    <th>Gestor</th>
                    <th>Fecha de Asignación</th>
                    <th class="centro">Estado</th>
                    <th class="centro">Acciones</th>
                </tr>
            </thead>
            <tbody class="tabladatos">
                <?php foreach ($resultados as $fila) { ?>
                <tr>
                    <td><?php echo htmlspecialchars($fila->tarea_nombre); ?></td>
                    <td><?php echo htmlspecialchars($fila->usuario_nombre); ?></td>
                    <td><?php echo htmlspecialchars($fila->gestor_nombre); ?></td>
                    <td><?php echo htmlspecialchars($fila->fecha_asignacion); ?></td>
                    <td class="centro"><?php echo htmlspecialchars($fila->estado); ?></td>
                    <td class="centro">
                        <a class="btn btn-warning btn-sm me-2" 
                           href="index.php?c=asignaciones&f=view_edit&id=<?php echo htmlspecialchars($fila->id); ?>">
                            <i class="fas fa-edit"></i> Editar
                        </a>
                        <a class="btn btn-danger btn-sm" 
                           onclick="if(!confirm('¿Está seguro de eliminar la asignación?')) return false;" 
                           href="index.php?c=asignaciones&f=delete&id=<?php echo htmlspecialchars($fila->id); ?>">
                           <i class="fas fa-trash-alt"></i> Eliminar
                        </a>
                    </td>
                </tr>
                <?php } ?>
            </tbody>
        </table>
    </div>
</div>

<?php require_once FOOTER; ?>

