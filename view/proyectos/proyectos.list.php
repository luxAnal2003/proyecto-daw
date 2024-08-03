<!-- list.php -->
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
                <th>ID</th>
                <th>Nombre</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($resultados as $proyecto) { ?>
                <tr>
                    <td><?php echo $proyecto->id; ?></td>
                    <td><?php echo $proyecto->nombre; ?></td>
                    <td>
                        <a href="index.php?c=Proyectos&f=view_edit&id=<?php echo $proyecto->id; ?>" class="btn btn-warning btn-sm">Editar</a>
                        <a href="index.php?c=Proyectos&f=delete&id=<?php echo $proyecto->id; ?>" class="btn btn-danger btn-sm">Eliminar</a>
                    </td>
                </tr>
            <?php } ?>
        </tbody>
    </table>
</div>

<?php require_once FOOTER; ?>
