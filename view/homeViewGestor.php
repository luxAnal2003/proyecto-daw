<?php require_once HEADER; ?>
<style>
    .container {
        margin-top: 30px;
        margin-bottom: 30px;
    }
    
    h3 {
        color: #274C77;
    }
    .proyecto-tarjeta, .plantillaDeshabilitada {
        background-color: #E7ECEF;
        width: 300px;
        padding: 20px;
        border-radius: 5px;
        margin-bottom: 20px;
        display: flex;
        align-items: center;
        justify-content: justify;
        box-shadow: 0 4px 8px rgba(0,0,0,0.1);
    }

    .proyecto-tarjeta p {
        font-size: 16px;
        margin-bottom: 10px;
    }

    .proyecto-tarjeta .descripcion {
        white-space: nowrap;
        overflow: hidden;
        text-overflow: ellipsis;
        max-height: 60px;
    }

    .proyecto-tarjeta .autor {
        font-size: 14px;
        font-weight: bold;
        margin-top: 10px;
    }

    .plantillas, .plantillaDeshabilitada {
        display: flex;
        gap: 20px;
        flex-wrap: wrap;
    }

    .plantillaDeshabilitada {
        align-items: center;
        justify-content: center;
        border-radius: 5px;
        font-size: 16px;
        color: white;
    }

    .plantillaDeshabilitada:hover {
        background-color: #ccc;
        transition: 0.1s;
    }
    </style>
<div class="container mt-4">
    <div>
        <div class="row">
            <div class="col-sm-6">
                <h3 class="mb-4">Proyectos disponibles</h3>
            </div>
            <div class="col-sm-6 d-flex justify-content-end">
                <a href="index.php?c=Proyectos&f=view_new"> 
                    <button type="button" class="btn btn-secondary">
                        <i class="fas fa-plus"></i> 
                        Nuevo Proyecto
                    </button>
                </a>
            </div>
        </div>

        <div class="plantillas">
            <?php foreach ($resultados as $proyecto) { ?>
                <div class="proyecto-tarjeta">
                    <p><?= $proyecto->nombre ?></p>
                </div>
            <?php } ?>
        </div>
    </div>
    <div>
        <div class="row">
            <div class="col-sm-6">
                <h3 class="mb-4">Tareas creadas</h3>
            </div>
            <div class="col-sm-6 d-flex justify-content-end">
                <a href="index.php?c=Tareas&f=view_new"> 
                    <button type="button" class="btn btn-secondary">
                        <i class="fas fa-plus"></i> 
                            Añadir nueva tarea
                    </button>
                </a>
            </div>
        </div>
        <div class="plantillas">
            <?php foreach ($tareas as $tarea) { ?>
                <div class="proyecto-tarjeta">
                    <p><?= $tarea->nombre ?></p>
                </div>
            <?php } ?>
        </div>
    </div>        
</div>
<?php require_once FOOTER; ?>
