<!-- nuevo.php -->
<?php require_once HEADER; ?>

<div class="container">
    <h2><?php echo $titulo; ?></h2>
    <div class="card card-body">
        <form action="index.php?c=Proyectos&f=new" method="POST">
            <div class="form-group">
                <label for="nombre">Nombre del Proyecto</label>
                <input type="text" class="form-control" id="nombre" name="nombre" required>
            </div>
            <button type="submit" class="btn btn-primary">Guardar</button>
            <a href="index.php?c=Proyectos&f=index" class="btn btn-secondary">Cancelar</a>
        </form>
    </div>
</div>

<?php require_once FOOTER; ?>
