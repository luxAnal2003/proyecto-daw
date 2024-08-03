<!-- incluimos  Encabezado -->
<?php require_once HEADER; ?>

<div class="container">
<h2> <?php echo $titulo?></h2>
    <div class="card card-body">
    
        <form action="index.php?c=tareas&f=edit" method="POST" name="formProdNuevo" id="formProdNuevo">
        
        <input type="hidden" name="id" id="id" value="<?php echo $tareas['tareas_id']; ?>"/>
            <div class="form-row">
               <div class="form-group col-sm-6">
                    <label for="nombre">Nombre</label>
                    <input type="text" name="nombre" id="nombre" value="<?php echo $tareas['tareas_nombre']; ?>" class="form-control" placeholder="nombre tarea" required>
                </div>

                <div class="form-group col-sm-6">
                    <label for="nombre">Descripcion</label>
                    <input type="text" name="descripcion" id="descripcion" value="<?php echo $tareas['tareas_descripcion']; ?>" class="form-control" placeholder="descripcion tarea" required>
                </div>

                <div class="form-group col-sm-12">
                    <input type="checkbox" id="estado" value="<?php echo $tareas['tareas_estado']?>" 
                           name="estado"  <?php echo ($tareas['tareas_estado'] == 1)?'checked="checked"':''; ?> >
                    
                    <label for="estado">Activo</label>
                </div>

                <div class="form-group col-sm-6">
                    <label for="precio">Prioridad</label>
                    <input type="text" name="prioridad" id="prioridad" value="<?php echo $tareas['tareas_prioridad']; ?>" class="form-control" placeholder="precio producto" required>
                </div>          

                <div class="form-group col-sm-6">
                    <label for="nombre">Tiempo estimado</label>
                    <input type="text" name="estimado" id="estimado" value="<?php echo $tareas['tiempo_estimado']; ?>" class="form-control" placeholder="descripcion tarea" required>
                </div>
                
                <div class="form-group mx-auto">
                    <button type="submit" class="btn btn-primary"
                     onclick="if (!confirm('Esta seguro de modificar el producto?')) return false;" >Guardar</button>
                    <a href="index.php?c=tareas&f=index" class="btn btn-primary">Cancelar</a>
                </div>
                    
            </div>  
        </form>
    </div>
</div>

<!-- incluimos  pie de pagina -->
<?php require_once FOOTER; ?>
