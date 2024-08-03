<!-- incluimos  Encabezado -->
<?php require_once HEADER; ?>

<div class="container">
    <h2><?php echo $titulo?></h2>
    <div class="card card-body">
        <form action="index.php?c=tareas&f=new" method="POST" name="formTareaNuevo" id="formTareaNuevo">
            <div class="form-row">
                <div class="form-group col-sm-6">
                    <label for="nombre">Nombre</label>
                    <input type="text" name="nombre" id="nombre" class="form-control" placeholder="nombre tarea" required>
                </div>

                <div class="form-group col-sm-6">
                    <label for="descripcion">Descripcion</label>
                    <input type="text" name="descripcion" id="descripcion" class="form-control" placeholder="Descripcion tarea" required>
                </div>          

                <div class="form-group col-sm-12">
                    <input type="checkbox" id="estado" name="estado">
                    <label for="estado">Activo</label>
                </div>

                <div class="form-group col-sm-6">
                    <label for="prioridad">Prioridad</label>
                    <input type="text" name="prioridad" id="prioridad" class="form-control" placeholder="prioridad tarea" required>
                </div>  

                <div class="form-group col-sm-6">
                    <label for="tiempo">Tiempo Estimado</label>
                    <input type="text" name="tiempo" id="tiempo" class="form-control" placeholder="Tiempo Estimado" required>
                </div> 

                <div class="form-group mx-auto">
                    <button type="submit" class="btn btn-primary">Guardar</button>
                    <a href="index.php?c=tareas&f=index" class="btn btn-primary">Cancelar</a>
                </div>
            </div>  
        </form>
    </div>
</div>


<!-- incluimos  pie de pagina -->
<?php require_once FOOTER; ?>