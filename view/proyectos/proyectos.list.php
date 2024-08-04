<!--autor: Sanchez Albarracin Luccy-->
<?php require_once HEADER; ?>

<div class="container">
    <h2><?php echo $titulo; ?></h2>
    <?php if (isset($_SESSION['mensaje'])) { ?>
        <div class="alert alert-<?php echo $_SESSION['color']; ?>">
            <?php echo $_SESSION['mensaje']; ?>
            <?php unset($_SESSION['mensaje']); ?>
        </div>
    <?php } ?>
    <a href="index.php?c=Proyectos&f=view_new" class="btn btn-primary">Nuevo Proyecto</a>
    <table class="table mt-4">
        <thead>
            <tr>
                <th>Nombre</th>
                <th>Descripción</th>
                <th>Gestor</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($resultados as $proyecto) { ?>
                <tr>
                    <td><?= $proyecto->nombre ?></td>
                    <td><?= $proyecto->descripcion ?></td>
                    <td><?= $proyecto->usuario_creacion ?></td>
                    <td>
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
