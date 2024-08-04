<?php require_once HEADER; ?>
<style>
   /* Estilos generales */
    body {
        font-family: Arial, sans-serif;
    }

    /* Tarjetas de tareas */
    .task-card {
        background-color: #fff;
        border-radius: 5px;
        box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
        padding: 20px;
        margin-bottom: 20px;
    }

    .task-title {
        font-weight: bold;
    }

    .task-due-date {
        color: #888;
    }

    .task-status {
        display: inline-block;
        width: 10px;
        height: 10px;
        border-radius: 50%;
        margin-right: 5px;
    }

    /* Estados de las tareas */
    .status-pending {
        background-color: #ffcc00; /* Amarillo */
    }

    .status-in-progress {
        background-color: #4CAF50; /* Verde */
    }

    .status-completed {
        background-color: #999; /* Gris */
    }

    /* Botones */
    .btn {
        border: none;
        padding: 10px 15px;
        border-radius: 3px;
        cursor: pointer;
    }

    .btn-primary {
        background-color: #007bff;
        color: #fff;
    }

    .btn-danger {
        background-color: #dc3545;
        color: #fff;
    }

</style>
<div class="container">
    <div class="task-card">
        <h3 class="task-title">Tareas asignadas</h3>
        <?php foreach ($asignaciones as $tarea) { ?>
            <div class="task-card">
                <h3 class="task-title"><?= $tarea['nombre'] ?></h3>
                <p>La tarea finaliza en: <?= $tarea['tiempo_estimado'] ?></p>
                <p>Estado: <span class="task-status <?= ($tarea['estado'] == 1) ? 'status-pending' : 'status-completed' ?>"></span></p>
                <p>Descripción de la tarea: <?= $tarea['descripcion'] ?></p>
                <form action="index.php?c=tareas&f=updateEstado" method="post">
                    <input type="hidden" name="id" value="<?= $tarea['id'] ?>">
                    <input type="hidden" name="estado" value="0"> 
                    <input type="checkbox" name="estadoCheckbox" <?= $tarea['estado'] == 1 ? 'checked' : '' ?> onchange="this.form.submit()">
                    <label><?= $tarea['estado'] == 1 ? 'Tarea activa' : 'Tarea completada' ?></label>
                </form>
            </div>
        <?php } ?>
    </div>
</div>
<?php require_once FOOTER; ?>
