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
</style>
<div class="container">
    <h2><?php echo $titulo; ?></h2>
    <div class="card card-body">
        <form action="index.php?c=Proyectos&f=edit" method="POST">
            <input type="hidden" name="id" value="<?php echo $proyecto->id; ?>"/>
            <div class="form-group">
                <label for="nombre">Nombre del Proyecto</label>
                <input type="text" class="form-control" id="nombre" name="nombre" value="<?php echo $proyecto->nombre; ?>" required>
            </div>
            <div class="form-group">
                <label for="descripcion">Descripción del Proyecto</label>
                <textarea class="form-control" id="descripcion" name="descripcion" required><?php echo $proyecto->descripcion; ?></textarea>
            </div>
            <button type="submit" class="btn btn-primary">Guardar</button>
            <a href="index.php?c=Proyectos&f=index" class="btn btn-secondary">Cancelar</a>
        </form>
    </div>
</div>

<?php require_once FOOTER; ?>