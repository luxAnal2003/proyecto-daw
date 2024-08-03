<!-- autor: Luccy Sanchez Albarracin -->
<?php require_once HEADER; ?>

<div class="container">
    <h2><?php echo htmlspecialchars($titulo); ?></h2>
    <div class="row">
        <div class="col-sm-6">
            <form action="index.php?c=asignaciones&f=search" method="POST">
                <input type="text" name="b" id="form-control" placeholder="buscar..."/>
                <button type="submit" class="btn btn-primary"><i class="fas fa-search"></i>Buscar</button>
            </form>       
        </div>
        <div class="col-sm-6 d-flex flex-column align-items-end">
            <a href="index.php?c=Asignaciones&f=view_new"> 
                <button type="button" class="btn btn-primary">
                    <i class="fas fa-plus"></i> 
                        Nuevo
                </button>
            </a>
        </div>
    </div>
    <div class="table-responsive mt-2">
        <table class="table table-striped table-bordered">
            <thead class="thead-dark">
                <tr>
                    <th>Tarea</th>
                    <th>Empleado</th>
                    <th>Gestor</th>
                    <th>Fecha de Asignación</th>
                    <th>Estado</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody class="tabladatos">
                <?php foreach ($resultados as $fila) { ?>
                <tr>
                    <td><?php echo htmlspecialchars($fila->tarea_nombre); ?></td>
                    <td><?php echo htmlspecialchars($fila->usuario_nombre); ?></td>
                    <td><?php echo htmlspecialchars($fila->gestor_nombre); ?></td>
                    <td><?php echo htmlspecialchars($fila->fecha_asignacion); ?></td>
                    <td><?php echo htmlspecialchars($fila->estado); ?></td>
                    <td>
                        <a class="btn btn-primary" 
                           href="index.php?c=asignaciones&f=view_edit&id=<?php echo htmlspecialchars($fila->id); ?>">
                            <i class="fas fa-marker"></i>
                        </a>
                        <a class="btn btn-danger" 
                           onclick="if(!confirm('¿Está seguro de eliminar la asignación?')) return false;" 
                           href="index.php?c=asignaciones&f=delete&id=<?php echo htmlspecialchars($fila->id); ?>">
                           <i class="fas fa-trash-alt"></i>
                        </a>
                    </td>
                </tr>
                <?php } ?>
            </tbody>
        </table>
    </div>
</div>

<?php require_once FOOTER; ?>

