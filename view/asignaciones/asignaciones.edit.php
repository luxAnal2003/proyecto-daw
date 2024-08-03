<!-- view_edit_assignment.php -->
<?php require_once HEADER; ?>

<div class="container">
    <h2><?php echo $titulo; ?></h2>
    <div class="card card-body">
        <form action="index.php?c=asignaciones&f=edit" method="POST" name="formEditAsignacion" id="formEditAsignacion">
            <input type="hidden" name="id" id="id" value="<?php echo $asignacion->id; ?>"/>
            <div class="form-row">
                <div class="form-group col-sm-6">
                    <label for="tarea">Tarea</label>
                    <input type="text" name="tarea" id="tarea" value="<?php echo $asignacion->tarea_nombre; ?>" class="form-control" placeholder="Descripción de la tarea" required>
                </div>
                <div class="form-group col-sm-6">
                    <label for="usuario">Usuario</label>
                    <select id="usuario" name="usuario" class="form-control">
                        <?php foreach ($usuarios as $usuario) {
                            $selected = ($usuario->id == $asignacion->usuario_id) ? 'selected' : '';
                        ?>
                        <option value="<?php echo $usuario->id; ?>" <?php echo $selected; ?>>
                            <?php echo $usuario->nombre; ?>
                        </option>
                        <?php } ?>
                    </select>
                </div>
                <div class="form-group mx-auto">
                    <button type="submit" class="btn btn-primary" onclick="if (!confirm('¿Está seguro de modificar la asignación?')) return false;">Guardar</button>
                    <a href="index.php?c=asignaciones&f=index" class="btn btn-primary">Cancelar</a>
                </div>
            </div>
        </form>
    </div>
</div>

<?php require_once FOOTER; ?>
