<!--autor: Sanchez Albarracin Luccy-->
<?php require_once HEADER; ?>

<div class="container">
    <h2><?php echo $titulo; ?></h2>
    <div class="card card-body">
        <form action="index.php?c=asignaciones&f=edit" method="POST" name="formEditAsignacion" id="formEditAsignacion">
            <input type="hidden" name="id" id="id" value="<?php echo $asignacion->id; ?>"/>
            <div class="form-row">
                <div class="form-group col-sm-6">
                    <label for="tarea_id">Tarea</label>
                    <select id="tarea_id" name="tarea_id" class="form-control">
                        <?php foreach ($tareas as $tarea) {
                            $selected = ($tarea['id'] == $asignacion->tarea_id) ? 'selected' : '';
                        ?>
                        <option value="<?php echo $tarea['id']; ?>" <?php echo $selected; ?>>
                            <?php echo $tarea['nombre']; ?>
                        </option>
                        <?php } ?>
                    </select>
                </div>
                <div class="form-group col-sm-6">
                    <label for="usuario_id">Usuario</label>
                    <select id="usuario_id" name="usuario_id" class="form-control">
                        <?php foreach ($usuarios as $usuario) {
                            $selected = ($usuario->id == $asignacion->usuario_id) ? 'selected' : '';
                        ?>
                        <option value="<?php echo $usuario->id; ?>" <?php echo $selected; ?>>
                            <?php echo $usuario->nombre; ?>
                        </option>
                        <?php } ?>
                    </select>
                </div>
            
                <div class="form-group col-sm-6">
                    <label for="estado">Estado</label>
                    <select id="estado" name="estado" class="form-control">
                        <?php foreach ([['id' => 0, 'nombre' => 'Inactivo'], ['id' => 1, 'nombre' => 'Activo']] as $estado) {
                            $selected = ($estado['id'] == $asignacion->estado) ? 'selected' : '';
                        ?>
                        <option value="<?php echo $estado['id']; ?>" <?php echo $selected; ?>>
                            <?php echo $estado['nombre']; ?>
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
